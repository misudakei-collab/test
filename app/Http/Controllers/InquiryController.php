<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Carbon\Carbon;

class InquiryController extends Controller
{
    // 完了フラグの切り替え
    public function toggleComplete(Inquiry $inquiry)
    {
        $inquiry->is_completed = !$inquiry->is_completed;
        $inquiry->save();

        // 一覧画面で検索中だった場合、その条件を維持して戻る
        return back()->with('success', $inquiry->is_completed ? '対応を完了にしました' : '未完了に戻しました');
    }

    // 日本語フォーム表示
    public function index()
    {
        return view('inquiry.form');
    }

    // 英語フォーム表示
    public function createEn()
    {
        return view('inquiry.form_en');
    }

    // 管理画面一覧
    public function adminIndex(Request $request)
    {
        $query = Inquiry::query();
        $tab = $request->query('tab', 'jp');

        // 1. タブ絞り込み
        if ($tab === 'en') {
            $query->whereNotNull('country');
        } else {
            $query->whereNull('country');
        }

        // 2. 名前検索
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $sort = $request->query('sort', 'created_at');
        $order = $request->query('order', 'desc');

        if (in_array($sort, ['name', 'created_at'])) {
            $query->orderBy($sort, $order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $inquiries = $query->paginate(5);

        return view('admin.inquiries', compact('inquiries', 'tab', 'sort', 'order'));
    }

    // 詳細表示
    public function show(Inquiry $inquiry)
    {
        try {
            if (!$inquiry->is_read) {
                $inquiry->is_read = true;
                $inquiry->save();
            }
        } catch (\Exception $e) {
            \Log::error("既読更新エラー: " . $e->getMessage());
        }

        $age = '未設定';
        if (!empty($inquiry->birthdate)) {
            try {
                $age = Carbon::parse($inquiry->birthdate)->age . '歳';
            } catch (\Exception $e) {
                $age = '不明';
            }
        }

        return view('admin.show', compact('inquiry', 'age'));
    }

    // 削除
    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return redirect()->route('admin.inquiries')->with('success', 'お問い合わせを削除しました。');
    }

    // --- 英語フォーム：確認画面の表示 ---
    public function confirmEn(Request $request)
    {
        $inputs = $request->validate([
            'name'      => 'required|max:100',
            'email'     => 'required|email|max:255',
            'country'   => 'required',
            'gender'    => 'nullable',
            'birthdate' => 'nullable|date',
            'tel'       => 'nullable|numeric',
            'title'     => 'required|max:100',
            'content'   => 'required',
            'terms'     => 'accepted',
        ]);

        return view('inquiry.confirm_en', compact('inputs'));
    }

    // --- 英語フォーム：保存処理 ---
    public function storeEn(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('contact.create.en')->withInput();
        }

        $inquiry = new Inquiry();
        $inquiry->name      = $request->name;
        $inquiry->email     = $request->email;
        $inquiry->country   = $request->country;
        $inquiry->gender    = $request->gender ?? "Other";
        $inquiry->birthdate = $request->birthdate;
        $inquiry->tel       = $request->tel ?? "";
        $inquiry->title     = $request->title;
        $inquiry->content   = $request->content;
        $inquiry->kana      = "";
        $inquiry->is_read      = false;
        $inquiry->is_completed = false;

        $inquiry->save();

        return redirect()->route('contact.create.en')->with('success', 'Thank you! Your message has been sent.');
    }

    // --- 日本語フォーム：確認画面の表示 ---
    public function confirm(Request $request)
    {
        $inputs = $request->validate([
            'name'      => 'required|max:100',
            'kana'      => 'nullable|max:50',
            'email'     => 'required|email|max:255',
            'tel'       => 'nullable|numeric',
            'gender'    => 'nullable',
            'birthdate' => 'nullable|date',
            'title'     => 'required|max:100',
            'content'   => 'required',
            'terms'     => 'accepted',
        ]);

        return view('inquiry.confirm', compact('inputs'));
    }

    // --- 日本語フォーム：保存処理 ---
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('contact.index')->withInput();
        }

        $inquiry = new Inquiry();
        $inquiry->name      = $request->name;
        $inquiry->kana      = $request->kana ?? "";
        $inquiry->email     = $request->email;
        $inquiry->tel       = $request->tel ?? "";
        $inquiry->gender    = $request->gender ?? "未設定";
        $inquiry->birthdate = $request->birthdate;
        $inquiry->title     = $request->title;
        $inquiry->content   = $request->content;

        // 【ここを追加】英語フォーム側と合わせる
        $inquiry->is_read      = false;
        $inquiry->is_completed = false;

        $inquiry->save();

        return redirect()->route('contact.index')->with('success', 'お問い合わせを送信しました！');
    }

    public function exportCsv(Request $request)
    {
        $query = Inquiry::query();
        $tab = $request->query('tab', 'jp');

        // 1. 一覧と同じ検索・絞り込みロジックを適用
        if ($tab === 'en') {
            $query->whereNotNull('country');
        } else {
            $query->whereNull('country');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 2. 並び替えも反映
        $sort = $request->query('sort', 'created_at');
        $order = $request->query('order', 'desc');
        $query->orderBy($sort, $order);

        $inquiries = $query->get();

        // 3. CSV出力の設定
        $filename = "inquiries_" . ($tab === 'en' ? 'english' : 'japanese') . "_" . now()->format('YmdHi') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($inquiries, $tab) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // Excel文字化け防止(BOM)

            // ヘッダー（ステータス項目を追加）
            $columns = ['送信日', '状態', '対応', '名前', 'メールアドレス', '性別', '年齢', '件名', '内容'];
            if ($tab === 'en') $columns[] = 'Country';
            fputcsv($file, $columns);

            // データ行の生成
            foreach ($inquiries as $inquiry) {
                $row = [
                    $inquiry->created_at->format('Y/m/d H:i'),
                    $inquiry->is_read ? '既読' : '未読',
                    $inquiry->is_completed ? '完了' : '未対応',
                    $inquiry->name,
                    $inquiry->email,
                    $inquiry->gender ?? '未設定',
                    $inquiry->birthdate ? \Carbon\Carbon::parse($inquiry->birthdate)->age : '不明',
                    $inquiry->title,
                    $inquiry->content,
                ];
                if ($tab === 'en') $row[] = $inquiry->country;
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportSingleCsv(Inquiry $inquiry)
    {
        // ファイル名に名前を入れると分かりやすい
        $filename = "inquiry_" . $inquiry->name . "_" . $inquiry->created_at->format('Ymd') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($inquiry) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM

            // 縦型のCSV（項目名, 値）にすると詳細資料として見やすくなります
            fputcsv($file, ['項目', '内容']);
            fputcsv($file, ['送信日時', $inquiry->created_at->format('Y/m/d H:i')]);
            fputcsv($file, ['名前', $inquiry->name]);
            if ($inquiry->kana) fputcsv($file, ['フリガナ', $inquiry->kana]);
            fputcsv($file, ['メールアドレス', $inquiry->email]);
            fputcsv($file, ['電話番号', $inquiry->tel]);
            fputcsv($file, ['性別', $inquiry->gender]);
            fputcsv($file, ['年齢', $inquiry->birthdate ? \Carbon\Carbon::parse($inquiry->birthdate)->age . '歳' : '不明']);
            if ($inquiry->country) fputcsv($file, ['国', $inquiry->country]);
            fputcsv($file, ['件名', $inquiry->title]);
            fputcsv($file, ['内容', $inquiry->content]);
            fputcsv($file, ['対応ステータス', $inquiry->is_completed ? '完了' : '未対応']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}

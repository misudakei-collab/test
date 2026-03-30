<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    /**
     * 【表】お問い合わせ入力画面
     */
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    /**
     * 【表】確認画面
     * 送信前にバリデーションを行い、不備があれば入力画面にメッセージ付きで戻します。
     */
    public function confirm(Request $request)
    {
        // 1. バリデーション実行（ここでエラーがあると自動で入力画面に戻ります）
        $request->validate([
            'category_id' => 'required',
            'first_name'  => 'required',
            'last_name'   => 'required',
            'gender'      => 'required',
            'email'       => 'required|email',
            'tel1'        => 'required|numeric|digits_between:1,5',
            'tel2'        => 'required|numeric|digits_between:1,5',
            'tel3'        => 'required|numeric|digits_between:1,5',
            'address'     => 'required',
            'detail'      => 'required|max:120',
        ], [
            // 日本語エラーメッセージの設定
            'required' => ':attributeを入力してください',
            'email'    => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'numeric'  => '電話番号は数値で入力してください',
            'max'      => 'お問合せ内容は120文字以内で入力してください',
        ], [
            // 項目名の日本語化
            'category_id' => 'お問い合わせの種類',
            'first_name'  => '名',
            'last_name'   => '姓',
            'gender'      => '性別',
            'email'       => 'メールアドレス',
            'tel1'        => '電話番号(左)',
            'tel2'        => '電話番号(中)',
            'tel3'        => '電話番号(右)',
            'address'     => '住所',
            'detail'      => 'お問い合わせ内容',
        ]);

        $contact = $request->all();
        return view('confirm', compact('contact'));
    }

    /**
     * 【表】完了処理（保存）
     */
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        $data = $request->all();

        $data['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        Contact::create($data);

        return view('thanks');
    }

    /**
     * 【裏】管理画面：一覧 & 検索
     */
    public function admin(Request $request)
    {
        $query = Contact::with('category');

        // 検索条件の適用
        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->name}%")
                  ->orWhere('last_name', 'like', "%{$request->name}%")
                  ->orWhere('email', 'like', "%{$request->name}%");
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 1ページ7件で取得
        $inquiries = $query->orderBy('created_at', 'desc')->paginate(7);
        $categories = Category::all();

        return view('admin.inquiries', compact('inquiries', 'categories'));
    }

    /**
     * 【裏】CSVエクスポート
     */
    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->name}%")
                  ->orWhere('last_name', 'like', "%{$request->name}%")
                  ->orWhere('email', 'like', "%{$request->name}%");
            });
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        return new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputs($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // Excel文字化け防止(BOM)

            fputcsv($handle, ['お名前', '性別', 'メールアドレス', '種類', '内容']);

            foreach ($contacts as $c) {
                fputcsv($handle, [
                    $c->last_name . ' ' . $c->first_name,
                    $c->gender == 1 ? '男性' : ($c->gender == 2 ? '女性' : 'その他'),
                    $c->email,
                    $c->category->content ?? '不明',
                    $c->detail
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('Ymd') . '.csv"',
        ]);
    }

    /**
     * 【裏】お問い合わせ削除
     */
    public function destroy(Request $request)
    {
        if ($request->filled('id')) {
            Contact::find($request->id)->delete();
        }

        return redirect()->route('admin.inquiries');
    }
}

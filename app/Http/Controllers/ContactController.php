<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    // 【表】お問い合わせ入力画面
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // 【表】確認画面
    public function confirm(Request $request)
    {
        // 1. バリデーション
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
        ]);

        // 2. データを取得
        $contact = $request->all();

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        return view('confirm', compact('contact'));
    }

    // 【表】完了処理
    public function store(Request $request)
    {
        // 1. バリデーション
        $request->validate([
            'category_id' => 'required',
            'first_name'  => 'required',
            'last_name'   => 'required',
            'gender'      => 'required',
            'email'       => 'required|email',
            'address'     => 'required',
            'detail'      => 'required|max:120',
        ]);

        // 2. データの整理
        $data = $request->all();

        if ($request->has('tel1')) {
            $data['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        }

        // 3. 保存
        Contact::create($data);

        return view('thanks');
    }

    // 【裏】管理画面：一覧 & 検索
    public function admin(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->name}%")
                  ->orWhere('last_name', 'like', "%{$request->name}%")
                  ->orWhere('email', 'like', "%{$request->name}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $inquiries = $query->orderBy('created_at', 'desc')->paginate(7);
        $categories = Category::all();

        return view('admin.inquiries', compact('inquiries', 'categories'));
    }

    // 【裏】CSVエクスポート
    public function export(Request $request)
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
        if ($request->filled('gender')) $query->where('gender', $request->gender);
        if ($request->filled('category_id')) $query->where('category_id', $request->category_id);
        if ($request->filled('date')) $query->whereDate('created_at', $request->date);

        $contacts = $query->get();

        return new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputs($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM付与（Excel対策）

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

    // 【裏】お問い合わせ削除
    public function destroy(Request $request)
    {

        if ($request->filled('id')) {
            Contact::find($request->id)->delete();
        }

        return redirect()->route('admin.inquiries');
    }
}

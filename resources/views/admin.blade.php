@extends('layouts.app')

@section('header-button')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-header">logout</button>
    </form>
@endsection

@section('content')
<style>
    /* 管理画面専用スタイル */
    .admin-container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }

    /* 検索フォーム */
    .search-form { display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px; align-items: flex-end; }
    .search-input { padding: 12px; background-color: #f4f4f4; border: 1px solid #eee; border-radius: 2px; }

    /* ボタン：赤茶色（テラコッタ） */
    .btn-search { background-color: #ab4a30; color: #fff; border: none; padding: 12px 40px; cursor: pointer; }
    .btn-reset { background-color: #f2ede9; color: #8b7969; border: none; padding: 12px 40px; cursor: pointer; text-decoration: none; }
    .btn-export { background-color: #f2ede9; color: #8b7969; border: none; padding: 10px 20px; cursor: pointer; margin-bottom: 20px; }

    /* テーブル */
    .admin-table { width: 100%; border-collapse: collapse; background-color: #fff; margin-top: 20px; }
    .admin-table th { background-color: #8b7969; color: #fff; padding: 15px; text-align: left; font-weight: normal; }
    .admin-table td { padding: 15px; border-bottom: 1px solid #f0ece9; color: #333; }

    /* 詳細ボタン（枠線ありの赤茶色） */
    .btn-detail {
        border: 1px solid #ab4a30; color: #ab4a30; background: none;
        padding: 5px 15px; cursor: pointer; transition: 0.3s;
    }
    .btn-detail:hover { background-color: #ab4a30; color: #fff; }

    /* モーダル */
    .modal {
        display: none; position: fixed; z-index: 100; left: 0; top: 0;
        width: 100%; height: 100%; background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fff; margin: 5% auto; padding: 40px;
        width: 50%; border-radius: 5px; position: relative;
    }
    .btn-delete {
        display: block; margin: 30px auto 0;
        background-color: #ab4a30; color: #fff; border: none;
        padding: 10px 40px; cursor: pointer;
    }
</style>

<div class="admin-container">
    <h2 class="page-title">Admin</h2>

    {{-- 検索エリア --}}
    <form action="{{ route('admin.search') }}" method="GET" class="search-form">
        <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレスを入力してください" style="flex: 2;">
        <select name="gender" class="search-input" style="flex: 1;">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>
        <select name="category_id" class="search-input" style="flex: 1;">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date" class="search-input" style="flex: 1;">

        <button type="submit" class="btn-search">検索</button>
        <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
    </form>

    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <button class="btn-export">エクスポート</button>
        {{-- ページネーション --}}
        {{ $contacts->links('vendor.pagination.custom') }}
    </div>

    {{-- テーブルエリア --}}
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <button class="btn-detail" onclick="openModal({{ $contact->id }})">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- 詳細モーダル（簡易実装） --}}
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span onclick="closeModal()" style="position:absolute; right:20px; top:10px; cursor:pointer; font-size:24px;">&times;</span>
        <div id="modalBody">
            {{-- ここにJSでデータを流し込む --}}
        </div>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">削除</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('detailModal').style.display = "block";
        // 実際にはここでAjax等を使って詳細データを取得します
    }
    function closeModal() {
        document.getElementById('detailModal').style.display = "none";
    }
</script>
@endsection

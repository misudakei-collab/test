@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin">
    <div class="admin__inner">
        <div class="admin__heading">
            <h2>Admin</h2>
        </div>

        {{-- 1. 検索フォーム  --}}
        <form class="search-form" action="{{ route('admin.inquiries') }}" method="get">
            <div class="search-form__row">
                <input type="text" name="name" class="input-keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('name') }}">

                <select name="gender" class="select-gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select name="category_id" class="select-type">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                    @endforeach
                </select>

                <input type="date" name="date" class="input-date" value="{{ request('date') }}">

                <button type="submit" class="search-form__search-btn">検索</button>
                <a href="{{ route('admin.inquiries') }}" class="search-form__reset-btn">リセット</a>
            </div>
        </form>

        {{-- 2. ユーティリティ  --}}
        <div class="admin__utility">
            <a href="{{ route('admin.export', request()->query()) }}" class="export-button">エクスポート</a>

            <div class="admin__pagination">
                {{ $inquiries->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>

        {{-- 3. 一覧テーブル --}}
        <table class="admin-table">
            <thead>
                <tr class="admin-table__row--header">
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                <tr>
                    <td class="admin-table__text">{{ $inquiry->last_name }}　{{ $inquiry->first_name }}</td>
                    <td class="admin-table__text">
                        {{ $inquiry->gender == 1 ? '男性' : ($inquiry->gender == 2 ? '女性' : 'その他') }}
                    </td>
                    <td class="admin-table__text">{{ $inquiry->email }}</td>
                    <td class="admin-table__text">{{ $inquiry->category->content ?? '' }}</td>
                    <td class="admin-table__text">
                        <button class="detail-button" onclick="openModal({
                            id: '{{ $inquiry->id }}',
                            name: '{{ $inquiry->last_name }} {{ $inquiry->first_name }}',
                            gender: '{{ $inquiry->gender == 1 ? '男性' : ($inquiry->gender == 2 ? '女性' : 'その他') }}',
                            email: '{{ $inquiry->email }}',
                            tel: '{{ $inquiry->tel }}',
                            address: '{{ $inquiry->address }}',
                            building: '{{ $inquiry->building ?? "-" }}',
                            category: '{{ $inquiry->category->content ?? "" }}',
                            detail: '{{ addslashes(str_replace(["\r", "\n"], " ", $inquiry->detail)) }}'
                        })">詳細</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="admin-table__empty">お問い合わせが見つかりませんでした。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- 4. 詳細モーダル  --}}
<div id="detail-modal" class="modal">
    <div class="modal__card">
        <button class="modal__close-btn" onclick="closeModal()">×</button>

        <div class="modal-list">
            <div class="modal-list__item"><span class="modal-list__label">お名前</span><span class="modal-list__content" id="modal-name"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">性別</span><span class="modal-list__content" id="modal-gender"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">メールアドレス</span><span class="modal-list__content" id="modal-email"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">電話番号</span><span class="modal-list__content" id="modal-tel"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">住所</span><span class="modal-list__content" id="modal-address"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">建物名</span><span class="modal-list__content" id="modal-building"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">お問い合わせの種類</span><span class="modal-list__content" id="modal-category"></span></div>
            <div class="modal-list__item"><span class="modal-list__label">お問い合わせ内容</span><span class="modal-list__content" id="modal-detail"></span></div>
        </div>

        <form action="{{ route('admin.inquiries.destroy') }}" method="post" onsubmit="return confirm('本当に削除しますか？')">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="delete-id">
            <div class="delete-form__button-container">
                <button type="submit" class="delete-form__button">削除</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(c) {
        document.getElementById('modal-name').innerText = c.name;
        document.getElementById('modal-gender').innerText = c.gender;
        document.getElementById('modal-email').innerText = c.email;
        document.getElementById('modal-tel').innerText = c.tel;
        document.getElementById('modal-address').innerText = c.address;
        document.getElementById('modal-building').innerText = c.building;
        document.getElementById('modal-category').innerText = c.category;
        document.getElementById('modal-detail').innerText = c.detail;
        document.getElementById('delete-id').value = c.id;
        document.getElementById('detail-modal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('detail-modal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target.id === 'detail-modal') closeModal();
    }
</script>
@endsection

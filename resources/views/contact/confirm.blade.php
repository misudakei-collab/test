@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-content">
    <h2 class="page-title">Confirm</h2>
    <form action="/store" method="post">
        @csrf
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $contact['last_name'] }}　{{ $contact['first_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</td>
            </tr>
            </table>

        <div class="form__button">
            <button class="submit-btn" type="submit">送信</button>
            <button class="back-btn" type="submit" name="back">修正</button>
        </div>
    </form>
</div>
@endsection

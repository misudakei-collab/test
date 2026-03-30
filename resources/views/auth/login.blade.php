@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-inner">
    <div class="auth-heading">
        <h2>Login</h2>
    </div>

    <div class="auth-form-card">
        <form action="{{ route('login') }}" method="post" class="auth-form">
            @csrf
            {{-- メールアドレス --}}
            <div class="form-group">
                <div class="form-label">
                    <span class="form-label-item">メールアドレス</span>
                </div>
                <div class="form-input-container">
                    <div class="form-input-text">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    </div>
                </div>
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <div class="form-label">
                    <span class="form-label-item">パスワード</span>
                </div>
                <div class="form-input-container">
                    <div class="form-input-text">
                        <input type="password" name="password" placeholder="例: coachtech1106">
                    </div>
                </div>
            </div>

            <div class="form-button">
                <button class="form-button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection

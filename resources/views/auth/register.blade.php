@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-inner">
    <div class="auth-heading">
        <h2>Register</h2>
    </div>

    <div class="auth-form-card">
        <form action="{{ route('register') }}" method="post" class="auth-form">
            @csrf

            {{-- お名前 --}}
            <div class="form-group">
                <div class="form-label">
                    <span class="form-label-item">お名前</span>
                </div>
                <div class="form-input-container">
                    <div class="form-input-text">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
                    </div>
                    <div class="form-error">
                        @error('name') {{ $message }} @enderror
                    </div>
                </div>
            </div>

            {{-- メールアドレス --}}
            <div class="form-group">
                <div class="form-label">
                    <span class="form-label-item">メールアドレス</span>
                </div>
                <div class="form-input-container">
                    <div class="form-input-text">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    </div>
                    <div class="form-error">
                        @error('email') {{ $message }} @enderror
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
                    <div class="form-error">
                        @error('password') {{ $message }} @enderror
                    </div>
                </div>
            </div>

            {{-- 登録ボタン (中央寄せ) --}}
            <div class="form-button">
                <button class="form-button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="/confirm" method="post">
        @csrf

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                </div>
                <div class="form__error">
                    @error('last_name') <p>{{ $message }}</p> @enderror
                    @error('first_name') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" id="male" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}><label for="male">男性</label>
                    <input type="radio" name="gender" id="female" value="2" {{ old('gender') == '2' ? 'checked' : '' }}><label for="female">女性</label>
                    <input type="radio" name="gender" id="other" value="3" {{ old('gender') == '3' ? 'checked' : '' }}><label for="other">その他</label>
                </div>
                <div class="form__error">
                    @error('gender') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                <div class="form__error">
                    @error('email') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="text" name="tel_1" placeholder="080" value="{{ old('tel_1') }}">
                    <span>-</span>
                    <input type="text" name="tel_2" placeholder="1234" value="{{ old('tel_2') }}">
                    <span>-</span>
                    <input type="text" name="tel_3" placeholder="5678" value="{{ old('tel_3') }}">
                </div>
                <div class="form__error">
                    @if($errors->has('tel_1')) <p>{{ $errors->first('tel_1') }}</p>
                    @elseif($errors->has('tel_2')) <p>{{ $errors->first('tel_2') }}</p>
                    @elseif($errors->has('tel_3')) <p>{{ $errors->first('tel_3') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                <div class="form__error">
                    @error('address') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="select-wrapper">
                    <select name="category_id">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                <div class="form__error">
                    @error('detail') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection

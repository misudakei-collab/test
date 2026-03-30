@extends('layouts.app')

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__background">
        <p class="thanks__background-text">Thank you</p>
    </div>

    <div class="thanks__message">
        <p class="thanks__message-text">お問い合わせありがとうございました</p>
        <div class="thanks__button">
            <a href="/" class="thanks__button-link">HOME</a>
        </div>
    </div>
</div>
@endsection

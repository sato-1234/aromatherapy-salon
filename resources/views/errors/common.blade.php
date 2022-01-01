@extends('layouts.common_show')

@section('head_meta')
<title>{{$status_code ?? 'error'}}：エラー</title>
<meta name="robots" content="noindex" />
<meta name="description" content="{{$status_code ?? 'error'}}：エラーページです。">
@endsection

@section('content')
@php
$message = '';
if ( $status_code ) {
    switch ($status_code) {
        case 400:
            $message = 'Bad Request';
            break;
        case 401:
            $message = '認証に失敗しました';
            break;
        case 403:
            $message = 'アクセス権がありません';
            break;
        case 404:
            $message = '存在しないページです';
            break;
        case 405:
            $message = 'Not Allowed';
            break;
        case 408:
            $message = 'タイムアウトです';
            break;
        case 414:
            $message = 'リクエストURIが長すぎます';
            break;
        case 419:
            $message = '不正リクエストまたはタイムアウトです。';
            break;
        case 500:
            $message = 'Internal Server Error';
            break;
        case 503:
            $message = 'Service Unavailable';
            break;
        default:
            $message = '';
            break;
    }
}
@endphp
<div class="notFound">
	<h2>{{$status_code ?? 'error'}}：{{ $message }}</h2>
	<p>エラーが発生しました。ご不便をおかけして申し訳ございません。</p>
	<a class="js-hover" href="{{ config('app.url') }}/">HOME</a>
</div>
@endsection

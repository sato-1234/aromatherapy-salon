@if ( url()->current() === config('app.url') )
<title>{{ $title }}</title>
@else
<title>{{ $title }} - {{ config('app.name') }}</title>
@endif
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ url()->current() }}">

<!-- ogp設定 -->
@if ( url()->current() === config('app.url') )
<meta property="og:title" content="{{ $title }}" />
@else
<meta property="og:title" content="{{ $title }} - {{ config('app.name') }}" />
@endif
<meta property="og:type" content="website" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image" content="{{ asset('ogp_img/ogp.png') }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:locale" content="ja_JP" />
<meta property="og:locality" content="市町村" />
<meta property="og:region" content="都道府県" />
<meta property="og:country-name" content="日本" />

<!-- twitter ある場合 -->
<!-- <meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@アカウント名" /> -->

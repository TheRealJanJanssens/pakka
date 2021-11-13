<!doctype html>
<html>
<head>
	{!! constructTrackers() !!}
	
	<!-- META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<meta name="robots" content="index,follow"/>
	
	<meta name="description" content="{{ $page['meta']['description'] }}"/>
	<meta name="keywords" content="{{ $page['meta']['keywords'] }}"/>
	
	<meta property="og:url" content="{{ $page['meta']['url'] }}"/>
	<meta property="og:type" content="website"/>
	
	<meta property="og:title" content="{{ $page['meta']['title'] }}"/>
	<meta property="og:description" content="{{ $page['meta']['description'] }}"/>
	
	@if(isset($settings['app_logo']))
		<meta property="og:image" content="{{ $page['meta']['url'] }}{{ config('image.app.public') }}{{ $settings['app_logo'] }}"/>
	@endif
	
	@foreach($lang as $k => $v)
		@if($k == 0)
			<link rel="canonical" href="{{ $page['meta']['url'] }}/{{ $v['language_code'] }}"/>
			<link rel="alternate" href="{{ $page['meta']['url'] }}/{{ $v['language_code'] }}" hreflang="x-default"/>
		@endif
		
		<link rel="alternate" href="{{ $page['meta']['url'] }}/{{ $v['language_code'] }}" hreflang="{{ $v['language_code'] }}"/>
	@endforeach
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	
	@if($page['meta']['mode'] == 2)
		<meta name="page" content="{{ $page['meta']['id'] }}"/>
	@endif
	
	@if(isset($page['meta']['items']))
		<meta name="items" content="{{ $page['meta']['items'] }}"/>
	@endif
	
	@if(isset($page['meta']['inputs']))
		<meta name="inputs" content="{{ $page['meta']['inputs'] }}"/>
	@endif
	
	@if(isset($page['meta']['menus']))
		<meta name="menus" content="{{ $page['meta']['menus'] }}"/>
	@endif
	
	@if(isset($page['meta']['pages']))
		<meta name="pages" content="{{ $page['meta']['pages'] }}"/>
	@endif
	
	@if($page['meta']['settings']['editor_autosave'])
		<meta name="autosave" content="{{ $page['meta']['settings']['editor_autosave'] }}"/>
	@endif
	
	@if(checkAccess("permission_layout_edit"))
		<meta name="layout_editor" content="1"/>
	@endif
	
	@if(checkAccess("permission_layout_edit_items"))
		<meta name="layout_editor_items" content="1"/>
	@endif
	
	@if(checkAccess("permission_content_edit_advanced"))
		<meta name="content_edit_advanced" content="1"/>
	@endif
	
	<!-- CSS -->
	@foreach($page['meta']['css'] as $css)
		<link rel="stylesheet" href="{{ asset($css) }}"> 
	@endforeach
	<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
	
	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
	
	<title>{{ $page['meta']['title'] }}</title>
	
	{!! constructStyleVar() !!}
	
</head>
<body class="preload">
	{!! constructTrackers("body") !!}
	
	<?php
	   	$settings = Session::get('settings');
	   	$menu = Menu::constructMenu(2);
	?>
	
	@include('partials.navigation', ['menu' => $menu, 'settings' => $settings])
	
    @yield('content')
	
	@include('partials.footer', ['menu' => $menu, 'settings' => $settings])
	
	@include('cookieConsent::index')
	
</body>
	<!-- JS -->
	<script src="https://kit.fontawesome.com/a4dc62876e.js" crossorigin="anonymous"></script>
	@foreach($page['meta']['js'] as $js)
		<script type="text/javascript" src="{{ asset($js) }}"></script>
	@endforeach
	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc7yjFYVJcrk2Oe1NGs5WgdySdYWCqOLI"></script>
<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

	<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
</html>

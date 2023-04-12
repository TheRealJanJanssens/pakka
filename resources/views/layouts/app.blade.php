<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('public/vendor/css/app.css') }}" rel="stylesheet">

  @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-gray-800">

    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            @yield('content')
        </div>
    </main>

    {{-- @include('pakka::admin.partials.spinner')

    <div class="peers ai-s fxw-nw h-100vh">
	    @if(isset($settings['app_cover']))
        	@php( $cover = config('image.app.public').$settings['app_cover'])
        @else
        	@php( $cover = config('placeholders.cover'))
        @endif
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("{{ $cover }}")'>
        <div class="pos-a centerXY">
          <div class="bgc-white bdrs-50p pos-r" style='width: 120px; height: 120px;'>
	        @if(isset($settings['app_logo']))
            	<img class="pos-a centerXY" src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="" style="max-width: 80%; max-height:75%;">
            @else
            	<img class="pos-a centerXY" src="{{ config('placeholders.logo') }}" alt="" style="max-width: 80%; max-height:75%;">
            @endif

          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        @yield('content')
      </div>
    </div> --}}

    @livewireScripts
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user_id" content="{{ auth()->user()->id }}">
    <meta name="user_name" content="{{ auth()->user()->name }}">

    <title>{{ config('app.name', 'Beheerpaneel') }}</title>

    <!-- Styles (use mix to add versioning to file against caching) -->
	<link href="{{ asset('public/vendor/css/app.css') }}" rel="stylesheet"> 
	
	@yield('css')

</head>

<body class="app">

    @include('pakka::admin.partials.spinner')

    <div>
        <!-- #Left Sidebar ==================== -->
        @include('pakka::admin.partials.sidebar')

        <!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            @include('pakka::admin.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">
						
						@include('pakka::admin.partials.messages')
						@if(View::hasSection('page-header'))
					        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
					    @endif
					    
					    @if(View::hasSection('page-header-alt'))
					        @yield('page-header-alt')
					    @endif
						
						@yield('content')

                    </div>
                </div>
            </main>

            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © {{ date('Y') }}<!--
 Developed by
                    <a href="https://janjanssens.be" target='_blank' title="Jan Janssens">Jan Janssens</a>
-->. All rights reserved. {{ session('pakka_version') }}</span>
            </footer>
        </div>
    </div>
    
	<!-- (use mix to add versioning to file against caching) -->
	<script src="https://kit.fontawesome.com/a4dc62876e.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/vendor/js/app.js') }}"></script>

    @yield('js')

</body>

</html>

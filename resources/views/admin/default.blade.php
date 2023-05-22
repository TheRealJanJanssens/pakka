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

    <!-- Styles -->
    <link href="{{ asset('public/vendor/css/app.css') }}?{{rand()}}" rel="stylesheet">

	@yield('css')
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body>
    {{-- @include('pakka::admin.partials.spinner') --}}

    <!-- ### $Topbar ### -->
    @include('pakka::admin.partials.topbar')

    <!-- #Main ============================ -->
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        <!-- #Left Sidebar ==================== -->
        {{-- @include('pakka::admin.partials.menu.sidebar') --}}
        <x-pakka::sidebar />

        <!-- ### $App Screen Content ### -->
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                @include('pakka::admin.partials.messages')
                @if(View::hasSection('page-header'))
                    <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
                @endif

                @if(View::hasSection('page-header-alt'))
                    @yield('page-header-alt')
                @endif

                @yield('content')
            </main>

            <!-- ### $App Screen Footer ### -->
            @include('pakka::admin.partials.footer')

        </div>
    </div>

    @livewire('notifications')

    @stack('scripts')
    @livewireScripts
	<!-- (use mix to add versioning to file against caching) -->
	<script src="https://kit.fontawesome.com/a4dc62876e.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/vendor/js/app.js') }}?{{rand()}}"></script>

    @yield('js')

</body>

</html>

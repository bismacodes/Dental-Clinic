@include('partials.header')

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        @include('partials.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('partials.navbar')
            <div id="main-content">
                <div class="page-heading">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')

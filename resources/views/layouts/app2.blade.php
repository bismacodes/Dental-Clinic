@include('partials.header')

<body>
    <div class="layout-wrapper layout-content-navbar">

        <div class="layout-container">

            @include('partials.sidebar')

            <div class="layout-page">
                @include('partials.navbar')

                <div class="content-wrapper">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    @include('partials.footer')

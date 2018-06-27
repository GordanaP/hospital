<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.app._head')
</head>

<body class="sidebar-fixed header-fixed">

    @include('partials.admin._nav')

    <div class="page-wrapper">
        <div class="main-container">

            <div class="sidebar">
                @include('partials.admin._sidebar')
            </div>

            <div class="content">
                @yield('content')
            </div>

        </div>
    </div>

    @include('partials.app._scripts')

</body>

</html>

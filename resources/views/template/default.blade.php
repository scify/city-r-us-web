<!DOCTYPE html>
<html>
<head>
    <!-- Title -->
    <title> @yield('title') | {{trans('admin_login.title')}}</title>
    <!-- Include css, js files-->
    @include('template.default.headerIncludes')
    @yield('headerScripts')

</head>


<body class="pace-done page-horizontal-bar compact-menu" data-url="{!! URL::to('/') !!}">
<main class="page-content content-wrap container">
    <!-- Navbar/TopBar -->
    @include('template.default.topBar')

    <!--Side Menu--->
    @include('template.default.menu')

    <div class="page-inner">
        <!--Page Title & Breadcrumbs -->
        @include('template.default.pageTitle')

        <!--Body -->
        <div id="main-wrapper">
            @if ( Session::has('flash_message') )
            <div class="alert {{ Session::get('flash_type') }}">
                <h3>{{ Session::get('flash_message') }}</h3>
            </div>
            @endif

            @yield('bodyContent')
        </div>

        <!-- Footer -->
        @include('template.default.footer')
    </div>
</main>
<div class="cd-overlay"></div>
@include('template.default.footerIncludes')
@yield('footerScripts')
</body>
</html>



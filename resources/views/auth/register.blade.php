<!DOCTYPE html>
<?php  $lang = "auth/login."; ?> {{--  resource label path --}}
<html>
<head>
    <!-- Title -->
    <title>{{trans($lang.'title')}} | Δημιουργία Λογαριασμού </title>
    @include('template.default.headerIncludes')
</head>

<body class="page-login">
<main class="page-content">
    <div class="page-inner">
        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-10 center">
                    <div class="login-box">
                        <div class="text-center">
                            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" class="logo"/></a>
                        </div>
                        <div class="alert alert-danger" id="errors"></div>
                        <form class="m-t-md" role="form" id="registrationForm">
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            <input type="hidden" name="role" value="web">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Όνομα" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Κωδικός" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Επαλήθευση Κωδικού" />
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Δημιουργία Λογαριασμού</button>
                        </form>
                    </div>
                </div>
            </div><!-- Row -->
        </div><!-- Main Wrapper -->
    </div><!-- Page Inner -->
</main><!-- Page Content -->
@include('template.default.footerIncludes')
<script src="{{ asset('/js/pages/register.js')}}"></script>
</body>
</html>

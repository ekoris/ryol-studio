<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ryol Studio | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('assets/admin-v1/assets/toast/toastr.min.css') }}">
    @stack('styles')
</head>

<body class="hold-transition skin-red-light sidebar-mini" style="background-color: #6a5f40">
    <div class="wrapper">
        <header class="main-header" >
            <a href="{{ asset('assets/admin') }}/" class="logo" style="background-color: #6a5f40 !important">
                <span class="logo-mini"><b>Ryol</b>Std</span>
                <span class="logo-lg"><b>Ryol</b>Studio</span>
            </a>
            <nav class="navbar navbar-static-top" style="background-color: #6a5f40 !important">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('admin.sign-out') }}"><i class="fa fa-sign-out"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @include('admin.theme.sidebar')
            @yield('body')
        @include('admin.theme.footer')
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('assets/admin') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets/admin') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/admin') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('assets/admin') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('assets/admin-v1/assets/toast/toastr.min.js') }}"></script>
    <script>
        toastr.options = {
            "progressBar": true
        };
    </script>
    @stack('toastr')
    @if(session()->has("notice"))
        @php
            $value = Session::get('notice');
        @endphp
        @if (is_array($value))
            <script>
                @foreach ($value as $data)
                    @if ($data['labelClass'] == 'success')
                        toastr["success"]("{{ $data['content'] }}");
                    @endif
                    @if ($data['labelClass'] == 'error')
                        toastr["error"]("{{ $data['content'] }}");
                    @endif
                @endforeach
            </script>
        @endif
        @php
            Session::forget('notice');
        @endphp
    @endif
    @stack('scripts')
</body>

</html>

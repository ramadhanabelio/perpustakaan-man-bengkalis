<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>
        @hasSection('title')
            Perpustakaan MAN 1 Bengkalis - @yield('title')
        @else
            Perpustakaan MAN 1 Bengkalis
        @endif
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}">
    <style>
        .dataTables_scrollHead {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: white;
        }

        .card-body {
            overflow: hidden;
        }

        .dataTables_scrollBody {
            border-bottom: 1px solid #dee2e6;
        }

        .logo {
            gap: 10px;
        }

        .logo-text {
            line-height: 1.1;
        }

        .logo-text .fw-bold {
            letter-spacing: .3px;
        }
    </style>
</head>

<body>
    @yield('body')

    <!-- Core JS Files -->
    <script src="{{ asset('js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>
    <!-- jQuery Sparkline -->
    <script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Chart Circle -->
    <script src="{{ asset('js/plugin/chart-circle/circles.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
    <!-- Bootstrap Notify -->
    <script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <!-- jQuery Vector Maps -->
    <script src="{{ asset('js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jsvectormap/world.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('js/kaiadmin.min.js') }}"></script>
    @stack('scripts')
</body>

</html>

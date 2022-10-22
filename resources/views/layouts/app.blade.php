<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AKMESCİD ERKEK ÖĞRENCİ YURDU</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="/dist/css/fullcalendar.css">
    <!-- SweetAlert2 -->
    <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="/dist/css/colorPick.css">
    <!-- The following line applies the dark theme -->
    <link rel="stylesheet" href="/dist/css/colorPick.dark.theme.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/dist/css/custom.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    @yield('head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.11.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.11.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAER8D7oOI4J--S0aS2bw6mev8eWG04xKY",
    authDomain: "webapp-c187f.firebaseapp.com",
    projectId: "webapp-c187f",
    storageBucket: "webapp-c187f.appspot.com",
    messagingSenderId: "884095726890",
    appId: "1:884095726890:web:04a11c10deb995a5215a53",
    measurementId: "G-8T07J9QCCF"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
    <div class="wrapper">
        @if (!Auth::check())
            <script>
                window.location = "/";
            </script>
        @else
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                    width="60">
            </div>

            @include('layouts.navbar')
            @include('layouts.sidebar')



            @yield('content')
        @endif
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery UI -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>

    <!-- fullCalendar 2.2.5 -->
    <script src="/plugins/fontawesome-free/js/all.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/plugins/moment/moment.js"></script>
    <script src="/plugins/moment/locale/tr.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>

    @yield('script')

</body>

</html>

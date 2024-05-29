<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{csrf_token()}}" >
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/argon.css?v=1.2.0') }}" type="text/css">

    {{-- toastr --}}
    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/toastr.css') }}"> --}}

    {{-- Snackbar --}}
    <link rel="stylesheet" href="{{ asset('/assets/css//snackbar.min.css') }}">
    <script src="{{ asset('/assets/js/snackbar.min.js') }}"></script>

    {{-- Costume Style --}}
    @yield('c_style')
</head>

<body style="background: #9b4dca">

    @yield('content')

    <!-- Core -->
    <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('/assets/js/argon.js?v=1.2.0') }}"></script>

    <!-- toastr -->
    {{-- <script src="{{ asset('/assets/js/toastr.min.js') }}"></script> --}}

    {{-- Costume JS --}}
    @yield('c_js')

    <script>
        @if (Session::has('success'))
            Snackbar.show({
            text: "{{ session('success') }}",
            backgroundColor: '#28a745',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('error'))
            Snackbar.show({
            text: "{{ session('error') }}",
            backgroundColor: '#dc3545',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('info'))
            Snackbar.show({
            text: "{{ session('info') }}",
            backgroundColor: '#17a2b8',
            actionTextColor: '#212529',
            })
        @endif;

        // toggle password
        function seePassword(icon) {
            try {
                var icon = $(`#${icon.id} i`);
                var inputPass = $('input[id="password"]')
                var type = 'password'

                if (icon.attr('class') === 'fas fa-eye') {

                    type = 'text'
                    icon.removeClass().addClass('fas fa-eye-slash')

                } else {
                    icon.removeClass().addClass('fas fa-eye')
                }

                inputPass.map((i, input) => {
                    $(`input[name="${input.name}"]`).attr('type', type)

                })
                return true;
            } catch (error) {
                console.log(error)
                return false;
            }
        }
    </script>
</body>

</html>

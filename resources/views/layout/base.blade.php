<!DOCTYPE html>
<html lang="fr">

<head>
    @yield('css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/summernote/summernote.min.css') }}">
<<<<<<< HEAD
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/index.js') }}"> --}}
=======
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}">
>>>>>>> 462f19c3d3b81c36d8f96ddf15c40607acd5471b
    <title>Super-m</title>
</head>

<body>
    @yield('content')

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatable/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
    <script src="{{ URL::asset('assets/index.js') }}"></script>


    @yield('js')
</body>

</html>

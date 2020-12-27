@push('head_style')


    <link rel="stylesheet" href="{{ asset('sass/_header.scss') }}">


    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Main CSS File -->

    <link rel="stylesheet" href="{{ asset('css/style.css')}}">

    <link rel="stylesheet" href="{{ asset('css/styles_comment.css')}}">

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.css">

@endpush

@push('404_style')
    <link rel="stylesheet" href="{{ asset('css/404.min.css') }}">
@endpush

@include('piles.scripts')
@include('piles.styles')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="viewport" content="initial-scale=1, shrink-to-fit=no, width=device-width">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icons/favicon.png') }}">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" data-devise="{{ Cookie::get('devise') }}">

    <title>
        {{ $title ?? config('app.name', 'Ossehi') }}
    </title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- Scripts --}}

    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700','Segoe Script:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = "{{ asset('js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);

    </script>

    <noscript>{{__('A fatal JavaScript error has occurred')}}</noscript>

<!-- Bootstrap CSS -->
    @stack('head_style')



    @if($title === 'Page not found')
        @stack('404_style')
    @endif


</head>

<body>
@if(session()->has('notify_generals'))
    <div class="alert alert-info alert-dismissible fade show d-none" id="show-alert-notify" role="alert">
        <strong>{{__('Info')}}</strong> <span id="message">{{session('notify_generals')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

   @yield('content')

   @stack('head_script')

   @yield('scripts')




<script type="module">

    import Validator from "{{ asset("js/Validator.js") }}";
    import Helpers from "{{ asset("js/Helpers.js") }}";
    import NewsLetter from "{{ asset("js/NewsLetter.js") }}";

    $(function () {

        let devise,
            checkbox = 0,
            requestDevise    = new Object();


        const $doc = $(document),
              devise_default = $('#devise-default');




        // CHANGE DEVISE SCRIPT

        $doc.on('click', "#devise-eur, #devise-usd, #devise-xof, #devise-ua, #devise-ngn", function (event)
        {
            event.preventDefault();

            devise = Helpers.changeDevise(this.id);

            requestDevise.devise = devise;

            devise_default.html(devise);

            Validator.requestAjax('POST', "{{ route_name('set.cookie.devise') }}", func_redirect, requestDevise);
        });

        function func_redirect(response){
            return window.location = location.href;
        }



        // NEWSLETTER SCRIPT

        $doc.on('submit', '#form-subscribe-pop, #form-subscribe-footer, #form-subscribe-home', function (event) {

            event.preventDefault();

            const idInput = $(this).find('input[type=email]');

            NewsLetter.create(this, idInput, '.error-email', {
                requiredText: "{{ __('validation.required', ['attribute' => 'email']) }}",
                filterText: "{{ __('validation.regex', ['attribute' => 'email']) }}"
            });

        });


        $doc.on('change', '#stop-pop-newsletter', function (event) {

            event.preventDefault();

            checkbox = parseInt($('input:checked').val());

            if (!checkbox) {
                checkbox = 0;
            }
            NewsLetter.stopNewsLetterPop(checkbox);
        });



    });
</script>

@include('scripts.script_auth')

@include('scripts.script_shipping_form')

@include('scripts.script_store_product')

@include('scripts.script_menus')

@include('scripts.script_create_store')

@include('scripts.script_create_various')

@include('scripts.script_create_product')

@include('scripts.script_create_store_product')

@include('scripts.script_delete')

@include('scripts.script_edit_product')

@include('scripts.script_edit_store_product')

@include('scripts.script_edit_various')

@include('scripts.script_edit_store')






</body>
</html>

@extends('layouts.default', ['title' => 'Page not found'])

@section('content')

    <!-- Page title-->
    <!-- Page Content-->
    <div class="container py-5 mb-lg-3">
        <div class="row justify-content-center pt-lg-4 text-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <h1 class="display-404">404</h1>
                <h2 class="h3 mb-4">{{__('Nous ne parvenons pas à trouver la page que vous recherchez.')}}</h2>
                <p class="font-size-md mb-4">
                    <u>{{__('Voici plutôt quelques liens utiles')}}:</u>
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="row">
                    <div class="col-sm-4 mb-3"><a class="card h-100 border-0 box-shadow-sm" href="{{ route_name('home') }}">
                            <div class="card-body">
                                <div class="media align-items-center"><ion-icon name="home-outline" class="text-primary h4 mb-0"></ion-icon>
                                    <div class="media-body pl-3">
                                        <h5 class="font-size-sm mb-0">{{__('Homepage')}}</h5><span class="text-muted font-size-ms">{{__('Retour à la page d\'accueil')}}</span>
                                    </div>
                                </div>
                            </div></a></div>
                    <div class="col-sm-4 mb-3">
                        <a class="card h-100 border-0 box-shadow-sm" href="">
                            <div class="card-body">
                                <div class="media align-items-center"><ion-icon name="information-circle-outline" class="text-success h4 mb-0"></ion-icon>
                                    <div class="media-body pl-3">
                                        <h5 class="font-size-sm mb-0">{{__('Contactez-nous')}}</h5><span class="text-muted font-size-ms">{{__('Trouvez les informations sur nous')}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-3"><a class="card h-100 border-0 box-shadow-sm" href="">
                            <div class="card-body">
                                <div class="media align-items-center"><ion-icon name="aperture-outline" class="text-info h4 mb-0"></ion-icon>
                                    <div class="media-body pl-3">
                                        <h5 class="font-size-sm mb-0">{{__('Aide')}} &amp; {{__('Support')}}</h5><span class="text-muted font-size-ms">{{__('Visitez notre centre d\'aide')}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@extends('layouts.default', ['title' => __('Create gallery for product')])

@section('content')

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-md-8 m-2">

                        <h4 class="title mb-5 text-center">{{__('Add more photos to your product')}}</h4>

                        <form method="post" action="{{ route_name('request.gallery.store_product', ['slug' => $product->slug]) }}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                            @csrf

                            <div class="dz-message" data-dz-message><span>{{ __("Drop files here or click to upload") }}</span></div>

                        </form>


                    </div><!-- End .col-md-8 -->


                </div><!-- End .row -->

                <div class="row justify-content-center">


                    @foreach($product->galleries as $image)

                        <div class="col-2 mb-4" id="gallery-product{{$image->id}}">
                            <img src="{{ asset($image->name) }}" alt="" class="w-md-100"/>
                            <form method="post" id="delete-gallery" action="{{ route_name('destroy.gallery.store_product', ['id' => $image->id]) }}">
                                @csrf
                                @method('DELETE')
                                <div class="product-action">
                                    <button class="btn btn-danger">{{ __('Delete') }}</button>
                                </div>
                            </form>
                        </div>

                    @endforeach

                </div>


            </div><!-- End .container -->

            <div class="mb-4"></div><!-- margin -->

            <div class="form-footer justify-content-center">
                <a href="{{ route_name('store.products.single', ['slug' => $product->slug]) }}" class="btn btn-primary btn-md">{{strtoupper(__('View the product'))}}</a>
            </div><!-- End .form-footer -->


        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')



@stop

@section('scripts')

    <script type="module">

        import Validator from "{{ asset('js/Validator.js') }}";

        $(function () {

            const $doc = $(document);

            let confirmation,
                routeName,
                canSubmit = true;

            $doc.on('submit', '#delete-gallery', function (event) {

                event.preventDefault();

                confirmation = confirm(`{{ __('Do you want to delete this photo') }}`);

                if (confirmation){

                    const imageId = $(this).parent('div').attr('id');

                    routeName = $(this).attr('action');

                    if (!canSubmit) return ;

                    canSubmit = false;

                    Validator.requestAjax('DELETE', routeName, function (response) {

                        if (response.success){

                            $(`#${imageId}`).remove();
                        }
                    })

                    setTimeout(function () {
                        canSubmit = true;
                    }, 3000);

                }
            })

        });

    </script>
@endsection







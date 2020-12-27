
<div class="product-single-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">{{__('Description')}}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">{{ __('Reviews') }}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
            <div class="product-desc-content">

                @if(isset($various))

                    <p>{{ $various->description }}</p>

                @elseif(isset($product))

                    <p>{{ $product->description }}</p>

                @endif

            </div><!-- End .product-desc-content -->
        </div><!-- End .tab-pane -->


        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">

            @include('layouts.comment')

        </div><!-- End .tab-pane -->

    </div><!-- End .tab-content -->
</div><!-- End .product-single-tabs -->

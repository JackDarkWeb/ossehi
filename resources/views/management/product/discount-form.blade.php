
<div class="product-single-container product-single-default product-quick-view container">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6">
                <h2 class="title mb-2">{{__('Add discount')}}</h2>

                <form method="post" action="{{ route('request.discount', ['lang' => app()->getLocale(), 'product_id' => $product_id, 'slug' => $slug, 'price' => $price, 'devise' => $devise]) }}" class="mb-1" id="discount-form" data-id="{{ $product_id }}">

                    <label for="old_price">{{__('Old price')}} <span class="required">*</span></label>
                    <input type="text" name="old_price" class="form-input form-wide mb-2 is-invalid" value="{{ $price.' '.$devise }}" id="old_price" disabled/>

                    <label for="discount-price">{{__('New price')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-discount-price"></span>
                    <input type="text" name="discount_price" class="form-input form-wide mb-2 is-invalid" id="discount-price"/>

                    <div class="form-footer">
                        <button type="submit" id="submit" class="btn btn-primary btn-md">{{strtoupper(__('Add'))}}</button>
                    </div><!-- End .form-footer -->

                </form>
            </div><!-- End .col-md-6 -->

        </div><!-- End .row -->
    </div><!-- End .container -->

</div>













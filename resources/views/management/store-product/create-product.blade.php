<div class="product-single-container product-single-default product-quick-view container">

    <div class="container">



        <form method="post" action="#" class="mb-1" id="store-product-form" data-slug="{{ $slug_store }}">

            <h2 class="title mb-2">{{__('CREATE PRODUCT')}}</h2>

            <div class="row">

                <div class="col-md-6">

                    <label for="name">{{__('Name')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-name"></span>
                    <input type="text" name="name" class="form-input form-wide mb-2 is-invalid" id="name"/>


                    <label for="price">{{__('Price')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-price"></span>
                    <input type="text" name="price" class="form-input form-wide mb-2 is-invalid" id="price"/>

                    <label for="devise">{{__('Devise')}} <span class="required ">*</span></label>
                    <div class="select-custom mb-2 form-group">
                        <span class="invalid-feedback error-devise"></span>
                        <select name="devise" id="devise" class="form-control form-control-sm">

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(devises() as $devise)
                                <option value="{{ $devise }}" >{{ strtoupper($devise) }}</option>
                            @endforeach

                        </select>
                    </div><!-- End .select-custom -->

                    <label for="file">{{__('Principal image')}} <span class="required">*</span></label>
                    <div class="bg-white rounded-lg p-4 mb-4">

                        <span class="invalid-feedback error-file"></span>
                        <input type="file" name="file" id="file" class="inputfile d-none"/>

                        <div class="media align-items-center" id="aph">

                            <img src="https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg" width="90" height="88" alt="" id="file-product">

                            <div class="media-body pl-3">
                                <label class="btn btn-light btn-shadow btn-sm mb-2" for="file" type="button"><ion-icon class="mr-2"  name="sync-outline"></ion-icon>{{ __('UPLOAD IMAGE') }}</label>
                                <div class="p mb-0 font-size-ms text-muted">{{ __('UPLOAD') }}   JPG or PNG image.</div>
                            </div>
                        </div>
                    </div>


                </div><!-- End .col-md-6 -->

                <div class="col-md-6">


                    <label for="colors">{{__('Colors')}}</label>

                    <div class="select-custo mb-2">
                        <span class="invalid-feedback error-colors"></span>
                        <select name="colors" id="colors" class="form-control form-control-sm"  multiple>

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(stock_colors() as $key => $value)
                                <option value="{{ $value }}" style="background-color: {{ $value }}">{{ strtoupper(__( $key)) }}</option>
                            @endforeach
                        </select>
                    </div><!-- End .select-custom -->


                    <label for="sizes">{{__('Sizes')}}</label>

                    <div class="select-custo mb-2">
                        <span class="invalid-feedback error-sizes"></span>
                        <select name="sizes" id="sizes" class="form-control form-control-sm"  multiple>

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(stock_sizes() as $size)
                                <option value="{{ $size }}" >{{ strtoupper($size) }}</option>
                            @endforeach


                        </select>
                    </div><!-- End .select-custom -->

                    <label for="Brands">{{__('Brands')}}</label>
                    <div class="select-custo mb-2">
                        <span class="invalid-feedback error-brands"></span>
                        <select name="Brands" id="brands" class="form-control form-control-sm"  multiple>

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(stock_brands() as $brand)
                                <option value="{{ $brand }}" >{{ strtoupper($brand) }}</option>
                            @endforeach

                        </select>
                    </div><!-- End .select-custom -->




                    <div class="form-group required-field">
                        <label for="description">{{__('Description')}}</label>
                        <span class="invalid-feedback error-description"></span>
                        <textarea cols="30" rows="1" id="description" class="form-control" name="description" ></textarea>

                    </div><!-- End .form-group -->




                </div><!-- End .col-md-6 -->

                <div class="form-footer">
                    <button type="submit" id="submit" class="btn btn-primary btn-md">{{strtoupper(__('Create'))}}</button>
                </div><!-- End .form-footer -->
            </div><!-- End .row -->

        </form>


    </div><!-- End .container -->

</div>











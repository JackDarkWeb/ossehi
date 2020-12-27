<div class="product-single-container product-single-default product-quick-view container">

    <div class="container">

            <form method="post" action="{{ route('update.product', ['lang' => app()->getLocale(), 'product_id' => $product->id, 'slug' => $product->slug]) }}" class="mb-1" id="edit-product-form">

                @csrf

                @method('PUT')

                <h2 class="title mb-2">{{__('EDIT PRODUCT')}}</h2>

                <div class="row">

                <div class="col-md-6">

                        <label for="name">{{__('Name')}} <span class="required">*</span></label>
                        <span class="invalid-feedback error-name"></span>
                        <input type="text" name="name" class="form-input form-wide mb-2 is-invalid" id="name" value="{{ $product->title }}"/>


                        <label for="category">{{__('Categories')}} <span class="required ">*</span></label>
                        <div class="select-custom mb-2">

                            <span class="invalid-feedback error-category"></span>
                            <select name="category" id="category" class="form-control form-control-sm">

                                <option value="">{{ __('Choose') }}</option>

                                @foreach(menu_sub_category_products() as $sub_category)
                                    <option value="{{ $sub_category->id }}" {{ $product->parent_id == $sub_category->id ? 'selected' : '' }} >{{ __(ucfirst($sub_category->name))  }}</option>
                                @endforeach

                            </select>
                        </div><!-- End .select-custom -->

                    @if(!$product->discount_price)

                        <label for="price">{{__('Price')}} <span class="required">*</span></label>
                        <span class="invalid-feedback error-price"></span>
                        <input type="text" name="price" class="form-input form-wide mb-2 is-invalid" id="price" value="{{ $product->price }}"/>

                        <label for="devise">{{__('Devise')}} <span class="required ">*</span></label>
                        <div class="select-custom mb-2 form-group">
                            <span class="invalid-feedback error-devise"></span>
                            <select name="devise" id="devise" class="form-control form-control-sm">

                                <option value="">{{ __('Choose') }}</option>

                                @foreach(devises() as $devise)
                                    <option value="{{ $devise }}" {{ $product->devise === $devise ? 'selected' : '' }} >{{ strtoupper($devise) }}</option>
                                @endforeach

                            </select>
                        </div><!-- End .select-custom -->
                    @endif

                        <label for="file">{{__('Principal image')}} <span class="required">*</span></label>
                        <div class="bg-white rounded-lg p-4 mb-4">

                            <span class="invalid-feedback error-file"></span>
                            <input type="file" name="file" id="file" class="inputfile d-none" value="{{ $product->image }}"/>

                            <div class="media align-items-center" id="aph">

                                <img src="{{ asset( $product->image ) }}" width="90" height="88" alt="" id="file-product">

                                <div class="media-body pl-3">
                                    <label class="btn btn-light btn-shadow btn-sm mb-2" for="file" type="button"><ion-icon class="mr-2"  name="sync-outline"></ion-icon>{{ __('UPLOAD IMAGE') }}</label>
                                    <div class="p mb-0 font-size-ms text-muted">{{ __('UPLOAD') }}   JPG or PNG image.</div>
                                </div>
                            </div>
                        </div>


                </div><!-- End .col-md-6 -->

                <div class="col-md-6">


                    <label for="type">{{__('Type')}} <span class="required">*</span></label>

                    <div class="select-custom mb-2 form-group">
                        <span class="invalid-feedback error-type"></span>
                        <select name="type" id="type" class="form-control form-control-sm">

                            <option value="">{{ __('Choose') }}</option>

                            <option value="simple" {{ $product->type === 'simple' ? 'selected' : '' }}>{{ strtoupper(__( 'simple')) }}</option>
                            <option value="vip" {{ $product->type === 'vip' ? 'selected' : '' }}>{{ strtoupper(__( 'VIP')) }}</option>

                        </select>
                    </div><!-- End .select-custom -->


                    <label for="colors">{{__('Colors')}}</label>

                    <div class="select-custo mb-2">
                        <span class="invalid-feedback error-colors"></span>
                        <select name="colors" id="colors" class="form-control form-control-sm"  multiple>

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(stock_colors() as $key => $value)
                                <option value="{{ $value }}" {{ ($product->colors_product && in_array($value, $product->colors_product) ) ? 'selected' : '' }}>{{ strtoupper(__( $key)) }}</option>
                            @endforeach
                        </select>
                    </div><!-- End .select-custom -->


                    <label for="sizes">{{__('Sizes')}}</label>

                    <div class="select-custo mb-2">
                        <span class="invalid-feedback error-sizes"></span>
                        <select name="sizes" id="sizes" class="form-control form-control-sm"  multiple>

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(stock_sizes() as $size)
                                <option value="{{ $size }}" {{ ($product->sizes_product && in_array($size, $product->sizes_product) ) ? 'selected' : '' }}>{{ strtoupper($size) }}</option>
                            @endforeach


                        </select>
                    </div><!-- End .select-custom -->

                    <label for="Brands">{{__('Brands')}}</label>
                    <div class="select-custo mb-2">
                        <span class="invalid-feedback error-brands"></span>
                        <select name="Brands" id="brands" class="form-control form-control-sm"  multiple>

                            <option value="">{{ __('Choose') }}</option>

                            @foreach(stock_brands() as $brand)
                                <option value="{{ $brand }}" {{ ($product->brands_product && in_array($brand, $product->brands_product) )? 'selected' : '' }}>{{ strtoupper($brand) }}</option>
                            @endforeach

                        </select>
                    </div><!-- End .select-custom -->


                    <div class="form-group required-field">
                        <label for="description">{{__('Description')}}</label>
                        <span class="invalid-feedback error-description"></span>
                        <textarea cols="30" rows="1" id="description" class="form-control" name="description" >{{ $product->description }}</textarea>

                    </div><!-- End .form-group -->


                </div><!-- End .col-md-6 -->

                    <div class="form-footer">
                        <button type="submit" id="submit" class="btn btn-primary btn-md">{{strtoupper(__('Create'))}}</button>
                    </div><!-- End .form-footer -->
                </div><!-- End .row -->

            </form>


    </div><!-- End .container -->

</div>













<div class="product-single-container product-single-default product-quick-view container">

    <div class="container">



        <form method="post" action="{{ route('update.various', ['lang' => app()->getLocale(), 'various_id' => $various->id, 'slug' => $various->slug]) }}" class="mb-1" id="edit-various-form">

            <h2 class="title mb-2">{{__('EDIT ANNOUNCE OR PUBLICITY')}}</h2>

            <div class="row">

                <div class="col-md-6">

                    <label for="name">{{__('Name')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-name"></span>
                    <input type="text" name="name" class="form-input form-wide mb-2 is-invalid" id="name" value="{{ $various->title }}"/>

                    @if($various->price)

                        @if(!$various->discount_price)

                            <label for="price">{{__('Price')}} </label>
                            <span class="invalid-feedback error-price"></span>
                            <input type="text" name="price" class="form-input form-wide mb-2 is-invalid" id="price" value="{{ $various->price }}"/>

                            <label for="devise">{{__('Devise')}} <span class="required d-none">*</span></label>
                            <div class="select-custom mb-2 form-group">
                                <span class="invalid-feedback error-devise"></span>
                                <select name="devise" id="devise" class="form-control form-control-sm">

                                    <option value="">{{ __('Choose') }}</option>

                                    @foreach(devises() as $devise)
                                        <option value="{{ $devise }}" {{ $various->devise === $devise ? 'selected' : '' }}>{{ strtoupper($devise) }}</option>
                                    @endforeach

                                </select>
                            </div><!-- End .select-custom -->
                        @endif
                    @endif

                    <label for="file">{{__('Principal image')}} <span class="required">*</span></label>
                    <div class="bg-white rounded-lg p-4 mb-4">

                        <span class="invalid-feedback error-file"></span>
                        <input type="file" name="file" id="file" class="inputfile d-none" value="{{ $various->image ?? asset('variouses_galleries/default-announce.jpg') }}"/>

                        <div class="media align-items-center" id="aph">

                            <img src="{{ asset( $various->image ) ?? asset('variouses_galleries/default-announce.jpg') }}" width="90" height="88" alt="" id="file-product">

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

                            <option value="announce" {{ $various->type === 'announce' ? 'selected' : '' }} >{{ strtoupper(__( 'announce')) }}</option>
                            <option value="publicity" {{ $various->type === 'publicity' ? 'selected' : '' }}>{{ strtoupper(__( 'publicity')) }}</option>
                            <option value="recruitment" {{ $various->type === 'recruitment' ? 'selected' : '' }}>{{ strtoupper(__( 'recruitment')) }}</option>

                        </select>
                    </div><!-- End .select-custom -->



                    <div class="form-group required-field">
                        <label for="description">{{__('Description')}}</label>
                        <span class="invalid-feedback error-description"></span>
                        <textarea cols="30" rows="1" id="description" class="form-control" name="description" >{{ $various->description }}</textarea>

                    </div><!-- End .form-group -->




                </div><!-- End .col-md-6 -->

                <div class="form-footer">
                    <button type="submit" id="submit" class="btn btn-primary btn-md">{{strtoupper(__('Create'))}}</button>
                </div><!-- End .form-footer -->
            </div><!-- End .row -->

        </form>


    </div><!-- End .container -->

</div>






















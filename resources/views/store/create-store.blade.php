<div class="product-single-container product-single-default product-quick-view container">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6">
                <h2 class="title mb-2">{{__('CREATE STORE')}}</h2>

                <form method="post" action="#" class="mb-1" id="store-form">

                    <label for="name-store">{{__('Name')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-name-store"></span>
                    <input type="text" name="name_store" class="form-input form-wide mb-2 is-invalid" id="name-store"/>


                    <label for="slogan">{{__('Slogan')}}</label>
                    <span class="invalid-feedback error-slogan-store"></span>
                    <input type="text" name="slogan_store" class="form-input form-wide mb-2 is-invalid" id="slogan-store"/>


                    <div class="bg-white rounded-lg p-4 mb-4">

                        <span class="invalid-feedback error-store-image"></span>
                        <input type="file" name="file" id="file" class="inputfile d-none"/>

                        <div class="media align-items-center" id="aph">

                            <img src="https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg" width="90" height="88" alt="" id="image-store">

                            <div class="media-body pl-3">
                                <label class="btn btn-light btn-shadow btn-sm mb-2" for="file" type="button"><ion-icon class="mr-2"  name="sync-outline"></ion-icon>{{ __('UPLOAD IMAGE') }}</label>
                                <div class="p mb-0 font-size-ms text-muted">{{ __('UPLOAD') }}   JPG or PNG image.</div>
                            </div>

                        </div>


                    </div>

                    <div class="form-footer">
                        <button type="submit" id="submit" class="btn btn-primary btn-md">{{strtoupper(__('Create'))}}</button>
                    </div><!-- End .form-footer -->

                </form>
            </div><!-- End .col-md-6 -->

        </div><!-- End .row -->
    </div><!-- End .container -->

</div>














<!-- SHIPPING FORM Modal -->

<div class="modal fade" id="orderProductModal" tabindex="-1" role="dialog" aria-labelledby="orderProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="shipping-form" data-new-address="">
                <div class="modal-header">
                    <h3 class="modal-title" id="addressModalLabel">{{__('Shipping Address')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- End .modal-header -->

                <div class="modal-body">
                    <div class="form-group required-field">
                        <label>{{__('First Name')}} </label>
                        <span class="invalid-feedback error-first-name"></span>
                        <input type="text" name="first_name" id="first-name" class="form-control form-control-sm" value="@if(Cookie::has('shipping_address')) {{ cast_cookie('shipping_address')->first_name }} @elseif(Auth::is()) {{ Auth::user()->first_name }} @else {{ '' }} @endif">

                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label>{{__('Last Name')}} </label>
                        <span class="invalid-feedback error-last-name"></span>
                        <input type="text" name="last_name" id="last-name" class="form-control form-control-sm" value="@if(Cookie::has('shipping_address')) {{ cast_cookie('shipping_address')->last_name }} @elseif(Auth::is()) {{ Auth::user()->last_name }} @else {{ '' }} @endif">

                    </div><!-- End .form-group -->

                    <div class="form-group d-none">
                        <label>{{__('Company')}} </label>
                        <input type="text" name="company" id="company" class="form-control form-control-sm">
                        <span class="invalid-feedback error-company"></span>
                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label>{{__('Street Address')}} </label>
                        <span class="invalid-feedback error-street"></span>
                        <input type="text" name="street" id="street" class="form-control form-control-sm" value="@if(Cookie::has('shipping_address')) {{ cast_cookie('shipping_address')->street }} @else {{ '' }} @endif">

                    </div><!-- End .form-group -->

                    <div class="form-group">
                        <label>{{__('Country')}}</label>
                        <div class="select-custom">
                            <select name="country" id="country-shipping" class="form-control form-control-sm">
                                @foreach(Helper::getCountries() as $country)
                                    <option value="{{ $country }}" @if(Cookie::has('shipping_address') && cast_cookie('shipping_address')->country === $country) {{ 'selected' }} @else {{ '' }} @endif >{{ $country }}</option>
                                @endforeach
                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .form-group -->

                    <div class="form-group required-field">
                        <label>{{__('City')}}  </label>
                        <span class="invalid-feedback error-city"></span>
                        <input type="text" name="city" id="city" class="form-control form-control-sm" value="@if(Cookie::has('shipping_address')) {{ cast_cookie('shipping_address')->city }} @else {{ Helper::userLocation()->city }} @endif">

                    </div><!-- End .form-group -->

                    <div class="form-group">
                        <label>{{__('State/Province')}}</label>
                        <div class="select-custom">
                            <select name="state" id="state-shipping" class="form-control form-control-sm">

                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .form-group -->

                    <div class="form-group">
                        <label>{{__('Zip/Postal Code')}} </label>
                        <span class="invalid-feedback error-postal-code"></span>
                        <input type="text" name="postal_code" id="postal-code" class="form-control form-control-sm" value="@if(Cookie::has('shipping_address')) {{ cast_cookie('shipping_address')->postal_code }} @else {{ Helper::userLocation()->postal_code }} @endif">

                    </div><!-- End .form-group -->



                    <div class="form-group required-field">
                        <label>{{__('Phone Number')}} </label>
                        <span class="invalid-feedback error-phone"></span>
                        <input name="phone" id="phone" type="tel" class="form-control form-control-sm" value="@if(Cookie::has('shipping_address')) {{ cast_cookie('shipping_address')->phone }} @elseif(Auth::is() && Auth::user()->phone) {{ Auth::user()->phone }} @endif">

                    </div><!-- End .form-group -->

                    <div class="form-group-custom-control">
                        <div class="custom-control custom-checkbox" id="custom-checkbox-save-address">
                            <input type="checkbox" name="save_address" value="1" class="custom-control-input" id="address-save">
                            <label class="custom-control-label" for="address-save">{{__('Save in Address book')}}</label>
                        </div><!-- End .custom-checkbox -->
                    </div><!-- End .form-group -->
                </div><!-- End .modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-sm" id="cancel-btn" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-primary btn-sm">{{__('Order')}}</button>
                    <button type="reset" class="btn btn-primary btn-sm d-none" id="reset-btn">{{__('Reset')}}</button>
                </div><!-- End .modal-footer -->
            </form>
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->




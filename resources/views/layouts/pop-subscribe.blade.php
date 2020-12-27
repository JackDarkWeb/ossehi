<div class="newsletter-popup mfp-hide" id="{{ Cookie::get('stop_pop_newsletter') ? '' : 'newsletter-popup-form' }}"  style="background-image: url({{ asset('images/newsletter_popup_bg.jpg') }})">

    <div class="newsletter-popup-content">
        <img src="{{ asset('images/logo-o.png') }}" height="50px" width="150px" alt="Logo" class="logo-newsletter">
        <h2>{{__('BE THE FIRST TO KNOW')}}</h2>
        <p>{{__('Subscribe to the Ossehi eCommerce newsletter to receive timely updates from your favorite products.')}}</p>

        <form action="#" method="#" id="form-subscribe-pop">
            @csrf
            <div class="input-group">

                <span class="error-email" style="color: red; font-size: small; font-style: italic; position: relative"></span>
                <input type="email" class="form-control" id="email-subscribe" name="email" placeholder="{{__('Email address')}}">

                <input type="submit" class="btn" value="{{__('GO')}}!">
            </div><!-- End .from-group -->
        </form>

        <div class="newsletter-subscribe">
            <div class="checkbox">
                <label data-browse="">
                    <input type="checkbox" id="stop-pop-newsletter" value="1">
                    {{__("Don't show this popup again")}}
                </label>
            </div>
        </div>
    </div><!-- End .newsletter-popup-content -->
</div><!-- End .newsletter-popup -->



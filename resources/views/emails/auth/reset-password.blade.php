@component('mail::message')
# {{__('Reset password')}}

{{__('Click in the button for change your password')}}

@component('mail::button', ['url' => route_name('password.update', ['slug' => $slug])])
    {{__('Reset your password') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent






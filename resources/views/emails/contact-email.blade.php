@component('mail::message')
## {{__(' Hello')}},

{{__('You received a message from **:name**', ['name' => $request->name])}}

#### {{__('The content of the message')}}

{{ $request->message }}
<br>
{{ $request->phone }}



{{__('Thanks')}},<br>
{{ $request->name }}
@endcomponent

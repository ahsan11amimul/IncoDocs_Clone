@component('mail::message')
#Thanks for Messaging Us.
<strong>Customer:</strong>{{ $data['name'] }}
<strong>Email:</strong>{{    $data['email'] }}
<strong>Message:</strong>{{ $data['message'] }}


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

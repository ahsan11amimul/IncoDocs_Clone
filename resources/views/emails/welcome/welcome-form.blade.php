@component('mail::message')
# Please Verify Your Email

Below is your Activation Link.
{{-- @component('mail::button', ['url' =>'verifymail/'.$user->email_verification_token,'color' => 'success'])
Activate Account
@endcomponent --}}
<a href="{{url('/verifymail/'.$user->email_verification_token)}}">Activate your Account</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
 
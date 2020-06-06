@component('mail::message')

<h6>Reciepient has accepted {{$quote->quote_number}} for {{$quote->invoice_total}}.</h6>
Hi,
<p>{{App\User::where('id',$quote->user_id)->first()->value('name')}} Reciepient has accepted {{$quote->quote_number}} for {{$quote->invoice_total}}.</p>

<p>View your quote online: <a href="{{url('/quotes/'.$quote->key.'/view')}}">View Quote</a></p>
<p>From your online quote you can accept, comment or print.</p>

<p>If you have any questions, please let me know.</p>


Thanks,<br>
<a href="#">www.incodocs.com</a>
@endcomponent  

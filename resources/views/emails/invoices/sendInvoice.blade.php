@component('mail::message')

<h6>{{$invoice->invoice_type?'Commercial Invoice':'Profarma Invoice'}} {{$invoice->invoice_number}} for {{$invoice->invoice_total}} is awaiting your approval.</h6>

Hi,<br>
Here's {{$invoice->invoice_type?'Commercial Invoice':'Profarma Invoice'}} {{$invoice->invoice_number}} for {{$invoice->invoice_total}}
<p>View your proforma invoice online: <a href="{{url('/invoices/'.$invoice->id.'/show')}}">View Invoice</a></p>
<p>From your online proforma invoice you can accept, comment or print.</p>

<p>If you have any questions, please let me know.</p>

Thanks,<br>
{{ App\User::where('id',$invoice->user_id)->first()->value('name') }}
@endcomponent

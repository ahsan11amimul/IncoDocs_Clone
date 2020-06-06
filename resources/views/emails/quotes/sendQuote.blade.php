<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Email</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-2">
                

                <h6>Quote {{$quote->quote_number}}  for {{$quote->invoice_total}} is awaiting your approval.</h6>

                Hi,<br>
                Here's {{$quote->quote_number}} for {{$quote->invoice_total}}
                <p>View your proforma invoice online: <a href="{{url('/quotes/'.$quote->key.'/view')}}">View Quotes</a></p>
                <p>From your online proforma invoice you can accept, comment or print.</p>

                <p>If you have any questions, please let me know.</p>

                Thanks,<br>
                {{ App\User::where('id',$quote->user_id)->first()->value('name') }}


            </div>
        </div>
    </div>
    
</body>
</html>
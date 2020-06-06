<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3 style="text-align: center;">Invoice</h3>
    <hr>
    <div style="float:left;width:350px;border:1px solid black;">
        <p style="padding:5px;"><strong>Invoice Number</strong><strong style="margin-left: 120px;">Delivery Date</strong></p></p>
        <p style="padding:5px;">{{$invoice->invoice_number}} <span style="margin-left: 185px;">{{$invoice->delivery_date}}</span></p>
        <hr>
        <p style="padding:5px;"><strong>Buyer</strong></p>
        <?php $item=App\Contact::where('id',$invoice->buyer_id)->first();?>
        <p style="padding:5px;"><strong>Name:</strong>{{$item->first_name??''}} {{$item->last_name??''}}</p>
        <p style="padding:5px;"><strong>Address:</strong>{{$item->address??''}}</p>
        <p style="padding:5px;"><strong>City:</strong>{{$item->city??''}},{{$item->state??''}}</p>
        <p style="padding:5px;"><strong>Country:</strong>{{$item->country}}</p>
        <p style="padding:5px;"><strong>Phone:</strong>{{$item->phone}}</p>
    

    </div>
     <div style="float:right;width:350px;border:1px solid black;">
        <p style="padding:5px;"><strong>Place</strong><strong style="margin-left: 160px;">Date Of Issue</strong></p>
        <p style="padding:5px;"><span>Dhaka</span> <span style="margin-left: 170px;">april 2020</span></p>
        <hr>
        <p style="padding:5px;"><strong>Sellr</strong></p>
        <?php $item=App\Contact::where('id',$invoice->seller_id)->first();?>
        <p style="padding:5px;"><strong>Name:</strong>{{$item->first_name??''}} {{$item->last_name??''}}</p>
        <p style="padding:5px;"><strong>Address:</strong>{{$item->address??''}}</p>
        <p style="padding:5px;"><strong>City:</strong>{{$item->city??''}},{{$item->state??''}}</p>
        <p style="padding:5px;"><strong>Country:</strong>{{$item->country}}</p>
        <p style="padding:5px;"><strong>Phone:</strong>{{$item->phone}}</p>

    </div>
    <div style="width: 700px;background-color:#fff;color:black;">
       <p>
       <span style="margin:0 20px;">#</span>
       <span style="margin:0 20px;">Code</span>
       <span style="margin:0 20px;">Description of Goods</span>
       <span style="margin:0 20px;">Quantity</span>
       <span style="margin:0 20px;">Unit</span>
       <span style="margin:0 20px;">Price</span>
       <span style="margin:0 20px;">Amount</span>

       </p>
        <?php
            $total_quantity=0;
            $total_amount=0;
            ?>
        @foreach (App\OrderItem::where('invoice_number',$invoice->invoice_number)->get() as $inv)
        <p>
        <span id="sr_no"style="margin:0 20px;">{{$loop->iteration}}</span>
        <span style="margin:0 20px;">{{$inv->code}}</span>
        <span style="margin:0 20px;">{{$inv->description}}</span>
        <span style="margin:0 0 0 120px;">{{$inv->quantity}}</span> 
        <?php $total_quantity+=$inv->quantity ?>
        <span style="margin:0 0 0 85px;">{{$inv->unit}}</span>
        <span style="margin:0 0 0 55px;">{{$inv->price}}</span>
        <span style="margin:0 0 0 55px;">{{$inv->amount}}</span> 
        <?php $total_amount+=$inv->amount ?>
       </p>
        @endforeach
       <hr>
       <p>
       <span style="margin:0 0 0 10px;">Total of This Page:</span>  <span style="margin:0 0 0 209px;">{{$total_quantity}}</span> 
       <span style="margin:0 0 0 224px;">{{$total_amount}}</span>
       </p>
       <hr>
       <p>
       <span style="margin:0 0 0 10px;">Discount:</span>  <span style="margin:0 0 0 515px;">{{$invoice->discount}}</span> 
       </p>
       <hr>
       <p>
       <span style="margin:0 0 0 10px;">Invoice Total:</span>  <span style="margin:0 0 0 480px;">{{$invoice->invoice_total}}</span> 
       </p>
    </div>
    <div style="width: 700px;background-color:#fff;color:black;">
       <p>Additional Information</p>
       <p>Signatory Company</p>
    </div>
     
</body>
</html>
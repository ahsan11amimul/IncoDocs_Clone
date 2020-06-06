{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="{{asset('css/pages_index.css')}}">
 
</head>
<body>
@yield('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('cdn/font-awesome/all.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables.css')}}">
    <link rel="stylesheet" href="{{ asset('css/pages_index.css')}}">
    <link rel="icon" href="{{ URL::asset('/images/favicon.png') }}" type="image/x-icon"/> 
    <title>@yield('title')</title>
</head>
<body>
      
   @yield('content')

    
<script src="{{asset('cdn/jquery.js')}}"></script>
<script src="{{asset('cdn/popper.js')}}"></script>
<script src="{{asset('cdn/bootstrap.js')}}"></script>
<script src="{{asset('cdn/datatables.js')}}"></script>
<script src="{{asset('cdn/boot_datatables.js')}}"></script>
<script src="{{asset('js/pages_index.js')}}"></script>

</body>
</html>
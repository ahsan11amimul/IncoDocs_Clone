<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">{{App\Contact::where('id',$quote->seller_id)->first()->value('company_name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        <a class="nav-link" href="{{url('user/dashboard')}}">Dashboard</a>
        </li>
      
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link mx-3" href="#">{{ number_format($quote->invoice_total, 3) }}</a>
        </li>
        <li class="nav-item">
          @if ($quote->status=='Sent')
        <a class="btn btn-outline-info btn-sm mx-3" href="{{url('quotes/'.$quote->id.'/accept')}}">Accept</a>  
            @else
        <a class="btn btn-outline-success btn-sm mx-3" href="#">Accepted</a> 
            @endif
          </a>
        </li>
        <li class="nav-item">
            @auth
            <a class="btn btn-outline-warning btn-sm mx-3" href="/logout">Sign out</a>
            @endauth

            @guest
            <a class="btn btn-outline-primary btn-sm mx-3" data-toggle="modal"data-target="#loginModal" href="#">Sign in</a>
            @endguest
        
        </li>
      </ul>
      
    </div>
  </div>

</nav>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3764C1;height:200px;">
        <h3 class="text-white pt-5 m-auto">IncoDocs</h3>
          
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <br>
        
      </div>
      <div class="modal-body">
          <div class="text-center font-weight-bolder mb-2" style="color:#30446D">Sign in to your account to <br>
            securely create documents.</div>
             @if (Session::has('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Warning !</strong>{{Session('error')}}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
             </div>  
             @endif
        <form action="{{url('/login')}}" method="POST" id="loginForm" class="alert alert-warning">
          @csrf
          <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="email" autofocus>
          </div>
          <span class="text-danger">{{$errors->first('email')}}</span>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password ( min 8characters)" required autocomplete="password">
          </div>
          <span class="text-danger">{{$errors->first('password')}}</span>
      <a href="{{url('/forgetpassword')}}" class="nav-link text-muted text-right">Forget Password??</a>
      <button type="submit" class="btn btn-primary w-100 continue">Continue</button>
      <a href="{{url('/register')}}" class="nav-link text-right"><span class="text-muted">New To IncoDocs??</span> Create an Account</a>
        </form>
      

      </div>
      <div class="modal-footer">
          
       <p class="text-center text-muted"> By continuing, you agree to IncoDocs’
        Terms of Use and Privacy Policy.
       </p>
      </div>
    </div>
  </div>
</div>
<script>
	//  $(document).ready(function(){
	// 	$.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  //   });
  //   $('.status').hide();
    $('#loginForm').on('submit', function (event) {
        
        event.preventDefault();
    });
        
  //       $.ajax({
  //          url: '/login',
  //          type: 'POST',
  //          contentType: false,
  //          cache: false,
  //          processData: false,
  //          dataType: "json",
  //          data: new FormData(this),
  //          success:function(result)
  //          {
  //           //$('#login_status').html(result.data);
  //           if(result.data==='admin')
  //           {
  //             window.location.href="localhost:8000/admin/dashboard";
  //           }else if(result.data==='user')
  //           {
  //             window.location.href="localhost:8000/user/dashboard";
              
  //           }else{
  //             $('#login_status').html(result.data);
  //             $('.status').show();
  //           }
            

  //          },
  //          error:function(result)
  //          {
  //             console.log(result.data);
              
  //          }
  //       });
  //     });

   // });
</script>

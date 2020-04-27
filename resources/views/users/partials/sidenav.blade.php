<div class="sidenav">
      <!-- Example split danger button -->
<div class="dropdown">
   <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{App\Company::firstWhere('user_id',auth()->user()->id)->name}}
  </a>
  <div class="dropdown-menu">
  <a class="dropdown-item" href="{{url('/profile')}}">
            <i class="fas fa-home mr-3 text-muted"></i>
            Account Setting
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
            <i class="fas fa-user-plus mr-3 text-muted"></i>
            Invite Members</a>
        <a class="dropdown-item" href="{{url('/team')}}">
            <i class="fas fa-user-friends mr-3 text-muted"></i>
            Manage Members
        </a>
        <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{url('/company')}}">
            <i class="fas fa-cog mr-3 text-muted"></i>
            Comapany Settings
        </a>
        <a class="dropdown-item" href="#">
        <i class="fas fa-file-invoice-dollar mr-3 text-muted"></i>
            Online Payment
        </a>
    <a class="dropdown-item" href="{{url('/plans')}}">
            <i class="fas fa-money-bill-wave text-muted mr-3"></i>
            Plans & Billing
        </a>
    </div>
</div>
      <hr>
      <a href="{{url('user/dashboard')}}">
            <i class="fas fa-home mr-3 text-muted"></i>
            Dashboard
        </a>
      <a href="{{url('/contacts')}}">
            <i class="fas fa-user mr-3 text-muted"></i>
            Contacts
            
        </a>
       <a href="{{url('/products')}}">
           <i class="fas fa-tags mr-2 text-muted"></i>
            Products
            
        </a>
        <a href="{{url('/details')}}">
            <i class="fas fa-file-alt mr-3 text-muted"></i>
            Details
           
        </a>
        <br>
        <br>
     <a href="{{url('/invoices')}}">
           <i class="fas fa-file-invoice-dollar mr-3 text-muted"></i>
            Invoices
            
        </a>
        <a href="{{url('/quotes')}}">
            <i class="fas fa-file-alt mr-3 text-muted"></i>
            Quotes
             
        </a>
        <hr>
    <a href="{{url('/purchases')}}">
            <i class="fas fa-file-alt mr-3 text-muted"></i>
            Purchases
            
        </a>
        <a href="#">
            <i class="far fa-folder mr-3 text-muted"></i>
            Shipment
            
        </a>
    </div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="{{url('admin/dashboard')}}">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/users')}}">Users </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/countries')}}">Country</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="{{url('/places')}}">Loading</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/places')}}">Discharge</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{url('/dispatch')}}">Dispatch</a>
      </li>
    </ul>
   
  </div>
</div>
</nav>
<div class="mainHeader">
    <ul class="nav justify-content-end  pt-4">
           
            <li class="nav-item">
                <a class="nav-link" href="#" title="Help Center">
                    <i class="fas fa-star"></i>
                </a>
            </li>
            <li class="nav-item">
             <div class="dropdow">
                <a class="nav-link dropdown-toggle" id="dropdownId" data-toggle="dropdown" href="#">
                  <span class="letter">
                      {{strtoupper(substr(Auth::user()->email,0,1))}}
                  </span>
                  
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">

                <a class="dropdown-item" href="#"> 
                   
                    <span class="letter">{{strtoupper(substr(Auth::user()->email,0,1))}}</span>
                    {{Auth::user()->email}}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"  href="{{url('/profile')}}">
                        <i class="fas fa-user-edit ml-2 mr-2"></i>
                        Account Setting
                    </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/logout')}}">
                       <i class="fas fa-sign-out-alt ml-2 mr-2"></i>
                        Log out
                    </a>
                  </div>  
                </div>
            </li>
           
        </ul>
</div>

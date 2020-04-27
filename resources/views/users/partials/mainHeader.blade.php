<div class="mainHeader">
    <ul class="nav justify-content-end mt-3 pt-4">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary">
                   <i class="fas fa-user-plus"></i>
                   Invite Team
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Help Center">
                    <i class="fas fa-star"></i>
                </a>
            </li>
            <li class="nav-item">
             <div class="dropdow">
                <a class="nav-link dropdown-toggle" id="dropdownId" data-toggle="dropdown" href="#">
                  <i class="fab fa-adn text-danger fa-2x">
                
                  </i>
                  
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">

                <a class="dropdown-item" href="#"> 
                   
                    <i class="fab fa-adn text-danger fa-1x ml-2 mr-2"></i>
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

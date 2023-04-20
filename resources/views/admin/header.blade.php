<nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="{{url('redirect')}}"><img src="{{asset('admin/assets/images/logo-mini.svg')}}" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form method="GET" action="{{url('search')}}" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  @csrf
                  <input type="text" style="color:white;" class="form-control" placeholder="Search products">
                  <button type="submit" name="search" class="btn btn-primary">Search</button>
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              
             
           
            


              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i  class="mdi mdi-bell">
                  @if(auth()->user()->unreadNotifications->count() > 0)
                  <span  class="count bg-danger"></span>
                  @else
                  <span ></span>
                  @endif
                </i>
                 
                </a>
               
                <div style="text-align:center ;" class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications </h6>
                 
                  <p style="margin: auto;" class="dropdown-title-text subtext subtext mb-0 text-white op-6 pd-0 tx-12">
                    You have {{auth()->user()->unreadNotifications->count()}} unread Comment
                  </p>
                 
                  <div class="dropdown-divider"></div>
                  @foreach(auth()->user()->unreadNotifications as $notification)

                  @if(isset($comment->id))
                  <a class="dropdown-item preview-item">
                    <a href="{{url('show_one_comment',$comment->id)}}">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class=""></i>
                      </div>
                              
                    </a>
          
                  @endif

                  @endforeach 

                    <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center"><a style="text-decoration: none;color: white;" href="{{url('mark_as_read_all')}}">Mark All Read</a> </p>
                </div>
              </li>
           
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
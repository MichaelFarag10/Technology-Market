<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="100" style="border-radius: 10%;"  src="{{asset('home/images/logo.png')}}" alt="5" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">

                     <li class="nav-item  @yield('active1')">

                           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>


                        <li class="nav-item  @yield('active2')">
                           <a class="nav-link" href="{{url('products')}}">Products</a>
                        </li>
                        <li class="nav-item  @yield('active3')">

                           <a class="nav-link" href="{{url('contact')}}">Contact</a>

                        </li>
                        @if(Route::has('login'))

                        @auth
                        <li class="nav-item  @yield('active4')">
                           <a class="nav-link" href="{{url('show_cart')}}" style="width:80px;display: flex;">Cart
                           @if($cartcount == 0)
                           <span style=" margin-left: 2px;">[{{$cartcount ?? '0'}}]</span></a>
                           @else
                           <span style=" color:red; margin-left: 2px;">[{{$cartcount ?? '0'}}]</span></a>

                           @endif
                        </li>
                       @else
                       <li class="nav-item  @yield('active4')">
                           <a class="nav-link" href="{{url('show_cart')}}" style="width:80px;display: flex;">Cart</a>
                        </li>
                       @endauth
                       @endif

                       @if(Route::has('login'))
                        @auth
                        <li class="nav-item  @yield('active5')">

                           <a class="nav-link" href="{{url('show_order')}}">
                          @if(count($order) == 0)
                          <span> Order[{{count($order) ?? 0}}]</span>
                          @else
                           Order<span style="color:red;">[{{count($order) ?? 0}}]</span>

                           @endif
                           </a>

                        </li>
                        @else
                        <li class="nav-item  @yield('active5')">
                       <a class="nav-link" href="{{url('show_order')}}">Order</a>
                        </li>
                        @endauth
                       @endif

                        @if(Route::has('login'))
                        @auth
                        @if(Auth::user()->usertype == "1")
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('redirect')}}">
                           Admin
                           </a>
                        </li>
                        @endif
                        @endauth
                        @endif
                        @if(Route::has('login'))

                        @auth

                        <li class="nav-item">

                           <x-app-layout>
                           </x-app-layout>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link" href="{{route('login')}}">
                           Login
                           </a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{route('register')}}">
                           Register
                           </a>
                        </li>
                        @endauth
                        @endif



                     </ul>
                  </div>
               </nav>
            </div>
</header>

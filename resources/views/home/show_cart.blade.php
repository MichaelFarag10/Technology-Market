@section('active4')
 active
@endsection




<!DOCTYPE html>
<html>
   <head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('home/images/logo.png')}}" type="">
      <title>Technology Market | Show Cart</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style type="text/css">

        .table_style{
            margin: auto;
            width: 50%;
            padding:50px; ;

        }

      </style>
   </head>
   <body>
   @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
     @include('home.header')
         <!-- end header section -->
         @if(session()->has('message'))
                <div class="alert alert-success">
                    <button class="close" data-dissmiss="alert" aria-hidden="true">x</button>
                  
                    {{session()->get('message')}}
                </div>
            @endif
      <div class="tabel_style mt-5 text-center">
         <table class="table  table-hover ">
                <tr>
                    <th>Product Title</th>
                    <th>Product Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                    
                </tr>
                <?php  $totalprice=0;?>
                @foreach($cart as $cart)
                <tr>
                    <td>{{$cart->product_title}}</td> 
                    <td>{{$cart->quantity}}</td> 
                    <td>${{$cart->price}}</td> 
                    <td style="width:50px ;" ><img style="border-radius:50px ;" src="/product/{{$cart->image}}" alt=""></td> 
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure!')" href="{{url('remove_product',$cart->id)}}">Remove Product</a></td> 

                </tr>
                <?php $totalprice= $totalprice + $cart->price; ?>
                @endforeach
                
            </table>
            <div>
                <h1 style="padding:40px;font-size:18px;">Total Price: <span style="color:red;">${{$totalprice}} </span></h1>
            </div>
        <br>
            <div>
                <h1 style="font-size: 18px;">Proceed To Order</h1>
                <br>
                <a class="btn btn-primary" href="{{url('cash_order')}}">Cash On Delivery</a>
                <a class="btn btn-danger" href="{{url('stripe',$totalprice)}}">Pay Using Card</a>
            </div>
        <br><br>
        </div>


         <!-- footer start -->
    @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <script type="text/javascript">
            function confirmation(ev){
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                console.log(urlToRedirect);
                swal({
                    title:"Are you sure to cancel this product",
                    text:"You will not be able to revert this!",
                    icon: "warning",
                    buttons:true,
                    dangerMode:true,

                })
                .then((willCancel) =>{

                    if(willCancel){
                        window.location.href = urlToRedirect;

                    }
                });
            }

      </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
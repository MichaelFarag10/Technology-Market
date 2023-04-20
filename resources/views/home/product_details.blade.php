<!DOCTYPE html>
<html>
   <head>

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
      <title>Technology Market | Product Details</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
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
      <div style="margin:auto;width:50%;padding: 30px;" class="col-sm-6 col-md-4 col-lg-4">
             
                     <div style="padding: 20px;" class="img-box">
                        <img src="/product/{{$product_details->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           Product Title: {{$product_details->title}}
                        </h5>
                     @if($product_details->discount_price !=null)

                        <h6>
                        Discount Price: ${{$product_details->discount_price}}
                        </h6>

                        <h6 style="text-decoration: line-through; color:red;">
                          Product Price: ${{$product_details->price}}
                        </h6>

                     @else

                     <h6>
                        Product Price:   ${{$product_details->price}}
                     </h6>
                     

                     @endif
                    <h6>Product Catagory: {{$product_details->catagory}}</h6>
                    <h6>Product Description: {{$product_details->description}}</h6>
                    <h6>Product Quantity: {{$product_details->quantity}}</h6>
                    
                    <form action="{{url('add_cart',$product_details->id)}}" method="POST">
                              @csrf
                             <div class="row">
                              <div class="col-md-4"> 
                               <input type="number" name="quantity"  style="width:100px;" value="1" min="1">
                             </div> 
                             <div class="col-md-4">
                               <input type="submit" class="btn btn-danger" style="border-radius:30px;" value="Add To Cart">
                             </div> 
                           </div>
                           </form>  
                            
                    </div>
                  </div>
               </div>
      <!-- footer start -->
 @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
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
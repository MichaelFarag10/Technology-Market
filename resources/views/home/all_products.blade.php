@section('active2')
 active
@endsection



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
      <title>Technology Market | All Products </title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   

   <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet"/>

</head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
     @include('home.header')
         <!-- end header section -->

    
      <!-- product section -->
   @include('home.product_view')
      <!-- end product section -->


     <!--  Comment and reply system starts here -->

     <h1 style="font-size:30px;text-align:center;padding-top:20px;padding-bottom: 20px;">Comments</h1>

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
      <div class="container">
      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
         <div class="swiper-wrapper">
      @foreach($comment as $comments)
         <div class="swiper-slide">
            <div class="testimonial-wrap">
               <div class="testimonial-item">
               
               @if (Route::has('login'))
               @auth
               <img class="testimonial-img "  src="storage/{{$comments->image}}" alt="" class="img-fluid">
               @else
               <img class="testimonial-img" src="assets/img/user_default.png" alt="" class="img-fluid">
               @endauth
               @endif

               <h3>{{$comments->name}}</h3>
               <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        {{$comments->comment}}
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
               </p>
               </div>
            </div>
         </div>
         
         @endforeach
         
         <!-- End testimonial item -->

         

         </div>
         <div class="swiper-pagination"></div>
      </div>

      </div>
</section>



<div style="text-align:center ;">
  <form action="{{url('add_comment')}}" method="POST">
     @csrf
     <textarea style="height:150px;width:600px;" placeholder="Comment Somthing Here" name="comment" id="" ></textarea>
     <br>
        <input class="btn btn-primary" type="submit" value="Comment">
  </form>
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



      <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
      <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
      <script src="assets/vendor/php-email-form/validate.js"></script>

      <!-- Template Main JS File -->
      <script src="assets/js/main1.js"></script>
   </body>
</html>
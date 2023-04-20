@section('active5')
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
      <title>Technology Market | Order</title>
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

        <div style="margin-top:40px;font-size:17px;">
            <table class="table table-white table-hover">
          <tr >
            <th>Product Title</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
            <th>Image</th>
            <th>Action</th>
         </tr>
         <tr>
            @foreach($order as $order)

                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td><img style="width: 50px; border-radius: 10px;" src="/product/{{$order->image}}" alt=""></td>
                <td>
                @if($order->delivery_status == "processing")
                 <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('cancel_order',$order->id)}}">Cansel Order</a>


                 @endif

                 @if($order->delivery_status == "delivred")
                 <p style="color:green;">Succeeded</p>

                 @endif

                 @if($order->delivery_status == "canceled")
                 <p style="color:red;">Not Allowed</p>

                 @endif
                </tr>
            @endforeach
        </table>
        </div>

      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>

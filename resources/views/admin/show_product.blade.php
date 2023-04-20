<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
   
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          @if(session()->has('message'))
                <div class="alert alert-success">
                    <button class="close" data-dissmiss="alert" aria-hidden="true">x</button>
                  
                    {{session()->get('message')}}
                </div>
            @endif
        <div class="continer" style="display: flex ; justify-content: center; align-items: center;">
          <table class="table table-dark table-hover">

            <tr>
                <th>Product Title</th>
                <th>Product Descripition</th>
                <th>Product Price</th>
                <th>Discount Price</th>
                <th>Product Quantity</th>
                <th>Product Catagory</th>
                <th>Product Image</th>
                <th>Update Product</th>
                <th>Delete Product</th>
            </tr>
            @foreach($product as $products)
            <tr>
                <td>{{$products->title}}</td>
                <td>{{$products->descripition}}</td>
                <td>{{$products->price}}</td>
                <td>{{$products->discount_pruce}}</td>
                <td>{{$products->quantity}}</td>
                <td>{{$products->catagory}}</td>
                <td><img src="product/{{$products->image}}" alt=""></td>
                <td><a class="btn btn-primary" href="{{url('/update_product',$products->id)}}">Update</a></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want delete '+'{{$products->title}}'+'?')" href="{{url('/delete_product',$products->id)}}">Delete</a></td>
           
              </tr>
            @endforeach
          </table>
          </div>
          </div>
        </div>
   
    <!-- container-scroller -->
    <!-- plugins:js -->
      @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
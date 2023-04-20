<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.header')
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')

      <div class="main-panel">
          <div class="content-wrapper">
          @if(session()->has('message'))
                <div class="alert alert-success">
                    <button class="close" data-dissmiss="alert" aria-hidden="true">x</button>

                    {{session()->get('message')}}
                </div>
            @endif
            <h6 style="text-align:center;font-size:20px;">All Orders</h6>
            <div style="text-align:center;">
              <form action="{{url('search')}}" method="GET">
                @csrf

                <input class="form-control" style="width: 250px;color:white;margin: auto;" style="font-size:17px;color:black; margin-bottom: 20px;" type="search" name="search" id="" placeholder="Search For Something">
               <br>
                <input  class="btn btn-primary" style="width: 200px;margin: auto;" type="submit" value="Search">
              </form>
            <br>
            </div>
          <table class="table table-dark table-hover">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Product Title</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Image</th>
          <th>Payment Status</th>
          <th>Delivery Status</th>
          <th>Delivered</th>
          <th>Delivered Mode</th>
          <th>Delete</th>
          <th>Print PDF</th>

          </tr>
          <tr>
            @forelse($order as $data)
            <td>{{$data->name}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->phone}}</td>
            <td>{{$data->address}}</td>
            <td>{{$data->product_title}}</td>
            <td>{{$data->quantity}}</td>
            <td>{{$data->price}}</td>
            <td><img style="width:50px;" src="/product/{{$data->image}}" alt=""></td>
            <td>{{$data->payment_status}}</td>
            <td>{{$data->delivery_status}}</td>
            <td >
             @if($data->delivery_status == "processing")
               <a href="{{url('delivred',$data->id)}}" onclick="return confirm('Are you sure you want this delivred?')" class="btn btn-primary">Delivred</a>

               @else

               <span style="color:green;">Deliverd</span>

               @endif
            </td>
            <td>
            <a href="{{url('delivred',$data->id)}}"  class="btn btn-success">Delivered</a>

            </td>
            <td>
            <a href="{{url('delete_order',$data->id)}}" onclick="return confirm('Are you sure you want delete this?')" class="btn btn-danger">Delete</a>

            </td>
            <td><a href="{{url('show_pdf',$data->id)}}" class="btn btn-secondary">PDF Mode</a></td>

          </tr>

            @empty
            <tr>

            <td colspan="16" style="text-align:center;font-size:17px;margin-bottom: 20px;">
                No Data Found >>> <span style="color:red">Try Again</span>
            </td>
            </tr>
            @endforelse


          </table>

          </div>
      </div>


      @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>

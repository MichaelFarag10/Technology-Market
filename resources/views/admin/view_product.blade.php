<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <style>
        .dev_center{

            text-align: center;
            padding-top:40px;
            
        }
        .input_color{

            color:black;
            margin: auto;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .dev_design{
            padding-bottom: 15px;
        }
    </style>
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
                    <button class="close" data-dissmiss="alert" aria-hidden="true" >x</button>
                    {{session()->get('message')}}

                </div>
                

            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="dev_center">
            <h2 style="font-size: 40px;padding-bottom:40px;">Add Products</h2>
            <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div  class="dev_design">
             <label for="">Product Title:</label>   
            <input  class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="title" placeholder="Write a title" id="" required>
            </div>
            <div class="dev_design">
            <label for="">Product Description:</label>
            <textarea class="form-control" id="" style="width: 250px;color:white;margin: auto;" name="description" cols="30" rows="10" required></textarea>
            </div>
            <div class="dev_design">
             <label for="">Product Price:</label>   
            <input class="form-control" style="width: 250px;color:white;margin: auto;" type="number" name="price" placeholder="Write a Price" id="" required>
            </div>
            <div class="dev_design">
             <label for="">Discount Price:</label>   
            <input class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="discount_price" placeholder="Write a title" id="" >
            </div >
            <div class="dev_design">
            <label for="">Product Quantity:</label>    
            <input class="form-control" style="width: 250px;color:white;margin: auto;" style="color:black" type="number" name="quantity" min="1" id="" required>
            </div>
            <div class="dev_design">
             <label for="">Product Catagory:</label>   
                <select name="catagory" class="form-control" style="width: 250px;color:white;margin: auto;" id="" style="color:black;" required>

                    <option value="" selected>--Select a Catagory--</option>
                    @foreach($catagory as $catagory)
                    <option value="{{$catagory->id}}"> {{$catagory->catagory_name}}</option>
                    @endforeach
                </select>

            </div>
        
            <div class="dev_design">
                <label for="">Product Image:</label>
                <input class="form-control" style="width: 250px;color:white;margin: auto;" type="file" name="image" required>
            </div>

            <div class="dev_design">
                <input class="btn btn-primary" type="submit" value="Add a Product">
            </div>

        </form>
        </div>
          </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
      @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
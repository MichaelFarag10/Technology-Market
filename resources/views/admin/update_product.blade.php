<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    @include('admin.css')
  
</head>
<style type="text/css">
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
            <h2 style="font-size: 40px;padding-bottom:40px;">Update Products</h2>
            <form action="{{url('/edit_product',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="dev_design">
             <label for="">Product Title:</label>   
            <input   class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="title" id="" value="{{$product->title}}">
            </div>
            <div class="dev_design">
            <label for="">Product Description:</label>
            <textarea  class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="description"  id="" value="{{$product->description}}"cols="30" rows="10"></textarea>
            </div>
            <div class="dev_design">
             <label for="">Product Price:</label>   
            <input  class="form-control" style="width: 250px;color:white;margin: auto;" type="number" name="price"  id="" value="{{$product->price}}" >
            </div>
            <div class="dev_design">
             <label for="">Discount Price:</label>   
            <input  class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="discount_price" value="{{$product->discount_price}}" id="" >
            </div >
            <div class="dev_design">
            <label for="">Product Quantity:</label>    
            <input  class="form-control" style="width: 250px;color:white;margin: auto;" style="color:black" type="number" name="quantity" min="1" id="" value="{{$product->quantity}}">
            </div>
            <div class="dev_design">
             <label for="">Product Catagory:</label>   
                <select class="form-control" style="width: 250px;color:white;margin: auto;" name="catagory" id="" style="color:black;" required>

                    <option value="" selected>--Select a Catagory--</option>
                    @foreach($catagory as $catagory)
                    <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="dev_design">
            <label for="">Old Image</label>
            <img class="form-control" style="width: 150px; height: 150px; color:white;margin: auto;" src="/product/{{$product->image}}" alt="">
            </div>
            <div class="dev_design">
                <label for="">Product Image:</label>
                <input class="form-control" style="width: 250px;color:white;margin: auto;" type="file" name="image" >
            </div>

            <div class="dev_design">
                <input class="btn btn-primary" type="submit" value="Update">
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
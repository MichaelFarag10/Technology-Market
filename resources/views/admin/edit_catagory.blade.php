<!DOCTYPE html>
<html lang="en">
  <head>
     @include('admin.css')
    </head>
    <style>
        .div_center{

            text-align: center;
            padding-top:40px;
        }
        .input_color{

            color:white;
        }

    </style>
    <!-- Required meta tags -->
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="div_center">
                <h2 style="font-size:40px;padding-bottom:40px;" class="mb-3">Add Catagory</h2>
                <div class="mt-3">
                <form  action="{{url('/edit_catagory',$catagory->id)}}" method="POST">
                    @csrf
                    <input type="text" class="form-control" style="width:200px;color:white;text-align:center;margin: auto;" name="catagory_name" id="" value="{{$catagory->catagory_name}}">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Add Catagory">
                </form>
                </div>
              </div>


          </div>
        </div>
   
    <!-- container-scroller -->
    <!-- plugins:js -->
      @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
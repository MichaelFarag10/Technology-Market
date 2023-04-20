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
            <h2 style="font-size: 40px;padding-bottom:40px;">Update User</h2>
            <form action="{{url('/edit_user',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="dev_design">
             <label for="">Name:</label>   
            <input  class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="name" id="" value="{{$user->name}}">
            </div>
            <div class="dev_design">
            <label for="">Email:</label>
            <input class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="email"  id="" value="{{$user->email}}">
            </div>
            <div class="dev_design">
             <label for="">Phone:</label>   
            <input class="form-control" style="width: 250px;color:white;margin: auto;" type="number" name="phone"  id="" value="{{$user->phone}}" >
            </div>
            <div class="dev_design">
             <label for="">Address:</label>   
            <input class="form-control" style="width: 250px;color:white;margin: auto;" type="text" name="address" value="{{$user->address}}" id="" >
            </div >
            <div class="dev_design">
             <label for="">Status:</label>   
                <select class="form-control" style="width: 250px;color:white;margin: auto;" name="usertype" id="" style="color:black;" required>

                    <option value="" selected>{{$user->usertype}}</option>
                 
                    
                    <option value="1">1</option>
                    <option value="0">0</option>
                 
                </select>

            </div>
            <div class="dev_design">
             <label for="">Password:</label>   
            <input class="form-control" style="width: 250px;color:white;margin: auto;" type="password" name="password"  id="" >
            </div >
          
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
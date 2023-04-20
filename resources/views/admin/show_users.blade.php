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
                  
                    {{session()->get('message')}}
                </div>
            @endif
        <div class="continer" style="display: flex ; justify-content: center; align-items: center;">
          <table class="table table-dark table-hover">

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Stauts</th>
                <th>Image</th>
                <th>Delete</th>
                <th>Edit</th>
  
                
            </tr>
            @foreach($users as $users)
            <tr>
                <td>{{$users->name}}</td>
                <td>{{$users->email}}</td>
                <td>{{$users->address}}</td>
                <td>{{$users->phone}}</td>
                <td>{{$users->usertype}}</td>
                @if($users->profile_photo_path != null)
                <td><img src="storage/{{$users->profile_photo_path}}" alt=""></td>
                @else
                <td><img src="assets/img/user_default.png" alt=""></td>
                @endif
                @if($users->usertype == 1)
                <td>Not Allowed</td>
                @else
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want delete '+' {{$users->name}}' + ' ?')" href="{{url('/delete_user',$users->id)}}">Delete</a></td>
                @endif
                <td><a class="btn btn-primary" href="{{url('/update_users',$users->id)}}">Update</a></td>
                
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
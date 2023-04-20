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
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Delete</th>
            </tr>
            @foreach($contact as $contacts)
            <tr>
                <td>{{$contacts->name}}</td>
                <td>{{$contacts->email}}</td>
                <td>{{$contacts->phone}}</td>
                <td>{{$contacts->message}}</td>
            
                   <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want delete '+ '{{$contacts->name}}' +'?')" href="{{url('/delete_contact',$contacts->id)}}">Delete</a></td>
            
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
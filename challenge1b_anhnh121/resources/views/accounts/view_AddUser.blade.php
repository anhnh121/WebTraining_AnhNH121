@extends('view_Master')
@section('title')
  <title>Add New Student</title>
@endsection

<!--@section('newcss')
<style>
</style>
@endsection-->

@section('sidebar')
    <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="{{route('route_UpdateUser')}}">
              <i class="material-icons">update</i>
              <p>Update Student</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('route_AddUser')}}">
              <i class="material-icons">person_add</i>
              <p>Add New Student</p>
            </a>
          </li>        
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{route('route_UpdateProfile')}}" style="color:#ff6666"><b>Profile</b></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('route_ListUser')}}" style="color:#ff6666"><b>User List</b></a></li>
        <?php 
            if ((Auth::guard('account')->user()->acc_role) === 0){
                $myRoute = "route_UploadHomework";
        ?>
        <li class="nav-item active"><a class="nav-link" href="{{route('route_UpdateUser')}}" style="color:#ff6666"><b>Student Management</b></a></li>
        <?php
            }else{
                $myRoute = "route_GetHomework";
            }
        ?>
        <li class="nav-item"><a class="nav-link" href="{{route($myRoute)}}" style="color:#ff6666"><b>Homework</b></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('route_GetInbox')}}" style="color:#ff6666"><b>Mail Box</b></a></li> 
        <li class="nav-item"><a class="nav-link" href="{{route('route_Challenge')}}" style="color:#ff6666"><b>Challenge</b></a></li>
    </ul>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Student Management</h4>
              <p class="card-category">Add New Student</p>
            </div>
            <div class="card-body">
              <div id="typography">
                  <form method="post" action="{{route('AddUser')}}">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>User Name</label>
                              <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input type="text" class="form-control" name="fullname" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Phone</label>
                              <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                    <div class="clearfix"></div>
                  </form>
                
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@extends('view_Master')
@section('title')
  <title>Change Password</title>
@endsection

<!--@section('newcss')
<style>
</style>
@endsection-->

@section('sidebar')
    <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('route_UpdateProfile')}}">
              <i class="material-icons">update</i>
              <p>Update Profile</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('route_ChangePassword')}}">
              <i class="material-icons">vpn_key</i>
              <p>Change Password</p>
            </a>
          </li>        
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="{{route('route_UpdateProfile')}}" style="color:#ff6666"><b>Profile</b></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('route_ListUser')}}" style="color:#ff6666"><b>User List</b></a></li>
        <?php 
            if ((Auth::guard('account')->user()->acc_role) === 0){
                $myRoute = "route_UploadHomework";
        ?>
        <li class="nav-item"><a class="nav-link" href="{{route('route_UpdateUser')}}" style="color:#ff6666"><b>Student Management</b></a></li>
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
              <h4 class="card-title">Change Password</h4>
<!--              <p class="card-category">Change Password</p>-->
            </div>
            <div class="card-body">
              <div id="typography">
                  <form method="post" action="{{route('ChangePassword')}}">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input type="password" class="form-control" name="old_password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>New Password</label>
                              <input type="password" class="form-control" name="new_password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Re-Enter Password</label>
                              <input type="password" class="form-control" name="re_password">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right" >Change Password</button>
                    <div class="clearfix"></div>
                  </form>
                
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@extends('view_Master')
@section('title')
  <title>User Details</title>
@endsection

@section('newcss')
<style>
    #details {
    color: #fff;
    background-color: #9c27b0;
    border-color: #9c27b0;
    box-shadow: 0 2px 2px 0 rgba(156, 39, 176, 0.14), 0 3px 1px -2px rgba(156, 39, 176, 0.2), 0 1px 5px 0 rgba(156, 39, 176, 0.12);
    }
    
    #lidetails {
    color: #fff;
    background-color: #9c27b0;
    border-color: #9c27b0;
    box-shadow: 0 2px 2px 0 rgba(156, 39, 176, 0.14), 0 3px 1px -2px rgba(156, 39, 176, 0.2), 0 1px 5px 0 rgba(156, 39, 176, 0.12);
    }
</style>
@endsection

@section('sidebar')
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('route_ListUser')}}">
              <i class="material-icons">people</i>
              <p>User List</p>
            </a>
            <ul>
                <li style="list-style-type: none;"><a id="details" class="nav-link">
                    <i id="lidetails" class="material-icons">contact_page</i>
                    <p>User Details</p>
                </a></li>
            </ul>
        </li>     
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{route('route_UpdateProfile')}}" style="color:#ff6666"><b>Profile</b></a></li>
        <li class="nav-item active"><a class="nav-link" href="{{route('route_ListUser')}}" style="color:#ff6666"><b>User List</b></a></li>
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
              <h4 class="card-title">User Details</h4>
              <p class="card-category">Send Messenger</p>
            </div>
            <div class="card-body">
              <div id="typography">
                  <form method="post" action="{{route('SendMsg')}}">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>User Name</label>
                              <input type="text" class="form-control" name="username" value='{{$user->username}}' disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input type="text" class="form-control" name="fullname" value=<?php echo "'$user->acc_fullname'";?> disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value={{$user->acc_email}} disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Phone</label>
                              <input type="text" class="form-control" name="phone" value={{$user->acc_phone}} disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Role</label>
                              <input type="text" class="form-control" name="role" value={{$role}} disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Message</label>
                              <textarea class="form-control" name="msg" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="recv_id" value={{$user->acc_id}}>
                    <button type="submit" class="btn btn-success pull-right" >Send</button>
                    <div class="clearfix"></div>
                  </form>
                
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
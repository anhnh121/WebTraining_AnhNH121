@extends('view_Master')
@section('title')
  <title>User List</title>
@endsection

@section('newcss')
<style>
    th {
        background-color: #006600; 
/*        color: #ffff66;*/
        font-weight: bold;
    }
    
</style>
@endsection

@section('sidebar')
    <ul class="nav">
        <li class="nav-item active ">
            <a class="nav-link" href="{{route('route_ListUser')}}">
              <i class="material-icons">people</i>
              <p>User List</p>
            </a>
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
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">User List</h4>
<!--                  <p class="card-category">Danh sách người dùng</p>-->
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tr class="">
                        <th style="color: #ffff66;">STT</th>
                        <th style="color: #ffff66;">User Name</th>
                        <th style="color: #ffff66;">Full Name</th>
                        <th style="color: #ffff66;">Role</th>
                        <th style="color: #ffff66;">Details</th>
                      </tr>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>teacher2</td>
                            <td>Nguyen Thi B</td>
                            <td>Teacher</td>
                            <td><a href="{{route('route_SendMsg')}}">
                                <i class="material-icons">remove_red_eye</i>
                            </a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>student1</td>
                            <td>Nguyen Van C</td>
                            <td>Student</td>
                            <td><a href="{{route('route_SendMsg')}}">
                                <i class="material-icons">remove_red_eye</i>
                            </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
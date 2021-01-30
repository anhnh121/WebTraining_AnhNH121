@extends('view_Master')
@section('title')
  <title>Update Student</title>
@endsection

@section('newcss')
<style>
    th {
        background-color: #006600; 
/*        color: #ffff66;*/
        font-weight: bold;
/*        text-align: center;*/
    }
    td {
/*         text-align: center;*/
    }
    
</style>
@endsection

@section('sidebar')
    <ul class="nav">
          <li class="nav-item  active">
            <a class="nav-link" href="{{route('route_UpdateUser')}}">
              <i class="material-icons">update</i>
              <p>Update Student</p>
            </a>
          </li>
          <li class="nav-item ">
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
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Student Management</h4>
                  <p class="card-category">Update Student</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tr class="">
                        <th style="color: #ffff66;">STT</th>
                        <th style="color: #ffff66;">User Name</th>
                        <th style="color: #ffff66;">Password</th>
                        <th style="color: #ffff66;">Student Name</th>
                        <th style="color: #ffff66;">Email</th>
                        <th style="color: #ffff66;">Phone</th>
                        <th style="color: #ffff66; text-align:center;">Actions</th>
                      </tr>
                      <tbody>
                        <?php
                            $i=0;
                            foreach ($data as $item){
                                $i++;
                                $acc_idrow=$item['acc_id'];
                            
                        ?>
                            <form method="post" action="{{route('UpdateUser')}}">
                                {{ csrf_field() }}
                            <tr>
                                <td>{{$i}}</td>
                                <td><input type="text" class="form-control" name="username" value={{$item['username']}} ></td>
                                <td><input type="password" class="form-control" name="password" value={{$item['password']}} ></td>
                                <td><input type="text" class="form-control" name="fullname" value='{{$item['acc_fullname']}}' ></td>
                                <td><input type="text" class="form-control" name="email" value={{$item['acc_email']}} ></td>
                                <td><input type="text" class="form-control" name="phone" value={{$item['acc_phone']}} ></td>
                                <td>
                                    <input type="hidden" name="edited_id" value={{$acc_idrow}}>
                                    <button type="submit" class="btn" name="edit" value="edit"><i class="material-icons">mode_edit</i></button>
                                    <button type="submit" class="btn" name="delete" value="delete"><i class="material-icons">delete</i></button>
                                </td>
                            </tr>   
                            </form>                               
                        <?php } ?>
                        
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
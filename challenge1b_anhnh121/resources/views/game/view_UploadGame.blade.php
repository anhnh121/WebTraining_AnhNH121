@extends('view_Master')
@section('title')
  <title>Upload Challenge</title>
@endsection

@section('newcss')
<style>
</style>
@endsection

@section('sidebar')
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('route_Challenge')}}">
              <i class="material-icons">brightness_7</i>
              <p>Challenge</p>
            </a>
        </li> 
        <?php 
            if ((Auth::guard('account')->user()->acc_role) === 0){
        ?>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('route_UploadGame')}}">
              <i class="material-icons">file_upload</i>
              <p>Upload Challenge</p>
            </a>
        </li> 
        <?php
            }
        ?>
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
        <li class="nav-item"><a class="nav-link" href="{{route('route_UpdateUser')}}" style="color:#ff6666"><b>Student Management</b></a></li>
        <?php
            }else{
                $myRoute = "route_GetHomework";
            }
        ?>
        <li class="nav-item"><a class="nav-link" href="{{route($myRoute)}}" style="color:#ff6666"><b>Homework</b></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('route_GetInbox')}}" style="color:#ff6666"><b>Mail Box</b></a></li> 
        <li class="nav-item active"><a class="nav-link" href="{{route('route_Challenge')}}" style="color:#ff6666"><b>Challenge</b></a></li>
    </ul>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Challenge</h4>
              <p class="card-category">Upload Challenge</p>
            </div>
            <div class="card-body">
              <div id="typography">
                  <form method="post" enctype="multipart/form-data" action="{{route('UploadGame')}}">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Press Hint</label>
                              <input type="text" class="form-control" name="hint" required>
                            </div>
                        </div>
                    </div>
                    <label>Upload File</label><br>
                    <input type="file" name="myFile" id="myFile"><br>
                    <button type="submit" class="btn btn-success pull-right" >Upload</button>
                    <div class="clearfix"></div>
                  </form>
                
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
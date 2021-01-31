@extends('view_Master')
@section('title')
  <title>Amazing Goodjob</title>
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
        <li class="nav-item">
            <a class="nav-link" href="{{route('route_Challenge')}}">
              <i class="material-icons">brightness_7</i>
              <p>Challenge</p>
            </a>
        </li> 
        <?php 
            if ((Auth::guard('account')->user()->acc_role) === 0){
        ?>
        <li class="nav-item">
            <a class="nav-link" href="{{route('route_UploadGame')}}">
              <i class="material-icons">file_upload</i>
              <p>Upload Challenge</p>
            </a>
        </li> 
        <?php
            }
        ?>
<!--            if ($title !== null and $content !== null){}-->
        <li class="nav-item active">
            <a class="nav-link"">
              <i class="material-icons">mood</i>
              <p>Congratulation</p>
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
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Congratulation!!!</h4>
<!--                  <p class="card-category">Congratulation</p>-->
                </div>
                <div class="card-body">
                    <div id="typography">
                        <div class="card-title">
                            <h2 style="color: #00ff33">{{$title}}</h2>
                        </div>
                        <div>
                            <h3><p style="color: white"><?php echo nl2br($content) ?></p></h3>
                        </div>  
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
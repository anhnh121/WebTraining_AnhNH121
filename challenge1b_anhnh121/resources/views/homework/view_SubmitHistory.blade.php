@extends('view_Master')
@section('title')
  <title>Submit History</title>
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
          <li class="nav-item">
            <a class="nav-link" href="{{route('route_GetHomework')}}">
              <i class="material-icons">import_contacts</i>
              <p>Available Homework</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('route_SubmitHistory')}}">
              <i class="material-icons">history_edu</i>
              <p>Submit History</p>
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
        <li class="nav-item active"><a class="nav-link" href="{{route($myRoute)}}" style="color:#ff6666"><b>Homework</b></a></li>
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
                  <h4 class="card-title mt-0">Homework</h4>
                  <p class="card-category">Submit History</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tr class="">
                        <th style="color: #ffff66;">STT</th>
                        <th style="color: #ffff66;">Title</th>
                        <th style="color: #ffff66;">Time Upload</th>
                        <th style="color: #ffff66; text-align:center;">Actions</th>
                      </tr>
                      <tbody>
                        <?php
                            $i=0;
                            foreach ($data as $item){
                                $i++;
                                $idrow=$item['kq_id'];        
                        ?>
                            <form method="post" action="{{route('route_DeleteHistory')}}">
                                {{ csrf_field() }}
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>{{$item['kq_uptime']}}</td>
                                    <td style="text-align:center;">
                                        <button type="submit" class="btn" name="idrow" value={{$idrow}}>
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </td>    
                                </tr>   
                            </form>
                        <?php }?>
                        
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
@extends('view_Master')
@section('title')
  <title>Inbox</title>
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
          <li class="nav-item  active">
            <a class="nav-link" href="#">
              <i class="material-icons">move_to_inbox</i>
              <p>Inbox</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#">
              <i class="material-icons">forward_to_inbox</i>
              <p>Sent</p>
            </a>
          </li>       
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Profile</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>User List</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Student Management</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Homework</b></a></li>
        <li class="nav-item active"><a class="nav-link" href="#" style="color:#ff6666"><b>Mail Box</b></a></li> 
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Challenge</b></a></li>
    </ul>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Inbox</h4>
<!--                  <p class="card-category">Danh sách người dùng</p>-->
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tr class="">
                        <th style="color: #ffff66;">STT</th>
                        <th style="color: #ffff66;">Recv From</th>
                        <th style="color: #ffff66;">Msg</th>
                        <th style="color: #ffff66;">Time</th>
                      </tr>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>teacher2</td>
                            <td>Nguyen Thi B</td>
                            <td>Teacher</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>student1</td>
                            <td>Nguyen Van C</td>
                            <td>Student</td>
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
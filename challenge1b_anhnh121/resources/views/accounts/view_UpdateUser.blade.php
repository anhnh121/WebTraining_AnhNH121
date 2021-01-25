@extends('view_Master')
@section('title')
  <title>Cập nhật sinh viên</title>
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
              <i class="material-icons">update</i>
              <p>Update Student</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#">
              <i class="material-icons">note_add</i>
              <p>Add New Student</p>
            </a>
          </li>        
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>User List</b></a></li>
        <li class="nav-item active"><a class="nav-link" href="#" style="color:#ff6666"><b>Student Management</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Homework</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Mail Box</b></a></li> 
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Challenge</b></a></li>
    </ul>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Student Management</h4>
                  <p class="card-category">Update Student</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <tr class="">
                        <th style="color: #ffff66;">STT</th>
                        <th style="color: #ffff66;">User Name</th>
                        <th style="color: #ffff66;">Password</th>
                        <th style="color: #ffff66;">Student Name</th>
                        <th style="color: #ffff66;">Email</th>
                        <th style="color: #ffff66;">Phone</th>
                        <th style="color: #ffff66;">Actions</th>
                      </tr>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>student1</td>
                            <td>123456aA@</td>
                            <td>Nguyen Thi B</td>
                            <td>songoku1994@gmail.com</td>
                            <td>01234567810</td>
                            <td>Actions</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>student2</td>
                            <td>123456aA@</td>
                            <td>Nguyen Van C</td>
                            <td>songoku1994@gmail.com</td>
                            <td>01234567810</td>
                            <td>Actions</td>
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
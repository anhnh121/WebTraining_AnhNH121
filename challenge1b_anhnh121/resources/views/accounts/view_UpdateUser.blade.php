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
            <a class="nav-link" href="#">
              <i class="material-icons">update</i>
              <p>Update Student</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#">
              <i class="material-icons">person_add</i>
              <p>Add New Student</p>
            </a>
          </li>        
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Profile</b></a></li>
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
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="form-control" value="student1"></td>
                            <td><input type="text" class="form-control" value="123456aA@"></td>
                            <td><input type="text" class="form-control" value="Nguyen Thi B"></td>
                            <td><input type="text" class="form-control" value="songoku1994@gmail.com"></td>
                            <td><input type="text" class="form-control" value="01234567810"></td>
                            <td>
                                <button type="submit" class="btn"><i class="material-icons">mode_edit</i></button>
                                <button type="submit" class="btn"><i class="material-icons">delete</i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><input type="text" class="form-control" value="student1"></td>
                            <td><input type="text" class="form-control" value="123456aA@"></td>
                            <td><input type="text" class="form-control" value="Nguyen Thi B"></td>
                            <td><input type="text" class="form-control" value="songoku1994@gmail.com"></td>
                            <td><input type="text" class="form-control" value="01234567810"></td>
                            <td>
                                <button type="submit" class="btn"><i class="material-icons">mode_edit</i></button>
                                <button type="submit" class="btn"><i class="material-icons">delete</i></button>
                            </td>
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
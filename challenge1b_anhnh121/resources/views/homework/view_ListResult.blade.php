@extends('view_Master')
@section('title')
  <title>Result List</title>
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
            <a class="nav-link" href="#">
              <i class="material-icons">file_upload</i>
              <p>Upload Homework</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">
              <i class="material-icons">content_paste</i>
              <p>Result List</p>
            </a>
          </li>        
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Profile</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>User List</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Student Management</b></a></li>
        <li class="nav-item active"><a class="nav-link" href="#" style="color:#ff6666"><b>Homework</b></a></li>
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
                  <h4 class="card-title mt-0">Homework</h4>
                  <p class="card-category">Result List</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tr class="">
                        <th style="color: #ffff66;">STT</th>
                        <th style="color: #ffff66;">Title</th>
                        <th style="color: #ffff66;">Teacher</th>
                        <th style="color: #ffff66;">Student</th>
                        <th style="color: #ffff66;">File Result</th>
                        <th style="color: #ffff66;">Time Upload</th>
                      </tr>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>teacher2</td>
                            <td>Nguyen Thi B</td>
                            <td>Teacher</td>
                            <td><a href="#">Details</a></td>
                            <td>Teacher</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>student1</td>
                            <td>Nguyen Van C</td>
                            <td>Student</td>
                            <td><a href="#">Details</a></td>
                            <td>Teacher</td>
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
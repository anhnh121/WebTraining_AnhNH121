@extends('view_Master')
@section('title')
  <title>User Detail</title>
@endsection

<!--@section('newcss')
<style>
</style>
@endsection-->

@section('sidebar')
    <ul class="nav">
<!--          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="material-icons">update</i>
              <p>Update Profile</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">
              <i class="material-icons">vpn_key</i>
              <p>Change Password</p>
            </a>
          </li>        -->
    </ul>
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Profile</b></a></li>
        <li class="nav-item active"><a class="nav-link" href="#" style="color:#ff6666"><b>User List</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Student Management</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Homework</b></a></li>
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Mail Box</b></a></li> 
        <li class="nav-item"><a class="nav-link" href="#" style="color:#ff6666"><b>Challenge</b></a></li>
    </ul>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">User Detail</h4>
              <p class="card-category">Send Messenger</p>
            </div>
            <div class="card-body">
              <div id="typography">
                  <form>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>User Name</label>
                              <input type="text" class="form-control" value="email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input type="text" class="form-control" value="phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" value="role">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Phone</label>
                              <input type="text" class="form-control" value="role">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Role</label>
                              <input type="text" class="form-control" value="role">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>Message</label>
                              <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right" >Send</button>
                    <div class="clearfix"></div>
                  </form>
                
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
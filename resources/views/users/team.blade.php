@extends('users.layouts.master')
@section('title','Inco Docs')

@section('content')
    <!-- Sidenav -->
    @include('users.partials.sidenav')
    <div class="main">
    <!-- mainHeader -->
      @include('users.partials.mainHeader')  
       <!-- Dummy design -->
      <div class="jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-6 text-primary text-center">Manage Team</h1>
            <p class="text-muted text-center">View workspace members and edit access controls.</p>
            
        </div>
      </div> 
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header text-right">
                          <button type="button" class="btn btn-primary text-white"
                           data-toggle="modal" data-target="#exampleModal">New User</button>
                      </div>
                      <div class="card-body">
                          <table class="table table-bordered table-hover" id="user_table">
                              <thead>
                                  <tr>
                                      <th>User</th>
                                      <th>Role</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($users as $item)
                                      <tr>
                                          <td>{{$item->email}}</td>
                                          <td>{{$item->role}}</td>
                                          <td>Active</td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Team Members</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userForm" name="userForm">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                <input type="email"  class="form-control" id="email" name="email" value="email@example.com">
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right" id="btn-submit">Send Invitation</button>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
        
@endsection
    

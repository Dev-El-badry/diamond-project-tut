@extends('admin.layouts.form')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage user</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/users">users</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create User</h3>
              </div>
                <div class="mt-2">
                    {{ Html::ul($errors->all()) }}
                </div>
              {{ Form::open(array('url' => 'admin/users', 'files' => true, 'enctype' => 'multipart/form-data')) }}
                <div class="card-body">
                    <div class="form-group col-6 offset-3">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="image" class="dropify" data-height="300" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group col-2 px-0">
                    <label>Activation</label>
                    <select name="activation" class="form-control select2">
                      <option value="1">Active</option>
                      <option value="0">Suspended</option>
                    </select>
                  </div>
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
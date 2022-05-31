@extends('admin.layouts.form')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/users">User</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                <h3 class="card-title">Edit User</h3>
              </div>
                <div class="mt-2">
                    {{ Html::ul($errors->all()) }}
                </div>
                {{ Form::model($row, array('route' => array('users.update', $row->id), 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data')) }}

                <div class="card-body">
                    <div class="form-group col-6 offset-3">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" data-default-file="{{ $row->getFirstMediaUrl('users') }}" name="image" class="dropify" data-height="300" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" value="{{ $row->first_name }}" class="form-control" name="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" value="{{ $row->last_name }}" class="form-control" name="last_name" placeholder="Last Name">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" value="{{ $row->email }}" class="form-control" name="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" autocomplete="new-password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group col-2 px-0">
                    <label>Activation</label>
                    <select name="activation" class="form-control select2">
                      <option value="1" {{ ($row->activation) ? 'selected' : '' }} >Active</option>
                      <option value="0" {{ ($row->activation) ? '' : 'selected' }} >Suspended</option>
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
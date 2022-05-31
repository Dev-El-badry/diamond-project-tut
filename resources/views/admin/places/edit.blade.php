@extends('admin.layouts.form')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Places</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/places">Place</a></li>
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
                <h3 class="card-title">Edit Place</h3>
              </div>
                <div class="mt-2">
                    {{ Html::ul($errors->all()) }}
                </div>
                {{ Form::model($row, array('route' => array('places.update', $row->id), 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data')) }}

                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>

                        <input type="text" class="form-control" value="{{ $row->translate('name', 'ar') }}" name="name_ar" placeholder="Name arabic">
                        <br>
                        <input type="text" class="form-control"value="{{ $row->translate('name', 'en') }}" name="name_en" placeholder="Name English">
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

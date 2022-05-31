@extends('admin.layouts.form')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Rooms</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/rooms">Room</a></li>
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
                {{ Form::model($row, array('route' => array('rooms.update', $row->id), 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data')) }}

                <div class="card-body">
                  <div class="form-group col-6 offset-3">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" data-default-file="{{ $row->getFirstMediaUrl('rooms') }}" name="image" class="dropify" data-height="300" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Code</label>
                    <input type="text" class="form-control" name="code" value="{{ $row->code }}" placeholder="Code">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="number" class="form-control" name="price" value="{{ $row->price }}" placeholder="Price">
              </div>
              <div class="form-group">
                <div class="form-group col-2 px-0">
                  <label>Places</label>
                  <select name="hotel_id" class="form-control select2">
                    @foreach ($hotels as $hotel)
                      <option {{ ($hotel->id == $row->hotel_id) ? 'selected' : '' }} value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                  </select>
                </div>
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
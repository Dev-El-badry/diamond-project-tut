@extends('admin.layouts.tables')

@section('table-content')

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Place</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    

    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-4 text-right offset-8">
                <a href="/admin/places/create" class="btn btn-primary mb-3">Create</a>
            </div>
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($rows as $row)
                  <tr>
                    <td>{{ $row->name }}</td>
                    <td class="d-flex ">

                        {{ Form::open(array('url' => 'admin/places/' . $row->id . '/edit', 'class' => 'pull-right mr-1')) }}
                            {{ Form::hidden('_method', 'GET') }}
                            {{ Form::submit('Edit', array('class' => 'btn btn-success')) }}
                        {{ Form::close() }}

                        {{ Form::open(array('url' => 'admin/places/' . $row->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}

                    </td>
                  </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@endsection
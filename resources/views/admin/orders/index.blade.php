@extends('admin.layouts.tables')

@section('table-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>

                    <th>Order REF</th>
                    <th>Price</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($rows as $row)
                  <tr>

                    <td>{{ $row->order_ref }}</td>
                    <td>{{ $row->price }}</td>
                    <td>
                      @if($row->order_status == 1)
                      <span class="badge col-6 py-2 badge-success">Paid</span>

                      @else
                      <span class="badge col-6 py-2 badge-primary">Pending</span>
                      @endif
                  </td>
                    <td class="d-flex ">

                        {{ Form::open(array('url' => 'admin/orders/' . $row->id, 'class' => 'pull-right mr-1')) }}
                            {{ Form::hidden('_method', 'GET') }}
                            {{ Form::submit('Show', array('class' => 'btn btn-success')) }}
                        {{ Form::close() }}

                        {{ Form::open(array('url' => 'admin/orders/' . $row->id, 'class' => 'pull-right')) }}
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

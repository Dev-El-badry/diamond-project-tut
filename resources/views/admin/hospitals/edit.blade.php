@extends('admin.layouts.form')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Hospitals</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/hospitals">Hospital</a></li>
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
                <h3 class="card-title">Edit Hospital</h3>
              </div>
                <div class="mt-2">
                    {{ Html::ul($errors->all()) }}
                </div>
                {{ Form::model($row, array('route' => array('hospitals.update', $row->id), 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data')) }}

                <div class="card-body">
                  <div class="form-group col-6 offset-3">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" data-default-file="{{ $row->getFirstMediaUrl('hospitals') }}" name="image" class="dropify" data-height="300" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name in english</label>
                    <input type="text" class="form-control" name="name_en" value="{{ $row->translate('name', 'en') }}" placeholder="Name in english">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Name in arabic</label>
                    <input type="text" class="form-control" name="name_ar" value="{{  $row->translate('name', 'ar') }}" placeholder="Name in arabic">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description in english</label>
                    <textarea class="form-control" name="description_en" rows="3">{{ $row->translate('description', 'en') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Description in arabic</label>
                    <textarea class="form-control" name="description_ar" rows="3">{{ $row->translate('description', 'ar') }}</textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address Details</label>
                  <textarea class="form-control" name="address_details" rows="3">{{ $row->address_details }}</textarea>
              </div>
              <div class="form-group">
                <div class="form-group col-2 px-0">
                  <label>Places</label>
                  <select name="village_id" class="form-control select2">
                    @foreach ($villages as $value)
                      <option {{ ($value->id == $row->village_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
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
    <section class="content">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Gallery</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary py-3">
              <div class="card-header">
                <h3 class="card-title">ADD PHOTOS</h3>
              </div>
                <div class="mt-2">
                    {{ Html::ul($errors->all()) }}
                </div>
              {{ Form::open(array('url' => 'admin/hospitals/actions/images/' . $row->id , 'files' => true, 'enctype' => 'multipart/form-data')) }}
                  <div class="container-fluid">
                    <div class="row d-flex align-items-center p-3">
                      @if(!$row->getMedia('hospital-gallery')->count())
                      <div class="form-group image col-3">
                        <input type="file" name="images[]" class="dropify" />
                      </div>
                      @endif
                      @foreach ($row->getMedia('hospital-gallery') as $image)
                      <div class="form-group image col-3">
                        <input type="file" disabled value="{{ $image->uuid }}" data-default-file="{{ $image->getFullUrl() }}" name="images[]" class="dropify" />
                      </div>
                      @endforeach
                      <div class="form-group plus-holder col-3">
                        <span class="pointer plus">
                          <img style="cursor: pointer" width="30" height="30" src="{{ asset('icons/plus.png') }}">
                        </span>
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


@push('script')
  <script>
    $(document).ready(function() {
      setTimeout(() => {
        $('<button type="button" class="dropify-clear">Remove</button>').insertAfter('.dropify');
      }, 1000);
      $(document).on('click', '.plus', function() {
        $('<div class="form-group image col-3"><input type="file" name="images[]" class="dropify" multiple/></div>').insertBefore('.plus-holder');
        $('.dropify').dropify();
        });
      $(document).on('click', '.dropify-clear', function() {
        $(this).parent().parent().remove();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
        jQuery.ajax({
          url: "{{ url('admin/hospitals/actions/deleteImage') }}",
          method: 'post',
          data: {
            "_token": "{{ csrf_token() }}",
            uuid: $(this).prev("input").attr("value")
        },
          success: function(result){
            toastr.error('Deleted!');
          }});
        });
    });
  </script>
@endpush

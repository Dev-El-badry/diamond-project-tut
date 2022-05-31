@extends('layouts.dashboard')

@section('dashboard')
<!-- Start Content -->
<div class="col-12 d-flex d-inline justify-content-between pr-0">
  <h4 class="font-bold secondary">{{__('frontend/profile.ManageProfile')}}</h4>
  <button class="btn d-xl-none pt-0" type="button" data-toggle="collapse" data-target="#example-collapse">
    <span class="navbar-light"><span class="navbar-toggler-icon"></span></span>
  </button>
</div>

@if (Session::has('updated'))
    <div class="alert alert-success">
        {{ session('updated') }}
    </div>
@endif

{{--  @if($errors->any())
<div class="error-msg">
  @foreach($errors->all() as $error)
    <p style="color: red">{{ $error }}</p>
  @endforeach
</div>
@endif  --}}


<form action="{{ route('dashboard.update_profile') }}" method="POST" class="mt-4">
    @csrf
  <div class=" col-xl-12">
    <!-- Start Dropify -->

    <!-- End Dropify -->
    <div class="form-group mt-3">
      <label for="last_name">{{__('frontend/profile.FirstName')}}</label>
      <input type="text" class="form-control" id="first_name" placeholder="{{__('frontend/profile.placeholderFirstName')}}" name="first_name" value="{{ auth()->user()->first_name }}">

      @if ($errors->has('first_name'))
      <span class="help text-danger">
          <strong>{{ $errors->first('first_name') }}</strong>
      </span>
      @endif
    </div>
    <div class="form-group mt-3">
        <label for="last_name">{{__('frontend/profile.LastName')}}</label>
        <input type="text" class="form-control" id="last_name" placeholder="{{__('frontend/profile.placeholderLastName')}}" name="last_name" value="{{ auth()->user()->last_name }}">
        @if ($errors->has('last_name'))
        <span class="help text-danger">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
        @endif
      </div>
    <div class="form-group">
      <label for="email">{{__('frontend/profile.EmailAddress')}}</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
        placeholder="{{__('frontend/profile.EnterEmail')}}" name="email" value="{{ auth()->user()->email }}">
      <small id="emailHelp" class="form-text text-muted">{{__('frontend/profile.emailHelp')}}</small>

        @if ($errors->has('email'))
        <span class="help text-danger">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="w-100">

      <button type="submit" class="btn btn-primary">{{__('frontend/profile.UpdateProfile')}}</button>
    </div>
  </div>

</form>
<!-- End Content -->
@endsection

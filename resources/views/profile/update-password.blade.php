@extends('layouts.dashboard')

@section('dashboard')
<!-- Start Content -->
<div class="col-12 d-flex d-inline justify-content-between pr-0">
  <h4 class="font-bold secondary">{{__('frontend/profile.UpdatePassword')}}</h4>
  <button class="btn d-xl-none pt-0" type="button" data-toggle="collapse" data-target="#example-collapse">
    <span class="navbar-light"><span class="navbar-toggler-icon"></span></span>
  </button>
</div>

@if (Session::has('updated'))
    <div class="alert alert-success">
        {{ session('updated') }}
    </div>
@endif



<form action="{{ route('dashboard.update-password-profile') }}" method="POST" class="mt-4">
    @csrf
  <div class=" col-xl-12">



    <div class="form-group">
        <label for="password">{{__('frontend/profile.Password')}}</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="{{__('frontend/profile.Password')}}">

        @if ($errors->has('password'))
      <span class="help text-danger">
          <strong>{{ $errors->first('password') }}</strong>
      </span>
      @endif
      </div>

      <div class="form-group">
        <label for="password_confirmation">{{__('frontend/profile.ConfirmPassword')}}</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
          placeholder="{{__('frontend/profile.ConfirmPassword')}}">

          @if ($errors->has('password_confirmation'))
      <span class="help text-danger">
          <strong>{{ $errors->first('password_confirmation') }}</strong>
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

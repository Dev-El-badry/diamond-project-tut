@extends('layouts.app')

@section('content')
<div class="content h-100">



    <!-- Start Form -->

    <div class="content-section d-flex align-items-center flex-column justify-content-center h-100 my-5">
      <div class="container">
        <div class="row w-100 justify-content-center">
          <div class="col-md-6 col-12 col-md-offset-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-center text-primary">{{__('frontend/Authentication/login.Login')}}</h5>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                  <div class="form-group">
                    <label for="email">{{__('frontend/Authentication/login.EmailAddress')}}</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                      placeholder="{{__('frontend/Authentication/login.EnterEmail')}}" name="email">
                    {{--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                      else.</small>  --}}

                      @if ($errors->has('email'))
                      <span class="help text-danger">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label for="password">{{__('frontend/Authentication/login.Password')}}</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="{{__('frontend/Authentication/login.Password')}}">
                    
                  </div>
                  <div class=" form-group font-text-8 d-flex align-items-center">
                    <a href="{{ route('password.request') }}" class="form-check-label font-bold primary pointer">{{__('frontend/Authentication/login.ForgetPassword')}}</a>

                      @if ($errors->has('password'))
                      <span class="help-block font-red-mint">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                      @endif
                  </div>



                  <div class="w-100 text-center">

                    <button type="submit" class="btn btn-primary">{{__('frontend/Authentication/login.Login')}}</button>
                  </div>
                </form>

                <div class="text-center border-top mt-4 pt-4">
                  <p class="font-text-8">{{__('frontend/Authentication/login.NewRegister')}} <a href="{{ url('/register') }}"
                      class="underline font-weight-bolder pointer secondary">{{__('frontend/Authentication/login.CreateAccount')}}</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Form  -->

  </div>

@endsection

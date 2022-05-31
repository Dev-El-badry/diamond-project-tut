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
                <h5 class="card-title text-center text-primary">Forget Password</h5>
                @php
                    if(!empty($errors)) {
                       foreach($errors->all() as $row) {
                           echo "
                            <span class='help-block text-danger'>
                                <strong>$row</strong>
                            </span>
                           ";
                       }
                    }
                @endphp
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email">
                        @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                      </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                      </div>


                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                          placeholder="Confirm Password">
                          @if ($errors->has('password_confirmation'))
                          <span class="help text-danger">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                          @endif
                      </div>


                    <div class="w-100 text-center">

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Form  -->

  </div>

@endsection

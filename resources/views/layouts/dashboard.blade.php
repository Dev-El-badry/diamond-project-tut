@extends('layouts.app')

@section('content')
<div class="content-section h-100" style="margin: 60px 0;">
    <div class="container mt-5">
      <div class="row">


        <div class="col-xl-3 col-12 d-xl-block d-none">


          <div class="my-3">
            <div class="row d-flex d-inline justify-content-between align-items-center {{ url()->current() === route('dashboard.update') ? 'primary' : 'text-muted' }} primary height-2em">
              <div class="col-2 ">
                <i class="fa fa-user fa-02x"></i>
              </div>
              <div class="col-8 pl-3">
                <span class="font-text font-bold"><a href="{{ route('dashboard.update') }}"
                    class="text-decoration-none  {{ url()->current() === route('dashboard.update') ? 'primary' : 'text-muted' }} dashboard-btn">{{__('frontend/profile.Profile')}}</a></span>
              </div>
              <div class="col-2">
                <span class="float-right custom-border-right d-none d-block"></span>
              </div>
            </div>
            <div class="border-line mt-3"></div>
          </div>

          <div class="my-3">
            <div class="row d-flex d-inline justify-content-between align-items-center {{ url()->current() === route('dashboard.update-password') ? 'primary' : 'text-muted' }} height-2em">
              <div class="col-2 ">
                <i class="fa fa-key fa-02x"></i>
              </div>
              <div class="col-8 pl-3">
                <span class="font-text font-bold"><a href="{{ route('dashboard.update-password') }}"
                    class="text-decoration-none  {{ url()->current() === route('dashboard.update-password') ? 'primary' : 'text-muted' }} dashboard-btn">{{__('frontend/profile.UpdatePassword')}}</a></span>
              </div>
              <div class="col-2">
                <span class="float-right custom-border-right d-none d-block"></span>
              </div>
            </div>
            <div class="border-line mt-3"></div>
          </div>


          <div class="my-3">
            <div class="row d-flex d-inline justify-content-between align-items-center {{ url()->current() === route('dashboard.cart') ? 'primary' : 'text-muted' }} height-2em">
              <div class="col-2 ">
                <i class="fa fa-shopping-cart fa-02x"></i>
              </div>
              <div class="col-8 pl-3">
                <span class="font-text font-bold"><a href="{{ route('dashboard.cart') }}"
                    class="text-decoration-none  {{ url()->current() === route('dashboard.cart') ? 'primary' : 'text-muted' }} dashboard-btn">{{__('frontend/profile.cart')}}</a></span>
              </div>
              <div class="col-2">
                <span class="float-right custom-border-right d-none d-block"></span>
              </div>
            </div>
            <div class="border-line mt-3"></div>
          </div>


          <div class="my-3">
            <div class="row d-flex d-inline justify-content-between align-items-center {{ url()->current() === route('dashboard.bookings') ? 'primary' : 'text-muted' }} height-2em">
              <div class="col-2 ">
                <i class="fa fa-ticket fa-02x"></i>
              </div>
              <div class="col-8 pl-3">
                <span class="font-text font-bold"><a href="{{ route('dashboard.bookings') }}"
                    class="text-decoration-none  {{ url()->current() === route('dashboard.bookings') ? 'primary' : 'text-muted' }} dashboard-btn">{{__('frontend/profile.Bookings')}}</a></span>
              </div>
              <div class="col-2">
                <span class="float-right custom-border-right d-none d-block"></span>
              </div>
            </div>
            <div class="border-line mt-3"></div>
          </div>

          <div class="my-3">
            <div class="row d-flex d-inline justify-content-between align-items-center text-muted height-2em">
              <div class="col-2 ">
                <i class="fa fa-sign-out fa-02x"></i>
              </div>

              <div class="col-8 pl-3">
                <span class="font-text font-bold"><a
                    class="text-decoration-none text-muted  dashboard-btn pointer"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{__('frontend/profile.Logout')}}</a></span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
              </div>
              
              <div class="col-2">
                <span class="float-right custom-border-right d-none d-block"></span>
              </div>
            </div>
            <div class="border-line mt-3"></div>
          </div>






        </div>
        <div class="col-xl-9 col-12 mt-3">

            @yield('dashboard')

        </div>
      </div>
    </div>
  </div>
@endsection

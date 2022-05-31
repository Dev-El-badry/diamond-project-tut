<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale()=='en'?'ltr':'rtl'}}">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diamond village</title>
  @if(app()->getLocale()=='en')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  @else
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css" integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous">
  @endif
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    @if(app()->getLocale()=='en')
      {{--links css en--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @else
      {{--links css ar--}}
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
    @endif


  @yield('head')
</head>

<body class="{{ url()->current() != url('/')? 'bg-light' : '' }}">

    <section class="{{ url()->current() === route('home')? 'top-section' : 'content  ' }}">
        <div class=" {{ url()->current() != url('/')? 'h-100' : 'container' }}">

          <!-- Start Navbar -->
          <nav class="navbar navbar-expand-lg  {{ url()->current() === url('/')? 'navbar-dark' : 'navbar-light bg-light shadow-sm' }}  ">
              @if(url()->current() != url('/'))
            <div class="container">
                @endif
                <a class="navbar-brand" href="{{ url('/') }}">{{__('frontend/app.Village')}} <strong>{{__('frontend/app.Diamond')}} </strong></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                {{--start button Locale --}}
                  <a href="{{ LaravelLocalization::getLocalizedURL(App::getLocale() == 'en' ? 'ar' : 'en', null, [], true) }}" class="btn btn-light btn-sm " data-toggle="dropdown"   aria-haspopup="true" aria-expanded="false">
                    @if (App::getLocale() == 'en')
                    اللغة العربية - AR
                    @else
                      English - EN
                    @endif
                  </a>
                {{--end button Locale --}}


                <div class="collapse navbar-collapse" id=" navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ url()->current() === url('/')? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}"> {{__('frontend/app.Home')}}</a>
                        </li>

                        <li class="nav-item {{ url()->current() === url('/hotels')? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/hotels') }}">{{__('frontend/app.Hotels')}}</a>
                        </li>
                        <li class="nav-item {{ url()->current() === url('/villas')? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/villas') }}">{{__('frontend/app.Villas')}}</a>
                        </li>
                        <li class="nav-item {{ url()->current() === url('/hospitals')? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/hospitals') }}">{{__('frontend/app.Hospitals')}}</a>
                        </li>
                        <li class="nav-item {{ url()->current() === url('/restaurants')? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/restaurants') }}">{{__('frontend/app.Restaurants')}}</a>
                        </li>
                        <li class="nav-item {{ url()->current() === url('/stores')? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/stores') }}">{{__('frontend/app.Stores')}}</a>
                        </li>
                        @guest

                        <li class="nav-item ml-3">
                        <a type="button" class="btn  {{ url()->current() === url('/')? 'custom-button' : 'custom-button-2 change-color' }}" href="{{ url('/login') }}">{{__('frontend/app.Login')}}</a>

                        </li>
                        @else

                        <li class="nav-item ml-3">
                            <a type="button" class="btn  {{ url()->current() === url('/')? 'custom-button' : 'custom-button-2 change-color' }}" href="{{ url('/dashboard/update') }}">
                                {{__('frontend/app.Profile')}}
                            </a>

                            </li>
                        @endguest

                    </ul>

                </div>
                @if(url()->current() != url('/'))
            </div>
            @endif
          </nav>
          <!-- End Navbar -->

          @yield('content')
        </div>

    </section>

  <div class="border-line"></div>
  <footer class="px-lg-5 pt-lg-5 pt-5 px-4 mt-lg-4" >
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mb-sm-4" style="    display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 20px;
        ">
          <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" width="200" alt="logo">
          </a>
          <div class="d-flex flex-wrap">
            <ul class="list-unstyled list-inline-item social-media mt-4 d-flex justify-content-between pr-md-5">
              <li class="mr-2">
                <a href="https://www.facebook.com/"
                  class="text-decoration-none font-text primary-bg radius-50 text-white d-flex justify-content-center align-items-center">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="mr-2">
                <a href="https://www.instagram.com/"
                  class="text-decoration-none font-text primary-bg radius-50 text-white d-flex justify-content-center align-items-center">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <li class="mr-2">
                <a href="https://twitter.com/"
                  class="text-decoration-none font-text primary-bg radius-50 text-white d-flex justify-content-center align-items-center">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
            </ul>
          </div>
          <p class="primary font-bold font-text">© 2022 All Rights Reserved for Diamond Village.</p>
        </div>
        <div class="col-lg-5 ">
          <div class="d-flex justify-content-between ">
            <div>
              <h6 class="font-bold secondary mb-3">{{__('frontend/app.Services')}}</h6>
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="{{ url('/hotels') }}"
                    class="primary text-decoration-none font-text font-regular">{{__('frontend/app.Hotels')}}</a>
                </li>
                <li class="mb-2">
                  <a href="{{ url('/villas') }}"
                    class="primary text-decoration-none font-text font-regular">{{__('frontend/app.Villas')}}</a>
                </li>
                <li class="mb-2">
                  <a href="{{ url('/hospitals') }}"
                    class="primary text-decoration-none font-text font-regular">{{__('frontend/app.Hospitals')}}</a>
                </li>

                <li class="mb-2">
                  <a href="{{ url('/restaurants') }}"
                    class="primary text-decoration-none font-text font-regular">{{__('frontend/app.Restaurants')}}</a>
                </li>

                <li class="mb-2">
                  <a href="{{ url('/stores') }}" class="primary text-decoration-none font-text font-regular">{{__('frontend/app.Stores')}}</a>
                </li>
              </ul>
            </div>
            <div>
              <h6 class="font-bold secondary mb-3">{{__('frontend/app.QuickLinks')}}</h6>
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="https://hihome.sa/" class="primary text-decoration-none font-regular">{{__('frontend/app.ContactUs')}}</a>
                </li>
                <li class="mb-2">
                  <a href="https://hihome.sa/" class="primary text-decoration-none font-regular">{{__('frontend/app.AboutUs')}}</a>
                </li>
              </ul>
            </div>
          </div>
          <p class="primary font-bold font-text">
            <a href="/" target="_blank">Designed &amp; Developed by Thebes Academy Team. 2022</a>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="{{ asset('js/dropify.min.js') }}"></script>
  <script src="{{ asset('js/slick.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
</body>

</html>

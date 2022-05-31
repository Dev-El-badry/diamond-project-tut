@extends('layouts.app')

@section('content')

<!-- Start Searh Results -->

<div class="content-section mt-4 ">
  <div class="container">
    <div class="border-bottom pb-2 mb-4">

      <h2>{{ __('frontend/app.Search Results') }}  </h2>
    </div>
    <div class="my-4">

        @include('../partials/search-results')
    </div>


    <div class="border-bottom pb-2 mb-4">

        <h2>{{ __('frontend/app.Search Results') }} </h2>
      </div>

    @foreach ($results as $row)
        @if(array_key_exists("hotels", $row))
            @foreach($row['hotels'] as $value)

                <!-- Start Card -->
                <div class="card d-flex mb-4 flex-row">
                <img class="card-img-top" style="width: 18rem; height: 200px" src="{{ $value->getFirstMediaUrl('hotels') }}" alt="{{ $value->name }}">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                    <h5 class="card-title">
                        <a href="{{ url('/hotels/'.$value->id) }}">{{ $value->name }}</a>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span class="badge bg-primary text-white" >{{ __('frontend/app.Hotels') }}</span>
                    </h6>
                    <p class="card-text">
                        {!! substr($value->description, 0, 100) !!}
                    </p>

                    </div>
                    <div>
                    <a href="{{ url('/hotels/'.$value->id) }}" class="btn btn-primary">
                        {{ __('frontend/app.Learn More') }}

                    </a>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            @endforeach
        @endif

        @if(array_key_exists("villas", $row))
            @foreach($row['villas'] as $value)

                <!-- Start Card -->
                <div class="card d-flex mb-4 flex-row">
                <img class="card-img-top" style="width: 18rem; height: 200px" src="{{ $value->getFirstMediaUrl('villages') }}" alt="{{ $value->name }}">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                    <h5 class="card-title">
                        <a href="{{ url('/villas/'.$value->id) }}">{{ $value->name }}</a>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span class="badge bg-secondary text-white" >{{ __('frontend/app.Villas') }}</span>
                    </h6>
                    <p class="card-text">
                        {!! substr($value->description, 0, 100) !!}
                    </p>

                    </div>
                    <div>
                    <a href="{{ url('/villas/'.$value->id) }}" class="btn btn-primary">
                        {{ __('frontend/app.Learn More') }}

                    </a>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            @endforeach
        @endif


        @if(array_key_exists("hospitals", $row))
            @foreach($row['hospitals'] as $value)

                <!-- Start Card -->
                <div class="card d-flex mb-4 flex-row">
                <img class="card-img-top" style="width: 18rem; height: 200px" src="{{ $value->getFirstMediaUrl('hospitals') }}" alt="{{ $value->name }}">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                    <h5 class="card-title">
                        <a href="{{ url('/hospitals/'.$value->id) }}">{{ $value->name }}</a>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span class="badge bg-secondary text-white" >{{ __('frontend/app.Hospitals') }}</span>
                    </h6>
                    <p class="card-text">
                        {!! substr($value->description, 0, 100) !!}
                    </p>

                    </div>
                    <div>
                    <a href="{{ url('/hospitals/'.$value->id) }}" class="btn btn-primary">
                        {{ __('frontend/app.Learn More') }}

                    </a>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            @endforeach
        @endif

    @if(array_key_exists("restaurants", $row))
        @foreach($row['restaurants'] as $value)

            <!-- Start Card -->
            <div class="card d-flex mb-4 flex-row">
            <img class="card-img-top" style="width: 18rem; height: 200px" src="{{ $value->getFirstMediaUrl('restaurants') }}" alt="{{ $value->name }}">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                <h5 class="card-title">
                    <a href="{{ url('/restaurants/'.$value->id) }}">{{ $value->name }}</a>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <span class="badge bg-secondary text-white" >{{ __('frontend/app.Restaurants') }}</span>
                </h6>
                <p class="card-text">
                    {!! substr($value->description, 0, 100) !!}
                </p>

                </div>
                <div>
                <a href="{{ url('/restaurants/'.$value->id) }}" class="btn btn-primary">
                    {{ __('frontend/app.Learn More') }}

                </a>
                </div>
            </div>
            </div>
            <!-- End Card -->
        @endforeach
    @endif

    @if(array_key_exists("stores", $row))
        @foreach($row['stores'] as $value)

            <!-- Start Card -->
            <div class="card d-flex mb-4 flex-row">
            <img class="card-img-top" style="width: 18rem; height: 200px" src="{{ $value->getFirstMediaUrl('stores') }}" alt="{{ $value->name }}">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                <h5 class="card-title">
                    <a href="{{ url('/stores/'.$value->id) }}">{{ $value->name }}</a>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <span class="badge bg-secondary text-white" >{{ __('frontend/app.Stores') }}</span>
                </h6>
                <p class="card-text">
                    {!! substr($value->description, 0, 100) !!}
                </p>

                </div>
                <div>
                <a href="{{ url('/stores/'.$value->id) }}" class="btn btn-primary">
                    {{ __('frontend/app.Learn More') }}

                </a>
                </div>
            </div>
            </div>
            <!-- End Card -->
        @endforeach
    @endif



    @endforeach



  </div>
</div>
<!-- End Searh Results  -->
@endsection

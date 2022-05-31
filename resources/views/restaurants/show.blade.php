@extends('layouts.app')

@section('content')
<div class="content-section ">
    <img src="{{ $restaurant->getFirstMediaUrl('restaurants') }}" style="height: 50vh;" class="w-100" alt="Single Hotel">

    <div class="container">
      <div class="top-content mt-4 border-bottom">

        <h2 class="text-primary">{{ $restaurant->name }}</h2>

        <p>
          {!! $restaurant->description !!}
        </p>

        <div class="border-top pt-2 ">
          <h3 class="text-primary">{{__('frontend/single_page.RestaurantsInformation')}}</h3>
          <ul class="list-unstyled">
            <li>
              <span class="text-primary w-25">
                {{__('frontend/single_page.AddressDetails')}}
              </span>
              <span>
                {{ $restaurant->address_details }}
              </span>
            </li>

            <li>
              <span class="text-primary w-25">
                {{__('frontend/single_page.Place')}}
              </span>
              <span>
                {{$restaurant->place->name}}
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="py-4">
        <h2 class="text-primary">{{__('frontend/single_page.RestaurantsGallery')}}</h2>
        <div class="slider   slick-slider custom-slider border-bottom py-3">
            @foreach($restaurant->getMedia('restaurant-gallery') as $img)

            <div><img src="{{ $img->getFullUrl() }}" class="img-fluid h-100" /></div>
        @endforeach
        </div>
      </div>



    </div>
  </div>
@endsection

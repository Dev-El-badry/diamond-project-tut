@extends('layouts.app')

@section('content')
<div class="content-section ">
    <img src="{{ $hospital->getFirstMediaUrl('hospitals') }}" style="height: 50vh;" class="w-100" alt="Single Hotel">

    <div class="container">
      <div class="top-content mt-4 border-bottom">

        <h2 class="text-primary">{{ $hospital->name }}</h2>

        <p>
         {!! $hospital->description !!}
        </p>

        <div class="border-top pt-2 ">
          <h3 class="text-primary">{{__('frontend/single_page.HospitalsInformation')}}</h3>
          <ul class="list-unstyled">
            <li>
              <span class="text-primary w-25">
                {{__('frontend/single_page.AddressDetails')}}
              </span>
              <span>
                {{ $hospital->address_details }}
              </span>
            </li>

            <li>
              <span class="text-primary w-25">
                {{__('frontend/single_page.Place')}}
              </span>
              <span>
                {{ $hospital->place->name }}
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="py-4">
        <h2 class="text-primary">{{__('frontend/single_page.HospitalsGallery')}}</h2>
        <div class="slider   slick-slider custom-slider border-bottom py-3">
            @foreach($hospital->getMedia('hospital-gallery') as $img)

            <div><img src="{{ $img->getFullUrl() }}" class="img-fluid h-100" /></div>
        @endforeach
        </div>
      </div>



    </div>
  </div>
@endsection

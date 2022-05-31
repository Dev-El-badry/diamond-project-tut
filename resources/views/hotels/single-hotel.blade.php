@extends('layouts.app')

@section('content')
<div class="content-section ">
    <img src="{{ $hotel->getFirstMediaUrl('hotels') }}" style="height: 50vh;" class="w-100" alt="Single Hotel">

    <div class="container">
      <div class="top-content mt-4 border-bottom">

        <h2 class="text-primary">{{ $hotel->name }}</h2>

        <p>
          {!! $hotel->description !!}
        </p>

        <div class="border-top pt-2 ">
          <h3 class="text-primary">{{__('frontend/single_page.HotelInformation')}}</h3>
          <ul class="list-unstyled">
            <li>
              <span class="text-primary w-25">

                {{__('frontend/single_page.AddressDetails')}}
              </span>
              <span>
                {{ $hotel->address_details }}
              </span>
            </li>
            <li>
              <span class="text-primary w-25">
                {{__('frontend/single_page.Place')}}
              </span>
              <span>
               {{$hotel->place->name}}
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="py-4">
        <h2 class="text-primary">{{__('frontend/single_page.HotelGallery')}}</h2>
        <div class="slider   slick-slider custom-slider border-bottom py-3">
            @foreach($hotel->getMedia('hotel-gallery') as $img)

                <div><img src="{{ $img->getFullUrl() }}" class="img-fluid h-100" /></div>
            @endforeach
        </div>
      </div>


      <!-- Start Rooms -->
      <div class="mt-4">
        <h2 class="text-primary"> {{__('frontend/single_page.HotelRooms')}}</h2>


      </div>

      @foreach($hotel->rooms as $room)
      <div class="mt-4 room">
        <div class="card d-flex mb-4 flex-row">
          <img class="card-img-top" style="width: 18rem;" src="{{ asset('img/hotel-img.jpeg') }}" alt="Card image cap">
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title text-primary">{{ $room->code }}</h5>
              <h4 class="text-info">${{ $room->price }}</h4>
              <p class="card-text">
                {{$hotel->description}}
              </p>

            </div>
            <div class="mt-2">
                <form id="booking-form" action="{{ route('booking.room', $room->id) }}" method="POST" class="d-none">
                    @csrf
                </form>
              <button onclick="event.preventDefault();
              document.getElementById('booking-form').submit();" class="btn btn-primary">
              {{__('frontend/single_page.booking')}}

            </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach


      <!-- End Rooms -->

    </div>
  </div>
@endsection

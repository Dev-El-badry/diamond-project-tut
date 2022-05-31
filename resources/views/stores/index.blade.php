@extends('layouts.app')

@section('content')

<!-- Start Hotels -->

<div class="content-section mt-4 ">
  <div class="container">
    <div class="border-bottom pb-2 mb-4">

      <h2>{{__('frontend/pages.SearchStores')}} </h2>
    </div>
    <div class="my-4">

        @include('../partials/search-results')
    </div>


    <div class="border-bottom pb-2 mb-4">

        <h2>{{__('frontend/pages.Stores')}} </h2>
      </div>

      @foreach ($stores as $row)

      <!-- Start Card -->
      <div class="card d-flex mb-4 flex-row">
        <img class="card-img-top" style="width: 18rem; height: 200px" src="{{ $row->getFirstMediaUrl('stores') }}" alt="{{ $row->name }}">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title">
                <a href="{{ url('/stores/'.$row->id) }}">{{ $row->name }}</a>
            </h5>
            <p class="card-text">
              {!! substr($row->description, 0, 100) !!}
            </p>

          </div>
          <div>
            <a href="{{ url('/stores/'.$row->id) }}" class="btn btn-primary">
              {{__('frontend/pages.LearnMore')}}

            </a>
          </div>
        </div>
      </div>
      <!-- End Card -->
      @endforeach


      <div class="d-flex justify-content-center w-100">

          {{ $stores->links() }}
      </div>





  </div>
</div>
<!-- End Hotels  -->
@endsection

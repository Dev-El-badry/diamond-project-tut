@extends('layouts.dashboard')

@section('dashboard')
<!-- Start Content -->
<div class="col-12 d-flex d-inline justify-content-between pr-0">
  <h4 class="font-bold secondary">{{__('frontend/profile.yourCart')}}</h4>
  <button class="btn d-xl-none pt-0" type="button" data-toggle="collapse" data-target="#example-collapse">
    <span class="navbar-light"><span class="navbar-toggler-icon"></span></span>
  </button>
</div>




<div class="row  mt-4">
  <div class="col-xl-12">

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{__('frontend/profile.HotelTitle')}}</th>
          <th scope="col">{{__('frontend/profile.RoomCode')}}</th>
          <th scope="col">{{__('frontend/profile.ItemType')}}</th>
          <th scope="col">{{__('frontend/profile.Price')}}</th>
          <th scope="col">{{__('frontend/profile.Actions')}}</th>

        </tr>
      </thead>
      <tbody>
          @php
              $count = 0;
              $totalPrice = 0;
              $cartIds = [];
          @endphp
          @foreach($items as $item)
          @php
              $totalPrice += $item->room->price;
              array_push($cartIds, $item->id);
          @endphp
        <tr>
          <th scope="row">{{ ++$count }}</th>
          <td>{{ $item->hotel->name }}</td>
          <td>{{ $item->room->code }}</td>
          <td>Room</td>
          <td>${{ $item->room->price }}</td>
          <td>
            <a class="btn btn-danger" href="{{ route('dashboard.cart.delete', $item->id) }}">
              <i class="fa fa-trash"></i>
              {{__('frontend/profile.delete')}}
            </a>
          </td>
        </tr>
        @endforeach




      </tbody>
    </table>
  </div>

  <div class="col-xl-12">
      @if($totalPrice > 0)
    <div class="text-right">
      {{--  <button class="btn btn-success" {{  $totalPrice > 0 ? '':'disabled' }}>
        Checkout ${{ $totalPrice }}
        <i class="fa fa-angle-double-right"></i>
      </button>  --}}
      <form action="{{ route('dashboard.cart.charge') }}" method="POST">
          @csrf
          <input type="hidden" name="item_ids" value="{{ implode(',', $cartIds) }}" />
          <input type="hidden" name="price" value="{{ $totalPrice }}" />

        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_PUB_KEY') }}"
                data-amount="{{ $totalPrice }}"
                data-name="Diamonds Village"
                data-description="Booking Room In Hotel"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="usd">
        </script>
    </form>
    </div>
    @endif
  </div>
</div>



<!-- End Content -->
@endsection

@section('scripts')

@endsection

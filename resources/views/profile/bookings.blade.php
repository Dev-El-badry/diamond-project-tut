@extends('layouts.dashboard')

@section('dashboard')
<!-- Start Content -->
<div class="col-12 d-flex d-inline justify-content-between pr-0">
  <h4 class="font-bold secondary">{{__('frontend/profile.Bookings')}}</h4>
  <button class="btn d-xl-none pt-0" type="button" data-toggle="collapse" data-target="#example-collapse">
    <span class="navbar-light"><span class="navbar-toggler-icon"></span></span>
  </button>
</div>




<div class="row  mt-4">
  <div class="col-xl-12">

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">{{__('frontend/profile.BookingReference')}}</th>
          <th scope="col">{{__('frontend/profile.HotelTitle')}}</th>
          <th scope="col">{{__('frontend/profile.RoomCode')}}</th>
          <th scope="col">{{__('frontend/profile.ItemType')}}</th>
          <th scope="col">{{__('frontend/profile.Price')}}</th>
          <th scope="col">{{__('frontend/profile.BookingStatus')}}</th>

        </tr>
      </thead>
      <tbody>
        @foreach($orders as $row)

        <tr>
          <th scope="row">{{ $row->order_ref }}</th>
          <td>{{ $row->hotel->name }}</td>
          <td>{{ $row->room->code }}</td>
          <td>Hotel Room</td>
          <td>${{ $row->price }}</td>
          <td>
            <span class="badge badge-warning">{{ $row->order_status == 1 ? __('frontend/profile.paid'):  __('frontend/profile.pending') }}</span>

          </td>

        </tr>
        @endforeach




      </tbody>
    </table>
  </div>
</div>
<!-- End Content -->
@endsection

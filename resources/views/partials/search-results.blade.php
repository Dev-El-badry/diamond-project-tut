<!-- start search box -->

<form action="{{ url()->current() == url('/').'/'.LaravelLocalization::getCurrentLocale() ? url('/search_results') :url(url()->current()) }}" method="get">

    <div class="input-group search">
      <input type="text" class="form-control h-100 border-0" value="{{ request()->name }}" name="name" placeholder="{{ __('frontend/app.search_placeholder') }}">

      <div class="input-group-append">

        <select class="form-select search-dropdown" id="inputGroupSelect01" name="place">
            <option selected value=''>{{ __('frontend/app.search_where') }}</option>
            @php
            $places = \App\Models\Place::all();
            foreach($places as $place) {
                $selected = request()->query('place') == $place->id ? 'selected' : '';
                echo " <option value='{$place->id}' {$selected}>{$place->name}</option>";
            }
        @endphp

          </select>


        <button class="btn search-btn" type="submit">{{ __('frontend/app.search_btn') }}</button>
      </div> <!-- end input-group-append -->


    </div>
</form>
<!-- end search box -->

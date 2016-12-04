@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{-- Displays a panel to suggest a user to login or register if they are not authenticated. --}}
            @if(!Auth::check())
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>
                    <div class="panel-body">
                        Please <a href="{{ url('/login') }}">login</a> or
                        <a href="{{ url('/register') }}">register</a>!
                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" href="#collapseRestoForm">Add a restaurant</a>
                </div>
                <div id="collapseRestoForm" class="panel-body collapse">
                    <!-- New restaurant form -->
                    <form action="{{url('/restaurant/store')}}" method="POST" class="form-horizontal">
                        {{csrf_field()}}

                        <!-- Restaurant name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="restaurant-name" class="form-control" value="{{ old('name') }}" placeholder="Restaurant name">
                            </div>
                        </div>

                        <!-- Restaurant address -->
                        <div class="form-group">
                            <label for="street_address" class="col-sm-2 control-label">Street address</label>
                            <div class="col-sm-9">
                                <input type="text" name="street_address" id="restaurant-address" class="form-control" value="{{ old('street_address') }}" placeholder="#### street name">
                            </div>
                        </div>

                        <!-- Restaurant city -->
                        <div class="form-group">
                            <label for="city" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" id="restaurant-city" class="form-control" value="{{ old('city') }}" placeholder="City name">
                            </div>
                        </div>

                        <!-- Restauramt province and postal code -->
                        <div class="form-group">
                            <label for="province" class="col-sm-2 control-label">Province</label>
                            <div class="col-sm-3">
                                <input type="text" name="province" id="restaurant-province" class="form-control" value="{{ old('province') }}" placeholder="eg. QC">
                            </div>
                            <label for="postal_code" class="col-sm-2 control-label">Postal code</label>
                            <div class="col-sm-3">
                                <input type="text" name="postal_code" id="restaurant-postcode" class="form-control" value="{{ old('postal_code') }}" placeholder="eg. M5V 1S5">
                            </div>
                        </div>

                        <!-- Restaurant genre -->
                        <div class="form-group">
                            <label for="genre" class="col-sm-2 control-label">Genre</label>
                            <div class="col-sm-9">
                                <input type="text" name="genre" id="restaurant-genre" class="form-control" value="{{ old('genre') }}" placeholder="Food genre">
                            </div>
                        </div>

                        <!-- Restaurant price range -->
                        <div class="form-group">
                            <label for="price_range" class="col-sm-2 control-label">Price range</label>
                            <div class="col-sm-3">
                                <input type="text" name="min_price" id="restaurant-minimum" class="form-control" value="{{ old('min_price') }}" placeholder="Minimum ($)">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="max_price" id="restaurant-maximum" class="form-control" value="{{ old('max_price') }}" placeholder="Maximum ($)">
                            </div>
                        </div>

                        <!-- Submit form -->
                        <div class="well well-sm">
                            <input class="btn btn-block" type="submit" value="Add restaurant"/>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Display restaurants -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Restaurants</h2>
                </div>

                @foreach($restaurants as $restaurant)
                    <a class="list-group-item">
                        <div class="panel-body">
                            <h3>{{ $restaurant->name }}</h3>
                            <p>{{ $restaurant->street_address }}</p>
                            <p>{{ $restaurant->city }}</p>
                            <p>{{ $restaurant->postal_code }}</p>
                        </div>
                    </a>
                @endforeach


                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

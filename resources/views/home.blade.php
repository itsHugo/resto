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
                    <a data-toggle="collapse" href="#collapseResto">Add a restaurant</a>
                </div>
                <div id="collapseResto" class="panel-body collapse">
                    <!-- New restaurant form -->
                    <form action="{{url('/restaurant')}}" method="POST" class="form-horizontal">
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
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" id="restaurant-address" class="form-control" value="{{ old('address') }}" placeholder="Number, street name, city, ...">
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
            <div class="panel panel-default" data-toggle="collapse" data-target=".demo">
                <div class="panel-heading">
                    Restaurants
                </div>
                @foreach($restaurants as $restaurant)
                    <div class="panel-body">
                        <p>{{ $restaurant->name }}</p>
                        </hr>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

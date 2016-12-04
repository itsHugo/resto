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

                @if($keywords)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Search: <b>{{ $keywords }}</b></h3>
                        </div>
                    </div>
                @endif

                <!-- Display restaurants -->
                <div class="panel panel-default" data-toggle="collapse" data-target=".demo">
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
                        {!! $restaurants->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

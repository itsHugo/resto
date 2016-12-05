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
                        <a class="list-group-item" href="{{ url('restaurant/'.$restaurant->id) }}">
                            <div class="panel-body resto">
                                <h3>{{ $restaurant->name }}</h3>
                                Genre: {{ $restaurant->genre }}
                                <br/>Price: ${{ $restaurant->min_price}} - ${{ $restaurant->max_price }}
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

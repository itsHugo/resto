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

            <!-- Display new Restaurant form -->
            @include('common.restaurantform')

            <!-- Display restaurants -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Restaurants</h2>
                </div>

                @if(count($restaurants) > 0)
                    @for($i=0; $i<20; $i++)
                        <a class="list-group-item" href="{{ url('restaurant/'.$restaurants[$i]->id) }}">
                            <div class="panel-body resto">
                                <h3>{{ $restaurants[$i]->name }}</h3>
                                Genre: {{ $restaurants[$i]->genre }}
                                <br/>Price: ${{ $restaurants[$i]->min_price}} - ${{ $restaurants[$i]->max_price }}
                            </div>
                        </a>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

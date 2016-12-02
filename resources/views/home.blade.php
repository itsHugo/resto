@extends('layouts.app')
@section('js')
    <script src="/js/geo.js"></script>
@endsection

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

            <!-- Display restaurants -->
            <div class="panel panel-default">
                <div class="panel-heading">Restaurants</div>
                @for($i = 0; $i < 20; $i++)
                    <div class="panel-body">
                        <p>{{$i}}</p>
                        </hr>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection

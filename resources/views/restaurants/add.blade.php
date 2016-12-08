@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <!-- Display restaurants -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Add a restaurant</h2>
                        @include("common.restaurantform")
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
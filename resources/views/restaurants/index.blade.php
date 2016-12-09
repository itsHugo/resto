@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <!-- Display restaurants -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>{{ $restaurant->name }}</h2>

                        @can('destroy', $restaurant)
                            <form action="{{ url('/restaurant/'.$restaurant->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" id="update-review" class="btn btn-danger">
                                    <i class="fa fa-btn"></i>Delete
                                </button>
                            </form>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <p>{{ $restaurant->street_address }}</p>
                        <p>{{ $restaurant->city }}</p>
                        <p>{{ $restaurant->postal_code }}</p>
                        <p>{{ $restaurant->genre }}</p>
                        <p>${{ $restaurant->min_price}} - ${{ $restaurant->max_price }}</p>

                        @can('edit', $restaurant)
                            @include('common.editrestaurant')
                        @endcan
                    </div>
                </div>

                <!-- Display reviews -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Reviews</h3>

                        <!-- Form collapsible panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#collapseReviewForm">Add a review</a>
                            </div>

                            <!-- Display error message -->
                            @include('common.errors')

                            <div id="collapseReviewForm" class="panel-body collapse">
                                <!-- New restaurant form -->
                                <form action="{{url('/review/store')}}" method="POST" class="form-horizontal">
                                    {{csrf_field()}}

                                    <!-- Review title -->
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Review title">
                                        </div>
                                    </div>

                                    <!-- Review rating -->
                                    <!-- TO DO: Make a better form input i.e. drop down list of available ratings -->
                                    <div class="form-group">
                                        <label for="rating" class="col-sm-2 control-label">Rating</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="rating" id="rating" class="form-control" value="{{ old('rating') }}" placeholder="1-5 stars *****">
                                        </div>
                                    </div>

                                    <!-- Review content -->
                                    <div class="form-group">
                                        <label for="content" class="col-sm-2 control-label">Content</label>
                                        <div class="col-sm-9">
                                            <textarea  name="content" id="content" class="form-control" placeholder="Review content...">{{ old('content') }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Restaurant id -->
                                    <input type="text" hidden name="restaurant_id" value="{{$restaurant->id}}"/>

                                    <!-- Submit form -->
                                    <div class="well well-sm">
                                        <input class="btn btn-block" type="submit" value="Add review"/>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if(count($reviews) > 0)
                            <!-- Display each review -->
                            @foreach($reviews as $review)
                                <a class="list-group-item">
                                    <div class="panel-body">
                                        <!-- Review details -->
                                        <h4>{{ $review->title }}</h4> <br/>
                                        <p>By: {{ $review->user->name }}</p>
                                        <p>Rating: {{ $review->rating }}</p>
                                        <p>{{ $review->content }}</p>


                                        <!-- Buttons here -->
                                        

                                        @can('destroy', $review)
                                            <!-- Current User can delete their review -->
                                            <!-- Delete Button -->
                                            <form action="{{ url('review/'.$review->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" id="delete-task-{{ $review->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </a>
                            @can('edit', $review)
                                            @include('common.editreview')
                                    @endcan
                            @endforeach

                                <div class="panel-footer">
                                    {!! $reviews->render() !!}
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

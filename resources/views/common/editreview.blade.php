<div class="panel panel-default">
    <div class="panel-heading">
        <a data-toggle="collapse" href="#{{$review->id}}">Edit review</a>
    </div>

    @include('common.errors')

    <div id="{{$review->id}}" class="panel-body collapse">
        <form action="{{url('editReview')}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Review name -->
            <!-- Review id -->
            <input type="text" hidden name="id" value="{{$review->id}}"/>
            <input type="text" hidden name="restaurant_id" value="{{$review->restaurant_id}}"/>
            
            
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-9">
                    <input type="text" name="title_edit{{$review->id}}" id="name" class="form-control" required="" value="{{$review->title }}" placeholder="Title">
                </div>
            </div>

            <!-- Review rating -->
            <div class="form-group">
                <label for="street_address" class="col-sm-2 control-label">Rating</label>
                <div class="col-sm-9">
                    <input type="text" name="rating_edit{{$review->id}}" id="street_address" class="form-control" required="" value="{{ $review->rating }}" placeholder="Rating">
                </div>
            </div>

            <!-- Review content -->
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-9">
                    <textarea name="content_edit{{$review->id}}" id="city" class="form-control longForm" required="" placeholder="Content">{{ $review->content }}</textarea>
                </div>
            </div>

            <!-- Submit form -->
            <div class="well well-sm">
                <input class="btn btn-block" type="submit" value="Edit Review"/>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <a data-toggle="collapse" href="#collapseRestoForm">Edit restaurant</a>
    </div>

    @include('common.errors')

    <div id="collapseRestoForm" class="panel-body collapse">
        <!-- New restaurant form -->
        <form action="{{url('editResto')}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Restaurant name -->
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Restaurant name">
                </div>
            </div>

            <!-- Restaurant address -->
            <div class="form-group">
                <label for="street_address" class="col-sm-2 control-label">Street address</label>
                <div class="col-sm-9">
                    <input type="text" name="street_address" id="street_address" class="form-control" value="{{ old('street_address') }}" placeholder="#### street name">
                </div>
            </div>

            <!-- Restaurant city -->
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-9">
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" placeholder="City name">
                </div>
            </div>

            <!-- Restauramt province and postal code -->
            <div class="form-group">
                <label for="province" class="col-sm-2 control-label">Province</label>
                <div class="col-sm-3">
                    <input type="text" name="province" id="province" class="form-control" value="{{ old('province') }}" placeholder="eg. QC">
                </div>
                <label for="postal_code" class="col-sm-2 control-label">Postal code</label>
                <div class="col-sm-3">
                    <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}" placeholder="eg. M5V 1S5">
                </div>
            </div>

            <!-- Restaurant genre -->
            <div class="form-group">
                <label for="genre" class="col-sm-2 control-label">Genre</label>
                <div class="col-sm-9">
                    <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') }}" placeholder="Food genre">
                </div>
            </div>

            <!-- Restaurant price range -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Price range</label>
                <div class="col-sm-3">
                    <input type="text" name="min_price" id="min_price" class="form-control" value="{{ old('min_price') }}" placeholder="Minimum ($)">
                </div>
                <div class="col-sm-3">
                    <input type="text" name="max_price" id="max_price" class="form-control" value="{{ old('max_price') }}" placeholder="Maximum ($)">
                </div>
            </div>

            <!-- Submit form -->
            <div class="well well-sm">
                <input class="btn btn-block" type="submit" value="Edit restaurant"/>
            </div>
        </form>
    </div>
</div>
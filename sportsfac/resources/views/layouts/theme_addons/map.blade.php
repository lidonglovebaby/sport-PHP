 <!-- Map Canvas-->
<div class="map-canvas list-solid" style="height: 640px;">
    <!-- Map -->
    <div class="map">
        <div class="toggle-navigation">
            <div class="icon">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
        <!--/.toggle-navigation-->
        <div id="map" class="has-parallax"></div>
    </div>
    <!-- end Map -->
    <!--Items List-->
    <div class="items-list">
        <div class="inner">
            <div class="scroller1">
                <div class="filter">
                    <form class="main-search" role="form" method="post" action="?">
                        <header class="clearfix">
                            <h3 class="pull-left">Search</h3>
                            {{-- <a href="#advanced-search" class="show-more pull-right" data-toggle="collapse" aria-expanded="false" aria-controls="advanced-search">Advanced Search</a> --}}
                        </header>
                        <div class="advanced-search collapse" id="advanced-search">
                            <h4>Features</h4>
                            <ul class="list-unstyled checkboxes">
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="1">Free Parking</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="2">Cards Accepted</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="3">Wi-Fi</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="4">Air Condition</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="5">Reservations</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="6">Team-buildings</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="7">Places to seat</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="8">Winery</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="9">Draft Beer</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="10">LCD</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="11">Saloon</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="12">Free Access</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="13">Terrace</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="14">Minigolf</label></div></li>
                                <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="15">Night Bar</label></div></li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="type">Activity Type</label>
                                    <select name="type" multiple title="All" data-live-search="true" id="type">
                                        <option value="1">Cardio</option>
                                        <option value="2" class="sub-category">Zumba</option>
                                        <option value="3" class="sub-category">CrossTraining</option>
                                        <option value="4" class="sub-category">Crossfit</option>
                                        <option value="5">Free Weight</option>
                                        <option value="6">Pool and Water Sports</option>
                                        {{-- <option value="7" class="sub-category">Bars</option>
                                        <option value="8" class="sub-category">Vegetarian</option>
                                        <option value="9" class="sub-category">Steak & Grill</option> --}}
                                        <option value="10">Others</option>
                                        <option value="11" class="sub-category">Yoga</option>
                                        <option value="12" class="sub-category">Box</option>
                                        <option value="13" class="sub-category">Squas</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!--/.col-md-6-->
                            {{-- <div class="col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label for="bedrooms">Bedrooms</label>
                                    <div class="input-group counter">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                                        </span>
                                        <input type="text" class="form-control" id="bedrooms" name="bedrooms" placeholder="Any">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div>
                                <!-- /.form-group -->
                            </div> --}}
                            <!--/.col-md-3-->
                           {{--  <div class="col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label for="bathrooms">Bathrooms</label>
                                    <div class="input-group counter">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                                        </span>
                                        <input type="text" class="form-control" id="bathrooms" name="bathrooms" placeholder="Any">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div>
                                <!-- /.form-group -->
                            </div> --}}
                            <!--/.col-md-3-->
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <div class="input-group location">
                                        <input type="text" class="form-control" id="location" placeholder="Enter Location">
                                        <span class="input-group-addon"><i class="fa fa-map-marker geolocation" data-toggle="tooltip" data-placement="bottom" title="Find my position"></i></span>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            {{-- <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <div class="ui-slider" id="price-slider" data-value-min="100" data-value-max="40000" data-value-type="price" data-currency="$" data-currency-placement="before">
                                        <div class="values clearfix">
                                            <input class="value-min" name="value-min[]" readonly>
                                            <input class="value-max" name="value-max[]" readonly>
                                        </div>
                                        <div class="element"></div>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div> --}}
                            <!--/.col-md-6-->
                        </div>
                        <!--/.row-->
                    </form>
                    <!-- /.main-search -->
                </div>
                <!--end Filter-->
                <header class="clearfix">
                    <h3 class="pull-left">Results</h3>
                    @if( $gymsSession && count($gymsSession) > 0)
                        <div class="buttons pull-right comparing-gyms-container row hidden-xs">
                    @else
                        <div class="buttons pull-right comparing-gyms-container row hidden-xs" style="display:none;">
                    @endif
                        <a class="button compare_button">Compare</a><a class="button compare_button_clear">Remove all</a> <h3 class="pull-right title">Comparing</h3>
                       {{--  <span class="icon active" id="display-grid"><i class="fa fa-th"></i></span>
                        <span class="icon" id="display-list"><i class="fa fa-th-list"></i></span> --}}
                        <div class="comparing_inner_container col-xs-12 pull-right">
                           @forelse($gymsSession as $gym)
                                <span data-id='{{$gym->idgym}}'>{!! $gym->name !!}</span>
                           @empty

                           @endforelse

                        </div>
                    </div> 
                </header>
                <ul class="results grid">

                </ul>
                <div class="scroller__track">
                    <div class="scroller__bar"></div>
                </div>
            </div>
        </div>
        <!--results-->
    </div>
    <!--end Items List-->
</div>
<!-- end Map Canvas-->

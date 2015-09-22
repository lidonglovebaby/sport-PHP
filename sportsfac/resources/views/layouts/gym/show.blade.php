@extends('layouts.template')

@section('content')
    {{-- var_dump($gym) --}}
    <div id="map-detail"></div>
    <section class="container">
        <div class="row">
            <!--Item Detail Content-->
            <div class="col-md-9">
                <section class="block" id="main-content">
                    <header class="page-title">
                        <div class="title">
                            <h1>{{ $gym->name }}</h1>
                            <!--<figure>  {{-- $gym->address --}}</figure>-->
                            {{--@include('layouts.gym.contribute', ['tag'=>'figure','content'=> $gym->address,'link'=>'','fieldName'=>'Address'])--}}
                        </div>
                        <!--<div class="info">
                            <div class="type">
                                <i>{!! HTML::image("icons/restaurants-bars/restaurants/restaurant.png","") !!}</i>
                                {{-- <span>Restaurant</span> --}}
                            </div>
                        </div>-->
                    </header>
                    <div class="row">
                        <!--Detail Sidebar-->
                        <aside class="col-md-4 col-sm-4" id="detail-sidebar">
                            <!--Contact-->
                            <section>
                                <header><h3>Contact</h3></header>
                                <address>
                                    <!-- <div>Max Five Lounge</div>-->
                                    @include('layouts.gym.contribute', ['tag'=>'div','content'=> $gym->fullAddress(),'link'=>'','fieldName'=>'Adress','custom'=>'Add Information'])
                                    <!--<div>63 Birch Street</div> -->
                                   {{--  @include('layouts.gym.contribute', ['tag'=>'div','content'=> $gym->exterior . ' ' . $gym->interior,'link'=>'','fieldName'=>'Number']) --}}
                                    <!-- <div>Granada Hills, CA 91344</div> -->
                                    {{-- @include('layouts.gym.contribute', ['tag'=>'div','content'=> $gym->state . ' ' . $gym->country . ' ' . $gym->postalCode ,'link'=>'','fieldName'=>'State,Country,Zip Code']) --}}
                                    <figure>
                                        {{-- <div class="info">
                                            <i class="fa fa-mobile"></i>
                                            <span>818-832-5258</span>
                                        </div> --}}
                                        <div class="info">
                                            <i class="fa fa-phone"></i>
                                            {{-- <span>+1 123 456 789</span> --}}
                                             @include('layouts.gym.contribute', ['tag'=>'span','content'=> $gym->phone,'link'=>'','fieldName'=>'Phone'])
                                        </div>
                                        <div class="info">
                                            <i class="fa fa-globe"></i>
                                            {{-- <a href="#">www.maxfivelounge.com</a> --}}
                                             @include('layouts.gym.contribute', ['tag'=>'a','content'=> $gym->website,'link'=>$gym->website,'fieldName'=>'Web Site'])
                                        </div>
                                        <div class="info">
                                            <i class="fa fa-facebook"></i>
                                             {{-- <a href="#">www.maxfivelounge.com</a> --}}
                                            @if( !empty(trim($gym->facebookLink())))
                                                @include('layouts.gym.contribute', ['tag'=>'a','content'=> $gym->address,'link'=>$gym->facebookLink(),'fieldName'=>'Facebook Page'])
                                            @else
                                                @include('layouts.gym.contribute', ['tag'=>'a','content'=> '','link'=>'','fieldName'=>'Facebook Page'])
                                            @endif
                                        </div>
                                    </figure>
                                </address>
                            </section>
                            <!--end Contact-->
                            <!--Sharing-->
                            <section class="clearfix">
                                <header><h3>Share this place</h3></header>
                                {{-- <header class="pull-left"><a href="#reviews" class="roll"><h3>Share this place</h3></a></header> --}}
                                <ul class="sharing_content">
                                    <li class="share_fb"><a target="_blank" href="http://www.facebook.com/sharer.php?u='{!! route('gyms.profile', ['id'=>$gym->idgym]) !!}'"><i class="fa fa-facebook"></i></a></li>
                                    <li class="share_tw"><a target="_blank" href="http://twitter.com/share?url='{!! route('gyms.profile', ['id'=>$gym->idgym]) !!}'&text='.urlencode(html_entity_decode(get_the_title())).'"><i class="fa fa-twitter"></i></a></li>
                                    <li class="share_gp"><a target="_blank" href="https://plus.google.com/share?url='{!! route('gyms.profile', ['id'=>$gym->idgym]) !!}'"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="share_mail"><a target="_blank" href="mailto:?Subject=Smart&Fit&amp;Body=%20'{!! route('gyms.profile', ['id'=>$gym->idgym]) !!}.'"><i class="fa fa-envelope"></i></a></li>
                                </ul>
                            </section>
                            <!--end Sharing-->
                            <!--Rating-->
                            <section class="clearfix">
                                <header class="pull-left"><a href="#reviews" class="roll"><h3>Rating</h3></a></header>
                                <figure class="rating big pull-right" data-rating="4"></figure>
                            </section>
                            <!--end Rating-->
                            
                            <!--Events-->
                            {{-- <section>
                                <header><h3>Events</h3></header>
                                <figure>
                                    <div class="expandable-content collapsed show-60" id="detail-sidebar-event">
                                        <div class="content">
                                            <p>Maecenas purus sapien, pellentesque non consectetur eu, rhoncus in mauris.
                                                Duis et nisl metus. Sed ut pulvinar mauris, bibendum ullamcorper ex.
                                                Aliquam vitae ante diam. Nam eu blandit odio. Cras erat lorem, iaculis eu nulla eu, sodales aliquam eros.
                                            </p>
                                        </div>
                                    </div>
                                    <a href="#" class="show-more expand-content" data-expand="#detail-sidebar-event" >Show More</a>
                                </figure>
                            </section> --}}
                            <!--end Events-->
                            <!--Contact Form-->
                             <section>
                                {{--<header><h3>Contact Form</h3></header>
                                <figure>
                                    <form id="item-detail-form" role="form" method="post" action="?">
                                        <div class="form-group">
                                            <label for="item-detail-name">Name</label>
                                            <input type="text" class="form-control framed" id="item-detail-name" name="item-detail-name" required="">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="item-detail-email">Email</label>
                                            <input type="email" class="form-control framed" id="item-detail-email" name="item-detail-email" required="">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="item-detail-message">Message</label>
                                            <textarea class="form-control framed" id="item-detail-message" name="item-detail-message"  rows="3" required=""></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <button type="submit" class="btn framed icon">Send<i class="fa fa-angle-right"></i></button>
                                        </div>
                                        <!-- /.form-group -->
                                    </form>
                                </figure>--}}
                                <article class="block">
                                    <header><h2>Services</h2></header>
                                    <ul class="bullets">
                                        {{-- <li>Free Parking</li>
                                        <li>Cards Accepted</li>
                                        <li>Wi-Fi</li>
                                        <li>Air Condition</li>
                                        <li>Valet Parking</li> --}}
                                        
                                    </ul>
                                    @include('layouts.gym.contribute', ['tag'=>'a','content'=> '','link'=>'','fieldName'=>'Add Service','default' => ''])
                                </article>
                                <article class="block">
                                    <header><h2>Activities</h2></header>
                                    <ul class="bullets">
                                        {{-- <li>Free Weight</li>
                                        <li>Cards Accepted</li>
                                        <li>Wi-Fi</li>
                                        <li>Air Condition</li>
                                        <li>Reservations</li>
                                        <li>Teambuildings</li>
                                        <li>Places to seat</li>
                                        <li>Winery</li>
                                        <li>Draft Beer</li>
                                        <li>LCD</li>
                                        <li>Saloon</li>
                                        <li>Free Access</li>
                                        <li>Terrace</li>
                                        <li>Minigolf</li> --}}
                                    </ul>
                                    @include('layouts.gym.contribute', ['tag'=>'a','content'=> '','link'=>'','fieldName'=>'Add Activity','default' => ''])
                                </article>
                                <!-- /.block -->
                                <article class="block">
                                    <header><h2>Opening Hours</h2></header>
                                    <dl class="lines">
                                        @forelse($gym->openinghours as $hour)
                                            <dt>{{ $hour->weekday->name }}</dt>
                                            <dd>{{ $hour->open }} - {{ $hour->close }}</dd>
                                        @empty
                                            @include('layouts.gym.contribute', ['tag'=>'a','content'=> '','link'=>'','fieldName'=>' ','default' => 'Not Available'])
                                        @endforelse
                                        {{-- <dt>Monday</dt>
                                        <dd>08:00 am - 11:00 pm</dd>
                                        <dt>Tuesday</dt>
                                        <dd>08:00 am - 11:00 pm</dd>
                                        <dt>Wednesday</dt>
                                        <dd>08:00 am - 11:00 pm</dd>
                                        <dt>Thursday</dt>
                                        <dd>08:00 am - 11:00 pm</dd>
                                        <dt>Friday</dt>
                                        <dd>08:00 am - 11:00 pm</dd>
                                        <dt>Saturday</dt>
                                        <dd>08:00 am - 11:00 pm</dd> --}}
                                    </dl>
                                </article>
                                <!-- /.block -->
                            </section> 
                            <!--end Contact Form-->
                        </aside>
                        <!--end Detail Sidebar-->
                        <!--Content-->
                        <div class="col-md-8 col-sm-8">
                            <section>
                                <article class="item-gallery">
                                    <div class="owl-carousel item-slider">
                                        <div class="slide">{!! HTML::image("img/items/1.jpg","",array("data-hash" => "1")) !!}</div>
                                        <div class="slide">{!! HTML::image("img/items/2.jpg","",array("data-hash" => "2"))!!}</div>
                                        <div class="slide">{!! HTML::image("img/items/3.jpg","",array("data-hash" => "3")) !!}</div>
                                        <div class="slide">{!! HTML::image("img/items/4.jpg","",array("data-hash" => "4")) !!}</div>
                                        <div class="slide">{!! HTML::image("img/items/5.jpg","",array("data-hash" => "5")) !!}</div>
                                        <div class="slide">{!! HTML::image("img/items/6.jpg","",array("data-hash" => "6")) !!}</div>
                                        <div class="slide">{!! HTML::image("img/items/7.jpg","",array("data-hash" => "7")) !!}</div>
                                    </div>
                                    <!-- /.item-slider -->
                                    <div class="thumbnails">
                                        <span class="expand-content btn framed icon" data-expand="#gallery-thumbnails" >More<i class="fa fa-plus"></i></span>
                                        <div class="expandable-content height collapsed show-70" id="gallery-thumbnails">
                                            <div class="content">
                                                <a href="#1" id="thumbnail-1" class="active">{!! HTML::image("img/items/7.jpg","") !!}</a>
                                                <a href="#2" id="thumbnail-2">{!! HTML::image("img/items/2.jpg","") !!}</a>
                                                <a href="#3" id="thumbnail-3">{!! HTML::image("img/items/3.jpg","") !!}</a>
                                                <a href="#4" id="thumbnail-4">{!! HTML::image("img/items/4.jpg","") !!}</a>
                                                <a href="#5" id="thumbnail-5">{!! HTML::image("img/items/5.jpg","") !!}</a>
                                                <a href="#6" id="thumbnail-6">{!! HTML::image("img/items/6.jpg","") !!}</a>
                                                <a href="#7" id="thumbnail-7">{!! HTML::image("img/items/7.jpg","") !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- /.item-gallery -->
                                <article class="block">
                                    <header><h2>Description</h2></header>
                                    @include('layouts.gym.contribute', ['tag'=>'p','content'=> isset($gym->description) ? $gym->description->description : '','link'=>'','fieldName'=>'Description','default' => 'Add Information'])
                                </article>
                                <!-- /.block -->
                                <article class="block classes" style="max-height:350px;">
                                    <header><h2>Scheduled Classes</h2></header>
                                        @if(isset($timetablesDates))
                                            <div class="list-slider owl-carousel">
                                           @foreach($timetablesDates as $date)
                                                
                                                    <div class="slide">
                                                        <header>
                                                            <h3><i class="fa fa-calendar"></i>{{date('D', strtotime("Sunday +{$date->__get('dayOfWeek')} days")) }} {{ $date->toFormattedDateString() }}</h3>
                                                        </header>
                                                        @foreach($timetables[$date->toDateString()] as $timetable) 
                                                            
                                                                <div class="list-item">
                                                                    <div class="left">
                                                                        <h4>{{$timetable->activity}}</h4>
                                                                        <figure>{{$timetable->trainer}}</figure>
                                                                    </div>
                                                                    <div class="right">{{$timetable->start or ''}} - {{$timetable->finish or ''}}</div>
                                                                </div>
                                                                <!-- /.list-item -->
                                                            
                                                        @endforeach
                                                    </div>
                                                    <!-- /.slide -->
                                            @endforeach
                                             </div>
                                            <!-- /.list-slider -->
                                        @else
                                            @include('layouts.gym.contribute', ['tag'=>'','content'=> '','link'=>'','fieldName'=>' ','default' => 'Not Available'])
                                        @endif
                                </article>
                                <!-- /.block -->
                            </section>
                            <!--Reviews-->
                            <section class="block" id="reviews">
                                <header class="clearfix">
                                    <h2 class="pull-left">Reviews</h2>
                                    <a href="#write-review" class="btn framed icon pull-right roll">Write a review <i class="fa fa-pencil"></i></a>
                                </header>
                                <article class="clearfix overall-rating">
                                    <strong class="pull-left">Over Rating</strong>
                                    <figure class="rating big color pull-right" data-rating="4"></figure>
                                    <!-- /.rating -->
                                </article><!-- /.overall-rating-->
                                <section class="reviews">
                                    @foreach ($gym->reviews as $review)
                                        <article class="review">
                                            <figure class="author">
                                                {!! HTML::image("img/default-avatar.png","") !!}
                                                <div class="date">12.05.2014</div>
                                            </figure>
                                            <!-- /.author-->
                                            <div class="wrapper">
                                                <h5>Catherine Brown</h5>
                                                <figure class="rating big color" data-rating="4"></figure>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Nulla vestibulum, sem ut sollicitudin consectetur, augue diam ornare massa,
                                                    ac vehicula leo turpis eget purus. Nunc pellentesque vestibulum mauris,
                                                    eget suscipit mauris imperdiet vel. Nulla et massa metus.
                                                </p>
                                                <div class="individual-rating">
                                                    <span>Value</span>
                                                    <figure class="rating" data-rating="4"></figure>
                                                </div>
                                                <!-- /.user-rating -->
                                                <div class="individual-rating">
                                                    <span>Service</span>
                                                    <figure class="rating" data-rating="4"></figure>
                                                </div>
                                                <!-- /.user-rating -->
                                            </div>
                                            <!-- /.wrapper-->
                                        </article>
                                    @endforeach
                                    <!-- /.review -->
                                   {{--  <article class="review">
                                        <figure class="author">
                                            {!! HTML::image("img/default-avatar.png","") !!}
                                            <div class="date">10.05.2014</div>
                                        </figure>
                                        <!-- /.author-->
                                        <div class="wrapper">
                                            <h5>John Doe</h5>
                                            <figure class="rating big color" data-rating="5"></figure>
                                            <p>
                                                Nunc pellentesque vestibulum mauris, eget suscipit mauris
                                                imperdiet vel. Nulla et massa metus. Nam porttitor quam eget ante
                                            </p>
                                            <div class="individual-rating">
                                                <span>Value</span>
                                                <figure class="rating" data-rating="5"></figure>
                                            </div>
                                            <!-- /.user-rating -->
                                            <div class="individual-rating">
                                                <span>Service</span>
                                                <figure class="rating" data-rating="5"></figure>
                                            </div>
                                            <!-- /.user-rating -->
                                        </div>
                                        <!-- /.wrapper-->
                                    </article> --}}
                                    <!-- /.review -->
                                </section>
                                <!-- /.reviews-->
                            </section>
                            <!-- /#reviews -->
                            <!--end Reviews-->
                            <!--Review Form-->
                            <section id="write-review">
                                <header>
                                    <h2>Write a Review</h2>
                                </header>
                                <form id="form-review" role="form" method="post" action="?" class="background-color-white">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="form-review-name">Name</label>
                                                <input type="text" class="form-control" id="form-review-name" name="form-review-name" required="">
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="form-review-email">Email</label>
                                                <input type="email" class="form-control" id="form-review-email" name="form-review-email" required="">
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="form-review-message">Message</label>
                                                <textarea class="form-control" id="form-review-message" name="form-review-message"  rows="3" required=""></textarea>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default">Submit Review</button>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-4">
                                            <aside class="user-rating">
                                                <label>Value</label>
                                                <figure class="rating active" data-name="value"></figure>
                                            </aside>
                                            <aside class="user-rating">
                                                <label>Service</label>
                                                <figure class="rating active" data-name="score"></figure>
                                            </aside>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.main-search -->
                            </section>
                            <!--end Review Form-->
                        </div>
                        <!-- /.col-md-8-->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /#main-content-->
            </div>
            <!-- /.col-md-8-->
            <!--Sidebar-->
            <div class="col-md-3">
                <aside id="sidebar">
                    <section>
                        <header><h2>New Places</h2></header>
                        @forelse($recent as $rec)
                            <a href="item-detail.html" class="item-horizontal small">
                                <h3>{{$rec->name}}</h3>
                                {{-- <figure>63 Birch Street</figure> --}}
                                <div class="wrapper">
                                    <div class="image">{!! HTML::image("img/items/1.jpg","") !!}</div>
                                    <div class="info">
                                        <div class="type">
                                            <i>{!! HTML::image("icons/sports/relaxing-sports/weights.png","") !!}</i>
                                            <span>Gym</span>
                                        </div>
                                        <div class="rating" data-rating="4"></div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            
                        @endforelse


                        <!--/.item-horizontal small-->
                        
                    </section>
                    <section>
                        <a href="#">{!! HTML::image("img/ad-banner-sidebar.png","") !!}</a>
                    </section>
                     <section>
                        <a href="#">{!! HTML::image("img/ad-banner-sidebar.png","") !!}</a>
                    </section>
                     <section>
                        <a href="#">{!! HTML::image("img/ad-banner-sidebar.png","") !!}</a>
                    </section>
                    {{-- <section>
                        <header><h2>Categories</h2></header>
                        <ul class="bullets">
                            <li><a href="#" >Restaurant</a></li>
                            <li><a href="#" >Steak House & Grill</a></li>
                            <li><a href="#" >Fast Food</a></li>
                            <li><a href="#" >Breakfast</a></li>
                            <li><a href="#" >Winery</a></li>
                            <li><a href="#" >Bar & Lounge</a></li>
                            <li><a href="#" >Pub</a></li>
                        </ul>
                    </section>
                    <section>
                        <header><h2>Events</h2></header>
                        <div class="form-group">
                            <select class="framed" name="events">
                                <option value="">Select Your City</option>
                                <option value="1">London</option>
                                <option value="2">New York</option>
                                <option value="3">Barcelona</option>
                                <option value="4">Moscow</option>
                                <option value="5">Tokyo</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </section> --}}
                </aside>
                <!-- /#sidebar-->
            </div>
            <!-- /.col-md-3-->
            <!--end Sidebar-->
        </div><!-- /.row-->
    </section>
    <!-- /.container-->


@stop
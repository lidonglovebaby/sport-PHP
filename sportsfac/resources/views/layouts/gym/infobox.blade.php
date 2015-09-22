
@if(isset($gym))
	<div class="infobox green">  
		<div class="inner">  
			<div class="image">  
				<!-- <div class="item-specific">  + drawItemSpecific(category, json, i) +  </div>   -->
				<!-- <div class="overlay">  
					<div class="wrapper">   -->
						<!-- <a href="#" class="quick-view" data-toggle="modal" data-target="#modal" id="{{$gym->idgym}}">Quick View</a>  
						<hr>   -->
						<!-- <a href="{!! action('GymController@index', array('id'=>$gym->idgym))!!} " class="detail">Go to Detail</a>   -->

						{{-- link_to_route('gyms.profile', 'Go to Detail', [$gym->idgym], ['class' => 'detail']) --}}
					<!-- </div>  
				</div>  --> 
				<a href="{!! route('gyms.profile', ['id'=>$gym->idgym]) !!} " class="description">
					<div class="meta">  
						{{-- $gym->price() --}}
						<h2>  {!! $gym->name !!}  </h2>  
						<figure>  {{ $gym->address }}  </figure>  
						<i class="fa fa-angle-right"></i>  
					</div>  
				</a>  
				<!-- <img src="{!! asset('icons/sports/relaxing-sports/weights.png') !!}">   -->
			</div>  
		</div>  
	</div> 
@endif
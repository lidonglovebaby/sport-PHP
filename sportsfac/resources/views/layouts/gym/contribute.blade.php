{{-- This comment will not be in the rendered HTML --}}
{{-- This comment will not be in the rendered HTML --}}
{{-- This comment will not be in the rendered HTML --}}
@if( isset($content) && !empty(trim($content)) && !isset($custom))
	
	@if ($tag == 'a')  
		 <a href="{{$link}}" target="_blank">{{$content}}</a>
	@else
		<{{$tag}}>{{$content}}</{{$tag}}>
	@endif
@elseif(isset($custom))
	@if ($tag == 'a')  
		 <a href="{{$link}}" target="_blank">{{$content}}</a>
	@else
		<{{$tag}}>{{$content}}</{{$tag}}>
	@endif
	<a href="javascript:void(0);" class="contribute_link" > {{$custom}} </a>
@else
	<span class="contribute_conatiner"><span class="contribute">
		@if( isset($fieldName) )
			@if( !isset($default) )
				{{$fieldName}} Not available
			@else
				{{$fieldName}} {{$default}}
			@endif
		@else
			@if( !isset($default) )
				Not available
			@else
				{{$default}}
			@endif
		@endif
	</span> <a href="javascript:void(0);" class="contribute_link" > Contribute +</a></span>
@endif
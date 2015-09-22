<div class="compare-wrapper">  
	@if(isset($comparing) && $comparing)
		{!! link_to_route('gyms.profile', 'Compare', [$idgym], ['class' => 'compare-link comparing']) !!}
	@else
		{!! link_to_route('gyms.profile', 'Compare', [$idgym], ['class' => 'compare-link']) !!}
	@endif
</div>  
<ul class="list-group">
	 @foreach($response as $busstop) 
		<li style="cursor:pointer;" data-id="{{ $busstop->id }}" data-toggle="modal" data-target="#openBuslist" class="list-group-item"> {{ $busstop->name }} <span class="text-danger small"> (<?php echo round($busstop->distance,2); ?>   miles away) </span></li>
	 @endforeach 
</ul>
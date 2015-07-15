@extends('app')
@section('content')
<script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize(latitude,longitude) {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(latitude, longitude),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="max-width:450px; margin:0 auto;">
						<input type="text" id="search" class="form-control" placeholder="Enter your location.."  />
					</div>
				</div>
				<div class="row">
				<div class="container">
					<div class="col-md-4">
						<h4 style="text-align:center;">Near by bus stop</h4>
						<div id="liststop">
							Please select the location to find the near by bus stops
						</div>
					</div>
					<div class="col-md-8">
						<div style="height:500px !important;" id="map-canvas"  class="panel-body">
					
						</div>
					</div>
				</div>
				
			</div>
			</div>
		</div>
	</div>

</div>

<!-- Modal -->
<div class="modal fade" id="openBuslist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Bus Information</h4>
      </div>
      <div class="modal-body">
        Please wait for bus information...
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



{!! HTML::script('js/typehead.js'); !!}
<script>
$( document ).ready(function() {
	var locations = ['Petaling jaya, Malaysia', 'Kuala lumpur, Malaysia', 'Chennai, India'];
	$('#search').typeahead({
		source: locations,
		afterSelect: function(location){
			getStoplist(location);
			$.ajax({
			    url: '{{ url() }}/locate',
			    type: 'POST',
			    data: {'name':location},
			    beforeSend: function (xhr) {
		            var token = $('meta[name="csrf_token"]').attr('content');

		            if (token) {
		                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
		            	}
	        	},
			    dataType: 'JSON',
			    success: function (data) {
			           initialize(data.latitude,data.longitude); 
			    },
			    error:function(error){ 
			    	console.log(error);
	           	 alert("error!!!!");
	        	}
			});
		}
	});

	function getStoplist(name){
		$.ajax({
			    url: '{{ url() }}/getStoplist',
			    type: 'POST',
			    data: {'name':name},
			    beforeSend: function (xhr) {
		            var token = $('meta[name="csrf_token"]').attr('content');

		            if (token) {
		                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
		            	}
	        	},
			    dataType: 'JSON',
			    success: function (data) {
			    	$('#liststop').html(data.html);
			    },
			    error:function(error){ 
			    	console.log(error);
	           	 alert("error!!!!");
	        	}
			});
	}

	function getBuslist(stopID){
		$.ajax({
			    url: '{{ url() }}/getBuslist',
			    type: 'POST',
			    data: {'stopID':stopID},
			    beforeSend: function (xhr) {
			    	$('.modal-body').html('Please Wait for bus details..');
		            var token = $('meta[name="csrf_token"]').attr('content');

		            if (token) {
		                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
		            	}
	        	},
			    dataType: 'JSON',
			    success: function (data) {
			    	$('.modal-body').html(data.html);
			    },
			    error:function(error){ 
			    	console.log(error);
	           	 alert("error!!!!");
	        	}
		});
	}

	$('#openBuslist').on('shown.bs.modal', function (e) {
	  $('.modal-backdrop').remove();
	  var stopID = $(e.relatedTarget).data('id');
	  getBuslist(stopID);
	});

});
</script>
@endsection

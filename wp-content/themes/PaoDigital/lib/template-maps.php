<style>
/* Always set the map height explicitly to define the size of the div
* element that contains the map. */
#map {
	height: 400px;
}
/* Optional: Makes the sample page fill the window. */
html, body {
	height: 100%;
	margin: 0;
	padding: 0;
}
</style>

<div id="pods-meta-box-more-fields" class="postbox">
	<div class="handlediv" title="Click to toggle" aria-expanded="true"><br>
	</div>
	<h3 class="hndle ui-sortable-handle">
		<span>Delimitação de Entrega</span>
	</h3>
	<div class="inside">
		<div id="map"></div>
	</div>
	<div class="mapbt" style="padding: 0 0 15px 10px;">
		<button id="delframe" class="button button-primary button-large"> Deletar Rotas de Entrega</button>
	</div>
</div>

<?php 

	$pid = $_GET['id'];
	$where = array(
		'where'   => "parceiro_id = {$pid}"
	);
	$map = pods( 'maps', $where );
	$maps = $map->data(); 

	//if( !empty($maps) ):
		// foreach( $maps as $key => $val ):

		// 	$array = unserialize($val->array);

		// endforeach;
	//endif;

?>


<script>

var app = {

	makePolygon: function(paths, color) {
        return (new google.maps.Polygon({
            paths: paths,
            strokeColor: color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35,
            editable: true
        }));
    },

    initialize: function() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -23.6815315, lng: -46.8754915},
          zoom: 8
        });

        var polygons = [];

		var drawingManager = new google.maps.drawing.DrawingManager({
			drawingMode: google.maps.drawing.OverlayType.POLYGON,
			drawingControl: true,
			drawingControlOptions: {
				position: google.maps.ControlPosition.TOP_CENTER,
				drawingModes: [google.maps.drawing.OverlayType.POLYGON]
			},
			polygonOptions: {
				editable: false
			}
        });
        drawingManager.setMap(map);


        <?php 

			$pid = $_GET['id'];
			$where = array(
				'where'   => "parceiro_id = {$pid}"
			);
			$map = pods( 'maps', $where );
			$maps = $map->data(); 

			if( !empty($maps) ):
				foreach( $maps as $key => $val ):

				$code = pods('mappoint', array( 
					'where' => "`t`.`map_id` = {$val->id}",
					'orderby' => "`t`.`id` ASC" 
				));
				$codes = $code->data(); 
		?>

			polygons.push([<?php
				if( !empty($codes) ):
					foreach( $codes as $kay => $poly ): 

						$v = ( $kay == ( count($codes) - 1) )? "" : ",";
						echo '{ lat: '.(string)$poly->latitude.', lng: '.(string)$poly->longitude.' }'. $v;

					endforeach;
				endif;
			?>]);

		<?php

				endforeach;
			endif;

		?>

		//console.log(polygons);
		var i = 0;
        polygons.forEach(function(poly) {
        	var bi = new google.maps.Polygon({
				paths: poly,
				strokeColor: '#000000',
				strokeOpacity: 0.6,
				strokeWeight: 3,
				fillColor: '#000000',
				fillOpacity: 0.35
			});
			bi.setMap(map);
			bi.addListener('click', function(){
				overlayClickListener(this);
			});
			i++;
        });

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
				var newShape = event.overlay;
				newShape.type = event.type;
		});

		google.maps.event.addListener(drawingManager, "overlaycomplete", function(event){
            var overl = event.overlay;
            var array = overl.getPath().getArray();
            var user = <?php echo $_GET['id']; ?>;

            jQuery.post( ajaxurl, { action: 'save_polygon', polygon: JSON.stringify(array), parceiro: user }, function(data){
            	jQuery(body).append(data);
            }, 'html');

            //$('#vertices').val(a.getPath().getArray());
        });

    }
}


    $(document).on("click", "#delframe", function(){
        var user = <?php echo $_GET['id']; ?>;
	    jQuery.post( ajaxurl, { action: 'delete_polygon', parceiro: user }, function(data){
	        //window.location.reload();
    	}, 'html');
    });



    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV2fGkkJbjzROwAewWvVZNuNRPFNNvVsk&libraries=drawing&callback=app.initialize"
         async defer></script>

	<script type="text/javascript">
	(function($){

		$(document).on("click", "#btmapspolig", function(){
			console.log(google.maps.StrokePosition);
		});

	})(jQuery);

    </script>






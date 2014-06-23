	<!--
	<link rel="stylesheet" href="./lib/js/jquery/themes/base/jquery.ui.tooltip.css">
	<script src="./lib/js/jquery/jquery-1.10.2.js"></script>
	<script src="./lib/js/jquery/ui/jquery.ui.core.js"></script>
	<script src="./lib/js/jquery/ui/jquery.ui.widget.js"></script>
	<script src="./lib/js/jquery/ui/jquery.ui.position.js"></script>
	<script src="./lib/js/jquery/ui/jquery.ui.tooltip.js"></script>
	-->

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	
	<script>
	$(function() {
		$( document ).tooltip({
			position: {
				my: "center bottom-12",   
				at: "center top",
				using: function( position, feedback ) {
					$( this ).css( position );
					$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this );
				}
			}
		});
	});
	
	//note: adjust center bottom-12 above, for tooltip to appear near & far from objects.
	</script>
	
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
</head>
<body>

	<div id="container2">
	<?php   
		$booking 	    = file_get_contents('json/bookings.json');
		$booking_data   = json_decode($booking,true);
		foreach ($booking_data as $key => $bookd) {
			if ($cleaner_id == $bookd['cleaner_id']) {
		//echo $bookd['duration'];
		$tNow	  =  $timefrom;
		$tNow2    = strtotime('-30 minutes',$tNow);
		while($tNow2 < $timeto){
			$tNow2 = strtotime('+30 minutes',$tNow2);
 	?>
		<input type="radio" class="dates" name="dates" value="<?php echo date("H:i",$tNow2)."\n"; ?>">
		 <?php echo $days[$week_day]." ".date("H:i",$tNow2)."\n"; ?><br>
	    <?php }
	    	}
		} ?>
	</div>

</body>
	<script type="text/javascript">
		 $(document).ready(function(){
		 	$('.dates').change(function() {
		 	var dates = $('input[name="dates"]:checked').val();
		 	$.ajax({
	                    type: 'POST',
	                    //url: '<?php echo base_url().'index.php/welcome/check_cleaner' ?>', 
	                    data: {dates: dates},
	                    success: function(result) {
	                     
	                           //$('#result2').html(result);
	                    }

	          });
		 });
		 });
	</script>
</html>
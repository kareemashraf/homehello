<?php
$booking = file_get_contents('json/bookings.json');
$data 	 = json_decode($booking,true); 
?>

<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo base_url(); ?>css/glDatePicker.default.css" rel="stylesheet" type="text/css">
</head>
<body>

    <input type="text" id="mydate" gldp-id="mydate" readonly  />
    <div gldp-el="mydate" id="testx" 
         style="width:400px; height:300px; position:absolute; top:70px; left:100px;" >
    </div>
    	<div id="result" style="margin-left: 500px;"></div>
    	<div id="result2" style="margin-left: 500px;"></div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    	<script src="<?php echo base_url(); ?>js/glDatePicker.min.js"></script>

    	<script type="text/javascript">
	        $(window).load(function() 
	        {
	            $('#mydate').glDatePicker(
				{
				    showAlways: true,
				    allowMonthSelect: false,
				    allowYearSelect: false,
				    prevArrow: '',
				    nextArrow: '',

				    selectedDate: new Date(2015, 5, 15),
				    
				    selectableDates: [
				    <?php
				    foreach ($data as $key => $value) {
	 						//echo $value['start_time']."<br/>";
	 						$date  = explode('-', $value['start_time']);
	 						$year  = $date[0];
	 						$month = $date[1];
	 						$month = $month - 1;
	 						$day   = $date[2];
	 						$day   = $day[0].$day[1];
	 				?>
				        { date: new Date(<?php echo $year.','.$month.','.$day; ?>) },
				    <?php } ?>
				    ]
				});
	        });
   		</script>
	   		
</body>
</html>


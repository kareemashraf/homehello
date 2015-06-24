<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
</head>
<body>

<div id="container">

<input type="radio" class="cleaner" name="cleaner" value="<?php echo $cleaner_id; ?>">cleaner : <?php echo $cleaner_id; ?><br>

</div>

</body>
<script type="text/javascript">
	 $(document).ready(function(){
	 	$('.cleaner').change(function() {
	 	var cleaner = $('input[name="cleaner"]:checked').val();
	 	$.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'index.php/welcome/check_cleaner' ?>', 
                    data: {cleaner_id: cleaner},
                    success: function(result) {
                     
                           $('#result2').html(result);
                    }

          });
	 });
	 });
</script>
</html>
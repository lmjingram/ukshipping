<style>.error,.pass,.warning{
	color: white; border-radius: 2px; line-height: 15px; ont-size: 12px; padding: 10px 20px;
	font-weight: bold;
}
.error{
	background: red; 
}
.pass{
	background: green;
}
.warning{
	background: orange;
}
</style>
<?php
	include 'shipping.php';
	
	Shipping::formServiceChecker();
	
	Shipping::resultServiceChecker();
?>

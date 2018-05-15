<?php

class Shipping
{
	
	private static $restrictedPostcodes = array(
	   'No Delivery' => array('BT','GY','HS','IM','JE','KW','ZE','PH',
	      'PO30','PO31','PO32','PO33','PO34','PO35','PO36','PO37','PO38',
	      'PO39','PO40','PO41','IV1','IV4'),
	   'No Weekend Delivery' => array('DD','IV2','IV5','IV12','IV13','IV31',
	      'IV36','KY','TF','WC','PA','PH1','PH2','PH3','PH4','PH5','PH6',
	      'PH7','PH8','PH9','PH10','PH11','PH12','PH13','PH14','PH15',
	      'PH16','PH17','PH18','PH19','PH20','PH21','PH22','PH23','PH24',
	      'PH25','PH26','PH27','PH28','PH29','PH30','PH31','PH32', 'IV30',
	      'IV31','IV32'),
	   'No Sunday Service' => array('CO','CR','DG','DY','EC','GU','LA',
	      'LD','LL','NR','NW','PE','PL','PO','SA','SL','SO','SP','SS','TW',
	      'UB','WR','WS','YO'));
	
	public static function formServiceChecker()
	{
		
		$postcode = isset($_GET['postcode']) ? self::cleanPostCode($_GET['postcode']) : '';
		
?>

<form>
	<div>
		<h2>Delivery Service Checker</h2>
		<p>Enter your Post Code to find which delivery service is available in your area.</p>
		<fieldset>
			<input name='postcode' placeholder='Post Code' value='<?= $postcode ?>'/>
			<input type='submit' value='check' />
		</fieldset>
	</div>
</form>

<?php
		
	}
	
	public static function resultServiceChecker()
	{
		
		$postcode = isset($_GET['postcode']) ? self::cleanPostCode($_GET['postcode']) : '';
		
		$valid = self::validatePostCode($postcode);
		
		if($valid)
		{
			
?>
<p class='pass'>The Post Code you supplied is a good one. Well done, we're proud of you :')</p>
<?php
			
			$restrictions = self::checkPostCodeServicesRestrictions($postcode);
			
			if(count($restrictions) == 0)
			{
				
?>
<p class='pass'>Hooray! You can get delivery any day, even Christmas day...</p>
<?php
				
			} else {
				
?>
<p class='warning'>Oh no! Looks like delivery is restricted in the following ways:</p>
<ul><li>
<?php
				echo implode('</li><li>', $restrictions);
?>
</li></ul>
<?php
			}
			
		} else {
			
?>
<p class='error'>The Post Code you supplied is either invalid or has been scrubbed from existence.</p>
<?php
			
		}
		
	}
	
	private static function validatePostCode($postcode)
	{
		
		/* use postcode.io to validate the postcode */
		
		$request = "https://api.postcodes.io/postcodes/{$postcode}/validate";
		
		$result = json_decode(file_get_contents($request));
		
		return $result->result;
		
	}
	
	private static function cleanPostCode($postcode)
	{
		
		return strtoupper(preg_replace("/[^A-Za-z0-9]/", '', $postcode));
		
	}
	
	private static function checkPostCodeServicesRestrictions($postcode)
	{
		$postcode = self::cleanPostCode($postcode);
		
		$restrictions = array();
		
		foreach(self::$restrictedPostcodes as $service => $postcodes)
		{
			
			foreach($postcodes as $restrictedPostcode)
			{
				
				 if(substr($postcode, 0, strlen($restrictedPostcode)) === $restrictedPostcode){
					 
					 $restrictions[$service] = $service;
					 
				 }
				
			}
			
		}
		
		return $restrictions;
		
	}
	
}

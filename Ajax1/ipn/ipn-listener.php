<?php   

require_once "../dbconnect.php";

$debug = false;

if ($debug == false)
{
     // PayPal now provides a variable called test_ipn on sandbox IPN's for simple flagging of sandbox IPN vs. production IPN
     $sandbox = isset($_POST['test_ipn']) ? true : false;
     $ppHost = $sandbox ? 'www.sandbox.paypal.com' : 'www.paypal.com';
     $production_ssl= true;
     // Set SSL based on config.php
     if($sandbox && $sandbox_ssl)
	    $ssl = true;
     elseif(!$sandbox && $production_ssl)
	    $ssl = true;
     else
	    $ssl = false;



}


//$DB->GetAll($sql);




  
// Read the post from PayPal system and add 'cmd'   
$req = 'cmd=_notify-validate';   
  
// Store each $_POST value in a NVP string: 1 string encoded and 1 string decoded   
$ipn_email = '';  
$ipn_data_array = array();
foreach ($_POST as $key => $value)   
{   
 $value = urlencode(stripslashes($value));   
 $req .= "&" . $key . "=" . $value;   
 $ipn_email .= $key . " = " . urldecode($value) . '<br />';  
 $ipn_data_array[$key] = urldecode($value);
}

// Store IPN data serialized for RAW data storage later
$ipn_serialized = serialize($ipn_data_array);
  
// Validate IPN with PayPal
if ($debug == false)
   require_once('validate.php');
  
// Load IPN data into PHP variables
require_once('parse-ipn-data.php');

// Store RAW IPN log in the DB, really need to store?
$ipn_log_data['ipn_data_serialized'] = $ipn_serialized;
//$ipn_log_data_id = $db -> query_insert('raw_log', $ipn_log_data);

// Check for disputes/chargebacks/chargeback-reversals
if(
   strtoupper($txn_type) == 'NEW_CASE' || 
   strtoupper($payment_status) == 'REVERSED' || 
   strtoupper($payment_status) == 'CANCELED_REVERSAL'
   )
	require_once('dispute.php');
	
// Check if this was a refund.  
// Flag that it's a refund so you can skip entering a new order record in order.php
if(strtoupper($reason_code) == 'REFUND')
	require_once('refund.php');

 /****************************************************************************
 *The following is deactivated while there is no such operation.
 ****************************************************************************
// Check if this was a mass payment
if(strtoupper($txn_type) == 'MASSPAY')
	require_once('mass-payment.php');

// Check for subscription sign-up
if(
   strtoupper($txn_type) == 'SUBSCR_SIGNUP' || 
   strtoupper($txn_type) == 'SUBSCR_FAILED' || 
   strtoupper($txn_type) == 'SUBSCR_CANCEL' || 
   strtoupper($txn_type) == 'SUBSCR_EOT' || 
   strtoupper($txn_type) == 'SUBSCR_MODIFY'
   )
	require_once('subscr.php');

// Check for subscription payment
if(strtoupper($txn_type) == 'SUBSCR_PAYMENT')
	require_once('subscr-payment.php');
	
// Check for new recurring payment profile
if(
   strtoupper($txn_type) == 'RECURRING_PAYMENT_PROFILE_CREATED' || 
   strtoupper($txn_type) == 'RECURRING_PAYMENT_PROFILE_CANCEL' || 
   strtoupper($txn_type) == 'RECURRING_PAYMENT_PROFILE_MODIFY'
   )
	require_once('recurring-payment-profile.php');
	
// Check for recurring payment
if(
   strtoupper($txn_type) == 'RECURRING_PAYMENT' || 
   strtoupper($txn_type) == 'RECURRING_PAYMENT_SKIPPED' || 
   strtoupper($txn_type) == 'RECURRING_PAYMENT_FAILED'
   )
	require_once('recurring-payment.php');
	
 ************************************************************************/


if ($debug == true)
{$reason_code = "test";
$txn_type = 'WEB_ACCEPT';
$ipn_log_data_id = 100;
$sandbox   = 0;
}

if(strtoupper($reason_code) != 'REFUND' && 
   (
	strtoupper($txn_type) == 'CART' || 
   	strtoupper($txn_type) == 'EXPRESS_CHECKOUT' || 
   	strtoupper($txn_type) == 'VIRTUAL_TERMINAL' || 
   	strtoupper($txn_type) == 'WEB_ACCEPT' || 
	strtoupper($txn_type) == 'SEND_MONEY'
	)
   )
{		//print "going to order";
		require_once('order.php'); //insert or update the order into the orders table.
		
}



?>
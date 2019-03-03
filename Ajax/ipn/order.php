<?php
if ($debug == true){
$txn_id ="dsfdsfdsf 5";

$mc_gross = 2;
$payer_email = "testpe@dsf.com";
$item_name = "1a1a1a1a";
$item_number = "dasfdfdsfdsf";
$db_table_prefix = "paypal_ipn_";

$valid = true;
$payment_status ="Completed";
$txn_id_exists = false;
$option_selection1 = '201310282011541-2';
$payer_id = 2; 
$receiver_email = 'receiver@dfd.com'; 
$pending_reason = 'test2';
$payment_date = date('Y-m-d');
$mc_fee =0.33;
$item_name ='test item name'; 
$item_number = 'test item number';
$contact_phone = '000-000-0000';
$first_name = 'fn';
$last_name = 'ln'; 
$option_name1 = 'transaction id'; 
$option_name2 = 'none'; 
$option_selection2 = 'none';

$valid = true;

}

// Gather order data.


$order_data['payer_id'] = $payer_id;
$order_data['receiver_email'] = $receiver_email;
$order_data['payment_status'] = $payment_status;
$order_data['pending_reason'] = $pending_reason;
$order_data['payment_date'] = $payment_date;
$order_data['mc_gross'] = $mc_gross;
$order_data['mc_fee'] = $mc_fee;
$order_data['tax'] = $tax;
$order_data['mc_currency'] = $mc_currency;
$order_data['txn_id'] = $txn_id;
$order_data['txn_type'] = $txn_type;
$order_data['first_name'] = $first_name;
$order_data['last_name'] = $last_name;
$order_data['address_street'] = $address_street;
$order_data['address_city'] = $address_city;
$order_data['address_state'] = $address_state;
$order_data['address_zip'] = $address_zip;
$order_data['address_country'] = $address_country;
$order_data['address_country_code'] = $address_country_code;
$order_data['address_status'] = $address_status;
$order_data['payer_email'] = $payer_email;
$order_data['payer_status'] = $payer_status;
$order_data['payment_type'] = $payment_type;
$order_data['notify_version'] = $notify_version;
$order_data['verify_sign'] = $verify_sign;
$order_data['address_name'] = $address_name;
$order_data['protection_eligibility'] = $protection_eligibility;
$order_data['subscr_id'] = $subscr_id;
$order_data['custom'] = $custom;
$order_data['reason_code'] = $reason_code;
$order_data['contact_phone'] = $contact_phone;
$order_data['item_name'] = $item_name;
$order_data['item_number'] = $item_number;
$order_data['option_name1'] = $option_name1;
$order_data['option_selection1'] = $option_selection1;
$order_data['option_name2'] = $option_name2;
$order_data['option_selection2'] = $option_selection2;
$order_data['invoice'] = $invoice;
$order_data['for_auction'] = $for_auction;
$order_data['auction_buyer_id'] = $auction_buyer_id;
$order_data['auction_closing_date'] = $auction_closing_date;
$order_data['auction_multi_item'] = $auction_multi_item;
$order_data['shipping_method'] = $shipping_method;
$order_data['memo'] = $memo;
$order_data['handling_amount'] = $handling_amount;
$order_data['insurance_amount'] = $insurance_amount;
$order_data['shipping_discount'] = $shipping_discount;
$order_data['payer_business_name'] = $payer_business_name;
$order_data['receiver_id'] = $receiver_id;
$order_data['transaction_subject'] = $transaction_subject;
$order_data['raw_log_id'] = $ipn_log_data_id;
$order_data['btn_id'] = $btn_id;
$order_data['test_ipn'] = $sandbox ? 1 : 0;
$order_data['ipn_status'] = $valid ? 'Verified' : 'Invalid';

// Check to see if this txn_id already exists in the database.
$txn_id_exists = false;

//need to reverse the following back after done testing order.php
$sql = "SELECT count(*) FROM PAYPAL_ORIGINAL_DATA WHERE txnid = '" . $txn_id . "'";

$result = $DB -> GetOne($sql);
if ($result != 0)
	$txn_id_exists = true;

// If no record exists create a new one, otherwise update the existing record.
if(!$txn_id_exists)
{
	// insert order into DB
	
	$sql = "insert into PAYPAL_ORIGINAL_DATA values('".$txn_id."', '".$payer_id."', '".$receiver_email."', '".$payment_status."', '".$pending_reason."','".$payment_date."','".$mc_gross."','".$mc_fee."','".$item_name."', '".$item_number."', '".$payer_email."','".$contact_phone."','".$first_name."', '".$last_name."', '".$option_name1."', '".$option_selection1."', '".$option_name2."', '".$option_selection2."')";

		$DB->Execute($sql);

}
else
{
	$sql = "update PAYPAL_ORIGINAL_DATA
		set PayerID = '".$payer_id."', 
		ReceiverEmail = '".$receiver_email."', 
		PaymentStatus = '".$payment_status."', 
		PendingReason = '".$pending_reason."',
		PaymentDate = '".$payment_date."',
		McGross = '".$mc_gross."',
		McFee = '".$mc_fee."',
		ItemName = '".$item_name."', 
		ItemNumber = '".$item_number."',
		PayerEmail =  '".$payer_email."',
		ContactPhone = '".$contact_phone."',
		FirstName = '".$first_name."', 
		LastName = '".$last_name."', 
		On1 = '".$option_name1."', 
		Os1 = '".$option_selection1."', 
		On2 = '".$option_name2."', 
		Os2 = '".$option_selection2."' 
	where TxnID = '".$txn_id."'";
	$DB->Execute($sql);	

}	
/*************************************************************************************************************
//*Above just dumped everything into the orders table. Now need to check if it's a verified and completed order.
//*If so, update the datababase tables accordingly and further process the order.
//**************************************************************************************************************/


if ($valid == true) // must be validated from Paypal first
{  
	if ($payment_status == "Completed")
	{	
		if(!$txn_id_exists) //if new order
		{
			print "payment status is ".$payment_status;
			//verify if the information matches what's recorded in the database tables
			$tranxID = $option_selection1; //this is the own transaction ID sent to paypal
			
			$result = $DB -> GetOne("select count(*) from TRANSACTION where TranxID = '".$tranxID."' and Total = ".$mc_gross);			
			if ($result == 1) {
				$sql = "update TRANSACTION set PayStatus = '".$payment_status."', PayDate = '".date("Y-m-d")."' where  TranxID = '".$tranxID."' and Total = ".$mc_gross;

				print $sql;
				$DB->Execute($sql);

			}	
			else
			{
				//email administrator or log all the information for investigation

			}
						
			
		}
	
	}

	print "Done";


}

?>
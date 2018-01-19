<?php
class Payment extends DatabaseConn
{
	private $_paymentId;
	private $_paymentName;
	private $_paymentAdate;
	private $_paymentEdate;
	private $_paymentPlan;
	private $_paymentDuration;
	private $_paymentProfile;
	private $_paymentVideo;
	private $_paymentChat;
	private $_paymentContacts;
	private $_paymentAmount;
	private $_paymentMsg;
	private $_paymentRprofile;
	private $_paymentRcnt;
	private $_paymentRsms;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($paymentId = null)
	{
		parent::__construct();
		
		if(!empty($paymentId) && is_numeric($paymentId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from payment_view where pmatri_id=$paymentId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_paymentId= $dbRow->pmatri_id;
			       $this->_paymentName = $dbRow->pname;
			       $this->_paymentAdate =  $dbRow->pactive_dt;
				   $this->_paymentEdate =  $dbRow->exp_date;
				   $this->_paymentPlan =  $dbRow->p_plan;
				   $this->_paymentDuration =  $dbRow->plan_duration;
				   $this->_paymentProfile =  $dbRow->profile;
				   $this->_paymentVideo =  $dbRow->video;
				   $this->_paymentChat =  $dbRow->chat;
				   $this->_paymentContacts =  $dbRow->p_no_contacts;
				   $this->_paymentAmount =  $dbRow->p_amount;
				   $this->_paymentMsg =  $dbRow->P_msg;
				   $this->_paymentRprofile =  $dbRow->r_profile;
				   $this->_paymentRcnt =  $dbRow->r_cnt;
				   $this->_paymentRsms =  $dbRow->r_sms;
			       $this->setMatriId($dbRow->matri_id);
			       $this->setUserName($dbRow->username);
			      
		       }
		}else{
		
			       $this->_paymentId= "";
			       $this->_paymentName = "";
			       $this->_paymentAdate =  "";
				   $this->_paymentEdate =  "";
				   $this->_paymentPlan =  "";
				   $this->_paymentDuration =  "";
				   $this->_paymentProfile =  "";
				   $this->_paymentVideo =  "";
				   $this->_paymentChat =  "";
				   $this->_paymentContacts =  "";
				   $this->_paymentAmount =  "";
				   $this->_paymentMsg =  "";
				   $this->_paymentRprofile =  "";
				   $this->_paymentRcnt =  "";
				   $this->_paymentRsms =  "";
			      

	
		}
	}
	public function getAllPaymentByRegister($paymentId)
	{
		$dbResult=$this->getSelectQueryResult("select * from payment_view where pmatri_id=".$paymentId);
		$paymentObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$payment = new Payment();
					
				   $payment->setpaymentId($dbRow->pmatri_id);
			       $payment->setpaymentName($dbRow->pname);
			       $payment->setpaymentAdate($dbRow->pactive_dt);
				   $payment->setpaymentEdate($dbRow->exp_date);
				   $payment->setpaymentPlan($dbRow->p_plan);
				   $payment->setpaymentDuration($dbRow->plan_duration);
				   $payment->setpaymentProfile($dbRow->profile);
				   $payment->setpaymentVideo($dbRow->video);
				   $payment->setpaymentChat($dbRow->chat);
				   $payment->setpaymentContacts($dbRow->p_no_contacts);
				   $payment->setpaymentAmount($dbRow->p_amount);
				   $payment->setpaymentMsg($dbRow->P_msg);
				   $payment->setpaymentRprofile($dbRow->r_profile);
				   $payment->setpaymentRcnt($dbRow->r_cnt);
				   $payment->setpaymentRsms($dbRow->r_sms);
			
			
			
			$paymentObjArr[]=$payment;
			$arrCount++;
		}
		return $paymentObjArr;					
	}
	
	public function setPaymentId($paymentId)
	{
		$this->_paymentId = $paymentId;
	}
	
	public function setPaymentName($paymentName)
	{
		$this->_paymentName = $paymentName;
	}
	
	public function setPaymentStatus($paymentStatus)
	{
		$this->_paymentStatus = $paymentStatus;
	}
	
	public function getPaymentId()
	{
		return $this->_paymentId;
	}
	
	public function getPaymentName()
	{
		return $this->_paymentName;
	}
	
	public function getPaymentStatus()
	{
		return $this->_paymentStatus;
	}			
}
?>
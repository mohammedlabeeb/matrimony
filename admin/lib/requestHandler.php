<?php
	$GAME_ID = (isset($_GET['game_id']))? $_GET['game_id'] : "";
	$GAME_NAME = (isset($_GET['game_name']))? $_GET['game_name'] : "";
	$PAGE_NAME = (isset($_GET['page_name']))? $_GET['page_name'] : "";
	
	//$query = $_SERVER['QUERY_STRING'];
	$query = "game_id=".$GAME_ID."&game_name=".$GAME_NAME."&page_name=".$PAGE_NAME;
	
	
	class Status
	{
		private $_actionSuccess ;
		private  $_statusMessage ;
		
		public function __construct()
		{
				 
		}
		public function setActionSuccess($actionSuccess)
		{
			$this->_actionSuccess=$actionSuccess;
		}
		public function getActionSuccess()
		{
			return $this->_actionSuccess;
		}
		public function setStatusMessage($statusMessage)
		{
			$this->_statusMessage=$statusMessage;
		}
		public function getStatusMessage()
		{
			return $this->_statusMessage;
		}
	}
	
	 function handle_post_request($action,$sql_statement,$DatabaseCo)
	 {
				$STATUS_MESSAGE = "";
				$statusObj = new Status();
				$SQL_STATEMENT = $sql_statement;
				switch($action)
				{
					case 'REGISTER':
					if(($DatabaseCo->updateData($SQL_STATEMENT)))
					{
						$STATUS_MESSAGE="A verification code has been sent to your email id.Please Enter verification code in below text box.";
						$statusObj->setActionSuccess(true);
						$statusObj->setStatusMessage($STATUS_MESSAGE);
					}
					else
					{
						$STATUS_MESSAGE="There is a problem while adding record.";
						
						$statusObj->setActionSuccess(false);
						$statusObj->setStatusMessage($STATUS_MESSAGE);								
					}
					break;
					
				case 'ADD':
							if(($DatabaseCo->updateData($SQL_STATEMENT)))
							{
								$STATUS_MESSAGE="Record is added successfully.";
								$statusObj->setActionSuccess(true);
								$statusObj->setStatusMessage($STATUS_MESSAGE);
							}
							else
							{
								$STATUS_MESSAGE="There is a problem while adding record.";
								
								$statusObj->setActionSuccess(false);
								$statusObj->setStatusMessage($STATUS_MESSAGE);								
							}
					break;
					
				case 'UPDATE':
							if(($DatabaseCo->updateData($SQL_STATEMENT)))
							{
								$STATUS_MESSAGE = "Record is updated successfully.";
								$statusObj->setActionSuccess(true);
								$statusObj->setStatusMessage($STATUS_MESSAGE);							}
							else
							{
								$STATUS_MESSAGE = "There is a problem while updating record.";
								$statusObj->setActionSuccess(false);
								$statusObj->setStatusMessage($STATUS_MESSAGE);								
							}							
					break;
					
				case 'DELETE':
							if(($DatabaseCo->updateData($SQL_STATEMENT)))
							{
								$STATUS_MESSAGE = "Record is deleted successfully.";
								$statusObj->setActionSuccess(true);
								$statusObj->setStatusMessage($STATUS_MESSAGE);							}
							else
							{
								$STATUS_MESSAGE = "There is a problem while deleting record.";
								$statusObj->setActionSuccess(false);
								$statusObj->setStatusMessage($STATUS_MESSAGE);								
							}												
					break;
				
				case 'LOGIN':
								$DatabaseCo->dbResult =	$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
								
							if($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
							{
								$STATUS_MESSAGE = "Logged in successfully.";
								$statusObj->setActionSuccess(true);
								$statusObj->setStatusMessage($STATUS_MESSAGE);							}
							else
							{
								$STATUS_MESSAGE = "User Name or Password does not match, Please try again!";
								$statusObj->setActionSuccess(false);
								$statusObj->setStatusMessage($STATUS_MESSAGE);								
							}											
							break;	
				}
		return $statusObj;
	}
	function getSelectForCountry($selected,$arg)
	{
		if($selected == $arg)
			echo "SELECTED=SELECTED";
		else
			echo "";	
	}
	function getRowCount($sqlForCount,$DatabaseCo)
	{
		$rowCount = 0;
		
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($sqlForCount);
		
		while($DatabaseCo->dbRow = mysql_fetch_array($DatabaseCo->dbResult))
		{
			$rowCount = $DatabaseCo->dbRow[0];	
		}
		return $rowCount;
		
	}
	function getWhereClauseForStatus($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE status='APPROVED'";	
				break;
			
			case 'unapproved':
				$where = " WHERE status='UNAPPROVED'";
				break;
				
			case 'Active':
				$where = " WHERE status='Active'";	
				break;
				
			case 'Paid':
				$where = " WHERE status='Paid'";	
				break;
			
			case 'Inactive':
				$where = " WHERE status='Inactive'";
				break;
				
			case 'Featured':
				$where = " WHERE fstatus='Featured'";
				break;
				
			case 'Suspended':
				$where = " WHERE status='Suspended'";
				break;
			
			case 'all':
				$where = "";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForPhoto1($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE photo1_approve='APPROVED' AND photo1!=''";
				break;
			
			case 'unapproved':
				$where = " WHERE photo1_approve='UNAPPROVED' AND photo1!=''";
				break;
				
			case 'all':
				$where = " WHERE photo1!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForPhoto2($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE photo2_approve='APPROVED' AND photo2!=''";
				break;
			
			case 'unapproved':
				$where = " WHERE photo2_approve='UNAPPROVED' AND photo2!=''";
				break;
				
			case 'all':
				$where = " WHERE photo2!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForPhoto3($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE photo3_approve='APPROVED' AND photo3!=''";
				break;
			
			case 'unapproved':
				$where = " WHERE photo3_approve='UNAPPROVED' AND photo3!=''";
				break;
				
			case 'all':
				$where = " WHERE photo3!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForPhoto4($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE photo4_approve='APPROVED' AND photo4!=''";
				break;
			
			case 'unapproved':
				$where = " WHERE photo4_approve='UNAPPROVED' AND photo4!=''";
				break;
				
			case 'all':
				$where = " WHERE photo4!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForPhoto5($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE photo5_approve='APPROVED' AND photo5!=''";
				break;
			
			case 'unapproved':
				$where = " WHERE photo5_approve='UNAPPROVED' AND photo5!=''";
				break;
				
			case 'all':
				$where = " WHERE photo5!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForPhoto6($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE photo6_approve='APPROVED' AND photo6!=''";
				break;
			
			case 'unapproved':
				$where = " WHERE photo6_approve='UNAPPROVED' AND photo6!=''";
				break;
				
			case 'all':
				$where = " WHERE photo6!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForVideo($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE video_approval='APPROVED' or video_chk='APPROVED' AND (video!='' OR video_url!='')";	
				break;
			
			case 'unapproved':
				$where = " WHERE video_approval='UNAPPROVED' or video_chk='UNAPPROVED' AND (video!='' OR video_url!='')";
				break;
				
			case 'all':
				$where = " WHERE (video!='' OR video_url!='')";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	
	function getWhereClauseForHoro($status)
	{
		$where = "";
		switch($status)
		{
			case 'approved':
				$where = " WHERE hor_check='APPROVED' AND hor_photo!=''";	
				break;
			
			case 'unapproved':
				$where = " WHERE hor_check='UNAPPROVED' AND hor_photo!=''";
				break;
				
			case 'all':
				$where = " WHERE hor_photo!=''";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	

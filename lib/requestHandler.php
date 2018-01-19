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
							$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
								
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
				case 'FORGET':
							$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
								
							if($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
							{
								$STATUS_MESSAGE = "Password Sent to your Email-ID successfully.";
								$statusObj->setActionSuccess(true);
								$statusObj->setStatusMessage($STATUS_MESSAGE);							}
							else
							{
								$STATUS_MESSAGE = "Password is not Sent to your Email-ID, Please try again!";
								$statusObj->setActionSuccess(false);
								$statusObj->setStatusMessage($STATUS_MESSAGE);								
							}											
							break;
				case 'SEARCH':
							$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
							if($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
							{
								$STATUS_MESSAGE = "Password Sent to your Email-ID successfully.";
								$statusObj->setActionSuccess(true);
								$statusObj->setStatusMessage($STATUS_MESSAGE);							}
							else
							{
								$STATUS_MESSAGE = "Password is not Sent to your Email-ID, Please try again!";
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
				$where = " WHERE STATUS='APPROVED'";	
				break;
			
			case 'unapproved':
				$where = " WHERE STATUS='UNAPPROVED'";
				break;
			
			case 'all':
				$where = "";
				break;
			default:
				$where = "";
			
		}
		return $where;
	}
	function getWhereClauseForProp($purpose,$status)
	{
		$where = "";
		
		switch($purpose)
		{
			case 'Sell':
				$where = " WHERE PURPOSE='SELL' and ";	
				break;
			
			case 'Rent':
				$where = " WHERE PURPOSE='RENT' and ";
				break;
			
			case 'Pg':
				$where = " WHERE PURPOSE='P.G.' and ";
				break;
			
			case 'Lease':
				$where = " WHERE PURPOSE='LEASE' and ";
				break;
			
			case 'Buy-Requirement':
				$where = " WHERE PURPOSE='BUY' and ";
				break;

			case 'Rent-Requirement':
				$where = " WHERE PURPOSE='RENT' and ";
				break;

			case 'PG-Requirement':
				$where = " WHERE PURPOSE='P.G.' and ";
				break;			
			
			case 'Lease-Requirement':
				$where = " WHERE PURPOSE='LEASE' and ";
				break;
			
			case 'Builder':
				$where = " WHERE ROLE_NAME='Builder' and IS_FEATURED=1 and";
				break;
			case 'Dealer':
				$where = " WHERE ROLE_NAME='Dealer' and  IS_FEATURED=1 and";
				break;
			case 'Financeir':
				$where = " WHERE ROLE_NAME='Financer' and  IS_FEATURED=1 and";
				break;
			default:
				$where = "";
			
		}
		switch($status)
		{
			case 'approved':
				if(empty($where)){
				  $where.= "  WHERE STATUS='APPROVED'";			
				}else{
				  $where.= "  STATUS='APPROVED' ";		
				}
				
				break;
			
			case 'unapproved':
				if(empty($where)){
				  $where.= "  WHERE STATUS='UNAPPROVED' ";			
				}else{
				  $where.= "  STATUS='UNAPPROVED' ";
				}
				
				break;
			
			case 'all':
			       if(!empty($where)){
				  $where = substr($where, 0, -4);
				}else{
				  $where.= " ";
				}				
				
				
				break;

			
			default:
				
			
		}
		return $where;
	}	
	
	function getWhereClauseForUser($role_id,$status)
	{
		$where = "";
		
		if(!empty($role_id))
		{
	           $where = "WHERE ROLE_ID=".$role_id." and ";		
		}
		switch($status)
		{
			case 'approved':
				if(empty($where)){
				  $where.= "  WHERE STATUS='APPROVED'";			
				}else{
				  $where.= "  STATUS='APPROVED' ";		
				}
				
				break;
			
			case 'unapproved':
				if(empty($where)){
				  $where.= "  WHERE STATUS='UNAPPROVED' ";			
				}else{
				  $where.= "  STATUS='UNAPPROVED' ";
				}
				
				break;
			
			case 'all':
			       if(!empty($where)){
				  $where = substr($where, 0, -4);
				}else{
				  $where.= " ";
				}				
				
				
				break;

			
			default:
				
			
		}
		return $where;
	}
	
	function getWhereClauseForFeaturedUser($role_id,$status)
	{
		$where = "";
		
		if(!empty($role_id))
		{
	           $where = "WHERE ROLE_ID=".$role_id." and IS_FEATURED=1 and ";		
		}
		switch($status)
		{
			case 'approved':
				if(empty($where)){
				  $where.= "  WHERE STATUS='APPROVED'";			
				}else{
				  $where.= "  STATUS='APPROVED' ";		
				}
				
				break;
			
			case 'unapproved':
				if(empty($where)){
				  $where.= "  WHERE STATUS='UNAPPROVED' ";			
				}else{
				  $where.= "  STATUS='UNAPPROVED' ";
				}
				
				break;
			
			case 'all':
			       if(!empty($where)){
				  $where = substr($where, 0, -4);
				}else{
				  $where.= " ";
				}				
				
				
				break;

			
			default:
				
			
		}
		return $where;
	}		

?>
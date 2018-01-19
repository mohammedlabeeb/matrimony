<?php
class Religion extends DatabaseConn
{
	private $_religionId;
	private $_religionName;
	private $_religionStatus;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($religionId = null)
	{
		parent::__construct();
		
		if(!empty($religionId) && is_numeric($religionId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from religion where religion_id=$religionId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_religionId= $dbRow->religion_id;
			       $this->_religionName = $dbRow->religion_name;
			       $this->_religionStatus =  $dbRow->status;
	
		       }
		}else{
		
			       $this->_depositMethodId= "";
			       $this->_depMethodName = "";
			       $this->_depMethodURL =  "";
	
		}
	}
	public  function getAllReligion()
	{
		$dbResult=$this->getSelectQueryResult("select * from religion");
		$religionObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$religion = new Religion();
			$religion->setReligionId($dbRow->religion_id);
			$religion->setReligionName($dbRow->religion_name);
			$religion->setReligionStatus($dbRow->status);

			$religionObjArr[]=$religion;
			$arrCount++;
		}
		return $religionObjArr;							
		
	}
			
	
	public function setReligionId( $religionId )
	{
		$this->_religionId = $religionId;
	}
	
	public function setReligionName( $religionName )
	{
		$this->_religionName = $religionName;
	}
	
	public function setReligionStatus( $religionStatus )
	{
		$this->_religionStatus = $religionStatus;
	}
	
	public function getReligionId()
	{
		return $this->_religionId;
	}
	
	public function getReligionName()
	{
		return $this->_religionName;
	}
	
	public function getReligionStatus()
	{
		return $this->_religionStatus;
	}			
}
?>
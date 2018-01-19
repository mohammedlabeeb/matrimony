<?php
include_once 'Religion.class.php';

class Caste extends Religion
{
	private $_casteId;
	private $_casteName;
	private $_casteStatus;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($casteId = null)
	{
		parent::__construct();
		
		if(!empty($casteId) && is_numeric($casteId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from caste_view where caste_id=$casteId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_casteId= $dbRow->caste_id;
			       $this->_casteName = $dbRow->caste_name;
			       $this->_casteStatus =  $dbRow->status;
			       $this->setReligionName($dbRow->religion_name);
			       $this->setReligionId($dbRow->religion_id);
	
		       }
		}else{
		
			       $this->_casteId= "";
			       $this->_casteName = "";
			       $this->_casteStatus =  "";

	
		}
	}
	public function getAllCasteByReligion($religionId)
	{
		$dbResult=$this->getSelectQueryResult("select * from caste_view where religion_id=".$religionId);
		$casteObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$caste = new Caste();
			$caste->setCasteId($dbRow->caste_id);
			$caste->setCasteName($dbRow->caste_name);								
			$caste->setCasteStatus($dbRow->status);
			$caste->setReligionId($dbRow->religion_id);
			$caste->setReligionName($dbRow->religion_name);
			$casteObjArr[]=$caste;
			$arrCount++;
		}
		return $casteObjArr;					
	}
	
	public function setCasteId( $casteId )
	{
		$this->_casteId = $casteId;
	}
	
	public function setCasteName( $casteName )
	{
		$this->_casteName = $casteName;
	}
	
	public function setCasteStatus( $casteStatus )
	{
		$this->_casteStatus = $casteStatus;
	}
	
	public function getCasteId()
	{
		return $this->_casteId;
	}
	
	public function getCasteName()
	{
		return $this->_casteName;
	}
	
	public function getCasteStatus()
	{
		return $this->_casteStatus;
	}			
}
?>
<?php
include_once 'Country.class.php';

class State extends Country
{
	private $_stateId;
	private $_stateName;
	private $_stateStatus;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($stateId = null)
	{
		parent::__construct();
		
		if(!empty($stateId) && is_numeric($stateId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from state where STATE_ID=$stateId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_stateId= $dbRow->STATE_ID;
			       $this->_stateName = $dbRow->STATE_NAME;
			       $this->_stateStatus =  $dbRow->STATUS;
	
		       }
		}else{
		
			$this->_stateId= "";
			$this->_stateName = "";
			$this->_stateStatus =  "";

	
		}
	}
	public function getAllStateByCountry($countryId)
	{
		$dbResult=$this->getSelectQueryResult("select * from state_view where COUNTRY_ID=".$countryId);
		$stateObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$state = new State();
			$state->setStateStatus($dbRow->STATUS);
			$state->setStateId($dbRow->STATE_ID);
			$state->setStateName($dbRow->STATE_NAME);
			$state->setCountryId($dbRow->COUNTRY_ID);
			$state->setCountryName($dbRow->COUNTRY_NAME);
			$stateObjArr[]=$state;
			$arrCount++;
		}
		return $stateObjArr;					
	}			
	public function setStateId( $stateId )
	{
		$this->_stateId = $stateId;
	}
	
	public function setStateName( $stateName )
	{
		$this->_stateName = $stateName;
	}
	
	public function setStateStatus( $stateStatus )
	{
		$this->_stateStatus = $stateStatus;
	}
	
	public function getStateId()
	{
		return $this->_stateId;
	}
	
	public function getStateName()
	{
		return $this->_stateName;
	}
	
	public function getStateStatus()
	{
		return $this->_stateStatus;
	}			
}
?>
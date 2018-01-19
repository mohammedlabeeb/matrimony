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
		       $dbResult=$this->getSelectQueryResult("select * from state where state_id=$stateId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_stateId= $dbRow->state_id;
			       $this->_stateName = $dbRow->state_name;
			       $this->_stateStatus =  $dbRow->status;
	
		       }
		}else{
		
			$this->_stateId= "";
			$this->_stateName = "";
			$this->_stateStatus =  "";

	
		}
	}
	public function getAllStateByCountry($countryId)
	{
		$dbResult=$this->getSelectQueryResult("select * from state_view where country_id=".$countryId);
		$stateObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$state = new State();
			$state->setStateStatus($dbRow->status);
			$state->setStateId($dbRow->state_id);
			$state->setStateName($dbRow->state_name);
			$state->setCountryId($dbRow->country_id);
			$state->setCountryName($dbRow->country_name);
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
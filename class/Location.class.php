<?php
include_once 'City.class.php';

class Location extends City
{
	private $_locationId;
	private $_locationName;
	private $_locationStatus;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($locationId = null)
	{
		parent::__construct();
		
		if(!empty($locationId) && is_numeric($locationId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from locality_view where LOCALITY_ID=$locationId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_locationId= $dbRow->LOCALITY_ID;
			       $this->_locationName = $dbRow->LOCALITY_NAME;
			       $this->_locationStatus =  $dbRow->STATUS;
			       $this->setCityId($dbRow->CITY_ID);
			       $this->setCityName($dbRow->CITY_NAME);
			       $this->setStateName($dbRow->STATE_NAME);
			       $this->setCountryName($dbRow->COUNTRY_NAME);
			       $this->setStateId($dbRow->STATE_ID);
			       $this->setCountryId($dbRow->COUNTRY_ID);
	
		       }
		}else{
		
			       $this->_locationId= "";
			       $this->_locationName = "";
			       $this->_locationStatus =  "";

	
		}
	}
	public function getAllLocationByState($cityId)
	{
		$dbResult=$this->getSelectQueryResult("select * from location_view where CITY_ID=".$cityId);
		$locationObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$location = new Location();
			$location->setLocationId($dbRow->LOCATION_ID);
			$location->setLocationName($dbRow->LOCATION_NAME);								
			$location->setLocationStatus($dbRow->STATUS);
			$location->setCityId($dbRow->CITY_ID);
			$location->setCityName($dbRow->CITY_NAME);                        
			$location->setStateId($dbRow->STATE_ID);
			$location->setStateName($dbRow->STATE_NAME);
			$location->setCountryId($dbRow->COUNTRY_ID);
			$location->setCountryName($dbRow->COUNTRY_NAME);
			$locationObjArr[]=$location;
			$arrCount++;
		}
		return $locationObjArr;					
	}
	public function setLocationId( $locationId )
	{
		$this->_locationId = $locationId;
	}
	
	public function setLocationName( $locationName )
	{
		$this->_locationName = $locationName;
	}
	
	public function setLocationStatus( $locationStatus )
	{
		$this->_locationStatus = $locationStatus;
	}
	
	public function getLocationId()
	{
		return $this->_locationId;
	}
	
	public function getLocationName()
	{
		return $this->_locationName;
	}
	
	public function getLocationStatus()
	{
		return $this->_locationStatus;
	}			
}
?>
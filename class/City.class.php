<?php
include_once 'State.class.php';

class City extends State
{
	private $_cityId;
	private $_cityName;
	private $_cityStatus;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($cityId = null)
	{
		parent::__construct();
		
		if(!empty($cityId) && is_numeric($cityId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from city_view where city_id=$cityId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_cityId= $dbRow->city_id;
			       $this->_cityName = $dbRow->city_name;
			       $this->_cityStatus =  $dbRow->status;
			       $this->setStateName($dbRow->state_name);
			       $this->setCountryName($dbRow->country_name);
			       $this->setStateId($dbRow->state_id);
			       $this->setCountryId($dbRow->country_id);
	
		       }
		}else{
		
			       $this->_cityId= "";
			       $this->_cityName = "";
			       $this->_cityStatus =  "";

	
		}
	}
	public function getAllCityByState($stateId)
	{
		$dbResult=$this->getSelectQueryResult("select * from city_view where state_id=".$stateId);
		$cityObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$city = new City();
			$city->setCityId($dbRow->city_id);
			$city->setCityName($dbRow->city_name);								
			$city->setCityStatus($dbRow->status);
			$city->setStateId($dbRow->state_id);
			$city->setStateName($dbRow->state_name);
			$city->setCountryId($dbRow->country_id);
			$city->setCountryName($dbRow->country_name);
			$cityObjArr[]=$city;
			$arrCount++;
		}
		return $cityObjArr;					
	}
	public function getAllCityByCountry($countryId)
	{
		$dbResult=$this->getSelectQueryResult("select * from city_view where country_id=".$countryId);
		$cityObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$city = new City();
			$city->setCityId($dbRow->city_id);
			$city->setCityName($dbRow->city_name);								
			$city->setCityStatus($dbRow->status);
			$city->setStateId($dbRow->state_id);
			$city->setStateName($dbRow->state_name);
			$city->setCountryId($dbRow->country_id);
			$city->setCountryName($dbRow->country_name);
			$cityObjArr[]=$city;
			$arrCount++;
		}
		return $cityObjArr;					
	}	
	public function setCityId( $cityId )
	{
		$this->_cityId = $cityId;
	}
	
	public function setCityName( $cityName )
	{
		$this->_cityName = $cityName;
	}
	
	public function setCityStatus( $cityStatus )
	{
		$this->_cityStatus = $cityStatus;
	}
	
	public function getCityId()
	{
		return $this->_cityId;
	}
	
	public function getCityName()
	{
		return $this->_cityName;
	}
	
	public function getCityStatus()
	{
		return $this->_cityStatus;
	}			
}
?>
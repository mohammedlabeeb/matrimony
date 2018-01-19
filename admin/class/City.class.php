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
		       $dbResult=$this->getSelectQueryResult("select * from city_view where CITY_ID=$cityId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_cityId= $dbRow->CITY_ID;
			       $this->_cityName = $dbRow->CITY_NAME;
			       $this->_cityStatus =  $dbRow->STATUS;
			       $this->setStateName($dbRow->STATE_NAME);
			       $this->setCountryName($dbRow->COUNTRY_NAME);
			       $this->setStateId($dbRow->STATE_ID);
			       $this->setCountryId($dbRow->COUNTRY_ID);
	
		       }
		}else{
		
			       $this->_cityId= "";
			       $this->_cityName = "";
			       $this->_cityStatus =  "";

	
		}
	}
	public function getAllCityByState($stateId)
	{
		$dbResult=$this->getSelectQueryResult("select * from city_view where STATE_ID=".$stateId);
		$cityObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$city = new City();
			$city->setCityId($dbRow->CITY_ID);
			$city->setCityName($dbRow->CITY_NAME);								
			$city->setCityStatus($dbRow->STATUS);
			$city->setStateId($dbRow->STATE_ID);
			$city->setStateName($dbRow->STATE_NAME);
			$city->setCountryId($dbRow->COUNTRY_ID);
			$city->setCountryName($dbRow->COUNTRY_NAME);
			$cityObjArr[]=$city;
			$arrCount++;
		}
		return $cityObjArr;					
	}
	public function getAllCityByCountry($countryId)
	{
		$dbResult=$this->getSelectQueryResult("select * from city_view where COUNTRY_ID=".$countryId);
		$cityObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$city = new City();
			$city->setCityId($dbRow->CITY_ID);
			$city->setCityName($dbRow->CITY_NAME);								
			$city->setCityStatus($dbRow->STATUS);
			$city->setStateId($dbRow->STATE_ID);
			$city->setStateName($dbRow->STATE_NAME);
			$city->setCountryId($dbRow->COUNTRY_ID);
			$city->setCountryName($dbRow->COUNTRY_NAME);
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
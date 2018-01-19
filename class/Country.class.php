<?php
class Country extends DatabaseConn
{
	private $_countryId;
	private $_countryName;
	private $_countryStatus;
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($countryId = null)
	{
		parent::__construct();
		
		if(!empty($countryId) && is_numeric($countryId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from country where country_id=$countryId");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_countryId= $dbRow->country_id;
			       $this->_countryName = $dbRow->country_name;
			       $this->_countryStatus =  $dbRow->status;
	
		       }
		}else{
		
			       $this->_depositMethodId= "";
			       $this->_depMethodName = "";
			       $this->_depMethodURL =  "";
	
		}
	}
	public  function getAllCountries()
	{
		$dbResult=$this->getSelectQueryResult("select * from country");
		$countryObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
			$country = new Country();
			$country->setCountryId($dbRow->country_id);
			$country->setCountryName($dbRow->country_name);
			$country->setCountryStatus($dbRow->status);

			$countryObjArr[]=$country;
			$arrCount++;
		}
		return $countryObjArr;							
		
	}
			
	
	public function setCountryId( $countryId )
	{
		$this->_countryId = $countryId;
	}
	
	public function setCountryName( $countryName )
	{
		$this->_countryName = $countryName;
	}
	
	public function setCountryStatus( $countryStatus )
	{
		$this->_countryStatus = $countryStatus;
	}
	
	public function getCountryId()
	{
		return $this->_countryId;
	}
	
	public function getCountryName()
	{
		return $this->_countryName;
	}
	
	public function getCountryStatus()
	{
		return $this->_countryStatus;
	}			
}
?>
<?php
class Config extends DatabaseConn
{
	private $_configId;
	private $_configName;
	private $_configFname;
	private $_configLogo;
	private $_configContactno;
	private $_configTitle;
	private $_configDescription;
	private $_configKeyword;
	private $_configFevicon;
	private $_configGoogle;
	private $_configFooter;
	private $_configFrom;
	private $_configTo;
	private $_configFeedback;
	private $_configContact;
	private $_configWatermark;
	private $_configLine1;
	private $_configLine2;
	private $_configLine3;
	
	/**
	* Constructor for class Expect expId as arg
	* 
	* Enter description here ...
	* @param unknown_type $expId
	*/
	public function __construct($configId = null)
	{
		parent::__construct();
		$configId = '1';
		if(!empty($configId) && is_numeric($configId))
		{
			       /*
				       proceed to get data for given bonus id
			       */
		       $dbResult=$this->getSelectQueryResult("select * from site_config where id='1'");
		       while($dbRow=mysql_fetch_object($dbResult))
		       {
		
			       $this->_configId= $dbRow->id;
				$this->_configName = $dbRow->web_name;
			       
				   $this->_configFname =  $dbRow->web_frienly_name;
				   $this->_configLogo =  $dbRow->web_logo_path;
				   $this->_configContactno =  $dbRow->contact_no;
				   $this->_configTitle =  $dbRow->title;
				   $this->_configDescription =  $dbRow->description;
				   $this->_configKeyword =  $dbRow->keywords;
				   
				   $this->_configFevicon =  $dbRow->favicon;
				   $this->_configGoogle =  $dbRow->google_analytics_code;
				   $this->_configFooter =  $dbRow->footer;
				   $this->_configFrom =  $dbRow->from_email;
				   $this->_configTo =  $dbRow->to_email;
				   $this->_configFeedback =  $dbRow->feedback_email;
				   $this->_configContact =  $dbRow->contact_email;		  
				   $this->_configWatermark =  $dbRow->watermark;
				   $this->_configLine1 =  $dbRow->top_line1;
				   $this->_configLine2 =  $dbRow->top_line2;
				   $this->_configLine3 =  $dbRow->top_line3;
				  	
		       }
		}else
		{
		
			      $this->_configId= "";
			       $this->_configName = "";
			       $this->_configFname =  "";
				   
				   $this->_configLogo =  "";
				   $this->_configContactno =  "";
				   $this->_configTitle =  "";
				   $this->_configDescription =  "";
				   $this->_configKeyword =  "";
				   
				   $this->_configFevicon =  "";
				   $this->_configGoogle =  "";
				   $this->_configFooter =  "";
				  
				   $this->_configFrom =  "";
				   $this->_configTo =  "";
				   $this->_configFeedback =  "";
				   
				   $this->_configContact =  "";
				 
				   $this->_configWatermark =  "";
				   
				 
				   $this->_configLine1 =  "";
				   $this->_configLine2 =  "";
				   $this->_configLine3 =  "";
				   
	
		}
	}
	public function getAllConfig()
	{
		$dbResult=$this->getSelectQueryResult("select * from site_config where id='1'");
		$configObjArr= array();
		$arrCount=0;
		
		while($dbRow=mysql_fetch_object($dbResult))
		{
					$config = new Config();
			
				   $config->setConfigId($dbRow->id);
			       $config->setConfigName($dbRow->web_name);
			       $config->setConfigFname($dbRow->web_frienly_name);
				   
				   $config->setConfigLogo($dbRow->web_logo_path);
				   $config->setConfigContactno($dbRow->contact_no);
				   $config->setConfigTitle($dbRow->title);
				   $config->setConfigDescription($dbRow->description);
				   $config->setConfigKeyword($dbRow->keywords);
				   
				   $config->setConfigFevicon($dbRow->favicon);
				   $config->setConfigGoogle($dbRow->google_analytics_code);
				   $config->setConfigFooter($dbRow->footer);
				  
				   $config->setConfigFrom($dbRow->from_email);
				   $config->setConfigTo($dbRow->to_email);
				   $config->setConfigFeedback($dbRow->feedback_email);
				   
				   $config->setConfigContact($dbRow->contact_email);
				   $config->setConfigWatermark($dbRow->watermark);
				   $config->setConfigLine1($dbRow->top_line1);
				   $config->setConfigLine2($dbRow->top_line2);
				   $config->setConfigLine3($dbRow->top_line3);
				  			   

			$configObjArr[]=$config;
			$arrCount++;
		}
		return $configObjArr;							
	}
	public function setConfigId( $configId )
	{
		$this->_configId = $configId;
	}
	public function setConfigName( $configName )
	{
		$this->_configName = $configName;
	}
	public function setConfigFname( $configFname )
	{
		$this->_configFname = $configFname;
	}
	public function setConfigLogo( $configLogo )
	{
		$this->_configLogo = $configFname;
	}
	public function setConfigContactno( $configContactno )
	{
		$this->_configContactno = $configContactno;
	}
	
	public function setConfigTitle( $configTitle )
	{
		$this->_configTitle = $configTitle;
	}
	public function setConfigDescription( $configDescription )
	{
		$this->_configDescription = $configDescription;
	}
	public function setConfigKeyword( $configKeyword )
	{
		$this->_configKeyword = $configKeyword;
	}
	public function setConfigFevicon( $configFevicon )
	{
		$this->_configFevicon = $configFevicon;
	}
	public function setConfigGoogle( $configGoogle )
	{
		$this->_configGoogle = $configGoogle;
	}
	public function setConfigFooter( $configFooter )
	{
		$this->_configFooter = $configFooter;
	}
	
	public function setConfigFrom( $configFrom )
	{
		$this->_configFrom = $configFrom;
	}
	public function setConfigTo( $configTo )
	{
		$this->_configTo = $configTo;
	}
	public function setConfigFeedback( $configFeedback )
	{
		$this->_configFeedback = $configFeedback;
	}
	public function setConfigContact( $configContact )
	{
		$this->_configContact = $configContact;
	}
	
	public function setConfigWatermark( $configWatermark )
	{
		$this->_configWatermark = $configWatermark;
	}
	
	public function setConfigLine1( $configLine1 )
	{
		$this->_configLine1 = $configLine1;
	}
	public function setConfigLine2( $configLine2 )
	{
		$this->_configLine2 = $configLine2;
	}
	public function setConfigLine3( $configLine3 )
	{
		$this->_configLine3 = $configLine3;
	}
	
	
	
	
	
	public function getConfigId()
	{
		return $this->_configId;
	}
	public function getConfigName()
	{
		return $this->_configName;
	}
	public function getConfigFname()
	{
		return $this->_configFname;
	}
	public function getConfigLogo()
	{
		return $this->_configLogo;
	}
	public function getConfigContactno()
	{
		return $this->_configContactno;
	}
	public function getConfigTitle()
	{
		return $this->_configTitle ;
	}
	public function getConfigDescription()
	{
		return $this->_configDescription ;
	}
	public function getConfigKeyword()
	{
		return $this->_configKeyword ;
	}
	public function getConfigFevicon()
	{
		return $this->_configFevicon ;
	}
	public function getConfigGoogle()
	{
		return $this->_configGoogle ;
	}
	public function getConfigFooter()
	{
		return $this->_configFooter ;
	}
	
	public function getConfigFrom()
	{
		return $this->_configFrom;
	}
	public function getConfigTo()
	{
		return $this->_configTo;
	}
	public function getConfigFeedback()
	{
		return $this->_configFeedback;
	}
	public function getConfigContact()
	{
		return $this->_configContact;
	}
	
	
	public function getConfigWatermark()
	{
		return $this->_configWatermark;
	}
	
	public function getConfigLine1()
	{
		return $this->_configLine1;
	}
	public function getConfigLine2()
	{
		return $this->_configLine2;
	}
	public function getConfigLine3()
	{
		return $this->_configLine3;
	}
	
	
}
?>
<?php
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();		
?>
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $configObj->getConfigFname(); ?></title>        
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
        <link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="css/newstyle.css" />
    </head>
    <body>		
        
                    <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
                       <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php">Search</a></li>
                        <li class="active">Advanced Search</li>
                      </ol>
                       <div class="row">
                           
                           <div class="col-xs-12 col-sm-9 col-xs-12 col-sm-push-3">
                             <div class="panel panel-warning">
                               <div class="panel-heading"> <h3 class="panel-title">Advance Search By Criteria</h3>  </div>
                               <div class="panel-body">
                                   
                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="panel panel-success">
                                                <div class="panel-body hover">                                                    
                                                    <div class="col-md-4">
                                                    <a href="basic-search.php">
                                                    <img src="images/search.png" class="img-small" /></div>
                                                        <div class="col-md-8">
                                                            <p class="search-tag">Find By Simple Search</p>
                                                            <p>Find your partner by your prefered Location you want</p>
                                                        </div>  
                                                        </a>                                        
                                                </div>
                                            </div>
                                       </div>                                       
                                       <div class="col-sm-6">
                                            <div class="panel panel-success">
                                                <div class="panel-body hover">  
                                                                                        
                                                    <div class="col-sm-4">
                                                      <a href="advanced-search.php">
                                                    <img src="images/advance_search.png" class="img-small" /></div>
                                                    <div class="col-sm-8">
                                                        <p class="search-tag">Find By Advance Search</p>
                                                            <p>Find your partner by your prefered Location you want</p>
                                                    </div>  
                                                    </a>                                        
                                                </div>
                                            </div>
                                       </div>
                                         </div>
                                   
                                   
                                   
                                   <div class="row">
                                       <div class="col-md-6">
                                            <div class="panel panel-success">
                                                <div class="panel-body hover">                                                    
                                                    <div class="col-md-4">
                                                    <a href="keyword-search.php">
                                                    <img src="images/keywords.png" class="img-small" /></div>
                                                        <div class="col-md-8">
                                                            <p class="search-tag">Find Partner By Keyword</p>
                                                            <p>Find your partner by your prefered Location you want</p>
                                                        </div> 
                                                        </a>                                         
                                                </div>
                                            </div>
                                       </div>                                       
                                       <div class="col-sm-6">
                                            <div class="panel panel-success">
                                                <div class="panel-body hover">                                           
                                                    <div class="col-sm-4">
                                                     <a href="education-search.php">
                                                    <img src="images/education.png" class="img-small" /></div>
                                                    <div class="col-sm-8">
                                                        <p class="search-tag">Find Partner By Education</p>
                                                            <p>Find your partner by your prefered Location you want</p>
                                                    </div>  
                                                    </a>                                        
                                                </div>
                                            </div>
                                       </div>                                       
                                   </div>
                                   
                                   <div class="row">
                                       <div class="col-md-6">
                                            <div class="panel panel-success">
                                                <div class="panel-body hover">                                                    
                                                    <div class="col-md-4">
                                                     <a href="occupation-search.php">
                                                    <img src="images/occpation.png" class="img-small" /></div>
                                                        <div class="col-md-8">
                                                            <p class="search-tag">Find Partner By Occupation</p>
                                                            <p>Find your partner by your prefered Location you want</p>
                                                        </div> 
                                                        </a>                                         
                                                </div>
                                            </div>
                                       </div>                                       
                                       <div class="col-md-6">
                                            <div class="panel panel-success">
                                                <div class="panel-body hover">                                                    
                                                    <div class="col-md-4">
                                                     <a href="location-search.php">
                                                    <img src="images/Location.png" class="img-small" /></div>
                                                        <div class="col-md-8">
                                                            <p class="search-tag">Find Partner By Location</p>
                                                            <p>Find your partner by your prefered Location you want</p>
                                                        </div>  
                                                        </a>                                        
                                                </div>
                                            </div>
                                       </div>                                       
                                   </div>
                               </div>
                             </div>
                           </div>
                           <div class="col-sm-3 col-xs-12 col-sm-pull-9">
						   <?php include 'advertise/add_three.php'; ?>
                           </div>
                       </div>	

           <!-----------------------top part end-------------------------->
           <?php include "page-part/footer.php";?>
           
        </div>
     </body>
        
        <script src="js/bootstrap-hover-dropdown.min.js"></script>
</html>
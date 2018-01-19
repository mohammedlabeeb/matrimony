                <?php
			error_reporting(0);
			include_once 'databaseConn.php';
			include_once 'lib/requestHandler.php';
			include_once './class/Config.class.php';
			$configObj = new Config();
			$DatabaseCo = new DatabaseConn();
			require_once("BusinessLogic/class.events.php");
			$ob=new event();
			$events=$ob->get_event();
			$tcount=mysql_num_rows($events);
                ?>
<!DOCTYPE>
<html>
<head>
<title><?php echo $configObj->getConfigFname(); ?></title>  
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">      
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcuticon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/common.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
</head>
<body>
<div class="event">
 <?php include "page-part/top-black.php";?>	
 </div>	
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?>
   
		<ol class="breadcrumb">
  			<li><a href="#">Home</a></li>
  			<li class="active">Events</li>
		</ol>
        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"> Upcoming Events </h3>
            </div>
            <div class="panel-body">
            <div class="col-xs-12">           
            <p><i class="glyphicon glyphicon-hand-right"></i>&nbsp; This is where we celebrate <?php echo $configObj->getConfigFname();?> Upcoming Events. This section is devoted to the innumerable <?php echo $configObj->getConfigFname();?> members who have found their soul-mates. Here's wishing them the very best for a happy and successful married life.
            </p>
             <?php
               if($tcount!=0)
              {
             ?>    
             <?php
			 while($event=mysql_fetch_array($events))
				{
			 ?>
	         <form method="post" name="event" action="event-details.php">
	            <p class="hr">
                  <img src="images/spacer.gif" alt="" />
                </p>
		      <div class="col-xs-12 col-sm-12 padding-left-right-zero-small">
                 
                    <img src="events-list/<?php echo $event['image']; ?>" class="img-circle col-xs-12 col-sm-2 img-responsive" />
                
                 <div class="col-sm-6 col-xs-12">
                 <p class="mb10px b large dif text-right">		 	
                    <b><?php echo $event['name']; ?></b> 
                       - <?php echo $event['event_date']; ?>
                       - <?php echo $event['event_time']; ?>
                 </p>
                 <p class="aj mb10px gray pull-right">
				     <?php echo $event['venue']; ?>
                 </p>
                 <div class="clearfix"></div>
                 <h3 class="pull-right">&#8377;
				    <?php echo $event['ticket']; ?>
                 </h3>
              </div> 
               <div class="rn_btn text-right col-sm-3">
                   <button type="submit" name="submit" class="col-xs-12 btn btn-success">
                     
                      Register Now
                     
                    </button>
                  <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>" />            
            
      	       </div>
               </div>
               <div class="clearfix "></div>
             </form> 
     
        <?php  } ?>   
                        <?php 
                         }
						 else
						 {
                                     
							?>
                           No Events Available 
                           <?php
						 }
						 ?>
           </div>
            
            </div>
            
       </div>
          <?php include 'advertise/add_full.php'; ?>
	<?php include "page-part/footer.php";?>
    <?php include "chat.php";?>
	
    </div>
 </body>

</html>

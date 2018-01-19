<?php
session_start();
include_once 'databaseConn.php';
include_once './lib/pagination.php';
include_once './lib/requestHandler.php';
include_once './class/City.class.php';


$DatabaseCo = new DatabaseConn();

$advertise_status = "";
if (isset($_GET['advertise_status'])) {
    $advertise_status = $_GET['advertise_status'];
    $_SESSION['advertise_status'] = $_GET['advertise_status'];
} else if (isset($_GET['page'])) {
    $advertise_status = $_SESSION['advertise_status'];
} else {
    $_SESSION['advertise_status'] = "all";
    $advertise_status = "all";
}
$purpose = "";
if(isset($_GET['purpose'])){
   $purpose = $_GET['purpose'];
   $_SESSION['purpose'] = $_GET['purpose'];	
}else{
   if(isset($_SESSION['purpose'])){
      $purpose = $_SESSION['purpose'];	
   }else{
     $purpose = "All-list";	
   }
}

$isPostBack = ($_SERVER["REQUEST_METHOD"] === "POST");
if ($isPostBack) {
    $ACTION = isset($_POST['action']) ? $_POST['action'] : "";
    if (isset($_POST['advertise_id'])) {
        $advertise_id_arr = $_POST['advertise_id'];
        $advertise_id_val = "(";
        foreach ($advertise_id_arr as $advertise_id) {
            $advertise_id_val .= $advertise_id . ",";
        }
        $advertise_id_val = substr($advertise_id_val, 0, -1);
        $advertise_id_val .=")";

        switch ($ACTION) {
            case 'DELETE':
                $SQL_STATEMENT = "delete from my_advertises where ADVERTISE_ID in " . $advertise_id_val;
                break;
            case 'APPROVED':
                $SQL_STATEMENT = "update my_advertises set STATUS='APPROVED' where ADVERTISE_ID in " . $advertise_id_val;
                break;
            case 'UNAPPROVED':
                $SQL_STATEMENT = "update my_advertises set STATUS='UNAPPROVED' where ADVERTISE_ID in " . $advertise_id_val;
                break;
            case 'FEATURED':
                $SQL_STATEMENT = "update my_advertises set IS_FEATURED=1 where ADVERTISE_ID in " . $advertise_id_val;
                break;
            case 'NOT_FEATURED':
                $SQL_STATEMENT = "update my_advertises set IS_FEATURED=0 where ADVERTISE_ID in " . $advertise_id_val;
                break;
        }

        $statusObj = handle_post_request("UPDATE", $SQL_STATEMENT, $DatabaseCo);
        $STATUS_MESSAGE = $statusObj->getStatusMessage();
    } else {
        $statusObj = new Status();
        $statusObj->setActionSuccess(false);
        $STATUS_MESSAGE = "Please select value to complete action.";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin | Advertise listing</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/styles.css" />

        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
        <script type="text/javascript" src="js/cookieapi.js"></script>
        <script type="text/javascript" src="js/util/redirection.js"></script>
        <!--[if IE ]>
        <link rel="stylesheet" type="text/css" href="css/ie.css">
        <![endif]-->
        <!--[if IE 9 ]>
        <link rel="stylesheet" type="text/css" href="css/ie9.css">
        <![endif]-->
        <script type="text/javascript">
            setPageContext("front-end-mgmt","advertise-list");
            $(document).ready(function ()
            {
     
                $("#approove" ).button().click(function(){
                    window.location = "advertise-list.php?advertise_status=approved&purpose=<?php echo $purpose; ?>";
                });
                $("#unapproove" ).button().click(function(){
                    window.location = "advertise-list.php?advertise_status=unapproved&purpose=<?php echo $purpose; ?>";
                });
                $("#all" ).button().click(function(){
                    window.location = "advertise-list.php?advertise_status=all&purpose=<?php echo $purpose; ?>";
                });
                registerRowSelect();
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php
            require_once('./page-part/header.php');
            ?>
            <!-- start content -->
            <div id="container" class="cf">
                <?php
                require_once('./page-part/left-menu.php');
                ?>
                <div class="widecolumn alignleft">
                    <div class="breadcum-wide"><a href="#" title="Properties">Advertising Compaign </a>/ <a href="#" title="Sell Listing">Advertise List</a></div>

                    <div class="listing-section">
                        <div class="member-list cf">
                            <a href="javascript:;" class="button" title="List <?php echo $purpose; ?>" onclick="window.location='advertise-list.php?purpose=<?php echo $purpose; ?>'"><img src="img/bgi/list-icon.png" alt=""/>List All Advertises</a>
                            <a href="javascript:;" class="button" title="Add New <?php echo $purpose; ?>" onclick="window.location='add-advertise.php?purpose=<?php echo $purpose; ?>'"><img src="img/bgi/add-icon.png" alt=""/>Add New Advertises</a>			
                            <div class="approval alignleft">

                                <input type="button" title="Approved <?php echo $purpose; ?> Requirement (10)"  id="approove" value="Approved (<?php echo getRowCount("select count(ADVERTISE_ID) from my_advertises ".getWhereClauseForProp($purpose,'approved'), $DatabaseCo); ?>)"/>+
                                <input type="button" title="Unapproved <?php echo $purpose; ?> Requirement (16)"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(ADVERTISE_ID) from my_advertises ".getWhereClauseForProp($purpose,'unapproved'), $DatabaseCo); ?>)"/>=
                                <input type="button" title="All <?php echo $purpose; ?> Requirement (16)"  id="all" value="All (<?php echo getRowCount("select count(ADVERTISE_ID) from my_advertises ".getWhereClauseForProp($purpose,'all'), $DatabaseCo); ?>)"/>
                            </div>		              
                        </div>
                    </div>

                    <div class="filter-section">
                        <form action="" method="">
                            <div class="rowElem">	
                                <label class="filter-label">Filter Field:</label>
                                <select class="comboBox">
                                    <option>Search By</option>
                                    <option>Requirement Category</option>
                                    <option>Requirement ID</option>
                                    <option>User Id</option>
                                </select>
                            </div>
                            <div class="rowElem">
                                <label class="filter-label">Operator:</label>
                                <select class="comboBox">
                                    <option>Operator</option>
                                    <option>Equals</option>
                                    <option>Graterthan</option>
                                    <option>Lessthan</option>
                                    <option>Between</option>

                                </select>
                            </div>   
                        </form>  
                        <label class="filter-label">Values:</label>
                        <input type="text" class="input-role filter-input placeholder_textbox" title="Enter Values here..." />
                        <button class="search-btn" title="Search"></button>

                    </div>	
                    <?php
                    if (!empty($STATUS_MESSAGE)) {
                        if ($statusObj->getActionSuccess()) {
                            echo "<div class='success-msg cf' id='success_msg'><h3>" . $STATUS_MESSAGE . "</h3>  </div>";
                        } else {
                            echo "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>" . $STATUS_MESSAGE . "</li></ul></div>";
                        }
                    }
                    ?>	
                    <div class="widecolumn-inner memership-detail">
                        <?php
                        $advertise_page_count = getRowCount("select count(ADVERTISE_ID) from my_advertises" .getWhereClauseForProp($purpose,$advertise_status), $DatabaseCo);
                        if ($advertise_page_count > 0) {
                            ?>	
                            <div class="nodata-avail ">
                                <h1><?php echo strtoupper($advertise_status) . " Advertise List"; ?></h1>
                            </div>                         
                            <div class="cf membership-data">
                                <div style="position: relative;top:8px;left:-3px;">
                                    <input type="checkbox" class="alignleft table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');" value="MASTER"/><span class="alignleft checkall"><b>Check All</b></span>
                                </div>                            
                                <a href="javascript:;" class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
                                <a href="javascript:;" class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
                                <a href="javascript:;" class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
                                <?php
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                
                                $page_size = isset($_COOKIE["advertise_page_count"]) ? $_COOKIE["advertise_page_count"] : 10;
                                $lim_str = getLimitForSqlState($current_page, $page_size);

                                $SQL_STATEMENT = "SELECT * FROM my_advertises" . getWhereClauseForProp($purpose,$advertise_status). "  LIMIT " . $lim_str;
                                ?>

                            </div>
                            <div class="table-desc cf">
                                <form method="post" action="advertise-list.php" id="action_form">
                                    <?php
                                    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
				
			//$a=$DatabaseCo->dbRow->USER_ID;
//			$SQL_STATEMENT2 = "SELECT * FROM users where USER_ID=".$a;
//			$DatabaseCo->dbResult1=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
//			$DatabaseCo->dbRow1 = mysql_fetch_object($DatabaseCo->dbResult1);
				 {
					$image_src = "./lib/viewImage.php?recid=".$DatabaseCo->dbRow->ADVERTISE_ID. "&key_name=ADVERTISE_ID&table_name=my_advertises";	
										
                                        ?>
                                        <div id="dialog<?php echo $DatabaseCo->dbRow->ADVERTISE_ID; ?>" class="cf dialog">
                                            <div class="profile-content">

<input type="checkbox" class="table-checkbox" name="advertise_id[]"  value="<?php echo $DatabaseCo->dbRow->ADVERTISE_ID; ?>" />
                                                <div class="profile-section">
                                                    <p class="cf">
              <img src="<?php echo $image_src;?>" title="" width="600px" height="50px"/>
                                                    </p>
                                                    <div class="property-detail cf">
                                                        <div class="first-detail-small">
                                                            <label class="detail-desc2 cf">
                                                                <label class="title-label">Contact Person:</label>
                                                                <label class="title-desc2">  
                                                                    <a href="javascript:;" title="Edit">
                                                                        <span title="Edit" class="floor-plan"><?php echo $DatabaseCo->dbRow->USER_ID;
// echo $DatabaseCo->dbRow->FIRST_NAME."&nbsp;".$DatabaseCo->dbRow1->LAST_NAME;?></span>
                                                                    </a></label>				  
                                                            </label>
                                                            <label class="detail-desc2 cf">
                                                                <label class="title-label">Tag:</label>
                                                                <label class="title-desc2">
                                                                    <?php echo $DatabaseCo->dbRow->TAG; ?>
                                                                </label>				  
                                                            </label>
                                                            <label class="detail-desc2 cf">
                                                                <label class="title-label">Link :</label>
                                <label class="title-desc2">
         <a href="<?php echo $DatabaseCo->dbRow->LINK; ?>" target="_blank"><?php echo $DatabaseCo->dbRow->LINK; ?></a>
                                                                </label>				  
                                                            </label>		  		  
                                                           	  		                                                              

                                                        </div>

                                                        <div class="second-detail-small">
							   <label class="detail-desc2 cf">
                                                                <label class="title-label">Posted Date :</label>
                                                                <label class="title-desc2">
                                                                    <?php echo $DatabaseCo->dbRow->POSTED_DATE; ?>
                                                                </label>				  
                                                            </label>		  		  
                                                            <label class="detail-desc2 cf">
                                                                <label class="title-label">Expiry Date :</label>
                                                                <label class="title-desc2">
                                                                    <?php echo $DatabaseCo->dbRow->EXPIRY_DATE; ?>
                                                                </label>				  
                                                            </label>	
                                                                     
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>
                                            <p class="clear"></p>					    
                                            <div class="profile-button cf">

                                                <a href="add-advertise.php?action=UPDATE&advertise_id=<?php echo $DatabaseCo->dbRow->ADVERTISE_ID; ?>" title="Edit">
                                                    <span title="Edit" class="floor-plan">Edit</span>
                                                </a>

                                                

                                            </div>                                          
                                            <span class="approve_feature">
                                                <span><b>Approval:</b>
                                                    <?php
                                                    $likeDisLikeCss = "";
                                                    if ($DatabaseCo->dbRow->STATUS == 'APPROVED')
                                                        $likeDisLikeCss = "approved";
                                                    else
                                                        $likeDisLikeCss = "unapproved";
                                                    ?>
                                <span class="<?php echo $likeDisLikeCss; ?>">&nbsp;</span>
                                                </span>


                                                
                                            </span>					    
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    <input  type="hidden" name="action" value="" id="action"/>
                                </form>
                                <?php
                                $SQL_STATEMENT_PAGINATION = "select count(ADVERTISE_ID) as 'total_rows' from  my_advertises" .getWhereClauseForProp($purpose,$advertise_status);
                                echo getNewPagination('advertise-list.php', 'advertise_page_count', 'my_advertises', 'ADVERTISE_ID', $page_size, $current_page, $SQL_STATEMENT_PAGINATION);
                                ?>      	
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="table-desc cf">
                                <div class="nodata-avail ">
                                    <h1>There are no data for <?php echo strtoupper($advertise_status) . " Advertise "; ?>  Listing. Please add data.</h1>
                                    <br/>
                                    <img src="img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <?php
                    require_once('./page-part/footer.php');
                    ?>
                </div>
            </div>
            <!-- end content -->
        </div>
    </body>
</html>

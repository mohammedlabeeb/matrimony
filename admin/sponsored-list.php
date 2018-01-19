<?php
session_start();
include_once 'databaseConn.php';
include_once './lib/pagination.php';
include_once './lib/requestHandler.php';
include_once './class/City.class.php';


$DatabaseCo = new DatabaseConn();

$sponsore_status = "";
if (isset($_GET['sponsore_status'])) {
    $sponsore_status = $_GET['sponsore_status'];
    $_SESSION['sponsore_status'] = $_GET['sponsore_status'];
} else if (isset($_GET['page'])) {
    $sponsore_status = $_SESSION['sponsore_status'];
} else {
    $_SESSION['sponsore_status'] = "all";
    $sponsore_status = "all";
}
$purpose = "";
if (isset($_GET['purpose'])) {
    $purpose = $_GET['purpose'];
    $_SESSION['purpose'] = $_GET['purpose'];
} else {
    if (isset($_SESSION['purpose'])) {
        $purpose = $_SESSION['purpose'];
    } else {
        $purpose = "All-list";
    }
}

$isPostBack = ($_SERVER["REQUEST_METHOD"] === "POST");
if ($isPostBack) {
    $ACTION = isset($_POST['action']) ? $_POST['action'] : "";
    if (isset($_POST['sponsore_id'])) {
        $sponsore_id_arr = $_POST['sponsore_id'];
        $sponsore_id_val = "(";
        foreach ($sponsore_id_arr as $sponsore_id) {
            $sponsore_id_val .= $sponsore_id . ",";
        }
        $sponsore_id_val = substr($sponsore_id_val, 0, -1);
        $sponsore_id_val .=")";

        switch ($ACTION) {
            case 'DELETE':
                $SQL_STATEMENT = "delete from sponsored_link where SPONSORED_LINK_ID in " . $sponsore_id_val;
                break;
            case 'APPROVED':
                $SQL_STATEMENT = "update sponsored_link set STATUS='APPROVED' where SPONSORED_LINK_ID in " . $sponsore_id_val;
                break;
            case 'UNAPPROVED':
                $SQL_STATEMENT = "update sponsored_link set STATUS='UNAPPROVED' where SPONSORED_LINK_ID in " . $sponsore_id_val;
                break;
            case 'FEATURED':
                $SQL_STATEMENT = "update sponsored_link set IS_FEATURED=1 where SPONSORED_LINK_ID in " . $sponsore_id_val;
                break;
            case 'NOT_FEATURED':
                $SQL_STATEMENT = "update sponsored_link set IS_FEATURED=0 where SPONSORED_LINK_ID in " . $sponsore_id_val;
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
        <title>Admin | sponsore listing</title>
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
                setPageContext("front-end-mgmt", "sponsored-list2");
                $(document).ready(function()
                {

                    $("#approove").button().click(function() {
                        window.location = "sponsored-list?sponsore_status=approved&purpose=<?php echo $purpose; ?>";
                    });
                    $("#unapproove").button().click(function() {
                        window.location = "sponsored-list.php?sponsore_status=unapproved&purpose=<?php echo $purpose; ?>";
                    });
                    $("#all").button().click(function() {
                        window.location = "sponsored-list.php?sponsore_status=all&purpose=<?php echo $purpose; ?>";
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
                    <div class="breadcum-wide"><a href="#" title="Properties">Advertising Compaign </a>/ <a href="#" title="Sell Listing"><?php echo $purpose; ?></a></div>

                    <div class="listing-section">
                        <div class="member-list cf">
                            <a href="javascript:;" class="button" title="List <?php echo $purpose; ?>" onclick="window.location = 'sponsored-list.php?purpose=<?php echo $purpose; ?>'"><img src="img/bgi/list-icon.png" alt=""/>List All <?php echo $purpose; ?></a>
                            <a href="javascript:;" class="button" title="Add New <?php echo $purpose; ?>" onclick="window.location = 'add-sponsored.php?purpose=<?php echo $purpose; ?>'"><img src="img/bgi/add-icon.png" alt=""/>Add New <?php echo $purpose; ?></a>			
                            <div class="approval alignleft">

                                <input type="button" title="Approved <?php echo $purpose; ?> Requirement (10)"  id="approove" value="Approved (<?php echo getRowCount("select count(SPONSORED_LINK_ID) from sponsored_link " . getWhereClauseForProp($purpose, 'approved'), $DatabaseCo); ?>)"/>+
                                <input type="button" title="Unapproved <?php echo $purpose; ?> Requirement (16)"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(SPONSORED_LINK_ID) from sponsored_link " . getWhereClauseForProp($purpose, 'unapproved'), $DatabaseCo); ?>)"/>=
                                <input type="button" title="All <?php echo $purpose; ?> Requirement (16)"  id="all" value="All (<?php echo getRowCount("select count(SPONSORED_LINK_ID) from sponsored_link " . getWhereClauseForProp($purpose, 'all'), $DatabaseCo); ?>)"/>
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
                        $sponsore_page_count = getRowCount("select count(SPONSORED_LINK_ID) from sponsored_link" . getWhereClauseForProp($purpose, $sponsore_status), $DatabaseCo);
                        if ($sponsore_page_count > 0) {
                            ?>	
                            <div class="nodata-avail ">
                                <h1><?php echo strtoupper($sponsore_status) . " " . strtoupper($purpose); ?></h1>
                            </div>                         
                            <div class="cf membership-data">
                                <div style="position: relative;top:8px;left:-3px;">
                                    <input type="checkbox" class="alignleft table-checkbox"  onclick="checkUncheck(this, '.table-checkbox');" value="MASTER"/><span class="alignleft checkall"><b>Check All</b></span>
                                </div>                            
                                <a href="javascript:;" class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
                                <a href="javascript:;" class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
                                <a href="javascript:;" class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
                                <?php
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                                $page_size = isset($_COOKIE["sponsore_page_count"]) ? $_COOKIE["sponsore_page_count"] : 10;
                                $lim_str = getLimitForSqlState($current_page, $page_size);

                                $SQL_STATEMENT = "SELECT * FROM sponsored_link" . getWhereClauseForProp($purpose, $sponsore_status) . " ORDER BY SPONSORED_LINK_ID DESC  LIMIT " . $lim_str;
                                ?>

                            </div>
                            <div class="table-desc cf">
                                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
                                    <tr>
                                        <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this, '.table-checkbox');"/></th>
                                        <th width="7%">Edit</th>
                                        <th width="5%">Status</th>
                                        <th width="5%">ID</th>
                                        <th width="20%">Title</th>
                                        <th width="30%">Short Detail</th>
                                        <th width="20%">Link</th>
                                    </tr>
                                    <form method="post" action="sponsored-list.php" id="action_form">
                                        <?php
                                        $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                        $rowCount = 0;
                                        while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) {
                                            if ($rowCount % 2 != 0)
                                                $cssClass = "odd";
                                            else
                                                $cssClass = "even";
                                            $rec_not_found = false;
                                            ?>
                                            <tr class="<?php echo $cssClass; ?>">
                                                <td><input type="checkbox"  class="table-checkbox" name="sponsore_id[]" value="<?php echo $DatabaseCo->dbRow->SPONSORED_LINK_ID; ?>" /></td>
                                                <td>  <a class="edit-btn margin-none" href="add-sponsored.php?action=UPDATE&sponsore_id=<?php echo $DatabaseCo->dbRow->SPONSORED_LINK_ID; ?>" title="Edit">Edit</a></td>
                                                <td><?php
                                    $likeDisLikeCss = "";
                                    if ($DatabaseCo->dbRow->STATUS == "APPROVED")
                                        $likeDisLikeCss = "like-icon";
                                    else
                                        $likeDisLikeCss = "dislike-icon";
                                            ?>
                                                    <a href="#" class="<?php echo $likeDisLikeCss; ?>"></a></td>
                                                <td ><?php echo $DatabaseCo->dbRow->SPONSORED_LINK_ID; ?></td>
                                                <td ><?php echo $DatabaseCo->dbRow->LINK_TITLE; ?></td>
                                                <td ><?php echo $DatabaseCo->dbRow->SHORT_DETAIL; ?></td>
                                                <td ><?php echo $DatabaseCo->dbRow->LINK; ?></td>

                                            </tr>
        <?php
        $rowCount++;
    }
    ?>
                                        <input  type="hidden" name="action" value="" id="action"/>
                                    </form>

                                </table>
    <?php
    $SQL_STATEMENT_PAGINATION = "select count(SPONSORED_LINK_ID) as 'total_rows' from  sponsored_link" . getWhereClauseForProp($purpose, $sponsore_status);
    echo getNewPagination('sponsore-list.php', 'sponsore_page_count', 'sponsored_link', 'sponsore_id', $page_size, $current_page, $SQL_STATEMENT_PAGINATION);
    ?>      	
                            </div>
                                <?php
                            } else {
                                ?>
                            <div class="table-desc cf">
                                <div class="nodata-avail ">
                                    <h1>There are no data for <?php echo strtoupper($sponsore_status) . " " . strtoupper($purpose); ?>  Listing. Please add data.</h1>
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

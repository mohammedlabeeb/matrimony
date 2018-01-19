<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Database Checkup</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

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
      <div class="breadcum-wide"><a title="Database Checkup">Database Checkup</a></div>
      <div class="listing-section">
        <div class="member-list cf">
         
          <a href="javascript:;" class="button" title="Database Checkup"  onclick="window.location='db-checkup.php'"><img src="img/bgi/add-icon.png" alt="Add"/>Go Back</a>
        </div>
      </div>
      <div style="overflow: auto; width:1000px; height:700px; background-color:white;">
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="5">
            <tr>
              <td class="red_text">
			  <?php
$strquery = $_POST['query'];
if (empty($strquery)) 
{
echo "<h4>Blank Submission.Please, Enter Mysql Query For Results</h4>";

}
else
{
        $select = mysql_query($strquery) or die ("<h4>You Entered... Invalid SQL Command.</h4>");
        $i = 0;
		
        echo "<table style='font-family: Verdana;font-size: 12px;border-collapse:collapse;'>";
        echo "<tr bgcolor=#000000 height='25px' style='color:#ffffff;'>";
        while($i < mysql_num_fields($select)){
            $column = mysql_fetch_field($select, $i);
            if($column->name != "id"){
                echo "<td><b>".$column->name."</b></td>";
            }
            $i++;
        }
        echo "</tr>";

        while($array = mysql_fetch_array($select)){
            echo "<tr>";
            foreach($array as $column => $value){
                if(!is_int($column) && $column != "id"){
                    echo "<td class='green_text'>$value</td>";
                }
            }
            ?>
            <?php 
            echo "</tr>";
        }
   echo "</table>";
 }      
   ?>

			  
			  </td>
            </tr>
          </table>
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
<style type="text/css">
.red_text
{
	font-family:Lucida Sans, Arial;
	font-size:14px;
	font-weight:900;
	color:#7e0000;
	text-align:center;
}
.h4
{
	font-family:Lucida Sans, Arial;
	font-size:19px;
	font-weight:900;
	color:#7e0000;
}
td {
    border: 1px solid #cccccc;
}
.green_text
{
	font-family:Lucida Sans, Arial;
	font-size:14px;
	font-weight:900;
	color:red;
}
tr {
    border: 1px solid #7E0000;
}
</style>
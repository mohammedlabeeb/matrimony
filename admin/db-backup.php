<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Submit","db-checkup.php","Submit");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$id = isset($_GET['id']) ? $_GET['id'] :"" ;

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
<script type="text/javascript">
setPageContext("database-operation","backup");
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
      <div class="breadcum-wide"><a title="Database Checkup">Database BackUp</a></div>
      <div class="listing-section">
        <div class="member-list cf">
         
          <a href="javascript:;" class="button" title="Database Checkup"  onclick="window.location='db-backup.php'"><img src="img/bgi/add-icon.png" alt="Add"/>Database BackUp</a>
        </div>
      </div>
      <div class="widecolumn-inner">
        <h4>Database BackUp</h4>
		
        
          <p class="cf"><a href="exampleScript.php" class="first-btn" style="text-decoration:none; background-color:red; color:white; margin-left:300px;">Take Full Backup OF Database Now</a>
          
          </p>
          
          
          
          
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
<?php 
backup_tables($host,$user,$pass,$name);

function backup_tables($host,$user,$pass,$name,$tables = '*') 
{ 
$link = mysql_connect($host,$user,$pass);
 mysql_select_db($name,$link);

//get all of the tables 
		if($tables == '*') 
			{ 
		 $tables = array();
		$result = mysql_query('SHOW TABLES');
		 while($row = mysql_fetch_row($result)) 
			{ 
			$tables[] = $row[0];
				 }
			 }

		else 
		 { 
 			$tables = is_array($tables) ? $tables : 
			explode(',',$tables);
		 } 

//cycle through 

		 foreach($tables as $table) 
		 { 
 		$result = mysql_query('SELECT * FROM '.$table);
		 $num_fields = mysql_num_fields($result);

 		$return.= 'DROP TABLE '.$table.';';
 		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));

		$return.= "\n\n".$row2[1].";\n\n";

			for ($i = 0; $i < $row = mysql_fetch_row($result); $i++) 
 			{ 
 			$return.= 'INSERT INTO '.$table.' VALUES(';
			 for($j=0; $j<$num_fields; $j++) 
				{ 
				 $row[$j] = addslashes($row[$j]);
 					$row[$j] = @ereg_replace("\n","\\n",$row[$j]);
 				if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; } 
 				if ($j<($num_fields-1)) { $return.= ','; } 
				 } 
			 $return.= ");\n";
			
 			} 
		 } 
 	//$return.="\n\n\n";
//} 

//save file 
 $now = date("F j, Y");
 $myfoldername = 'backup/';
$handle = fopen($myfoldername.$now.'.sql','w+');
//$handle = fopen(getcwd().$myfoldername.'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
 fwrite($handle,$return);
 
fclose($handle);


}
?>

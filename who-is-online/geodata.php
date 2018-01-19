<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
require "functions.php";
$indexid = $_SESSION['uid'];
$gen = $_SESSION['gender123'];

// We don't want web bots accessing this page:
if(is_bot()) die();

// Selecting the top 15 countries with the most visitors:
$result = mysql_query("SELECT register.photo1,register.gender,online_users.username,online_users.index_id FROM online_users,register where register.index_id =online_users.index_id and online_users.gender!='$gen'");

while($row=mysql_fetch_array($result))
{
	?>
	<div class="geoRow">
		<a href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $row['index_id'];?>','<?php echo $row['username'];?>')" style="color:black; text-decoration:none;">
		<div><img src="photos/<?php if($row['photo1']!=''){echo $row['photo1']; }
		else if($row['gender']=='Male'){ echo "male_small.png";} else{echo "female_small.png";}?>" width="20" height="20"> <?php echo $row['username'];?></div>
        </a>
	</div>
	<?php
}

?>
<?php include "../chat.php" ;?> 
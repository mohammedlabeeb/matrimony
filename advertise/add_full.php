<?php
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$select=mysql_query("select * from  advertisement where adv_level='level-1' AND status='APPROVED' order by rand() limit 0,1");
	$fetch=mysql_fetch_array($select);
	if(mysql_num_rows($select)>0)
	{
?>   
    <a href="<?php echo $fetch['adv_link'] ;?>" target="_blank">
        <img src="./advertise/<?php echo $fetch['adv_img'] ;?>" class="img-responsive" style="min-width:100%; height:130px;"/></a> 
        <?php
	}
	?>

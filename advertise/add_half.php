<?php
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();	
	$select=mysql_query("select * from  advertisement where adv_level='level-1' AND status='APPROVED' order by rand() limit 0,2");
	if(mysql_num_rows($select)>0)
	{	
?> 
           <?php while($fetch=mysql_fetch_array($select)){		?>
                <div class="panel panel-success">            
                    <div class="panel-body">
                      <a href="<?php echo $fetch['adv_link'] ;?>" target="_blank">
                          <img src="./advertise/<?php echo $fetch['adv_img'] ;?>" class="img-responsive" style="max-width:100%; height:230px;"/></a> 
                    </div>
                </div>
	<?php	}
	
	}?>
           
    

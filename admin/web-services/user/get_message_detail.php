<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$mes_id = isset($_GET['mes_id'])?$_GET['mes_id']:0;
if($mes_id!=0){
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select * from messages where mes_id=".$mes_id;
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$DatabaseCo2 = new DatabaseConn();
    while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
    { 
?>   
<h3 class="titles extra-space"><b><?php echo $DatabaseCo->dbRow->subject;?></b></h3><br />

                    
        	 		<div class="my-property-outer email-reply">
                    
                <p class="msg-head" style="padding: 10px;">
				From :<?php 
						
					  $matri_id = $DatabaseCo->dbRow->from_id;;
					  echo $DatabaseCo->dbRow->from_id;
						
					  ?>
				</p>
                <p><textarea cols="50" class="textarea" disabled="true" style="width:448px; padding:11px; border:none; background-color:#F5F5F5;"><?php echo $DatabaseCo->dbRow->message;?></textarea></p>
                <p class="cf msg-section" style="padding: 10px;">
                    	
                        <span class="msg-date"><?php $a=$DatabaseCo->dbRow->sent_date;
				 echo date('F j, Y, g:i a', (strtotime($a)));?></span>
                    </p>
				<p class="cf" style="padding: 10px;">
                <a href="#" title="Reply" class="delete-btn" onclick="$('message_detail').dialog('close');openReplyMessage('<?php  echo $matri_id; ?>')">Reply</a>
                
                </p>
             </div>
      <?php
	  $update=mysql_query("update messages set status='Read' where mes_id='$mes_id'");            
 		?>
<?php
    }
}else{
    echo "<h1>Invalid Message Id.</h1>";
}
?>


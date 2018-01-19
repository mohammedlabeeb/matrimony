<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$story_id = isset($_GET['tosid'])?$_GET['tosid']:0;
if($story_id!=0){
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select * from success_story where story_id=".$story_id;
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	//$DatabaseCo2 = new DatabaseConn();
    while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
    {
		$marriagedate = $DatabaseCo->dbRow->marriagedate;
		$weddingphoto = $DatabaseCo->dbRow->weddingphoto;
		$successmessage = $DatabaseCo->dbRow->successmessage;
		$bname = $DatabaseCo->dbRow->bridename;
		$gname = $DatabaseCo->dbRow->groomname;
	}
	?>   
<div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Success Story of <?php echo $bname; ?> & <?php echo $gname?></h4>
      </div>
      <div class="modal-body" align="center">
        <img src="SuccessStory/<?php echo $weddingphoto; ?>" class="col-xs-12 img-responsive" />
      </div>
      <p align="center" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif;font-size:14px; word-wrap:break-word;">
   	<?php echo $successmessage;?> - <strong><?php echo $bname; ?> & <?php echo $gname?></strong></p>      
    </div><!-- /.modal-content -->
  </div>
<?php    
}
?>
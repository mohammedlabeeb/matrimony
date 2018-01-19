<?php
include_once './databaseConn.php';
include_once './lib/requestHandler.php';	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 $from_id = isset($_GET['frmid'])?$_GET['frmid']:0;
if($from_id!=0){
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select * from messages where from_id=".$from_id;
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	//$DatabaseCo2 = new DatabaseConn();
    while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
    { 
?>
<div class="lightBox-content topHead-bg">
    <div class="contactsCount">
      <h2>Send Message</h2>
    </div>
    <div class="getContact-option full-width-content">
      <div class="messageComposetab">
        <div class="userDetails rounded-border"><img src="images/profile-photos/photo4.jpg" width="77" height="77" alt="photo1" />
          <ul>
            <li><strong>To</strong> <?php echo $DatabaseCo->dbRow->from_id;?></li>
            <li ><strong id="name"></strong></li>
            <li>Profile ID:<span id="mtid"></span></li>
          </ul>
        </div>
        <form action="send_message.php" name="sendfrm" method="post">
          <input type="hidden" name="txtTo" id="txtTo" value="" />
          <textarea name="txtmsg" id="txtmsg"></textarea>
          <input type="submit"  class="button-common-style send-button "/>
        </form>
      </div>
      <a class="close-lightBox" title="close"></a> </div>
  </div>
  <?php } }?>
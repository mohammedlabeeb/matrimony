<?php
$SQL_STATEMENT =  "SELECT * FROM success_story WHERE status='APPROVED' LIMIT 0,5";
$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
?>
<div class="listBox-head">
                    <h1>Success Story</h1>
                  </div>
                  <div class="listBox-content">
                    <div id="slides1">
                      <div class="slides_container">
					    <?php                    
                    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                    {
                    ?>
                         <div class="slide">
                          <div class="profile-list">
                  
                            <div class="profile-list-item borderNone">
                           <a target="_blank" href="#">
                           <img src="SuccessStory/<?php echo $DatabaseCo->dbRow->weddingphoto; ?>" alt="photo0" />
                           </a>
                              <ul class="profile-list-details">
  <li><a target="_blank" href="#"><strong>Bride : </strong></a><?php echo $DatabaseCo->dbRow->bridename; ?></li>
  <li><a target="_blank" href="#"><strong>Groom : </strong> </a><?php echo $DatabaseCo->dbRow->groomname; ?></li>
    <li><a target="_blank" href="#">
	<strong>Date : </strong>
							<?php
                            $date1=$DatabaseCo->dbRow->marriagedate;
							echo $date2 = date("d M ,Y", (strtotime($date1)));
                            ?>
							</a> 
							</li>
<li><a target="_blank" href="#"><strong>Message : </strong><?php echo substr($DatabaseCo->dbRow->successmessage,0,15);?></a></li>
                              
                              </ul>
                            </div>
                           
                          </div>
                        </div>
						 <?php 
                           
                    }
                            ?>
                      </div>
                    </div>
                  </div>
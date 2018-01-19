<?php
	$srtlist = getRowCount("select count(sh_id) from shortlist where from_id='$mid'", $DatabaseCo);
	//My Sortlist Member
	$blacklist = getRowCount("select count(block_id) from block_profile where block_by='$mid'", $DatabaseCo);
?>
<div class="listBox-head">
	<div class="headingIcon advancedSearch-icon"></div>
		<h2>My Membership</h2>
</div>
   <div class="listBox-content">
	<ul>
	  <li><a href="myshortlist.php">My Shortlist <span class="blueText">(<?php echo $srtlist; ?>)</span></a></li>
	  <li><a href="myblocklist.php">My Blocklist <span class="blueText">(<?php echo $blacklist; ?>)</span></a></li>
	  <li><a href="viewed_members.php">Contact Viewers </a></li>
	  <li><a href="viewed_address.php">Viewed Address </a></li>
	 </ul>
   </div>
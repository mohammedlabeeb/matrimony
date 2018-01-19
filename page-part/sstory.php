<?php 
require_once("BusinessLogic/class.story.php");
	
	$sql="select * from success_story where status='APPROVED' ORDER BY RAND() LIMIT 0,4 ";
	$resultst=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($resultst)>0)
							{
?>

<div class="success-stories">
	<h3>Success Stories</h3>
	<div class="links">
		<a href="#">Share your Success Story</a> | <a href="#">More Couple</a>
	</div>
	<div class="story-slider">
		
		<ul class="bxslider">
		<?php while($rowst=mysql_fetch_array($resultst))  { ?> 
			<li>
				<div class="story-image">
					<img src="SuccessStory/<?php echo $rowst['weddingphoto']; ?>" />
				</div>
				<div class="story-content">
					<div class="quote">
						<p><?php echo substr($rowst['successmessage'], 0,100); ?></p>
					</div>
					<div class="couple-details">
						<h4><?php echo $rowst['bridename']; ?> & <?php echo $rowst['groomname']; ?></h4>
						<p><?php $date1=$rowst['marriagedate'];   echo $date2 = date("l, d M Y", (strtotime($date1)));   ?></p>
					</div>
				</div>
			</li>
		<?php } ?>
		</ul>
		
	</div>
	</div>
<?php } ?>
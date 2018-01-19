<?php
	if(isset($_SESSION['user_id']))
	{
?>
<nav class="navbar navbar-default margin-top-320" role="navigation">
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span style="color:#FFF !important;">Menu&nbsp;<i class="glyphicon glyphicon-arrow-down"></i></span>
      </button>
      <a href="view-profile.php" class="white col-xs-5 white margin-collapse-profile visible-xs btn-success btn"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;My Profile</a>
     
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">	
<ul class="nav nav-justified">
    <li><a href="myhome.php" title="My Home"><i class="glyphicon glyphicon-home"></i> My Home</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-search"></i> Matches <b class="caret"></b></a>
                   
                  <ul class="dropdown-menu col-xs-12">
                        <li><a href="one_way.php" title="1-way Matches">1-way Matches</a></li>
                        <li><a href="two_way.php" title="2-way Matches">2-way Matches</a></li>
                        <li><a href="broader_matches.php" title="Broader matches">Broader matches</a></li>           
                        <li><a href="reverse_matches.php" title="Reverse Matches">Reverse Matches</a></li>
                  </ul>
    </li>
    <li><a href="success-story.php" title="Success Story"><i class="glyphicon glyphicon-heart-empty"></i> Success Story</a></li>
    <li><a  href="wedding-planner.php" title="Wedding Planner"><i class="glyphicon glyphicon-cutlery"></i> Wedding Planner</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-search"></i> Search <b class="caret"></b></a>
                   <ul class="dropdown-menu col-xs-12">
                       <li><a href="basic-search.php" title="Basic Search">Basic Search</a></li>
                       <li><a href="advanced-search.php" title="Advance Search">Advance Search</a></li>
                       <li><a href="education-search.php" title="Education Search">Education Search</a></li>           
                       <li><a href="occupation-search.php" title="Occupation Search">Occupation Search</a></li>
                       <li><a href="location-search.php" title="Location Search">Location Search</a></li>
                       <li><a href="keyword-search.php" title="Keyword Search">Keyword Search</a></li>
                      </ul>
     </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-credit-card"></i> My Membership <b class="caret"></b></a>
                   <ul class="dropdown-menu col-xs-12">
                        <li><a href="payment.php" title="Payment Option">Payment Option</a></li>
                        <li><a href="my-membership.php" title="My Orders">My Orders</a></li>
                       
                  </ul>
    </li>
    
    
    <li><a href="event.php" title="Event"><i class="glyphicon glyphicon-bell"></i> Event</a></li>
    <li><a href="online-members.php" title="Online Members"><i class="glyphicon glyphicon-heart"></i> Online Members</a></li>
    <li><a href="contact.php" title="contact"><i class="glyphicon glyphicon-phone-alt"></i> Contact</a></li>
</ul>
</div>
</div>
</nav>
      
         <?php }else{ ?>
<nav class="navbar navbar-default margin-top-320" role="navigation">
<div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span style="color:#FFF !important;">Menu&nbsp;<i class="glyphicon glyphicon-arrow-down"></i></span>
      </button>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">	      
      <ul class="nav nav-justified">                
               <li><a href="index.php" title="Home"><i class="glyphicon glyphicon-home"></i>  Home</a></li>                
               <li><a href="register.php" title="Register Now"><i class="glyphicon glyphicon-pencil"></i> Register Now</a></li>                
                <li><a  href="success-story.php" title="Success Story"><i class="glyphicon glyphicon-heart-empty"></i> Success Story</a></li>                
                <li><a  href="wedding-planner.php" title="Wedding Planner"><i class="glyphicon glyphicon-cutlery"></i> Wedding Planner</a></li>                
               <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-search"></i> Search <b class="caret" style="color:#FFF !important;"></b></a>
               <ul class="dropdown-menu" role="menu">
                    <li><a href="basic-search.php">Basic Search</a></li>
                    <li><a href="advanced-search.php">Advance Search</a></li>
                    <li><a href="education-search.php">Education Search</a></li>           
                    <li><a href="occupation-search.php">Occupation Search</a></li>
                    <li><a href="location-search.php">Location Search</a></li>
                     <li><a href="keyword-search.php">Keyword Search</a></li>
                  </ul>
               </li>                
              <li><a  href="payment.php" title="Payment"><i class="glyphicon glyphicon-credit-card"></i> Payment</a></li>                
               <li><a href="event.php" title="Event"><i class="glyphicon glyphicon-bell"></i> Event</a></li>                
               <li><a href="online-members.php" title="Online Members"><i class="glyphicon glyphicon-heart"></i> Online Members</a></li>                
               <li><a href="contact.php" title="contact"><i class="glyphicon glyphicon-phone-alt"></i> Contact</a></li>
               </ul>
               </div>
               </div>
               </nav>
     <?php } ?>
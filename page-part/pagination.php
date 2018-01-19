<?php
$pagination = "";
	if($lastpage >= 1)
	{
		$pagination .= "<ul class='pagination' style='float:right;'>";
		//previous button
		if ($page > 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$prev\">previous</a></li>";
		else
			$pagination.= "<li><span class=\"disabled\">previous</span></li>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class='active'><span class=\"current\">$counter</span></li>";
				else
					$pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active'><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active'><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active'><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$next\">next</a></li>";
		else
			$pagination.= "<li><span class=\"disabled\">next</span></li>";
		$pagination.= "</ul>\n";		
	}
	?>
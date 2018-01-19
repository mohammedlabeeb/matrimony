<?php
	include_once './databaseConn.php';
	
	function getCssClass($active_page,$sub_page_name){
					$cssActiveForLeftMenu = "";
					if($sub_page_name == $active_page)
						$cssActiveForLeftMenu = 'active';
					else			
						$cssActiveForLeftMenu = '';
					
				return $cssActiveForLeftMenu;
				}

	/*
		Get pagination string of declared css in wdget.css from table name.
	*/
	function getPagination($table_name,$pk_column,$page_size,$current_page,$search_case_sql)
	{
		$query = $_SERVER['QUERY_STRING'];
		$pagination = "";
		
		$total_rows = 0;
		if(empty($search_case_sql))
		 $SQL_STATEMENT = "select count(".$pk_column.") as 'total_rows' from ".$table_name;
		else
		 $SQL_STATEMENT = $search_case_sql;
		$DatabaseCo = new DatabaseConn();
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			$total_rows = $DatabaseCo->dbRow->total_rows;
		}
		
		$total_page = $total_rows / $page_size;
	
		if($total_page > 1)
		{
			$prev_page =(($current_page == 1)? $current_page:$current_page-1);
			$pagination = '<ul class="pagination"><li><a href="?'.$query.'&page='.$prev_page.'">Previous</a></li>';
			for($i=1;$i<($total_page+1);$i++)
			{
				if($i==$current_page)
				$pagination.= "<li class='active'><a href='?".$query."&page=".($i)."'>".($i)."</a></li>";
				else
				$pagination.= "<li ><a href='?".$query."&page=".($i)."'>".($i)."</a></li>";				
			}
			$next_class =  (($current_page == $total_page) ? 'next-off' : 'next');
			$next_page = (($current_page == $total_page)?$current_page:$current_page+1);
			$pagination.="<li><a href='?".$query."&page=".$next_page."'>Next</a></li>";
			$pagination.="</ul>";
		}
		
		return $pagination;
	}
	function getLimitForSqlState($current_page,$page_size)
	{
		$limit_str = "";
		$low_lim = $page_size * ($current_page -1);
		$high_lim = $page_size ;
		$limit_str = $low_lim .",".$high_lim ;
		
		return $limit_str;
	}
	
?>
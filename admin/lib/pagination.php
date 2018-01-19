<?php


function getCssClass($active_page,$sub_page_name)
{
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
		$pagination = "<div id='pagination-container'> <ul id='pagination-digg'> <li class='previous'><a href='?".$query."&page=".$prev_page."'>«Previous</a></li>";
		for($i=1;$i<($total_page+1);$i++)
		{
			if (strpos($query,'page=') !== false)
			{
				$query[strpos($query,'page=')+5] = $i;
				if($i==$current_page)
					$pagination.= "<li class='active'><a href='?".$query."'>".($i)."</a></li>";
				else
				$pagination.= "<li ><a href='?".$query."'>".($i)."</a></li>";
			}
			else
			{
				if($i==$current_page)
					$pagination.= "<li class='active'><a href='?".$query."&page=".($i)."'>".($i)."</a></li>";
				else
				$pagination.= "<li ><a href='?".$query."&page=".($i)."'>".($i)."</a></li>";
			}
		}
		$next_class =  (($current_page == $total_page) ? 'next-off' : 'next');
		$next_page = (($current_page == $total_page)?$current_page:$current_page+1);
		$pagination.="<li class='$next_class'><a href='?".$query."&page=".$next_page."'>Next »</a></li>";
		$pagination.="</ul></div>";
	}
	return $pagination;
}
function getNewPagination($page_name,$page_size_cookie_name,$table_name,$pk_column,$page_size,$current_page,$search_case_sql)
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
	$total_page = ceil($total_rows / $page_size);
	
	if($total_page > 1)
	{
		$prev_page =(($current_page == 1)? $current_page:$current_page-1);
		$next_page = (($current_page == $total_page)?$current_page:$current_page+1);
		$pagination = "<label class='search-role'>Item Per Page:</label><input type='text' name='page_size' value='$page_size' size='1' maxlength='2' id='page_size' class='drop-menu'  style='border:1px solid #919FC1;' onkeydown='if (event.keyCode == 13){setPageSize(\"$page_name\",\"#page_size\",$total_rows,\"$page_size_cookie_name\");}'  onkeypress='return isNumberKey(event);'>";
		
		$prev_disable="";
		if($current_page == 1){$prev_disable="disabled";}
		
		$next_disable="";
		if($current_page == $total_page){$next_disable="disabled";}
		
		
		$findme   = '?';
		$pos = strpos($page_name, $findme);
		$prev_page_str = "";
		$next_page_str = "";
		if ($pos === false) {
			$prev_page_str = $page_name."?page=".$prev_page;
			$next_page_str =  $page_name."?page=".$next_page;
		}else{
			$prev_page_str = $page_name."&page=".$prev_page;
			$next_page_str =  $page_name."&page=".$next_page;			
		}
		$pagination.="<a  href='javascript:;' class='first-btn' title='Prev' onclick='redirectToURL(\"$prev_page_str\");' ".$prev_disable.">Prev</a>";

		$pagination.="<label class='search-role'>Page No <span class='role-number'><input type='text' name='current_page' value='".$current_page."'  style='width:70px;height:20px;border:1px solid #919FC1;'  id='page' title='$current_page' onkeydown='if (event.keyCode == 13){gotoPage(\"$page_name\",\"#page\",$total_page);}' onkeypress='return isNumberKey(event);'></span> out of ".$total_page."</label>";

		$pagination.= "<a  href='javascript:;' class='first-btn' title='Next' onclick='redirectToURL(\"$next_page_str\");' ".$next_disable.">Next</a>";

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
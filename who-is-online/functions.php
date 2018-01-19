<?php
/* Helper functions: */

function get_tag($tag,$xml)
{
	preg_match_all('/<'.$tag.'>(.*)<\/'.$tag.'>$/imU',$xml,$match);
	return $match[1];
}

function is_bot()
{
	/* This function will check whether the visitor is a search engine robot */
	
	$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
	"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
	"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
	"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
	"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
	"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
	"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
	"Butterfly","Twitturls","Me.dium","Twiceler");

	foreach($botlist as $bot)
	{
		if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
		return true;	// Is a bot
	}

	return false;	// Not a bot
}
?>
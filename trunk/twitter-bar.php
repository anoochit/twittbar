<?

/*
Copyright (C) 2009 Anoochit Chalothorn <anoochit@redlinesoft.net>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


require_once("class.twitter.php");

class TwitterBar extends Twitter {

	function twitterLoadBar() {
		
		$twitter_url="http://twitter.com/".$this->username."/statuses/";
?>
<script language="javascript">

function fade(id, color){ 
	
	if(color<255) { //If color is not white yet
		color+=11; // increase color darkness
		document.getElementById(id).style.color="rgb("+color+","+color+","+color+")"; 
		setTimeout("fade('"+id+"', "+color+")",10); 
	}
	else color=0; //reset colorTitre value
}
function flux(i, nb) {
	document.getElementById("spTheme").innerHTML=theme[i];
	document.getElementById("sp").innerHTML=titre[i];

	fade("sp"+i, 0);
	if(i<nb-1) i++;
	else i=0;
	setTimeout("flux("+i+","+nb+")",6000); 
	
}

function init(nbItem){
	document.getElementById("sp0").style.color="rgb(0,0,0)";
	flux(0, nbItem);
}

	var theme = new Array();
	var titre = new Array();


</script>
<style>
/* twit */
#twit{  position: fixed;  }

#twit {width:100%;top:0;left:0;background: #000;color:white;opacity: 0.7;-moz-opacity: 0.7;-khtml-opacity: 0.7;filter: alpha(opacity=70);}
#twit a { color:white;  font-weight:bold; text-decoration:none;}
#twit .theme {float:left !important; margin:6px 0 3px 8px;font-family:Lucida Grande, Arial, Verdana, Sans-Serif; font-size:11px; color:#e9d426; font-weight:bold;}
#twit .titre {float:left !important; margin:6px 0 3px 8px;font-family:Lucida Grande, Arial, Verdana, Sans-Serif; font-size:11px; color:#fff;font-weight:bold; }
#twit #opened {height:25px; margin:0 8px 0 8px;}
#close {float:left !important; margin:3px 0 3px 0;}
#twit #closed {height:10px;float:left;margin:2px 8px 2px 8px; font-size:10px;}
img {border: none;}
</style>
<?
	
	$obtwitter=new Twitter($this->username,$this->password);
	$xml=$obtwitter->twitterCapture();

?>
<div id="twit">
<div id="closed" style="display:none;"> 
<a href="javascript:void(0);"  onclick="document.getElementById('opened').style.display='block'; document.getElementById('closed').style.display='none';"><img src="twittbar/open.gif"  alt="+"/></a> <span  > <a href="javascript:void(0);"  onclick="document.getElementById('opened').style.display='block'; document.getElementById('closed').style.display='none';">Open</a></span> </div><div id="opened"> <a href="http://twitter.com/statuses/user_timeline/12883272.rss"><span id="rss" style="display: block; float: right;margin-top: 2px;margin-right: 2px;"><img src="twittbar/rss.gif" width="20px" alt="Rss"/></span></a> <a href="javascript:void(0);"  onclick="document.getElementById('opened').style.display='none'; document.getElementById('closed').style.display='block';"><span id="close"><img src="twittbar/close.gif"  alt="Close"/></span></a> <span id="spTheme"></span> <span id="sp"><span id="sp0"></span></span> 
<script language="javascript">
<?

	$i=0;
	foreach ($xml->status as $item) {
		
?>
	theme[<?=$i;?>]='<a href="<?=$twitter_url; ?><?=$item->id; ?>" class="theme" id="spTheme<?=$i; ?>">Twitter /</a>';
	titre[<?=$i;?>]='<a href="<?=$twitter_url; ?><?=$item->id; ?>"  class="titre" id="sp<?=$i; ?>"><?=htmlspecialchars($item->text,ENT_QUOTES); ?></a>';
<?
		$i++;
	}
?>
	init(19);

</script>
</div>
</div>
<?
	}	
		
}


$obtwitter=new TwitterBar("twitter-login","twitter-password");

$obtwitter->twitterLoadBar();



?>
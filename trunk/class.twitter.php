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


class Twitter{

var $username=null;
var $password=null;
	
function __construct($username,$password) {
	$this->username=$username;
	$this->password=$password;
}
	
function twitterCapture() {  
	// Set your username and password here  
	$user = $this->username;
	$password = $this->password;
	$ch = curl_init("https://twitter.com/statuses/user_timeline.xml");  
	curl_setopt($ch, CURLOPT_HEADER, 1);  
	curl_setopt($ch,CURLOPT_TIMEOUT, 30);  
	curl_setopt($ch,CURLOPT_USERPWD,$user . ":" . $password);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
	$result=curl_exec ($ch);  
	$data = strstr($result, '<?');  

     $xml = new SimpleXMLElement($data);  

     return $xml;  
}  


	
}



?>
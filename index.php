<?php
//$domain = $_GET['domain'];
$domain = "domaintoche.ck";
// For the full list of TLDs/Whois servers see http://www.iana.org/domains/root/db/ and http://www.whois365.com/en/listtld/
$whoisserver = "whois.rotld.ro" ;
$from = "email@tosend.from";

function LookupDomain($domain){
	global $whoisserver;
	$result = QueryWhoisServer($whoisserver, $domain);
	if(!$result) {
		$result321="$domain e cel mai probabil liber";
	}

	
	

$ok="Domain Status: OK";
$pe="Domain Status: PendingDelete";
$de="liber";
$pos = strpos($result,$ok);
$posp = strpos($result,$pe);
$posd = strpos($result321,$de);

if ($posp)
{

 $result1="Domeniul $domain e in curs de stergere";



}
else {

// Test row. If uncommented, will spam while the domain is registered
//$result1="Domeniul $domain e inregistrat";
 
}

if ($posd)
{
 // string needle NOT found in haystack
 $result1="Domeniul $domain e liber la inregistrare";
mail("email@tosend.to",$result1,$result1,"From: $from\n");


}
else {
// Test row. If uncommented, will spam while the domain is registered
//$result1="Domeniul $domain e inregistrat";
 
}

	
		
	return $result1;
	

	
}


function ValidateDomain($domain) {
	if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
		return false;
	}
	return $domain;
}

function QueryWhoisServer($whoisserver, $domain) {
	$port = 43;
	$timeout = 10;
	$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
	//if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
	fputs($fp, $domain . "\r\n");
	$out = "";
	while(!feof($fp)){
		$out .= fgets($fp);
	}
	fclose($fp);

	$res = "";
	if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
		$rows = explode("\n", $out);
		foreach($rows as $row) {
			$row = trim($row);
			if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
				$res .= $row."\n";
			}
		}
	}
	
	

	return $res;
	
}

if($domain) {
	$domain = trim($domain);
	if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
	if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
	$result = LookupDomain($domain);
	echo "<pre>\n" . $result . "\n</pre>\n";
}
?>
                            

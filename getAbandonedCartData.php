<?
/*
 * Proof of concept; programmatically pull abandoned cart API data into text files.
 *
 * Example request for September 23, 2014 8AM Pacific: 
 * http://labs.richrelevance.com/api/abandonedcart/getUsers.php?apiKey=[API_KEY]&time=2014-09-23:08
 *
 * 2014 RichRelevance, Inc.
 * @brad
 *
 * version 14.09.23
*/


/* API key for your account */
$apiKey = $_GET["apiKey"];

/* Time in format: Y-m-d:h (for example, 2014-09-23:03) */
$time = $_GET["time"];
$timeArray = explode("-", $time);
$Y = $timeArray[0];
$m = $timeArray[1];

/* Split day/hour on colon */
$dArray = explode(":",$timeArray[2]);
$d = $dArray[0];
$h = $dArray[1];
  
/* URL for abandoned_cart_api */
$url = "https://api.richrelevance.com/api/v1/datamesh/apis/$apiKey/abandoned_cart_api?key=$Y-$m-$d:$h";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); // request as GET, not POST
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // do not echo results
$result = curl_exec($ch);

$file = "./abandoned_cart_$Y-$m-$d:$h.txt";  // update this to be a name format that meets your needs
$handle = fopen($file, 'wx'); // open for writing 
$data = $result;
fwrite($handle, $data);  
fclose($handle); 
?>

<?php
require('simple_html_dom.php');
$html = new simple_html_dom();
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, 'http://www.dns-shop.ru/catalog/105/smartfony/');
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $output contains the output string
$output = curl_exec($ch);
// close curl resource to free up system resources
curl_close($ch);
$html->load($output);
// Find all images
$dsn = 'mysql:dbname=oneComp;host=127.0.0.1:3306';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
foreach( $html->find("table tr .title a+a") as $element){
	if(!$element->plaintext==""){
		$dbh->query("INSERT INTO `technics` (`name`) values('".$element->plaintext."')");
	}
	unset($element);
}
	
?>
<?php

/**
 *
 * Countries
 * Example of use (PHP) 
 * Copyright (c) 2012-2013 Peter Kahl. All rights reserved.
 * Use of this source code is governed by a GNU General Public License
 * that can be found in the LICENSE file.
 *
 * https://github.com/peterkahl/countries
 *
 */



define('DB_HOSTNAME', 'localhost');
define('DB_DBNAME',   'someDBname');
define('DB_USERNAME', 'someDBuser');
define('DB_PASSWORD', 'someDBpwd');


$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

if ($mysqli->connect_error) {
	die('Connect Error ('.$mysqli->connect_errno.') '.$mysqli->connect_error);
}

$mysqli->set_charset("utf8");

//----------------------------------------------------------------------

$lang_code = 'zh_HK';

$country_code = 'de';

$sql = "SELECT * FROM `countries` WHERE `code`='".$country_code."' LIMIT 0,1";
$result = mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if     ($lang_code == 'zh_HK') $lang_code = 'zh_TW';
	elseif ($lang_code == 'en_US') $lang_code = 'en_GB';
	$name = $row['country_'.$lang_code];
}

echo $name; // 德國

//----------------------------------------------------------------------



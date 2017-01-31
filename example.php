<?php
/**
 * Countries
 *
 * @version    0.2 (2017-01-31)
 * @author     Peter Kahl <peter.kahl@colossalmind.com>
 * @since      2012
 * @license    Apache License, Version 2.0
 *
 * Copyright 2012-2017 Peter Kahl <peter.kahl@colossalmind.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      <http://www.apache.org/licenses/LICENSE-2.0>
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

define('DB_HOSTNAME', 'localhost');
define('DB_DBNAME',   'someDBname');
define('DB_USERNAME', 'someDBuser');
define('DB_PASSWORD', 'someDBpwd');


$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

if ($mysqli->connect_error) {
	die('Connect Error ('.$mysqli->connect_errno.') '.$mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4"); # Very important!

$country = 'de';

$sql = "SELECT * FROM `countries` WHERE `code`='".$country."' LIMIT 0,1";
$result = mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$info = $row;
}

echo $info['country_de'];    # Deutschland
echo $info['country_ru'];    # Германия
echo $info['country_zh-hk']; # 德國
echo $info['flag'];          # 🇩🇪
echo $info['cont'];          # EU
echo $info['lat'];           # 51
echo $info['lon'];           # 9
echo $info['locale'];        # de_DE

Countries
=========

Copyright (c) 2012-2015, Peter Kahl. All rights reserved. www.colossalmind.com

[https://github.com/peterkahl/countries](https://github.com/peterkahl/countries)

About/關於/約
=================

Translates ISO 2-letter country codes to:

* country names in various languages
* to locale (language code)
* corresponding continent code
* approximate geolocation (lat, lon)

這個資料庫能夠把兩個字母的國家代碼，轉換成繁體中文、簡體中文、日文、以及其他語言的國家名稱。國家代碼轉換語言代碼。

このデータベースには、国名の日本語、繁体字中国語、簡体字中国語、および他の言語に変換し、2文字の国コードであることができます。国コード変換言語コード。

These are the country name languages (at this moment):

* ar_SA
* cs_CZ
* de_DE
* en_GB
* es_ES
* fr_FR
* it_IT
* ja_JP
* nl_NL
* pt_PT
* ru_RU
* sk_SK
* zh_CN
* zh_TW

The structure of this database is based on Per Gustafsson's [ip2nation](http://ip2nation.com/) database and is fully compatible therewith.

Usage Examples
==============

**Select (drop-down list):**

```php
<?php

$language_code = 'zh_HK';
$user_country = 'cn';

echo '<select name="ccode" class="countryselect">';

if     ($language_code == 'zh_HK') $to = 'zh_TW';
elseif ($language_code == 'en_US') $to = 'en_GB';
else $to = $language_code;

$sql = "SELECT * FROM `countries` ORDER BY `country_".$to."` ASC";
$result = mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if (!in_array($row['code'], array('yu','eu','ap','nt','aq','01'))) {
		echo '<option value="'.$row['code'].'"';
		if ($user_country === $row['code']) echo ' SELECTED';
		echo '>'.$row['country_'.$to].'</option>';
	}
}
echo '</select>';

?>
```

**Translate country name:**

```php
<?php

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

?>
```

**Get language code(s):**

```php
<?php

$country_code = 'gb';

if ($country_code == 'gb') $country_code = 'uk';

$sql = "SELECT * FROM `countries` WHERE `code`='".$country_code."' LIMIT 0,1";
$result = mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$lang = $row['locale'];
}

echo $lang; // en_GB,ga_GB,cy_GB,gd_GB,kw_GB

?>
```

License
=======

Copyright 2012-2015 Peter Kahl (www.colossalmind.com)

Licensed under the Apache License, Version 2.0 (the "License"); you
may not use this file except in compliance with the License. You may
obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or
implied. See the License for the specific language governing
permissions and limitations under the License.

Change Log
==========

1.0.0 ..... 2012-11-25
	Initial release

1.1.0 ..... 2013-09-24
	Added languages.

1.2.0 ..... 2013-10-07
	Added locale.

1.3.0 ..... 2015-07-03
	Added sk_SK column. Added continent column. Changed license to Apache version 2.0.





Countries
=========

Copyright (c) 2012-2013, Peter Kahl. All rights reserved.

[https://github.com/peterkahl/countries](https://github.com/peterkahl/countries)

About/關於/約
=================

Translates ISO 2-letter country codes to country names in various languages. Converts country
code to language.

這個資料庫能夠把兩個字母的國家代碼，轉換成繁體中文、簡體中文、日文、以及其他語言的國家名稱。國家代碼轉換語言代碼。

このデータベースには、国名の日本語、繁体字中国語、簡体字中国語、および他の言語に変換し、2文字の国コードであることができます。国コード変換言語コード。

Details
=======

This database consists of one table which allows for translation of
2-letter country ISO code to several languages; country to locale (country to language conversion);
country to coordinates (lat, lon).

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
* zh_CN
* zh_TW

The structure of this database is based on Per Gustafsson's [ip2nation](http://ip2nation.com/) database and is fully compatible.

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

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).

Change Log
==========

1.0.0 ..... 2012-11-25
	Initial release

1.1.0 ..... 2013-09-24
	Added languages.

1.2.0 ..... 2013-10-07
	Added locale.





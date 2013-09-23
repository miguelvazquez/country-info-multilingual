Countries
=========

[https://github.com/peterkahl/countries](https://github.com/peterkahl/countries)

About/關於/关于/約
=================

Translates 2-letter country ISO code to country name in various languages.

這個資料庫能夠把兩個字母的國家代碼，轉換成繁體中文、簡體中文、日文、以及其他語言的國家名稱。

このデータベースには、国名の日本語、繁体字中国語、簡体字中国語、および他の言語に変換し、2文字の国コードであることができます。

Details
=======

This database consists of one table which allows for translation of
2-letter country ISO code to country name in 13 languages and coordinates (lat, lon):

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

This database is based in part on Per Gustafsson's [ip2nation](http://ip2nation.com/) database. 
This table is fully compatible with the ip2nation database.

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

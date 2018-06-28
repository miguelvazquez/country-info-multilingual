# Country Info (Multilingual)

[![License](http://img.shields.io/:license-apache-blue.svg)](http://www.apache.org/licenses/LICENSE-2.0.html)
[![If this project has business value for you then don't hesitate to support me with a small donation.](https://img.shields.io/badge/Donations-via%20Paypal-blue.svg)](https://www.paypal.me/PeterK93)

Converts country code to full name in any of 17 languages and other country-related information from database.

Available data (for given country code):
* country names in 17 languages (and/or script variations)
* emoji flag
* locale code
* continent code
* latitude and longitude of country's centroid
* elevation (altitude) in metres
* international calling code
* total population
* area in km²
* currency code
* Google Maps API `place_id`
* TODO: capital city

Available languages:
* Arabic (عربى)
* Czech (čeština)
* German (Deutsch)
* Danish (dansk)
* English
* Spanish (español)
* French (français)
* Hebrew (עִברִית)
* Italian (italiano)
* Japanese (日本語)
* Dutch (Nederlands)
* Portuguese (português)
* Russian (русский)
* Slovak (slovenčina)
* Chinese simplified (中文简体)
* Chinese traditional (中文繁體)
* Welsh (Cymraeg) ... incomplete but working

## Be cautious when upgrading to newer version

Consider backing up your existing `countries` database if it contains bespoke data. Your existing `countries` database will be dropped during the import (SQL query) of the new database dump.

## Usage Examples

**Generate HTML for select (drop-down list) of country names:**

```php
use peterkahl\Countries\Countries;

$link = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DBNAME);

mysqli_set_charset($link, "utf8mb4");

$countryObj = new Countries;
$countryObj->dbresource = $link;
$array = $countryObj->getAllCodesNames('zh-tw'); # Chinese traditional

echo '<select>';
foreach ($array as $val) {
  echo '<option value="'.$val['code'].'">'.$val['name'].'</option>';
}
echo '</select>';
```

**Translate country name:**

```php
use peterkahl\Countries\Countries;

$link = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DBNAME);

mysqli_set_charset($link, "utf8mb4");

$countryObj = new Countries;
$countryObj->dbresource = $link;

echo $countryObj->code2countryName('US', 'ru'); # Соединенные Штаты
```

**Get all information for a given country:**

```php
use peterkahl\Countries\Countries;

$link = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DBNAME);

mysqli_set_charset($link, "utf8mb4");

$countryObj = new Countries;
$countryObj->dbresource = $link;

$array = $countryObj->getCountryInfo('VC');
var_dump($array);
/*
array(29) {
  ["code"]=>
  string(2) "VC"
  ["cur_code"]=>
  string(3) "XCD"
  ["flag"]=>
  string(8) "🇻🇨"
  ["longname"]=>
  string(32) "Saint Vincent and the Grenadines"
  ["name_ar"]=>
  string(36) "سانت فنسنت وغرنادين"
  ["name_cs"]=>
  string(26) "Svatý Vincent a Grenadiny"
  ["name_cy"]=>
  string(26) "Saint Vincent a'r Grenadiniaid"
  ["name_da"]=>
  string(29) "Saint Vincent og Grenadinerne"
  ["name_de"]=>
  string(30) "St. Vincent und die Grenadinen"
  ["name_en"]=>
  string(32) "Saint Vincent and the Grenadines"
  ["name_es"]=>
  string(28) "San Vicente y las Granadinas"
  ["name_fr"]=>
  string(31) "Saint-Vincent-et-les Grenadines"
  ["name_he"]=>
  string(40) "סנט וינסנט והגרנדינים"
  ["name_it"]=>
  string(26) "Saint Vincent e Grenadines"
  ["name_ja"]=>
  string(54) "セントビンセント・グレナディーン諸島"
  ["name_nl"]=>
  string(30) "Saint Vincent en de Grenadines"
  ["name_pt"]=>
  string(25) "São Vicente e Granadinas"
  ["name_ru"]=>
  string(45) "Сент-Винсент и Гренадины"
  ["name_sk"]=>
  string(28) "Svätý Vincent a Grenadíny"
  ["name_zh-cn"]=>
  string(30) "圣文森特和格林纳丁斯"
  ["name_zh-hk"]=>
  string(30) "聖文森特和格林納丁斯"
  ["latitude"]=>
  string(10) "13.2528179"
  ["longitude"]=>
  string(11) "-61.1970774"
  ["elevation"]=>
  string(7) "624.517"
  ["continent"]=>
  string(2) "NA"
  ["locale"]=>
  string(5) "en_VC"
  ["dialcode"]=>
  string(4) "1784"
  ["area"]=>
  string(3) "389"
  ["population"]=>
  string(6) "103000"
  ["place_id"]=>
  string(27) "ChIJuzU5nuKsQIwRsaHSjejT_TE"
}
*/
```

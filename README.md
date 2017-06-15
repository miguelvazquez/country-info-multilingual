# Country Info (Multilingual)

Converts country code to full name in any of 16 languages and provides other useful information. Can be used to generate HTML code.

Available data:
* country names in 16 languages and scripts
* emoji flags
* locale (language code)
* corresponding continent code
* latitude and longitude of each country's centroid
* mean elevation (altitude) in metres
* international calling code
* total population
* area in km²

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

$array = $countryObj->getCountryInfo('fr');
var_dump($array);
/*
array(27) {
  ["code"]=>
  string(2) "fr"
  ["flag"]=>
  string(8) "🇫🇷"
  ["longname"]=>
  string(6) "France"
  ["ar"]=>
  string(10) "فرنسا"
  ["cs"]=>
  string(7) "Francie"
  ["da"]=>
  string(6) "France"
  ["de"]=>
  string(10) "Frankreich"
  ["en"]=>
  string(6) "France"
  ["es"]=>
  string(7) "Francia"
  ["fr"]=>
  string(6) "France"
  ["he"]=>
  string(14) "צָרְפַת"
  ["it"]=>
  string(7) "Francia"
  ["ja"]=>
  string(12) "フランス"
  ["nl"]=>
  string(9) "Frankrijk"
  ["pt"]=>
  string(7) "França"
  ["ru"]=>
  string(14) "Франция"
  ["sk"]=>
  string(11) "Francúzsko"
  ["zh-cn"]=>
  string(6) "法国"
  ["zh-hk"]=>
  string(6) "法國"
  ["latitude"]=>
  string(8) "46.53078"
  ["longitude"]=>
  string(8) "2.715019"
  ["elevation"]=>
  string(3) "375"
  ["continent"]=>
  string(2) "EU"
  ["locale"]=>
  string(5) "fr_FR"
  ["dialcode"]=>
  string(2) "33"
  ["area"]=>
  string(6) "550788"
  ["population"]=>
  string(8) "56700000"
}
*/
```

# Country Info (Multilingual)

Converts country code to full name and can provide lots of other useful information. Can be used to generate HTML code.

Available data:
* country names in 16 languages and scripts
* emoji flags
* locale (language code)
* corresponding continent code
* approximate geolocation (latitude, longitude)
* approximate elevation (altitude in metres)
* international calling code

Available languages:
* Arabic (عربى)
* Czech (čeština)
* German (Deutsch)
* Danish (dansk)
* English
* Spanish (Español)
* French (français)
* Hebrew (עִברִית)
* Italian (italiano)
* Japanese (日本語)
* Dutch (Nederlands)
* Portuguese (Português)
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

**Get all information for a given country (and name in specified language):**

```php
use peterkahl\Countries\Countries;

$link = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DBNAME);

mysqli_set_charset($link, "utf8mb4");

$countryObj = new Countries;
$countryObj->dbresource = $link;

$array = $countryObj->getCountryInfo('fr', 'ar_SA');
/*
Array
(
    [code] => fr
    [flag] => 🇫🇷
    [country_iso] => France
    [latitude] => 46
    [longitude] => 2
    [elevation] => 375
    [continent] => EU
    [locale] => fr_FR
    [dialcode] => 33
    [name] => فرنسا
)
*/
```

# Countries 國家 カントリー СТРАНЫ
Translates ISO 2-letter country code to:

* country names in 14 languages and scripts
* emoji flags
* locale (language code)
* corresponding continent code
* approximate geolocation (latitude, longitude)
* approximate elevation (altitude in metres)
* international calling code

這個資料庫能夠把兩個字母的國家代碼，轉換成繁體中文、簡體中文、日文、俄語、以及其他語言的國家名稱。國家代碼轉換語言代碼。

このデータベースには、国名の日本語、繁体字中国語、簡体字中国語、および他の言語に変換し、2文字の国コードであることができます。国コード変換言語コード。

Эту базу данных возможно использовать для преобразования двухбуквенного кода страны на название страны на китайском (традиционном или упрощенном), японском, русском и другим языкам.

* Arabic (عربى)
* Czech (čeština)
* German (Deutsch)
* English
* Spanish (Español)
* French (français)
* Italian (italiano)
* Japanese (日本語)
* Dutch (Nederlands)
* Portuguese (Português)
* Russian (русский)
* Slovak (slovenčina)
* Chinese simplified (中文简体)
* Chinese traditional (中文繁體)

## Database Connection
Make sure that connection to the database uses `utf8mb4`.

## Usage Examples

**Select (drop-down list) of country names:**

```php
<?php

$lang = 'zh-hk';
$country = 'cn';

echo '<select>';

$sql = "SELECT * FROM `countries` ORDER BY `country_".$lang."` ASC";
$result = $mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  if (!in_array($row['code'], array('yu','eu','ap','nt','aq','01'))) {
    echo '<option value="'.$row['code'].'"';
    if ($country === $row['code']) echo ' SELECTED';
    echo '>'.$row['country_'.$lang].'</option>';
  }
}
echo '</select>';
```

**Translate country name:**

```php
<?php

$lang = 'zh-hk';
$country = 'de';

$sql = "SELECT * FROM `countries` WHERE `code`='".$country."' LIMIT 0,1";
$result = $mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $name = $row['country_'.$lang];
}

echo $name; # 德國
```

**Get language code(s):**

```php
<?php

$country = 'gb';

$sql = "SELECT * FROM `countries` WHERE `code`='".$country."' LIMIT 0,1";
$result = $mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $lang = $row['locale'];
}

echo $lang; # en_GB,ga_GB,cy_GB,gd_GB,kw_GB
```

**Get emoji flag:**

```php
<?php

$country = 'gb';

$sql = "SELECT * FROM `countries` WHERE `code`='".$country."' LIMIT 0,1";
$result = $mysqli->query($sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $flag = $row['flag'];
}

echo $flag; # 🇬🇧
```

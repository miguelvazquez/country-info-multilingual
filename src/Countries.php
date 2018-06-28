<?php
/**
 * Countries
 *
 * Converts country code to full name in 17 languages and provides
 * other useful country-related information from database.
 *
 * @version    4.0 (2018-06-28 06:11:00 GMT)
 * @author     Peter Kahl <https://github.com/peterkahl>
 * @since      2017
 * @license    Apache License, Version 2.0
 *
 * Copyright 2017-2018 Peter Kahl <https://github.com/peterkahl>
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

namespace peterkahl\Countries;

use \Exception;


class Countries {


  /**
   * Database resource.
   * @var mixed
   */
  public $dbresource;


  /**
   * Validates language string.
   * @param  string
   * @return string
   * @throws \Exception
   */
  private function ValidateLanguage($lang) {
    $available = array(
      'ar',
      'cs',
      'cy',
      'da',
      'de',
      'en',
      'es',
      'fr',
      'he',
      'it',
      'ja',
      'nl',
      'pt',
      'ru',
      'sk',
      'zh-cn',
      'zh-hk',
    );
    $lang = $this->denormaliseLangcode($lang);
    if ($lang == 'zh-tw' || $lang == 'zh-mo') {
      return 'zh-hk';
    }
    elseif (substr($lang, 0, 2) == 'zh') {
      return 'zh-cn';
    }
    if (in_array($lang, $available)) {
      return $lang;
    }
    $lang = substr($lang, 0, 2);
    if (in_array($lang, $available)) {
      return $lang;
    }
    throw new Exception('Invalid argument lang');
  }


  /**
   * Turns en_GB --> en-gb
   * @param  string
   * @return string
   */
  private function denormaliseLangcode($str) {
    $str = strtolower($str);
    return str_replace('_', '-', $str);
  }


  /**
   * Returns translated country name.
   * When database filed is empty, returns English name.
   * @param  string  code lang
   * @return string
   * @throws \Exception
   */
  public function code2countryName($code, $lang = 'en') {

    if (!$this->ValidateCountryCode($code)) {
      throw new Exception('Invalid value argument code');
    }
    if ($name = $this->QueryCountryName($code, $lang)) {
      return $name;
    }
    return $this->QueryCountryName($code, 'en');
  }


  /**
   * Returns translated country name.
   * @param  string  code lang
   * @return string
   */
  private function QueryCountryName($code, $lang = 'en') {

    $lang = $this->ValidateLanguage($lang);
    $code = strtoupper($code);

    $sql = "SELECT `name_". mysqli_real_escape_string($this->dbresource, $lang) ."` FROM `countries` WHERE `code`='". mysqli_real_escape_string($this->dbresource, $code) ."' LIMIT 0,1;";
    $result = mysqli_query($this->dbresource, $sql);

    if ($result === false) {
      throw new Exception('Error executing SQL query');
    }

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      return $row['name_'. $lang];
    }

    return '';
  }


  /**
   * Validates 2-character country code.
   * @param  string
   * @return boolean
   */
  private static function ValidateCountryCode($code) {
    return (empty($code) || strlen($code) != 2) ? false : true;
  }


  /**
   * Returns array of all world's countries as pairs of
   * code + full name in specified language.
   * This is useful for generating HTML of select (drop-down list)
   * of country names.
   * @param  string  code lang
   * @throws \Exception
   * @return array
   */
  public function getAllCodesNames($lang = 'en') {
    if ($lang == 'cy') {
      $lang = 'en';
    }
    $lang = $this->ValidateLanguage($lang);
    $new = array();
    $sql = "SELECT `code`,`name_". mysqli_real_escape_string($this->dbresource, $lang) ."` FROM `countries` ORDER BY `". mysqli_real_escape_string($this->dbresource, $lang) ."` ASC;";
    $result = mysqli_query($this->dbresource, $sql);
    if ($result === false) {
      throw new Exception('Error executing SQL query');
    }
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      # We ignore the codes that aren't real countries
      if (!in_array($row['code'], array('EU','AP','AQ','01'))) {
        $new[] = array('code' => $row['code'], 'name' => $row['name_'. $lang]);
      }
    }
    return $new;
  }


  /**
   * Fetches the whole row of data for given country code.
   * @param  string     2-character country code
   * @throws \Exception
   * @return array
   */
  public function getCountryInfo($code) {
    $sql = "SELECT * FROM `countries` WHERE `code`='". mysqli_real_escape_string($this->dbresource, strtoupper($code)) ."' LIMIT 0,1;";
    $result = mysqli_query($this->dbresource, $sql);
    if ($result === false) {
      throw new Exception('Error executing SQL query');
    }
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      return $row;
    }
    throw new Exception('Unknow error at line '. __LINE__);
  }

}

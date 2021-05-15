<?php
/**
 * User Agent Library
 * Parse user agent information.
 *
 * @package : User Agent
 * @category : Library
 * @author : Unic Framework
 * @link : https://github.com/unicframework/unic
 */

namespace UserAgent;

class UserAgent {
  public $ip;
  public $os;
  public $osVersion;
  public $browser;
  public $browserVersion;
  public $deviceType;
  public $deviceBrand;
  public $userAgent;
  public $referrer;
  public $isReferred;

  function __construct(string $userAgent = NULL) {
    $this->userAgent = (isset($userAgent) ? $userAgent : (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL));
    $this->ip = $this->getIP();
    $this->os = $this->getOS();
    $this->osVersion = $this->getOsVersion();
    $this->browser = $this->getBrowser();
    $this->browserVersion = $this->getBrowserVersion();
    $this->deviceType = $this->getDeviceType();
    $this->deviceBrand = $this->getDeviceBrand();
    $this->referrer = (isset($userAgent) ? FALSE : $this->getReferrer());
    $this->isReferred = (isset($userAgent) ? FALSE : (isset($_SERVER['HTTP_REFERER']) ? TRUE : FALSE));
  }

  /**
   * Retrieve user ip address.
   *
   * @return string|null
   */
  private function getIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) {
      return $_SERVER['HTTP_X_REAL_IP'];
    } else if(isset($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    } else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
      return $_SERVER['HTTP_X_FORWARDED'];
    } else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_FORWARDED_FOR'];
    } else if(isset($_SERVER['HTTP_FORWARDED'])) {
      return $_SERVER['HTTP_FORWARDED'];
    } else if(isset($_SERVER['REMOTE_ADDR'])) {
      return $_SERVER['REMOTE_ADDR'];
    }
    return NULL;
  }

  /**
   * Parse os from user agent string
   *
   * @return string|null
   */
  private function getOS() {
    // List of all OS
    $data = [
      '/Android/i' => 'Android',
      '/windows|win32/i' => 'Windows',
      '/iPhone|iPod|iPad|iOS/i' => 'iOS',
      '/macintosh|mac os x|mac_powerpc/i' => 'Mac OS',
      '/blackberry|BB/i' => 'BlackBerry',
      '/webos/i' => 'Mobile',
      '/ubuntu/i' => 'Ubuntu',
      '/linux/i' => 'Linux',
      '/unix/i' => 'Unix',
    ];
    // Match os from user agent string
    foreach($data as $pattern => $os) {
      if(preg_match($pattern, $this->userAgent)) {
        return $os;
      }
    }
    return NULL;
  }

  /**
   * Parse os version from userAgent
   *
   * @return string
   */
  private function getOsVersion() {
    if($this->os == 'Android') {
      // List of all android version
      $data = [
        '/android 12/i' => 'Android 12',
        '/android 11/i' => 'Android 11',
        '/android 10/i' => '10 Q',
        '/android 9.0/i' => '9.0 Pie',
        '/android 9/i' => '9 Pie',
        '/android 8.1.0/i' => '8.1.0 Oreo',
        '/android 8.1/i' => '8.1 Oreo',
        '/android 8.0/i' => '8.0 Oreo',
        '/android 7.1.2/i' => '7.1.2 Nougat',
        '/android 7.1.1/i' => '7.1.1 Nougat',
        '/android 7.1/i' => '7.1 Nougat',
        '/android 7.0/i' => '7.0 Nougat',
        '/android 6.0.1/i' => '6.0.1 Marshmallow',
        '/android 6.0/i' => '6.0 Marshmallow',
        '/android 5.1.1/i' => '5.1.1 Lollipop',
        '/android 5.1/i' => '5.1 Lollipop',
        '/android 5.0.2/i' => '5.0.2 Lollipop',
        '/android 5.0.1/i' => '5.0.1 Lollipop',
        '/android 5.0/i' => '5.0 Lollipop',
        '/android 4.4.4/i' => '4.4.4 KitKat',
        '/android 4.4.3/i' => '4.4.3 KitKat',
        '/android 4.4.2/i' => '4.4.2 KitKat',
        '/android 4.4.1/i' => '4.4.1 KitKat',
        '/android 4.4/i' => '4.4 KitKat',
        '/android 4.3.1/i' => '4.3.1 Jelly Bean',
        '/android 4.3/i' => '4.3 Jelly Bean',
        '/android 4.2.2/i' => '4.2.2 Jelly Bean',
        '/android 4.2.1/i' => '4.2.1 Jelly Bean',
        '/android 4.2/i' => '4.2 Jelly Bean',
        '/android 4.1.2/i' => '4.1.2 Jelly Bean',
        '/android 4.1.1/i' => '4.1.1 Jelly Bean',
        '/android 4.1/i' => '4.1 Jelly Bean',
        '/android 4.0.4/i' => '4.0.4 IceCream Sandwich',
        '/android 4.0.3/i' => '4.0.3 IceCream Sandwich',
        '/android 4.0.2/i' => '4.0.2 IceCream Sandwich',
        '/android 4.0.1/i' => '4.0.1 IceCream Sandwich',
        '/android 4.0/i' => '4.0 IceCream Sandwich',
        '/android 3.2.6/i' => '3.2.6 Honeycomb',
        '/android 3.2.5/i' => '3.2.5 Honeycomb',
        '/android 3.2.4/i' => '3.2.4 Honeycomb',
        '/android 3.2.3/i' => '3.2.3 Honeycomb',
        '/android 3.2.2/i' => '3.2.2 Honeycomb',
        '/android 3.2.1/i' => '3.2.1 Honeycomb',
        '/android 3.2/i' => '3.2 Honeycomb',
        '/android 3.1/i' => '3.1 Honeycomb',
        '/android 3.0/i' => '3.0 Honeycomb',
        '/android 2.3.7/i' => '2.3.7 Gingerbread',
        '/android 2.3.6/i' => '2.3.6 Gingerbread',
        '/android 2.3.5/i' => '2.3.5 Gingerbread',
        '/android 2.3.4/i' => '2.3.4 Gingerbread',
        '/android 2.3.3/i' => '2.3.3 Gingerbread',
        '/android 2.3.2/i' => '2.3.2 Gingerbread',
        '/android 2.3.1/i' => '2.3.1 Gingerbread',
        '/android 2.3/i' => '2.3 Gingerbread',
        '/android 2.2.3/i' => '2.2.3 Froyo',
        '/android 2.2.2/i' => '2.2.2 Froyo',
        '/android 2.2.1/i' => '2.2.1 Froyo',
        '/android 2.2/i' => '2.2 Froyo',
        '/android 2.1/i' => '2.1 Eclair',
        '/android 2.0.1/i' => '2.0.1 Eclair',
        '/android 2.0/i' => '2.0 Eclair',
        '/android 1.6/i' => '1.6 Donut',
        '/android 1.5/i' => '1.5 Cupcake',
        '/android 1.1/i' => '1.1',
        '/android 1.0/i' => '1.0',
      ];
      // Match android version
      foreach($data as $pattern => $version) {
        if(preg_match($pattern, $this->userAgent)) {
          return $version;
        }
      }
    } else if($this->os == 'iOS') {
      // List of all iOS version
      $data = [
        '/OS 14_6/i' => 'iOS 14.6',
        '/OS 14_5_1/i' => 'iOS 14.5.1',
        '/OS 14_5/i' => 'iOS 14.5',
        '/OS 14_4_2/i' => 'iOS 14.4.2',
        '/OS 14_4_1/i' => 'iOS 14.4.1',
        '/OS 14_4/i' => 'iOS 14.4',
        '/OS 14_3/i' => 'iOS 14.3',
        '/OS 14_2_1/i' => 'iOS 14.2.1',
        '/OS 14_2/i' => 'iOS 14.2',
        '/OS 14_1/i' => 'iOS 14.1',
        '/OS 14_0_1/i' => 'iOS 14.0.1',
        '/OS 14_0/i' => 'iOS 14.0',
        '/OS 13_7/i' => 'iOS 13.7',
        '/OS 13_6_1/i' => 'iOS 13.6.1',
        '/OS 13_6/i' => 'iOS 13.6',
        '/OS 13_5_1/i' => 'iOS 13.5.1',
        '/OS 13_5/i' => 'iOS 13.5',
        '/OS 13_4_1/i' => 'iOS 13.4.1',
        '/OS 13_4/i' => 'iOS 13.4',
        '/OS 13_3_1/i' => 'iOS 13.3.1',
        '/OS 13_3/i' => 'iOS 13.3',
        '/OS 13_2_3/i' => 'iOS 13.2.3',
        '/OS 13_2_2/i' => 'iOS 13.2.2',
        '/OS 13_2_1/i' => 'iOS 13.2.1',
        '/OS 13_2/i' => 'iOS 13.2',
        '/OS 13_1_3/i' => 'iOS 13.1.3',
        '/OS 13_1_2/i' => 'iOS 13.1.2',
        '/OS 13_1_1/i' => 'iOS 13.1.1',
        '/OS 13_1/i' => 'iOS 13.1',
        '/OS 13_0/i' => 'iOS 13.0',
        '/OS 12_0/i' => 'iOS 12',
        '/OS 12/i' => 'iOS 12',
        '/OS 11_0/i' => 'iOS 11',
        '/OS 11/i' => 'iOS 11',
        '/OS 10_3_3/i' => 'iOS 10.3.3',
        '/OS 10_3/i' => 'iOS 10.3',
        '/OS 10_0_1/i' => 'iOS 10.0.1',
        '/OS 10_0/i' => 'iOS 10',
        '/OS 10/i' => 'iOS 10',
        '/OS 9_3_5/i' => 'iOS 9.3.5',
        '/OS 9_3_3/i' => 'iOS 9.3.3',
        '/OS 9_3_2/i' => 'iOS 9.3.2',
        '/OS 9_2_1/i' => 'iOS 9.2.1',
        '/OS 9_2/i' => 'iOS 9.2',
        '/OS 9_1/i' => 'iOS 9.1',
        '/OS 9_0_2/i' => 'iOS 9.0.2',
        '/OS 9_0_1/i' => 'iOS 9.0.1',
        '/OS 9_0/i' => 'iOS 9',
        '/OS 9/i' => 'iOS 9',
        '/OS 8_4_1/i' => 'iOS 8.4.1',
        '/OS 8_4/i' => 'iOS 8.4',
        '/OS 8_3/i' => 'iOS 8.3',
        '/OS 8_2_2/i' => 'iOS 8.2.2',
        '/OS 8_2/i' => 'iOS 8.2',
        '/OS 8_1_3/i' => 'iOS 8.1.3',
        '/OS 8_1_2/i' => 'iOS 8.1.2',
        '/OS 8_1_1/i' => 'iOS 8.1.1',
        '/OS 8_1/i' => 'iOS 8.1',
        '/OS 8_0_2/i' => 'iOS 8.0.2',
        '/OS 8_0/i' => 'iOS 8',
        '/OS 8/i' => 'iOS 8',
        '/OS 7_1_6/i' => 'iOS 7.1.6',
        '/OS 7_1_2/i' => 'iOS 7.1.2',
        '/OS 7_1_1/i' => 'iOS 7.1.1',
        '/OS 7_1/i' => 'iOS 7.1',
        '/OS 7_0_6/i' => 'iOS 7.0.6',
        '/OS 7_0_5/i' => 'iOS 7.0.5',
        '/OS 7_0_4/i' => 'iOS 7.0.4',
        '/OS 7_0_3/i' => 'iOS 7.0.3',
        '/OS 7_0_2/i' => 'iOS 7.0.2',
        '/OS 7_0_1/i' => 'iOS 7.0.1',
        '/OS 7_0/i' => 'iOS 7',
        '/OS 7/i' => 'iOS 7',
        '/OS 6_1_6/i' => 'iOS 6.1.6',
        '/OS 6_0/i' => 'iOS 6',
        '/OS 6/i' => 'iOS 6',
        '/OS 5_1_1/i' => 'iOS 5.1.1',
        '/OS 5_1/i' => 'iOS 5.1',
        '/OS 5_0_1/i' => 'iOS 5.0.1',
        '/OS 5_0/i' => 'iOS 5',
        '/OS 5/i' => 'iOS 5',
        '/OS 4_3_5/i' => 'iOS 4.3.5',
        '/OS 4_3_3/i' => 'iOS 4.3.3',
        '/OS 4_3_2/i' => 'iOS 4.3.2',
        '/OS 4_2_1/i' => 'iOS 4.2.1',
        '/OS 4_2/i' => 'iOS 4.2',
        '/OS 4_0/i' => 'iOS 4',
        '/OS 4/i' => 'iOS 4',
        '/OS 3_2_2/i' => 'iOS 3.2.2',
        '/OS 3_2_1/i' => 'iOS 3.2.1',
        '/OS 3_2/i' => 'iOS 3.2',
        '/OS 3_1_3/i' => 'iOS 3.1.3',
        '/OS 3_0/i' => 'iOS 3',
        '/OS 3/i' => 'iOS 3',
        '/OS 2_1_1/i' => 'iOS 2.2.1',
        '/iPhone/i' => 'iOS',
        '/iPad/i' => 'iOS',
      ];
      // Match iOS version
      foreach($data as $pattern => $version) {
        if(preg_match($pattern, $this->userAgent)) {
          return $version;
        }
      }
    } else if($this->os == 'Windows') {
      // List of all windows version
      $data = [
        '/windows nt 10.0/i' => 'Windows 10',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows xp/i' => 'Windows XP',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
      ];
      // Match windows version
      foreach($data as $pattern => $version) {
        if(preg_match($pattern, $this->userAgent)) {
          return $version;
        }
      }
    } else {
      // Other os version
      $data = [
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux X86_64/i' => 'Linux 64-Bit',
        '/linux i386/i' => 'Linux 32-Bit',
        '/linux i686/i' => 'Linux 32-Bit'
      ];
      foreach($data as $pattern => $version) {
        if(preg_match($pattern, $this->userAgent)) {
          return $version;
        }
      }
    }
    return NULL;
  }

  /**
   * Parse browser from user agent string
   *
   * @return string|null
   */
  private function getBrowser() {
    // List of all browsers
    $data = [
      '/msie/i' => 'Internet Explorer',
      '/edge/i' => 'Edge',
      '/firefox/i' => 'Firefox',
      '/SamsungBrowser/i' => 'SamsungBrowser',
      '/UCBrowser/i' => 'UCBrowser',
      '/MiuiBrowser/i' => 'MiuiBrowser',
      '/opera/i' => 'Opera',
      '/netscape/i' => 'Netscape',
      '/maxthon/i' => 'Maxthon',
      '/konqueror/i' => 'Konqueror',
      '/YaBrowser/i' =>  'Yandex Browser',
      '/MxBrowser/i' =>  'MxBrowser',
      '/Chrome/i' =>  'Chrome',
      '/safari/i' => 'Safari',
      '/mobile/i' => 'Handheld Browser'
    ];
    // Match browser
    foreach($data as $pattern => $browser) {
      if(preg_match($pattern, $this->userAgent)) {
        return $browser;
      }
    }
    return NULL;
  }

  /**
   * Parse browser version from user agent string
   *
   * @return string|null
   */
  private function getBrowserVersion() {
    $browser = $this->browser;
    $known = array('version', $browser, 'other');
    $pattern = '#(?<browser>'. join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

    if (!preg_match_all($pattern, $this->userAgent, $matches)) {
      // We have no matching number just continue
    }

    // Get browser version from matched pattern
    $i = count($matches['browser']);
    if($i != 1) {
      if(strripos($this->userAgent, 'version') < strripos($this->userAgent, $browser)) {
        $version = $matches['version'][0];
      } else {
        $version = $matches['version'][1];
      }
    } else {
      $version = $matches['version'][0];
    }

    if($version == null || $version == '') {
      return NULL;
    } else {
      return $version;
    }
  }

  /**
   * Parse device type from user agent string
   *
   * @return string|null
   */
  private function getDeviceType() {
    // List of all device types
    $data = [
      '/blackberry|BB/i' => 'Phone',
      '/android/i' => 'Phone',
      '/iphone/i' => 'iPhone',
      '/ipod/i' => 'iPod',
      '/ipad/i' => 'iPad',
      '/webos/i' => 'Mobile',
      '/tablet/i' => 'Tablet',
      '/windows|win32/i' => 'Computer',
      '/macintosh|mac os x|mac_powerpc/i' => 'Computer',
      '/linux|unix/i' => 'Computer',
    ];
    // Match device type
    foreach($data as $pattern => $type) {
      if(preg_match($pattern, $this->userAgent)) {
        return $type;
      }
    }
    return NULL;
  }

  /**
   * Parse device brand from userAgent
   *
   * @return string|null
   */
  private function getDeviceBrand() {
    // List of all device brands
    $data = [
      '/iPhone|iPad|iPod|macintosh|Apple/i' => 'Apple',
      '/SAMSUNG|SM-/i' => 'Samsung',
      '/Sony/i' => 'Sony',
      '/LG/i' => 'LG',
      '/Xiaomi|Redmi/i' => 'Xiaomi',
      '/realme|RMX/i' => 'Realme',
      '/Oppo/i' => 'Oppo',
      '/Vivo/i' => 'Vivo',
      '/Lenovo/i' => 'Lenovo',
      '/karbonn/i' => 'Karbonn',
      '/Panasonic/i' => 'Panasonic',
      '/OnePlus/i' => 'OnePlus',
      '/Nokia/i' => 'Nokia',
      '/Motorola|Moto/i' => 'Motorola',
      '/Meizu/i' => 'Meizu',
      '/Lava/i' => 'Lava',
      '/Intex/i' => 'intex',
      '/HTC/i' => 'HTC',
      '/Google|Pixel/i' => 'Google',
      '/Nexus/i' => 'Nexus',
      '/Gionee/i' => 'Gionee',
      '/BlackBerry|BB/i' => 'BlackBerry',
      '/Asus/i' => 'Asus',
      '/Huawei/i' => 'Huawei',
      '/Micromax/i' => 'Micromax',
      '/Lyf/i' => 'Lyf',
      '/Infinix/i' => 'Infinix',
      '/Tecno/i' => 'Tecno',
      '/ZTE/i' => 'ZTE',
    ];
    // Match device brand
    foreach($data as $pattern => $brand) {
      if(preg_match($pattern, $this->userAgent)) {
        return $brand;
      }
    }
    return NULL;
  }

  /**
   * Checking user is referred or not
   *
   * @return string|null
   */
  private function getReferrer() {
    return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL;
  }
}
?>

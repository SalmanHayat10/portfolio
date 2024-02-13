<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * PHP version 5
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  Component
 * @package   Special
 * @author    Mohammed Sufyan Shaikh <mohammed.sufyan@actonate.com>
 * @copyright 2017 Copyright (c) Actonate Pvt. Ltd.
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id$
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 */
namespace App\Controller\Component;


use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;
use Cake\Utility\Security;
use Cake\Network\Http\Client;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Cookie\CookieCollection;
use Cake\I18n\Date;

/**
 * Special Component
 *
 * @category Component
 * @package  Special
 * @author   Mohammed Sufyan Shaikh <mohammed.sufyan@actonate.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     https://www.actonate.com/
 */

class SpecialComponent extends Component
{
    // public $components = [];
    /**
     *  Universal Unique Indentifier v4
     *    DATE: 30th January 2017
     *
     * @return uuid
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public static function UUIDv4()
    {
        return sprintf(
            '%s-%04x-%04x-%04x-%04x%04x%04x',
            substr(uniqid('', true), 0, 8), //UUIDv1 Based on time
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }


    /**
     *  Generate Random Order Code
     *    DATE: 30th January 2017
     *
     * @param string $startString Prefix For OrderCode
     *
     * @return string
     * @author Mohammed Sufyan <sufyan@ascendtis.com>
     */
    public static function getOrderCode($startString = "F", $length = 4)
    {
        return strtoupper(
            $startString.
            substr(
                hash('sha256', mt_rand() . microtime()), 0, $length
            )
        );
    }


    /**
     *  Get referre Code
     *    DATE: 18th March 2017
     *
     * @param string $prefix Prefix For Referre code
     *
     * @return string
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public static function getReferCode($prefix = "LS")
    {
        return strtoupper(
            $prefix.
            substr(
                hash('sha256', mt_rand() . microtime()), 0, 10
            )
        );
    }

    /**
     *  Get Random String
     *    DATE: 18th March 2017
     *
     * @param integer $length Length of Password
     *
     * @return string
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public static function generateString($length = 8)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
                ."abcdefghijklmnopqrstuvwxyz"
                ."0123456789@$&-=";
        $str = substr(str_shuffle($chars), 0, $length);
        return $str;
    }


    /**
     * Return Only Unique Values of Array
     *
     *    DATE: 8th February 2017
     *
     * @param array  $array Pass Array
     * @param string $key   Pass Key For array
     *
     * @return array
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public static function uniqueArray($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }


    /**
     * Image Base Url
     *
     * @return string URL
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public static function getBaseImageUrl()
    {
        return "https://ls-cdn.letsshave.com/products/";
        // return "http://192.168.0.120/public_html/
        //divya/letsshave_aws/polkadot/files/";
    }
	

    /**
     *   Get Image Sizes
     *
     * @param string $size Size of Image
     *
     * @return string URL
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public static function getImageSize($size = null)
    {
        $tmp = null;
        switch($size) {
        case "SM": $tmp = "small";
            break;
        case "F": $tmp = "full";
            break;

        default: $tmp = "";
        }
        return $tmp;
    }


    /**
     *   Get Sorted MultiDimensional Array
     *
     * @param string $keyPass   Key of Array Element
     * @param array  $arr       Array to sort
     * @param string $sortOrder Sort Order Asscending or Descending
     *
     * @return array sorted
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public function sortMultiArray($keyPass,$arr = array(),$sortOrder = "ASC")
    {
        $this->keyPass = $keyPass;
        $this->sortOrder = $sortOrder;
        if ($sortOrder === "ASC") {
            $ORDER = 4; //Asscending
        } else if ($sortOrder === "DESC") {
            $ORDER = 3; //Descending
        } else {
            return "Invalid Sort Order. Hint [ASC,DESC]";
        }

        // PHP 7.0 Version [Anonymous Spaceship Operator]
        usort($arr, function ($item1, $item2) {
            if ($this->sortOrder == 'ASC') {
                return $item1[$this->keyPass] > $item2[$this->keyPass];
            } else if ($this->sortOrder == 'DESC') {
                return $item1[$this->keyPass] < $item2[$this->keyPass];                
            }
        });

        if (empty($arr) or empty($keyPass)) {
            return $arr;
        }
        return $arr;
    }


    /**
     * Get Configs of Particular Page
     *
     * @param string $alias URL/Page Name
     *
     * @return void
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public function getConfigs($alias = null)
    {
        //Model->TableName
        $configs = TableRegistry::get('Configs');

        $tmp = $configs->findByAlias($alias)
            ->first();
        $tmp = json_decode($tmp['config'], true);
        return $tmp;
    }


    /**
     * Get Cookie
     *
     * @param string $key Key To Access Cookie
     *
     * @return cookie value
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public function getCookie($key = null)
    {
        if (isset($_COOKIE[$key]) && !empty($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return null;
        }
        // $cookie = \Cake\Http\Cookie\Cookie();
        // $cookie = Cookie::createFromHeaderString($key);
        // $str = $cookie::read();
        // return $cookie->getValue($key);
        // return $cookie->getValue($key);
        // return $req->getCookie($key);
        // Cookie::
    }


    /**
     *   Set Cookie Wrapper
     *
     * @param string $key   Key For Cookie
     * @param string $value Value For Cookie
     *
     * @return cookie value
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public function setCookie($key = null, $value = null)
    {
        setcookie($key, $value, time() + (86400 * 30 * 60), "/"); // 86400 = 1 day
        // Cookie::setDefaults(
        //     [
        //         'expires' => '+60 days',
        //         'httpOnly' => false
        //     ]
        // );
        // // $guestID = $this->request->getCookie('guestCookie');
        // $cookie = Cookie::create($key, $value, [
        //     'expires' => new Date(strtotime('+60 days')),
        //     'http' => true,
        // ]);
        
        // // $cookie = (new Cookie($key))
        // //     ->withValue($value)
        // //     ->withExpiry(new Date(strtotime('+60 days')))
        // //     ->withPath('/')
        // //     ->withHttpOnly(false);

        // // $cookies = new CookieCollection([$cookie]);
        // return $cookie->getValue();
    }



    /**
     * Remove Cookie
     *
     * @param string $key Key To Remove Cookie
     *
     * @return cookie value
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public function deleteCookie($key = null)
    {
        setcookie($key, "", time() - 3600);
    }

    /**
     * Remove Cookie
     *
     * @param string $key Key To Check Cookie
     *
     * @return cookie value
     * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
     */
    public function isCookieExists($key = null)
    {   
        if (isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
        // $cookie = new Cookie($key);
        // $this->log("Cookie:");
        // $this->log($cookie->getValue());

        // if ($cookie::check($key)) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    /**
     *   Set Session
     *
     * @param string $key   Key of session
     * @param string $value Value to store in Session
     *
     * @return session
     */
    public function setSession($key = null, $value = null)
    {
        $session = $this->request->session();
        return $session->write($key, $value);
        // return $this->getSession($key);
    }


    /**
     *   Get Session
     *
     * @param string $key Key
     *
     * @return session
     */
    public function getSession($key = null)
    {
        $session = $this->request->session();
        return $session->read($key);
    }


    /**
     *   Get Session
     *
     * @param string $key Key
     *
     * @return session
     */
    public function deleteSession($key = null)
    {
        $session = $this->request->session();
        return $session->delete($key);
    }

    /**
     *   Check Session
     *
     * @param string $key Key
     *
     * @return session
     */
    public function checkSession($key = null)
    {
        $session = $this->request->session();
        return $session->check($key);
    }

    /**
     * Get UrlSlug
     * @param string $str urlSlug
     * 
     * @return string
     */
    public function getUrlSlug($str = null)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($str, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
        // $urlSlug = strtolower($str);
        // $urlSlug = str_replace(" ","-",$urlSlug);
        // $urlSlug = str_replace("?","",$urlSlug);
        // $urlSlug = str_replace("&","",$urlSlug);
        // $urlSlug = str_replace("(","",$urlSlug);
        // $urlSlug = str_replace(")","",$urlSlug);
        // $urlSlug = str_replace("'","",$urlSlug);
        // $urlSlug = str_replace(":","",$urlSlug);
        // $urlSlug = str_replace("™","",$urlSlug);
        // $urlSlug = str_replace(",","",$urlSlug);
        // $urlSlug = str_replace("+","",$urlSlug);
        // $urlSlug = str_replace("#","",$urlSlug);
        // $urlSlug = str_replace("@","",$urlSlug);
        // $urlSlug = str_replace("`","",$urlSlug);
        // $urlSlug = str_replace("*","",$urlSlug);
        // $urlSlug = str_replace("|","-",$urlSlug);
        // $urlSlug = str_replace("'","",$urlSlug);
        
        // return $urlSlug;
    }

    /**
     *   Hash my password
     *
     * @param string $password Password of User
     *
     * @return Encrypted Password
     */
    public function encryptPassword($password = null)
    {
        return Security::hash($password, 'sha1', true);
    }

 
    public static function getCode($startString = "vimeo-", $length = 6)
    {
        return strtoupper(
            $startString.
            substr(
                hash('sha256', mt_rand() . microtime()), 0, $length
            )
        );
    }

    public function getOTP($number = 4) {
        return substr(str_shuffle("0123456789"), 0, $number);
    }

    public function getSocialUsername($firstName = '', $lastName = '') {
        $username = strtolower($firstName).'_'.strtolower($lastName).$this->getOTP(3);
        $username = str_replace(' ', '', $username);
        return $username;
    }

    public function getHourMinFromSec($seconds = 0) {
        return gmdate("H:i:s", $seconds);
    }

    public function numToText($num = 1) {
        $txt = $num;
        $txtArr = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        if (isset($txtArr[$num])) {
            return $txtArr[$num];
        }
        return $txt;
    }
}
?>
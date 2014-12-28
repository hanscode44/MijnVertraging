<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 28-12-2014
 * Time: 22:25
 */

class PostCookie extends Singleton{
    /**
     * @return mixed
     */
    private $postCookieValue;
    public function getPostCookieValue($postCookieName)
    {
        if(isset($_COOKIE[$postCookieName]) || isset($_POST[$postCookieName])) {
            if (isset($_POST[$postCookieName])) {
                $this->postCookieValue = $_POST[$postCookieName];
            } else {
                $this->postCookieValue = $_COOKIE[$postCookieName];
            }
            return $this->postCookieValue;
        }
    }

    /**
     * @param mixed $huidigStation
     */
    public function setPostCookieValue($cookieName,$cookieValue)
    {
            ob_start();
            setcookie($cookieName, $cookieValue, time() + (60 * 60 * 24 * 30), '/'); // 30 dagen
    }



} 
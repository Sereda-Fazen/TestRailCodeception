<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 26.05.16
 * Time: 9:57
 */

namespace Page;


class LoginMowDirect
{
    public static $URL = '/customer/account/login/';
    public static $emailAddress = '#email';
    public static $password = '#pass';
    public static $loginButton = '#send2';
    public static $wait = '//*[@class="welcome-msg"]//strong';
    public static $logoutLink = './/*[@id="md_top_links_ul"]/li[3]/a[2]';

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public function loginMowDirect($email, $pass)
    {
        $I= $this ->tester;
        $I->amOnPage(self::$URL);
        $I->fillField(self::$emailAddress, $email);
        $I->fillField(self::$password,$pass);
        $I->click(self::$loginButton);
        $I->waitForElement(self::$wait);
        $I->see('Hello',self::$wait);
        return $this;
    }

    public function  logoutMowDirect(){
        $I= $this ->tester;
        $I->waitForElement(self::$logoutLink);
        $I->click(self::$logoutLink);
    }



}
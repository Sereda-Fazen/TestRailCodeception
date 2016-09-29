<?php
namespace Page;

use Exception;

class Login
{

    public static $URL = '/';
    public static $URL2 = 'customer/account/login/';
    public static $clickLogIn = '//a[@href="#header-account"]';
    public static $login = '//*[@class="links"]//li/a[text()="Log In"]';

    public static $email = '#email';
    public static $pass = '#pass';
    public static $submit = '[name="send"] > span > span';

    public static $account = '//a[@href="#header-account"]';
    public static $logout = '//*[@class="block-title"]//span/a[text()="LOGOUT"]';

    public static $msg = 'div.col-main > p';

    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }



    public function login()
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        $I->click(self::$clickLogIn);
        $I->waitAndClick(self::$login);
    }

    public function loginAccount()
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL2);

    }

    public function loginInvalid($name, $password)
    {
        $I = $this->tester;
        $I->seeInCurrentUrl(self::$URL2);
        $I->fillField(self::$email, $name);
        $I->fillField(self::$pass, $password);
        $I->click(self::$submit);
        return $this;
    }

    public function logout()
    {
        $I = $this->tester;
        $I->waitAndClick(self::$account);
        $I->waitForElementVisible(self::$logout);
        $I->click(self::$logout);
        $I->waitForElement(self::$msg);
        $I->see('You have logged out and will be redirected to our homepage in 5 seconds.',self::$msg);

    }


}
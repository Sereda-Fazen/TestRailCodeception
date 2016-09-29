<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 07.06.16
 * Time: 16:58
 */

namespace Page;


use Exception;

class ShoppingCart
{



    public static $URL = '/';
    public static $URL1 = '/checkout/cart/';
    public static $LawnTractorsLocator = '//*[@id="wp-nav-container"]/nav/ul/li[2]';
    public static $HeavyDutyTractors = '//*[@class="item2 active"]/nav/div[4]/h3/a';
    public static $assertHeavyDutyTractors = '//*[@class="mb-content"]//div/h1';
    public static $addToBasket1Button = '//*[@class="category-products"]//li[1]/div[2]/div/div[3]/p[1]';
    public static $headerBasket = '//*[@class="header-minicart"]/a';
    public static $headerPayPal = './/*[@id="ec_shortcut_cf93769374aae8421f6c6663213e364d"]/img';
    // Shopping Cart

  //  public static $assertYourBasket = '//*[@id="cart_desktop\"]/div[1]/div[1]/h1';
    public static $payPalCheckoutLink = '//div[@id="cart_mobile"]//div[3]//ul/li//img';
    public static $payPalCredit = '//div[@id="cart_mobile"]//div[3]//ul/li[2]//img';


    public static $payPalCheckoutLinkTablet = '//ul[@class="checkout-types bottom"]/li/p//img';
    public static $payPalCreditTablet = '//ul[@class="checkout-types bottom"]//li[3]//img';

    //PayPal Page
    public static $payPalLogo = '//*[@id="paypalLogo"]';
    public static $errorUnable = '//li[@class="error-msg"]';
    public static $emailField = '//*[@id="login_emaildiv"]/div[1]';
    public static $passwordField = '#password';
    public static $loginButton = '#btnLogin';

    public static $mowdirect = '//*[@id="header"]';
    public static $payPalCart = '//span[@id="transactionCart"]';
    public static $showPay = '//*[@class="transctionCartDetails ng-scope"]//h3/span[text()="MowDirect"]';


    protected $tester;
    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }


    public function payPalCheckout(){
        $I = $this->tester;
        try {
            $I->waitForElementVisible(self::$payPalCheckoutLink);
            $I->click(self::$payPalCheckoutLink);
        } catch (Exception $e) { $I->waitForElementVisible(self::$payPalCheckoutLinkTablet);
            $I->click(self::$payPalCheckoutLinkTablet);}
        try {
            $I->waitForElement(self::$errorUnable);
            $I->see('Unable to communicate with the PayPal gateway.',self::$errorUnable);
        } catch (Exception $e) {
            //$I->see('Mowdirect', self::$mowdirect);
            $I->waitForElement(self::$payPalCart);
            $I->click(self::$payPalCart);
            $I->waitForElement(self::$showPay);
        }

    }


    public function payPalCredit(){
        $I = $this->tester;
        try {
            $I->waitForElementVisible(self::$payPalCredit);
            $I->click(self::$payPalCredit);
        } catch (Exception $e) {$I->waitForElementVisible(self::$payPalCreditTablet);
            $I->click(self::$payPalCreditTablet);}
        try {
            $I->waitForElement(self::$errorUnable);
            $I->see('Unable to communicate with the PayPal gateway.',self::$errorUnable);
        } catch (Exception $e) {

            $I->see('Mowdirect', self::$mowdirect);
            $I->waitForElement(self::$payPalCart);
            $I->click(self::$payPalCart);
            $I->waitForElement(self::$showPay);

        }

    }






}
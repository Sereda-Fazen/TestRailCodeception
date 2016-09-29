<?php
namespace Page;



use Exception;

class Checkout
{

    public static $loginForm = '//div[@class="col-2"]';
    public static $email = '#login-email';
    public static $pass = '#login-password';
    public static $submit = '//div[@class="col-2"]//button/span';
   
    public static $processCheckout = '//div[@id="cart_mobile"]//button';
    public static $continue = '//div[@id="billing-buttons-container"]//button';
    public static $formList = '//ul[@class="form-list"]';
    public static $deliver = '//ul[@class="form-list"]/li[3]/label[text()="Deliver to this address"]';
    public static $differentAddress = '//ul[@class="form-list"]/li[4]/label[text()="Deliver to different address"]';

    //delivery

    public static $showDelivery = '//*[@class="section allow active"]';
    public static $useAddress = '#co-shipping-form > ul.form-list > li.control > label';
    public static $continue2 = '//div[@id="shipping-buttons-container"]//button';

    // delivery method


    public static $showMethod = '//li[@id="opc-shipping_method"]';
    public static $continue3 = '//*[@id="checkout-step-shipping_method"]//button//span[text()="Continue"]';

    //payment info

    public static $showPayment = '//li[@id="opc-payment"]';
    public static $continue4 = '//li[@id="opc-payment"]//button';
    public static $bankTransfer = '//*[@id="co-payment-form"]//dl/dt[2]/input';
    public static $payPalCredit = '//*[@id="co-payment-form"]//dl/dt[4]/input';
    public static $errorUnable = '//li[@class="error-msg"]';
    public static $removeItem = '//div[@id="cart_mobile"]//tbody//td[2]//a';
    public static $removeItem2 = '//div[@id="cart_desktop"]//tbody//td[6]//a';

    // suge purchase

    public static $sugePurchase = '//*[@id="co-payment-form"]//dl/dt[1]/input';

    //suge switch on admin panel

    public static $inputNameCard = '//ul[@class="form-list paymentsage"]//li//input';
    public static $typeCreditCard = '//ul[@class="form-list paymentsage"]//li[2]//select';
    public static $cardNumber = '//ul[@class="form-list paymentsage"]//li[3]/div/input';
    public static $verificationNum = '//ul[@class="form-list paymentsage"]//li[5]/div//input';

    //order

    public static $showOrder = '//li[@id="opc-review"]';
    public static $yourOrder = '//*[@id="md-checkout-cart"]';
    public static $productTable = '//*[@id="checkout-review-table"]';
    public static $agree = '//p[@class="agree"]/input';

    public static $continue5 = '//li[@id="opc-review"]//button';

    // after order

    public static $seeOrder =  '//div[@class="page-title"]/h1';
    public static $keepContinue = '//div[@class="buttons-set"]/button';
    public static $mainPage = '//div[@class="page-header-container"]';


    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
        
    }

    public function loginInvalid($name, $password)
    {
        $I = $this->tester;
        $I->waitForElement(self::$loginForm);
        $I->fillField(self::$email, $name);
        $I->fillField(self::$pass, $password);
        $I->scrollDown(200);
        $I->click(self::$submit);

        return $this;
    }


    /**
     * @param $name
     * @param $password
     */
    public function checkOrder($name, $password)
    {
        $I = $this->tester;
        try {
            $I->waitAndClick('//div[@id="cart_mobile"]//button');
        } catch (Exception $e) {
            $I->waitAndClick('//ul[@class="checkout-types top"]//button');
        }

        try {
            self::loginInvalid($name, $password);
        } catch (Exception $e) {
        }

        $I->waitForText('Checkout');
        $I->getVisibleText('Billing Information');
        $I->seeElement(self::$formList);
        $I->seeElement(self::$deliver);
        $I->seeElement(self::$differentAddress);
        $I->scrollDown(200);
        $I->waitForElement(self::$continue);
        $I->click(self::$continue);
        $I->waitForElementNotVisible('//*[@id="billing-please-wait"]');

        $I->waitForElement(self::$showDelivery);
        $I->waitForText('Delivery Information');
        $I->waitForElement(self::$useAddress);
        $I->scrollDown(200);
        try {
            $I->waitAndClick(self::$continue2);
        } catch (Exception $e) {
        }

        $I->waitForElement(self::$showMethod);
        $I->waitForText('Delivery Method');
        $I->waitForElementVisible(self::$continue3);
        $I->waitForElement(self::$continue3);
        $I->click(self::$continue3);

        $I->waitForElement(self::$showPayment);
        $I->waitForText('Payment Information');
        $I->waitForElementVisible(self::$continue4);

        $I->wait(2);
    }

    public function mobilePayment($name, $password)
    {
        $I = $this->tester;
        self::checkOrder($name, $password);
        $I->scrollTo('div.md-our-proposition',300);
        $I->waitAndClick(self::$bankTransfer);
        $I->waitAndClick(self::$continue4);
        try{
            $I->scrollTo('div.md-our-proposition',300);
            $I->click(self::$continue4);
            $I->scrollTo(self::$continue4,100);
            $I->click(self::$continue4);
        }catch (Exception $e){}

        $I->waitForElement(self::$showOrder);
        $I->waitForText('Order Review');
        $I->waitForElement(self::$yourOrder);
        $I->getVisibleText('YOUR SELECTION');
        $I->getVisibleText('INVOICE ADDRESS');
        $I->getVisibleText('DELIVERY ADDRESS');
        $I->getVisibleText('DELIVERY METHOD');
        $I->getVisibleText('PAYMENT METHOD');
        $I->getVisibleText('Cheque or Bank Transfer');
        $I->waitForElement(self::$productTable);

        $I->waitForElement(self::$agree);
        $I->wait(2);
        $I->scrollTo('div.md-our-proposition',300);

        $I->waitAndClick(self::$agree);

        $I->scrollDown(200);
        $I->waitForElementVisible(self::$continue5);

        $I->click(self::$continue5);
        $I->waitForText('Your order has been received.',30);
        $I->see('Your order has been received.',self::$seeOrder);
        $I->getVisibleText('Thank you for your purchase!');
        $I->click(self::$keepContinue);
        $I->waitForElement(self::$mainPage);


    }

    public function mobilePaymentAccessories($name, $password)
    {
        $I = $this->tester;
        self::checkOrder($name, $password);
        $I->scrollTo('div.md-our-proposition',300);
        $I->waitForElement(self::$bankTransfer);
        $I->click(self::$bankTransfer);
        $I->waitForElement(self::$continue4);
        $I->click(self::$continue4);
        try{
            $I->scrollTo('div.md-our-proposition',300);
            $I->click(self::$continue4);
            $I->scrollTo(self::$continue4,100);
            $I->click(self::$continue4);
        }catch (Exception $e){}

        $I->waitForElement(self::$showOrder);
        $I->waitForText('Order Review');
        $I->waitForElement(self::$yourOrder);
        $I->getVisibleText('YOUR SELECTION');
        $I->getVisibleText('INVOICE ADDRESS');
        $I->getVisibleText('DELIVERY ADDRESS');
        $I->getVisibleText('DELIVERY METHOD');
        $I->getVisibleText('PAYMENT METHOD');
        $I->getVisibleText('Cheque or Bank Transfer');
        $I->waitForElement(self::$productTable);

        $I->waitForElement(self::$agree);
        $I->wait(2);
        $I->scrollTo('div.md-our-proposition',300);

        $I->waitAndClick(self::$agree);
        $I->waitAndClick('//dl[@class="item-options"]/dt[text()="Optional Accessories:"]');

        $I->scrollDown(200);
        $I->waitForElementVisible(self::$continue5);

        $I->click(self::$continue5);
        $I->waitForText('Your order has been received.',30);
        $I->see('Your order has been received.',self::$seeOrder);
        $I->getVisibleText('Thank you for your purchase!');
        $I->click(self::$keepContinue);
        $I->waitForElement(self::$mainPage);
    }

    public function checkPayPalCredit($name, $password)
    {
        $I = $this->tester;
        self::checkOrder($name, $password);
        $I->waitAndClick(self::$payPalCredit);
        $I->wait(2);
        $I->click(self::$continue4);
        try {
            $I->waitForElement(self::$errorUnable);
            $I->see('Unable to communicate with the PayPal gateway.',self::$errorUnable);
            try {$I->click(self::$removeItem);} catch (Exception $e) {$I->click(self::$removeItem2);}
            $I->waitForText('Your Basket is empty...');
        } catch (Exception $e){}


    }

    public function checkSugePurchase($name, $password, $card, $numCard, $verNum)
    {
        $I = $this->tester;
        self::checkOrder($name, $password);
        $I->waitAndClick(self::$sugePurchase);
        $I->wait(2);
        $I->click(self::$continue4);

        try {
            $I->scrollTo('div.md-our-proposition',300);
            $I->click(self::$continue4);
            $I->scrollTo(self::$continue4,100);
            $I->click(self::$continue4);
            $I->getVisibleText('This is a required field.');
            $I->getVisibleText('Card type doesn\'t match credit card number');
            $I->fillField(self::$inputNameCard, 'Test');
            $I->selectOption(self::$typeCreditCard, $card);
            $I->fillField(self::$cardNumber, $numCard);
            $I->fillField(self::$verificationNum, $verNum);
            $I->scrollTo('div.md-our-proposition',300);
            $I->click(self::$continue4);
        } catch (Exception $e){}

        $I->waitForElement(self::$showOrder);
        $I->waitForText('Order Review');
        $I->waitForElement(self::$yourOrder);
        $I->getVisibleText('YOUR SELECTION');
        $I->getVisibleText('INVOICE ADDRESS');
        $I->getVisibleText('DELIVERY ADDRESS');
        $I->getVisibleText('DELIVERY METHOD');
        $I->getVisibleText('PAYMENT METHOD');
        $I->getVisibleText('Cheque or Bank Transfer');

        $I->waitForElement(self::$productTable);

        $I->wait(2);
        $I->scrollTo('div.md-our-proposition',300);
        $I->waitAndClick(self::$agree);

        $I->waitForElementVisible(self::$continue5);
        $I->click(self::$continue5);

        try {
            $I->wait(5);
            $I->acceptPopup();
            $I->amOnPage('/checkout/cart/');
            try { $I->click(self::$removeItem);} catch (Exception $e) {$I->click(self::$removeItem2);}
            $I->waitForText('Your Basket is empty...');
        } catch (Exception $e) {
        }
    }

}
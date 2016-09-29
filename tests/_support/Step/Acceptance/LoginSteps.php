<?php
namespace Step\Acceptance;

use Exception;
use \Codeception\Util\Locator;

class LoginSteps extends \AcceptanceTester
{

    public function checkExistUser()
    {
        $I = $this;
        $grabMsg = $I->grabTextFrom('//ul[@class="messages"]');
        if (preg_match('/Thank you for registering with Denimio./i', $grabMsg) == 1) {
            $I->see('Thank you for registering with Denimio.', '//ul[@class="messages"]');
        } else {
            $I->see('There is already an account with this email address. ', '//ul[@class="messages"]');
        }
    }

    public function login()
        {
            $I = $this;
            $I->amOnPage('/');
            $I->click('//a[@class="login_click"]');
            $I->waitForElement('#email');
            $I->fillField('#email', 'denimio_test@yahoo.com');
            $I->fillField('#pass', '123456');
            $I->click('Login');
            $I->see('From your My Account Dashboard','div.welcome-msg > p:nth-of-type(2)');
        }



        public function deleteAddresses ()
        {
            $I = $this;
            $count = count($I->grabMultiple('//*[@class="col-2 addresses-additional"]/ol/li'));
            for ($d = $count; $d > 0; $d--) {
                $this->scrollDown(1000);
                $I->click('ol > li:nth-of-type(' . $d . ') > p > a.link-remove');
                $I->acceptPopup();
                $I->waitForElement('li.success-msg');
            }
        }

    public function loginSuccess ($login,$pass)
    {
        $I = $this;

            $I->amOnUrl('http://www.mowdirect.co.uk/');
            $I->waitForElement('//div[@class="skip-links"]/a[3]');
            $I->click('//div[@class="skip-links"]/a[3]');
            $I->waitForElement('//div[@class="links"]//li[6]/a');
            $I->click('//div[@class="links"]//li[6]/a');
            $I->fillField('#email', $login);
            $I->fillField('#pass', $pass);
            $I->click('//div[@class="buttons-set"]//button/span');
            $I->waitForElement('p.hello > strong');
            $I->see('Hello    Test Test1 Test2', 'p.hello > strong');

    }

    public function cycleRate ()
    {
        $I = $this;
        $I->amOnPage('/');
        //$I->amOnUrl('http://www.mowdirect.co.uk/');
        $I->waitForElement('//div[@class="skip-links"]//a[1]');
        $I->click('//div[@class="skip-links"]//a[1]');
        $I->waitForElement('//*[@id="menu-mobile-2430"]/div[1]/span');
        $I->click('//*[@id="menu-mobile-2430"]/div[1]/span');

        $I->waitForElement('//*[@id="submenu-mobile-2430"]/div[1]');
        $I->click('//*[@id="submenu-mobile-2430"]/div[1]');
        $I->waitForElement('//*[@class="m_rom_filter_type_filter md-image-filter"]//li/a');
        $I->click('//*[@class="m_rom_filter_type_filter md-image-filter"]//li/a');
        $I->waitForElement('//div[@class="category-products"]');
        $I->click('//p[@class="rating-links"]/a[2]');
        $I->waitForElement('//div[@id="customer-reviews"]');
        $rate = count($I->grabMultiple('//*[@class="form-list"]//tbody/tr'));
        for ($r = 1; $r <= $rate; $r++) {
            $I->click('//*[@class="form-list"]//tbody/tr[' . $r . ']/td[' . rand(2, $rate) . ']/input');
            $I->wait(1);
        }


        $I->fillField('//*[@class="box-content"]//ul[2]/li//input', 'Test');
        $I->getVisibleText('Test');
        $I->fillField('//*[@class="box-content"]//ul[2]/li[2]//input', 'Test2');
        $I->getVisibleText('Test2');
        $I->fillField('//textarea[@id="review_field"]', 'Test3');
        $I->getVisibleText('Test3');
        try {
            $I->waitForElement('//div[@class="sweetcaptcha ltr"]');
        } catch (Exception $e) {
            $I->click('//*[@class="buttons-set form-buttons btn-only"]/div');
            $I->waitForElement('//li[@class="success-msg"]');
            $I->see('Your review has been accepted for moderation.', '//li[@class="success-msg"]');


            $I->waitForElement('//*[@class="fright"]//li[3]/a');
            $I->click('//*[@class="fright"]//li[3]/a');
            $I->waitForElement('//*[@class="main"]//ul/li[5]');
            $I->click('//*[@class="main"]//ul/li[5]');
            $I->waitForElement('//table[@class="data-table"]');
            $I->click('//table[@class="data-table"]//td[5]/a');
            $I->waitForElement('//div[@class="product-review"]');
            $I->waitForElement('//div[@class="product-review"]//table');
            $I->getVisibleText('FEATURES');
            $I->getVisibleText('BUILD QUALITY');
            $I->getVisibleText('ASSEMBLY');
            $I->getVisibleText('PERFORMANCE');
            $I->getVisibleText('Test');
        }
    }





}
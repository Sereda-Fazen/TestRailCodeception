<?php
namespace Step\Acceptance;


class EmailSteps extends \AcceptanceTester
{

    public function loginEmail()
    {
        $I = $this;
        $I->amOnUrl("https://mail.yahoo.com");
        $I->fillField('//*[@id="login-username"]', 'test_mowdirect@yahoo.co.uk');
        $I->click('//*[@id="login-signin"]');
        $I->waitForElementVisible('//*[@id="login-passwd"]');
        $I->fillField('//*[@id="login-passwd"]', 'fJ4qEn5Y');
        $I->click('//*[@id="login-signin"]');
        $I->waitForElement('//*[@class="list-view-items-page"]',40);
        $I->waitForText('Take a look at Test alex sereda\'s wishlist');

        $I->click('//*[@class="subject bold"]');


        $I->waitForText('Take a look at my wishlist from MowDirect.');
        $I->waitForText('Test');

        $I->waitForElement('//*[@class="icon-delete"]');
        $I->click('//*[@class="icon-delete"]');
        $I->waitForText('Your Inbox folder is empty');
        
        
    }





}
<?php
namespace Step\Acceptance;


use Exception;

class AccountSteps extends \AcceptanceTester
{

    public function loginSuccess ($login,$pass)
    {
        $I = $this;
        $I->amOnUrl('http://www.mowdirect.co.uk/');
        $I->waitForElement('//div[@class="fright"]/ul/li[3]/a[1]');
        $I->click('//div[@class="fright"]/ul/li[3]/a[1]');
        $I->fillField('#email',$login);
        $I->fillField('#pass', $pass);
        $I->click('[name="send"] > span > span');
        $I->waitForElement('p.hello > strong');
        $I->see('Hello', 'p.hello > strong');
    }


    





}
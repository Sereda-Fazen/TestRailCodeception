<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 31.05.16
 * Time: 12:56
 */

namespace Step\Acceptance;



class LoginStepsMowDirect extends \AcceptanceTester
{

    public function loginSuccess ($login,$pass)
    {
        $I = $this;
        $I->amOnPage('/');
        $I->waitForElement('//div[@class="fright"]/ul/li[3]/a[1]');
        $I->click('//div[@class="fright"]/ul/li[3]/a[1]');
        $I->fillField('#email',$login);
        $I->fillField('#pass', $pass);
        $I->click('[name="send"] > span > span');
        $I->waitForElement('p.hello > strong');
        $I->see('Hello    Test Test1 Test2', 'p.hello > strong');
    }

}
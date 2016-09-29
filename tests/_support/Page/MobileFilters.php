<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 07.06.16
 * Time: 15:27
 */

namespace Page;


class MobileFilters
{

    public static $URL = '/';
    public static $lawnTractorsLocator = '//div[@class="skip-links"]//a[1]';
    public static $clickTractors = '//*[@id="menu-mobile-2430"]/div[1]/span';
    public static $heavyDutyTractors = '//*[@id="menu-mobile-2549"]';
    public static $assertHeavyDutyTractors = '//*[@class="before-col-left"]//div/h1';





    protected $tester;


    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public function filtersCheckbox() {

        $I = $this->tester;
        //$I->amOnPage(self::$URL);
        $I->amOnUrl('http://www.mowdirect.co.uk/');
        $I->waitAndClick(self::$lawnTractorsLocator);
        $I->waitAndClick(self::$clickTractors);
        $I->waitAndClick(self::$heavyDutyTractors);
        $I->waitForElement(self::$assertHeavyDutyTractors);
        $I->see('Heavy-Duty Garden Tractors',self::$assertHeavyDutyTractors);

    }





}
<?php
namespace Page;
use \Codeception\Util\Locator;

class CategoryNavigation
{

    // T1400

    public static $lawnTractor = '//*[@id="menu-content"]/div//a/span[text()="Lawn Tractors"]';
    public static $waitTractorsPanel = '//div[@class="category-collateral lawn-garden-tractors"]';

    // T1359

    public static $menu = '.skip-links>a';
    public static $deals = '//*[@id="menu-content"]/div//a/span[text()="Deals"]';
    public static $shopNow = '.full-range-name';
    public static $bestDeals = 'ul > li:nth-of-type(2) > span > a';
    public static $clearZone = '.floating-ticket>a';

    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }



    public function home()
    {
        $I = $this->tester;
        $I->amOnPage('/');
        $I->waitAndClick(self::$menu);
        //$I->waitAndClick(Locator::combine('nav.product-navigation > ul > li:nth-of-type(2) > a','//a[@href="/lawn-garden-tractors"]'));
    }

    public function lawnTractor(){
        $I = $this->tester;
        $I->waitAndClick(self::$lawnTractor);
        $I->waitForElement(self::$waitTractorsPanel);
    }

    public function saleDepartment(){
        $I = $this->tester;
        $I->waitAndClick(self::$deals);
        $I->waitAndClick(self::$shopNow);

        $I->see('Top Deals from MowDirect!', 'h1');
        $I->seeInCurrentUrl('/sale-begins-now/top-deals-from-mowdirect');
        $I->moveBack();
        $I->seeInCurrentUrl('/sale-begins-now');
        $I->waitAndClick(self::$clearZone);
        $I->waitForText('The Clearance Zone');
        $I->see('The Clearance Zone', 'h1');
        $I->seeInCurrentUrl('/sale-begins-now/clearance-zone');
    }

}
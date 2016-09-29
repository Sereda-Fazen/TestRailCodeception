<?php
namespace Page;


class Search
{

    public static $URL = '/';
    public static $clickSearchHeader = '//*[@class="skip-links"]/a[2]/span';
    public static $search = '#search';
    public static $search2 = '//div[@class="gsc-input-box"]//input';
    public static $clickSearch = '//button[@class="button search-button"]';
    public static $clickSearch2 = '//td[@class="gsc-search-button"]';
    public static $wait = '//div[@class="std"]';

    // optional


   

    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }



    public function search()
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        $I->click(self::$clickSearchHeader);

    }

    public function searchWrong($search)
    {
        $I = $this->tester;
        $I->fillField(self::$search, $search);
        $I->click(self::$clickSearch);
        $I->waitForElement(self::$wait);
    }

    public function searchInvalid($search)
    {
        $I = $this->tester;
        $I->fillField(self::$search2, $search);
        $I->click(self::$clickSearch2);
        $I->waitForElement(self::$wait);
    }




}
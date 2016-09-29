<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 31.05.16
 * Time: 10:49
 */

namespace Page;


class SearchMowDirect
{

    public static $URL = '/';
    public static $searchField = '//*[@id="search"]';
    public static $searchField2 = '//*[@id="gsc-i-id1"]';
    public static $searchButton = '//*[@id="search_mini_form"]/div[1]/button';
    public static $searchButton2 = '//*[@id="___gcse_0"]/div/div/form/table[1]/tbody/tr/td[2]/input';
    public static $searchResultLink = '//*[@class="gsc-results gsc-webResult"]/div[1]/div[1]/div[1]/a';
    public static $noResult = '//*[@class="gsc-wrapper"]/div[2]/div/div/div[1]/div/div';

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public function searchMowDirect($searchData1,$searchData2)
    {
        $I= $this ->tester;
        $I->amOnPage(self::$URL);
        $I->fillField(self::$searchField,$searchData1);
        $I->click(self::$searchButton);
        $I->see('Husqvarna 321',self::$searchResultLink);
        $I->click(self::$searchResultLink);
        $I->fillField(self::$searchField2,$searchData2);
        $I->click(self::$searchButton2);
        $I->waitForElement(self::$noResult);
        return $this;
    }
}
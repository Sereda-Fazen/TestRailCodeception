<?php
use \Step\Acceptance;

/**
 * @group test
 */
class TestCest
{

    function T2ValidLogin(Page\CategoryNavigation $categoryNavigation, \Step\Acceptance\ProductsSteps $I)
    {
        $categoryNavigation->home();
        $categoryNavigation->saleDepartment();
    }
    
}


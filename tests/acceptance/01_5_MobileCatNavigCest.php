<?php

use \Step\Acceptance;


/**
 * @group mobileCategoryNavigation
 */
class MobileCategoryNavigationCest
{

    /**
     * @param \Page\CategoryNavigation $categoryNavigation
     * @param Acceptance\ProductsSteps $I
     * T930_Use category navigation to find the 10 top selling products
     * @internal param \Page\CategoryNavigation $category
     */

    function T1359UseCategoryNavigationToNavigateToTheVariousSaleDepartments(Page\CategoryNavigation $categoryNavigation, \Step\Acceptance\ProductsSteps $I)
    {
        $categoryNavigation->home();
        $categoryNavigation->saleDepartment();
    }

    function T1400TestTheShowNumberDropdownTopAndBottom(Page\CategoryNavigation $categoryNavigation, \Step\Acceptance\CategorySteps $I) {
        $categoryNavigation->home();
        $categoryNavigation->lawnTractor();
        $I->randomPanel();
    }

    function T1401TestTheSortByDropdownTopAndBottom(Page\CategoryNavigation $categoryNavigation, \Step\Acceptance\CategorySteps $I)
    {
        $categoryNavigation->home();
        $categoryNavigation->lawnTractor();
        $I->sortBy();

    }

    function T1402TestThePagingTopAndBottom(Page\CategoryNavigation $categoryNavigation, \Step\Acceptance\CategorySteps $I)
    {
        $categoryNavigation->home();
        $categoryNavigation->lawnTractor();
        $I->paging();

    }


    
    
    



    

}


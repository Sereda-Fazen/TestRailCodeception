<?php
namespace Step\Acceptance;

class ProductsSteps extends \AcceptanceTester
{

    /**
     * Products Layout
     */

    public function productsLayout(){
        $I = $this;
        $I->amOnPage('/');
        $I->waitAndClick('//div[@class="skip-links"]//a[1]');
        $I->waitAndClick('//*[@id="menu-mobile-2430"]/div[1]/span');
        $I->waitAndClick('//*[@rel="submenu-mobile-2505"]');

        $I->waitAndClick('//*[@id="submenu-mobile-2505"]/div[1]//span[text()="Trailers for Ride-On Mowers / Garden Tractors"]');
        $I->waitAndClick('//*[@class="item odd"]//a/img');
        $I->scrollDown(200);
        $I->waitAndClick('//*[@id="collateral-tabs"]/dt[3]');
        $I->waitForElement('//*[@class="tab-container current"]');
        $I->click('//*[@id="collateral-tabs"]/dt[4]/span[text()="Reviews"]');
        $I->waitForElement('//*[@id="customer-reviews"]');

        $I->scrollUp(300);
       
    }

    public function mobileProductsLayoutCustomOptions(){
        $I = $this;
        $I->waitAndClick('//div[@class="gsc-results gsc-webResult"]//a');
        $I->waitForElement('//div[@class="category-products"]');
        $I->click('//*[@class="products-list"]/li//a');
        $I->waitForElement('//*[@id="product-collateral-id"]');
        $I->waitForElement('//*[@class="toggle-tabs"]');
        $count = count($I->grabMultiple('//*[@class="collateral-tabs"]/dt'));
        for ($l = 1; $l <=$count; $l++){
            $I->click('//*[@class="collateral-tabs"]/dt['.$l.']');

            switch ($l){
                case 1:
                    $I->waitForElement('//*[@class="product-attributes-container"]');
                    break;
                case 2:
                    $I->waitForElement('//*[@class="tab-container current"]');
                    break;
                case 3:
                    $I->waitForElement('//*[@class="tab-container current"]');
                    break;
                case 4:
                    $I->waitForElement('//*[@class="tab-container current"]');
                    break;
                case 5:
                    $I->waitForElement('//*[@class="box-collateral box-reviews"]');
                    break;
                case 6:
                    $I->waitForElement('//*[@class="tab-content"]');
                    $I->waitForElement('//div[@id="params"]');
                    $I->selectOption('//div[@id="params"]//select', '12 Months Classic Credit (19.5% APR)');
                    $I->fillField('//div[@id="params"]/div[3]/input', '20');
                    $I->click('//div[@id="params"]/div[5]/input');

                    $I->waitForElement('//span[@id="cost_of_goods"]');
                    $I->waitForElement('//span[@id="deposit_percentage"]');
                    $I->waitForElement('//span[@id="deposit_amount"]');
                    $I->waitForElement('//span[@id="credit_amount"]');
                    $I->waitForElement('//span[@id="finance_term"][text()="12 months"]');
                    $I->waitForElement('//span[@id="apr"]');
                    $I->waitForElement('//span[@id="cost_per_month"]');
                    $I->waitForElement('//span[@id="monthly_repayment"]');
                    $I->waitForElement('//span[@id="total"]');
                    $I->waitForElement('//span[@id="loan_cost"]');
                    $I->waitForElement('//span[@id="loan_true_cost"]');



            }
        }



    }


    public function mobileLayoutBannerAdvert(){
        $I = $this;
        $I->waitAndClick('//div[@class="gsc-results gsc-webResult"]//a');
        $I->waitAndClick('//*[@class="lead-article pod"]//div[2]//figcaption/a');
        $I->waitForElement('//div[@class="widget widget-banner"]/ul/li/img');
        $I->getVisibleText('New and Exclusive');
    }





    /**
     * Category Navigation
     */

    public function amountTopCategories10()
    {
        $I = $this;
        for ($a = 1; $a <= 10; $a++) {
            $I->waitForElement('//*[@class="products-list"]/li[' . $a . ']');
        }
    }

    public function amountTopCategories25()
    {
        $I = $this;
        for ($a = 1; $a <= 25; $a++) {
            $I->waitForElement('//*[@class="products-list"]/li[' . $a . ']');
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

}
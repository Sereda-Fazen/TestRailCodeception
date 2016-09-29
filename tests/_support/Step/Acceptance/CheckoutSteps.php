<?php
namespace Step\Acceptance;
use Exception;

class CheckoutSteps extends \AcceptanceTester
{

    public function menu(){
        $I = $this;
        $I->amOnPage('/');
        $I->waitAndClick('.skip-links>a');
    }

    public function brands(){
        $I = $this;
        $I->amOnPage('/');
        $I->waitForElement('//*[@class="brands"]');
        $I->waitForElement('//*[@id="brandsViewAll"]');
    }

    public function mobileAddToBasket(){
        $I = $this;
        $I->scrollDown(200);
        $I->waitAndClick('p.action>button');
        $I->see('was added to your shopping cart.','.success-msg');
    }

    public function exceptionAddToBasket(){
        $I = $this;
        try {
            $I->waitAndClick('//div[@class="add-to-cart-buttons"]/button');
        } catch (Exception $e) {
            $I->waitAndClick('p.action>button');
        }
        $I->waitForElement('.success-msg');
        $I->see('was added to your shopping cart.','.success-msg');
    }


    /**
     * Tractor
     */
    

    public function mobileSellTractor(){
        $I = $this;
        self::menu();
        $I->waitAndClick('//a[contains(@href,"/lawn-garden-tractors")]/../span');
        $I->waitAndClick('//a[contains(@href,"/lawn-garden-tractors")]/../span/../../div/div');
        $I->click('.md-filter-image');
        self::mobileAddToBasket();


    }

    /**
     * Mower
     */

    public function mobileSellMower(){
        $I = $this;
        self::menu();

        $I->waitAndClick('//a[contains(@href,"/lawn-mowers")]/../span');
        $I->waitAndClick('//*[@id="menu-mobile-1934"]/div[1]/span/../span');
        $I->waitAndClick('//*[@id="menu-mobile-1934"]/div[1]/span/../span/../../div/div//a/span[contains(text(),"Brush Lawnmowers")]');
        self::mobileAddToBasket();

    }

    public function mobilePurchaseOtherItem()
    {
        $I = $this;
        self::menu();
        $I->waitAndClick('//*[@id="menu-mobile-2334"]/div[1]/span');
        $I->waitAndClick('//*[@id="menu-mobile-2381"]/div[1]/span');
        $I->waitAndClick('//*[@id="menu-mobile-2382"]/div/a/span');
        self::mobileAddToBasket();

    }






    public function mobileSelectBrand($qty)
    {
        $I = $this;
        for ($b =1; $b <= 2; $b++) {
        self::brands();

        $I->scrollTo('//*[@id="brandsViewAll"]', 100);
        $I->click('//*[@id="brandsViewAll"]');
        $brands = count($I->grabMultiple('//*[@id="md-brand-list"]/li'));

            $I->wait(2);
            $I->waitForElement('//*[@id="md-brand-list"]/li');
            $I->scrollDown(100);
            $I->click('//*[@id="md-brand-list"]/li['.rand(1,$brands).']/a');
            $I->waitForElement('//*[@class="mdgo-page-title main-container"]/h1');
            $I->click('//div[@class="category-collateral"]/div['.$b.']');
            try {$I->waitForElement('//*[@class="category-collateral"]/div['.$b.']/div');
                $I->click('//*[@class="category-collateral"]//div/div');} catch (Exception $e){}

            $I->scrollDown(200);

            self::exceptionAddToBasket();
        }
        
        try {
            $I->waitForElement('//div[@id="cart_mobile"]//tbody//tr[2]');
            $I->waitAndClick('//div[@id="cart_mobile"]//tbody//tr[2]//input');
            $I->waitForElementVisible('//div[@id="cart_mobile"]//tbody//tr[2]//button');
            $I->fillField('//div[@id="cart_mobile"]//tbody//tr[2]//input', $qty);
            $I->click('//div[@id="cart_mobile"]//tbody//tr[2]//button');
            $I->getVisibleText($qty, '//div[@id="cart_mobile"]//tbody//tr[2]//input');
        } catch (Exception $e) {
            $I->waitForElement('//tr[@class="last even"]');
            $I->fillField('//tr[@class="last even"]/td[4]/input',$qty);
            $I->click('//tr[@class="last even"]/td[4]/button');
            $I->getVisibleText($qty, '//tr[@class="last even"]/td[4]/input');
            
        }


    }




    public function mobileSelectBrands($qty)
    {
        $I = $this;
        for ($f = 1; $f <= 2; $f++) {

        self::brands();

        $I->scrollTo('//*[@id="brandsViewAll"]', 100);
        $I->click('//*[@id="brandsViewAll"]');

            $I->scrollTo('//*[@id="md-mobile-social-links"]');
            $I->waitAndClick('//*[@id="md-brand-list"]//img');

            $I->waitForElement('//*[@class="mdgo-page-title main-container"]/h1');
            $I->click('//div[@class="category-collateral"]/div['.$f.']');

            $I->scrollDown(200);

            self::exceptionAddToBasket();
        }

        try {
            $I->waitForElement('//div[@id="cart_mobile"]//tbody//tr[2]');
            $I->waitAndClick('//div[@id="cart_mobile"]//tbody//tr[2]//input');
            $I->waitForElementVisible('//div[@id="cart_mobile"]//tbody//tr[2]//button');
            $I->fillField('//div[@id="cart_mobile"]//tbody//tr[2]//input', $qty);
            $I->click('//div[@id="cart_mobile"]//tbody//tr[2]//button');
            $I->getVisibleText($qty, '//div[@id="cart_mobile"]//tbody//tr[2]//input');
        } catch (Exception $e) {

            $I->waitForElement('//tr[@class="last even"]');
            $I->fillField('//tr[@class="last even"]/td[4]/input',$qty);
            $I->click('//tr[@class="last even"]/td[4]/button');
            $I->getVisibleText($qty, '//tr[@class="last even"]/td[4]/input');

        }

    }
    

    public function optional(){
        $I = $this;
        self::menu();
        $I->waitAndClick('//*[@id="menu-mobile-2430"]/div[1]/span');
        $I->waitAndClick('//*[@id="submenu-mobile-2430"]/div[6]');
        $I->waitAndClick('//*[@class="products-list"]//img');
        $I->waitForElement('//*[@class="product-options"]//ul');
        $optional = count($I->grabMultiple('//*[@class="product-options"]//ul/li'));
        for ($o =1; $o <= $optional; $o++){
            $I->click('//*[@class="product-options"]//ul/li['.$o.']/input');
            $I->waitForElement('//*[@class="checkbox  product-custom-option2523 change-container-classname validation-passed"]');
        }
        self::exceptionAddToBasket();
    }



}
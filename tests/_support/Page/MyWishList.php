<?php
namespace Page;
use Codeception\Util\Locator;
use Exception;

class MyWishList
{

    public static $clickAccount = '//a[@class="skip-link skip-account"]/span';
    public static $accountMenu = '//*[@class="left-off-canvas-menu"]/div';
    public static $myWishlist = '//*[@class="block-content"]//li[6]/a';

    public static $seeEmptyList = '//div[@class="fieldset"]/p';
    public static $url = '/';
    public static $urlWishlist = 'https://www.mowdirect.co.uk/wishlist';

    // add item

    public static $ourTops = '//div[@class="best-container"]/a/div';
    public static $catProd = '//div[@class="category-products"]';
    public static $clickProd = '//ol[@class="products-list"]//img';

    public static $seeAddToWishList = '//div[@class="actions"]/ul/li[1]';
    public static $successMsg = '//li[@class="success-msg"]';
    public static $here = '//li[@class="success-msg"]//a';
    public static $urlReturn = '/';
    public static $clickProd2 = '//ol[@class="products-list"]//li[2]//a';


    public static $addNewItem = '//li[@class="item first"]';
    public static $seeLastEven = '//tr[@class="last even"]';

    // add to basket

    public static $addBasket = '//div[@class="buttons-set buttons-set2"]/button[2]';
    public static $removeFromCartMobile = '//div[@id="cart_mobile"]//table/tbody/tr/td[2]/a';
    public static $removeFromCartTablet = '//td[@class="a-center product-cart-remove last"]/a';

    public static $cart = '//*[@class="skip-links"]/div/a';
    public static $removeItem = '//*[@id="cart_mobile"]//tbody//td[2]/a';
    public static $removeItem2 = '//tr[@class="first last odd"]/td[6]/a';

    //remove

    public static $clickRemove = '//tr[@class="last even"]/td[6]/a';
    public static $clickRemoveFirst = '//tr[@class="first last odd"]/td[6]/a';

    // add comment

    public static $textarea = '//tr[@class="first last odd"]//textarea';
    public static $updateComment = '//tr[@class="first last odd"]/td[2]/div[2]/button';

    // add share

    public static $clickShare = '//div[@class="buttons-set buttons-set2"]/button';
    public static $inputEmail = '//ul[@class="form-list"]//textarea';
    public static $inputComment = '//ul[@class="form-list"]/li[2]//textarea';
    public static $shareWishlist = '//*[@class="buttons-set form-buttons"]/button';


    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function wishList(){
        $I = $this->tester;
        $I->waitAndClick(self::$clickAccount);
        $I->waitForElement(self::$accountMenu);
        $I->wait(2);
        $I->click(self::$accountMenu);
        $I->waitAndClick(self::$myWishlist);
        $I->waitForElement(self::$seeEmptyList);
        $I->see('You have no items in your wishlist.',self::$seeEmptyList);

    }


    public function checkItems(){
        $I = $this->tester;
        $I->amOnPage(self::$url);
        $I->scrollDown(300);
        $I->waitAndClick(self::$ourTops);
        $I->waitForElement(self::$catProd);
        $I->click(self::$clickProd);
        $I->waitAndClick(self::$seeAddToWishList);
        $I->getVisibleText('My Wishlist');
        $I->waitForElement(self::$successMsg);

    }

/*
    public function removeItemFromWishList(){
        $I = $this->tester;
        $I->waitForElement(self::$clickRemove);
        $I->click(self::$clickRemove);
        $I->acceptPopup();
        $I->waitForElementNotVisible(self::$seeLastEven);
        $I->dontSeeElement(self::$seeLastEven);
    }
*/

    public function addComment(){
        $I =$this->tester;
        $I->waitForElement(self::$textarea);
        $I->fillField(self::$textarea, 'Test');
        $I->click(self::$updateComment);
        $I->getVisibleText(self::$textarea, 'Test');
    }

    public function addShare(){
        $I = $this->tester;
        $I->waitAndClick(self::$clickShare);
        $I->waitForText('Share Your Wishlist');
        $I->click(self::$shareWishlist);
        $I->getVisibleText('This is a required field.');

        $I->waitForElement(self::$inputEmail);
        $I->fillField(self::$inputEmail, 'test_mowdirect@yahoo.co.uk');
        $I->fillField(self::$inputComment, 'Test');
        $I->click(self::$shareWishlist);
        $I->waitForElement(self::$successMsg);
        $I->see('Your Wishlist has been shared.',self::$successMsg);
        
    }

    public function removeItem(){
        $I = $this->tester;
        $I->amOnUrl(self::$urlWishlist);
        $I->waitAndClick(self::$clickRemoveFirst);
        $I->acceptPopup();
        $I->waitForElement(self::$seeEmptyList);
        $I->see('You have no items in your wishlist.',self::$seeEmptyList);
    }

    public function addItemsInWishlist(){
        $I = $this->tester;

        $I->waitAndClick(self::$clickAccount);
        $I->waitForElement(self::$accountMenu);
        $I->wait(2);
        $I->click(self::$accountMenu);
        $I->waitAndClick(self::$myWishlist);

        $I->waitAndClick(self::$addBasket);
        $I->waitForElement(self::$successMsg);
        $I->seeElement(self::$successMsg);

        $I->click(self::$cart);
        try{
        $I->waitAndClick(self::$removeItem);}
        catch (Exception $e) {
            $I->waitAndClick(self::$removeItem2);
        }
        $I->waitForText('Your Basket is empty...');


        
    }



    


}
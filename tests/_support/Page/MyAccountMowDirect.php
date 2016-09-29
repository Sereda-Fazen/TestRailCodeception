<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 31.05.16
 * Time: 13:24
 */

namespace Page;


use Exception;

class MyAccountMowDirect
{
    // account information

    public static $URL = '/customer/account/';
    public static $accountInformation = '//div[@class="skip-links"]/a[3]';
    public static $leftBlock = '//*[@class="left-off-canvas-menu"]';
    public static $myAccount = '//*[@class="left-off-canvas-menu"]//span';
    public static $information = '//*[@class="left-off-canvas-menu"]/div//ul/li[2]/a';


    // address billing


    public static $addressBilling = '//*[@class="left-off-canvas-menu"]/div//ul/li[3]/a';
    public static $assertAccountPage = '//*[@class="page-title"]/h1';
    public static $titleField = '//*[@id="prefix"]';
    public static $firstNameField = '//*[@id="firstname"]';
    public static $lastNameField = '//*[@id="lastname"]';
    public static $telephoneField = './/*[@id="telephone"]';
    public static $emailAddressField = './/*[@id="email"]';
    public static $saveButton = '//*[@id="form-validate"]/div[3]/button';
    public static $assertSaveOk = '//*[@class="success-msg"]//span';

    public static $URL2 = '/customer/address/';
    public static $addressBook = '//*[@class="my-account"]//button';
    public static $assertAddressPage = '//*[@class="page-title title-buttons"]/h1';
    public static $assertAddressPage2 = '//*[@class="page-title"]';
    public static $defaultAddressEdit = '//ol/li[1]/p/a';
    public static $changeShipAddress = '//ol/li[2]/p/a';
    public static $AddNewAddressButton = '//*[@class="page-title"]';
    public static $countyCanada = '//*[@id="country"]/option[41]';
    public static $countryFrance = '//*[@id="country"]/option[76]';
    public static $countryGermany = '//*[@id="country"]/option[83]';
    public static $streetAddress = '//*[@id="street_1"]';
    public static $townCity = '//*[@id="city"]';
    public static $regionManitobe = '//*[@id="region_id"]/option[4]';
    public static $regionHautes = './/*[@id="region_id"]/option[22]';
    public static $regionBayern = '//*[@id="region_id"]/option[4]';
    public static $postcodeField = '//*[@id="zip"]';
    public static $saveDefaultAddressButton =' //div[@class="buttons-set"]/button';


    public static $assertEditAddress = '//*[@class="page-title"]/h1';
    public static $defaultBillingAddressCheckbox = '//*[@id="primary_billing"]';
    public static $defaultShippingAddressCheckbox = '//*[@id="primary_shipping"]';
    public static $deleteAddress = '//*[@class="col-2 addresses-additional"]//li[1]/p/a[2]';


    // reorder

    public static $reorder = '//*[@class="left-off-canvas-menu"]/div//ul/li[4]/a';
    public static $myOrders = '//*[@class="main"]/div[2]/div/div[2]/ul/li[4]';
    public static $viewOrderLink = '//*[@class="nobr"]/a[1]';
    public static $myWishList = '//*[@class="main"]/div[2]/div/div[2]/ul/li[5]';
    public static $assertTitle = '//*[@class="page-title title-buttons"]/h1';
    public static $reorderLink = '//*[@class="link-reorder"]';

    public static $removeItem = '//div[@id="cart_mobile"]//tbody//td[2]//a';
    public static $removeItem2 = '//div[@id="cart_desktop"]//tbody//td[6]//a';

    // newsletter

    public static $newsletterSubscription = '//*[@class="left-off-canvas-menu"]/div//ul/li[8]/a';
    public static $assertNewsletterPage = '//*[@class="col-main std"]/h2';
    public static $newsletterCheckbox = '//*[@id="list-b33a1ab066"]';
    public static $newsletterSaveButton = '//*[@id="mailchimp-additional"]/div[2]/button';

    public static $URL4 = '/invitation/';
    public static $myInvitations = '//*[@class="main"]/div[2]/div/div[2]/ul/li[11]';
    public static $sendInvitationsButton = '//*[@class="button"]/span';
    public static $assertInvitationPage = '//*[@class="my-account"]//h1';
    public static $inputEmailField1 = '//*[@id="invitationForm"]/div[1]/ul/li[1]/div/input';
    public static $sendInvitation = '//*[@class="buttons-set form-buttons"]/button';
    public static $assertSuccessMessage = '//*[@class="success-msg"]//span';
    public static $assertFalse = 'li.error-msg > ul > li';

    // Add review

    public static $urlHome = '/';
    public static $addReview = '//*[@id="md-recommendations"]//div[6]//div[2]//div[2]//p/a[2]';
    public static $writeReview = '//*[@class="main-container col1-layout"]';

    // invitation

    public static $invitation = '//*[@class="left-off-canvas-menu"]/div//li/a[text()="My Invitations"]';

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public function navigateToAccount(){
        $I = $this->tester;
        $I->waitAndClick(self::$accountInformation);
        $I->waitForElementVisible(self::$leftBlock);
        $I->wait(2);
        $I->click(self::$myAccount);

    }

    public function accountInformationMowDirect($title, $firstName, $lastName)
    {
        $I= $this ->tester;
        self::navigateToAccount();
        $I->waitAndClick(self::$information);
        $I->see('Edit Account Information',self::$assertAccountPage);
        $I->fillField(self::$titleField,$title);
        $I->fillField(self::$firstNameField,$firstName);
        $I->fillField(self::$lastNameField,$lastName);
        $I->waitAndClick(self::$saveButton);
        $I->waitForElement(self::$assertSaveOk);
        $I->see('The account information has been saved.',self::$assertSaveOk);
        return $this;
        }

    public function addDefaultBillingAddress($firstName, $lastName,$telephone,$street,$city,$postcode)
    {
        $I= $this ->tester;

        self::navigateToAccount();
        $I->waitAndClick(self::$addressBilling);

        $I->see('Address Book',self::$assertAddressPage);
        $I->click(self::$defaultAddressEdit);
        $I->fillField(self::$firstNameField,$firstName);
        $I->fillField(self::$lastNameField,$lastName);
        $I->fillField(self::$telephoneField,$telephone);
        $I->click(self::$countyCanada);
        $I->fillField(self::$streetAddress,$street);
        $I->fillField(self::$townCity,$city);
        $I->click(self::$regionManitobe);
        $I->fillField(self::$postcodeField,$postcode);
        $I->waitAndClick(self::$saveDefaultAddressButton);
        $I->waitForElement(self::$assertSaveOk);
        $I->see("The address has been saved.", self::$assertSaveOk);
        return $this;
    }

    public function changeShippingAddress($firstName,$lastName,$telephone,$street,$city,$postcode)
    {
        $I= $this ->tester;



        $I->click(self::$addressBook);
        $I->waitForElement(self::$assertAddressPage2);
        $I->fillField(self::$firstNameField,$firstName);
        $I->fillField(self::$lastNameField,$lastName);
        $I->fillField(self::$telephoneField,$telephone);
        $I->click(self::$countryFrance);
        $I->fillField(self::$streetAddress,$street);
        $I->fillField(self::$townCity,$city);
        $I->click(self::$regionHautes);
        $I->fillField(self::$postcodeField,$postcode);
        $I->waitForElement(self::$saveDefaultAddressButton);
        $I->click(self::$saveDefaultAddressButton);
        $I->waitForElement(self::$assertSaveOk);
        $I->see("The address has been saved.", self::$assertSaveOk);
        return $this;
    }


    public function addNewAddress($firstName,$lastName,$telephone,$street,$city,$postcode)
    {
        $I= $this ->tester;

        $I->click(self::$addressBook);
        $I->waitForElement(self::$assertAddressPage2);
        $I->click(self::$AddNewAddressButton);
        $I->fillField(self::$firstNameField,$firstName);
        $I->fillField(self::$lastNameField,$lastName);
        $I->fillField(self::$telephoneField,$telephone);
        $I->click(self::$countryGermany);
        $I->fillField(self::$streetAddress,$street);
        $I->fillField(self::$townCity,$city);
        $I->click(self::$regionBayern);
        $I->fillField(self::$postcodeField,$postcode);
        $I->waitForElement(self::$defaultBillingAddressCheckbox);
        $I->click(self::$defaultBillingAddressCheckbox);
        $I->click(self::$defaultShippingAddressCheckbox);
        $I->waitAndClick(self::$saveButton);
        $I->waitForElement(self::$assertSaveOk);
        $I->see("The address has been saved.", self::$assertSaveOk);
       
        return $this;
    }

    public function newsletterCheck (){
        $I= $this ->tester;
        self::navigateToAccount();
        $I->click(self::$newsletterSubscription);
        $I->waitForElement(self::$assertNewsletterPage);
        $I->click(self::$newsletterCheckbox);
        $I->click(self::$newsletterSaveButton);
        try {

            $I->waitForElement(self::$assertSuccessMessage);
            $I->see('Newsletter subscription success', self::$assertSuccessMessage);
        } catch (Exception $e){}

        $I->click(self::$newsletterCheckbox);
        $I->click(self::$newsletterSaveButton);
        try {

            $I->waitForElement(self::$assertSuccessMessage);
            $I->see('Newsletter unsubscription success', self::$assertSuccessMessage);
        } catch (Exception $e){}

    }

    public function orderReorderCheck ()
    {
        $I = $this->tester;
        self::navigateToAccount();
        $I->waitForElement(self::$reorder);
        $I->click(self::$reorder);

        $I->waitForElement(self::$viewOrderLink);
        $I->click(self::$viewOrderLink);
        $I->waitForElement(self::$assertTitle);
        $I->see('Order', self::$assertTitle);
        $I->click(self::$reorderLink);
        $I->waitForElement(self::$assertTitle);
        $I->getVisibleText('Your Basket');
        try {$I->click(self::$removeItem); } catch (Exception $e) { $I->click(self::$removeItem2);}
        $I->waitForText('Your Basket is empty...');
    }
        


    public function myInvitationsCheck ($testEmail){
        $I= $this ->tester;
        self::navigateToAccount();
        $I->waitForElement(self::$invitation);
        $I->click(self::$invitation);
        $I->waitForElement(self::$assertInvitationPage);
        $I->see('My Invitations', self::$assertInvitationPage);
        $I->click(self::$sendInvitationsButton);
        $I->waitForElement(self::$assertInvitationPage);
        $I->see('Send Invitations', self::$assertInvitationPage);
        $I->fillField(self::$inputEmailField1,$testEmail);
        $I->click(self::$sendInvitation);

        try {
            $I->waitForElement(self::$assertSuccessMessage);
            $I->see('Invitation for', self::$assertSuccessMessage);
        } catch (Exception $e) {
            $I->waitForElement(self::$assertFalse);
            $I->see('Invitation for same email address already exists.', self::$assertFalse);
        }
    }
    

    





}
<?php
namespace Step\Acceptance;

use Exception;

class FiltersSteps extends \AcceptanceTester
{

    /**
     *
     */
    public function exceptions(){
        $I = $this;
        $I->seeElement('.products-list');
    }
    public function removeFilter(){
        $I = $this;
        $I->waitForAjax(10);
        $I->click('//div[@class="currently"]//a');
        $I->wait(2);
    }

    public function checkFilters()
    {
        $I = $this;
        $I->waitAndClick('.mb-mana-catalog-leftnav');
        $I->waitForElement('.narrow-by-list');


        for ($t = 2; $t <= 11; $t++) {

            $manufact = count($I->grabMultiple('//*[@class="narrow-by-list"]/dd['.$t.']//li'));

            $I->waitForElementVisible('//*[@class="narrow-by-list"]//dt['.$t.']');
            $I->wait(2);
            $I->click('//*[@class="narrow-by-list"]//dt['.$t.']');

            try {
                $I->click('//dl[@class="narrow-by-list"]//dd[2]/div/a[2]');
                } catch (Exception $e) {}
            try {$I->click('//dl[@class="narrow-by-list"]//dd[7]/div/a[2]');
                } catch (Exception $e){}
            try {$I->click('//dl[@class="narrow-by-list"]//dd[10]/div/a[2]');
                } catch (Exception $e){}


            $I->wait(2);
            $I->click('//*[@class="narrow-by-list"]//dd['.$t.']//li['.rand(1,$manufact).']');
            $I->waitForAjax(10);
            $I->exceptions();
            $I->waitForElement('//div[@class="currently"]//ol/li//span');

            switch ($t) {

                case 2:
                    $I->see('Manufacturer:', '//div[@class="currently"]/ol//span');
                    $I->removeFilter();
                    break;

                case 3:
                    $I->see('Type:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 4:
                    $I->see('Drive System:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 5:
                    $I->see('Cutting Width:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 6:
                    $I->see('Engine Size:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 7:
                    $I->see('Lawn Size:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 8:
                    $I->see('Turning Circle:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 9:
                    $I->see('Grass Catcher:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 10:
                    $I->see('Features:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;

                case 11:
                    $I->see('Price:', '//div[@class="currently"]//ol/li//span');
                    $I->removeFilter();
                    break;
            }

        }

    }



        /*
                $I->wait(3);
                $type = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[3]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[3]//li['.rand(1,$type).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->waitForElement('//div[@class="currently"]//ol/li//span');
                $I->see('Type:','//div[@class="currently"]//ol/li//span');
                $I->waitForAjax(10);
                $I->click('//div[@class="currently"]//ol/li/a');

            }





        /*
            public function checkFilters()
            {
                $I = $this;
                $I->waitForElement('//dl[@class="narrow-by-list"]');

                $I->click('//dl[@class="narrow-by-list"]//dd[2]/div/a[2]');
                $manufact = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[2]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[2]//li['.rand(1,$manufact).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);


                $type = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[3]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[3]//li['.rand(1,$type).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);

                $driveSystem = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[4]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[4]//li['.rand(1,$driveSystem).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);


                $cuttingWidth = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[5]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[5]//li['.rand(1,$cuttingWidth).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);




                $engineSize = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[6]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[6]//li['.rand(1,$engineSize).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);

                $lawnSize = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[7]//li'));
                try {$I->click('//dl[@class="narrow-by-list"]//dd[7]/div/a[2]');} catch (Exception $e){}
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[7]');
                $I->click('//dl[@class="narrow-by-list"]//dd[7]//li['.rand(1,$lawnSize).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);

                $turningCircle = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[8]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[8]//li['.rand(1,$turningCircle).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);

                $I->click('//dl[@class="narrow-by-list"]//dd[9]//li[1]');
                $I->waitForAjax(10);


                $I->scrollDown(300);

                $features = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[10]//li'));
                try {$I->click('//dl[@class="narrow-by-list"]//dd[10]/div/a[2]');} catch (Exception $e){}
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[10]');
                $I->click('//dl[@class="narrow-by-list"]//dd[10]//li['.rand(1,$features).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->wait(2);


                $price = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[11]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[11]//li[1]');
                $I->waitForAjax(10);
                $I->exceptions();

                // closed blocks
        /*
                $I->click('//dl[@class="narrow-by-list"]//dt[12]');
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[12]//li');
                $engineMake = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[12]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[12]//li['.rand(1,$engineMake).']');
                $I->waitForAjax(10);
                $I->exceptions();
                $I->scrollDown(200);

                $I->click('//dl[@class="narrow-by-list"]//dt[13]');
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[13]//li');
                $powerOutput = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[13]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[13]//li['.rand(1,$powerOutput).']');
                $I->waitForAjax(10);
                $I->exceptions();

                $I->click('//dl[@class="narrow-by-list"]//dt[14]');
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[14]//li');
                $engineCelinders = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[14]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[14]//li['.rand(1,$engineCelinders.']'));
                $I->waitForAjax(10);
                $I->exceptions();

                $I->click('//dl[@class="narrow-by-list"]//dt[15]');
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[15]//li');
                $fuelTank = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[15]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[15]//li['.rand(1,$fuelTank.']'));
                $I->waitForAjax(10);
                $I->exceptions();

                $I->click('//dl[@class="narrow-by-list"]//dt[16]');
                $I->waitForElement('//dl[@class="narrow-by-list"]//dd[16]//li');
                $bleads = count($I->grabMultiple('//dl[@class="narrow-by-list"]//dd[16]//li'));
                $I->click('//dl[@class="narrow-by-list"]//dd[16]//li['.rand(1,$bleads.']'));
                $I->waitForAjax(10);
                $I->exceptions();
        */



}
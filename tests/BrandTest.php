<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);

            //Act
            $test_brand->save();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();

            $name2 = "Adidas";
            $website2 = "http://www.adidas.com";
            $test_brand2 = new Brand($name2, $website2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();

            $name2 = "Adidas";
            $website2 = "http://www.adidas.com";
            $test_brand2 = new Brand($name2, $website2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();

            $name2 = "Adidas";
            $website2 = "http://www.adidas.com";
            $test_brand2 = new Brand($name2, $website2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand2->getId());

            //Assert
            $this->assertEquals($test_brand2, $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();

            //Act
            $new_name = "Reebok";
            $test_brand->updateName($new_name);

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($new_name, $result[0]->getName());
        }

        function test_updateWebsite()
        {
            //Arrange
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();

            //Act
            $new_website = "Reebok";
            $test_brand->updateWebsite($new_website);

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($new_website, $result[0]->getWebsite());
        }

        //
        // function test_delete()
        // {
        //     //Arrange
        //     $name = "Burchs";
        //     $location = "Oakway Center";
        //     $phone = "5415131122";
        //     $test_store = new Store($name, $location, $phone);
        //     $test_store->save();
        //
        //     $name2 = "Payless ShoeSource";
        //     $location2 = "Valley River Center";
        //     $phone2 = "5415130809";
        //     $test_store2 = new Store($name2, $location2, $phone2);
        //     $test_store2->save();
        //
        //     //Act
        //     $test_store->delete();
        //
        //     //Assert
        //     $result = Store::getAll();
        //     $this->assertEquals([$test_store2], $result);
        // }
        //
        //



    }
?>

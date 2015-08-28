<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    // require_once "src/Brand.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            // Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Payless ShoeSource";
            $location = "Valley River Center";
            $phone = "5415130809";
            $test_store = new Store($name, $location, $phone);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);

            //Act
            $test_store->save();

            //Assert
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $name2 = "Payless ShoeSource";
            $location2 = "Valley River Center";
            $phone2 = "5415130809";
            $test_store2 = new Store($name2, $location2, $phone2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $name2 = "Payless ShoeSource";
            $location2 = "Valley River Center";
            $phone2 = "5415130809";
            $test_store2 = new Store($name2, $location2, $phone2);
            $test_store2->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $name2 = "Payless ShoeSource";
            $location2 = "Valley River Center";
            $phone2 = "5415130809";
            $test_store2 = new Store($name2, $location2, $phone2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store2->getId());

            //Assert
            $this->assertEquals($test_store2, $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            //Act
            $new_name = "Shoe Emporium";
            $test_store->updateName($new_name);

            //Assert
            $result = Store::getAll();
            $this->assertEquals($new_name, $result[0]->getName());
        }

        function test_updateLocation()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            //Act
            $new_location = "Downtown";
            $test_store->updateLocation($new_location);

            //Assert
            $result = Store::getAll();
            $this->assertEquals($new_location, $result[0]->getLocation());
        }

        function test_updatePhone()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            //Act
            $new_phone = "5037898756";
            $test_store->updatePhone($new_phone);

            //Assert
            $result = Store::getAll();
            $this->assertEquals($new_phone, $result[0]->getPhone());
        }

        function test_delete()
        {
            //Arrange
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $name2 = "Payless ShoeSource";
            $location2 = "Valley River Center";
            $phone2 = "5415130809";
            $test_store2 = new Store($name2, $location2, $phone2);
            $test_store2->save();

            //Act
            $test_store->delete();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([$test_store2], $result);
        }

        function test_addBrand()
        {
            //Arrange
            // Make a test Store
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            // Make a test Brand
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();

            //Act
            $test_store->addBrand($test_brand);

            //Assert
            $result = $test_store->getBrands();
            $this->assertEquals([$test_brand], $result);

        }

        function test_getBrands()
        {
            //Arrange
            // Make two test Stores
            $name = "Burchs";
            $location = "Oakway Center";
            $phone = "5415131122";
            $test_store = new Store($name, $location, $phone);
            $test_store->save();

            $name2 = "Payless ShoeSource";
            $location2 = "Valley River Center";
            $phone2 = "5415130809";
            $test_store2 = new Store($name2, $location2, $phone2);
            $test_store2->save();


            // Make two test Brands
            $name = "Nike";
            $website = "http://www.nike.com";
            $test_brand = new Brand($name, $website);
            $test_brand->save();
            
            $name2 = "Adidas";
            $website2 = "http://www.adidas.com";
            $test_brand2 = new Brand($name2, $website2);
            $test_brand2->save();

            // Add both brands to second store
            $test_store2->addBrand($test_brand);
            $test_store2->addBrand($test_brand2);

            //Act
            $result = $test_store2->getBrands();


            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }





    }
?>

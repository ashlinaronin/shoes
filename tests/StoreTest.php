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




    }
?>

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
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll();
        // }

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
    }
?>

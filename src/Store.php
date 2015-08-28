<?php

    class Store
    {
        private $name;
        private $location;
        private $phone;
        private $id;

        function __construct($name, $location, $phone, $id = null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->phone = $phone;
            $this->id = $id;
        }


        // Getters and Setters
        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getId()
        {
            return $this->id;
        }


        // Basic database storage methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, location, phone)
                VALUES (
                    '{$this->getName()}',
                    '{$this->getLocation()}',
                    '{$this->getPhone()}'
                );"
            );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}'
                WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function updateLocation($new_location)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET location = '{$new_location}'
                WHERE id = {$this->getId()};");
            $this->setLocation($new_location);
        }

        function updatePhone($new_phone)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET phone = '{$new_phone}'
                WHERE id = {$this->getId()};");
            $this->setPhone($new_phone);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM retail_locations WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $store_query = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $all_stores = array();
            foreach ($store_query as $store) {
                $new_store = new Store(
                    $store['name'],
                    $store['location'],
                    $store['phone'],
                    $store['id']
                );
                array_push($all_stores, $new_store);
            }
            return $all_stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM retail_locations;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $all_stores = Store::getAll();
            foreach($all_stores as $store) {
                if ($store->getId() == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }



        // Database methods relating to Brands table
        function addBrand($new_brand)
        {

        }

        function getBrands()
        {

        }
        

    }
 ?>

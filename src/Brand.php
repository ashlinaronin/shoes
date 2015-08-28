<?php

    class Brand
    {
        private $name;
        private $website;
        private $id;

        function __construct($name, $website, $id = null)
        {
            $this->name = $name;
            $this->website = $website;
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

        function setWebsite($new_website)
        {
            $this->website = $new_website;
        }

        function getWebsite()
        {
            return $this->website;
        }


        function getId()
        {
            return $this->id;
        }


        // Basic database storage methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name, website)
                VALUES (
                    '{$this->getName()}',
                    '{$this->getWebsite()}'
                );"
            );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}'
                WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function updateWebsite($new_website)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET website = '{$new_website}'
                WHERE id = {$this->getId()};");
            $this->setWebsite($new_website);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM retail_locations WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $brand_query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $all_brands = array();
            foreach ($brand_query as $brand) {
                $new_brand = new Brand(
                    $brand['name'],
                    $brand['website'],
                    $brand['id']
                );
                array_push($all_brands, $new_brand);
            }
            return $all_brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM retail_locations;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $all_brands = Brand::getAll();
            foreach($all_brands as $brand) {
                if ($brand->getId() == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }



        // Database methods relating to Stores table
        function addStore($new_brand)
        {

        }

        function getStores()
        {

        }

    }
 ?>

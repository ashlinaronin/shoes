<?php

    class Store
    {
        private $name;
        private $location;
        private $phone;
        private $id;

        function __construct($name, $location, $phone, $id = null)
        {

        }


        // Getters and Setters
        function setName($new_name)
        {

        }

        function getName()
        {

        }

        function setLocation($new_location)
        {

        }

        function getLocation()
        {

        }

        function setPhone($new_phone)
        {

        }

        function getPhone()
        {

        }

        function getId()
        {

        }


        // Basic database storage methods
        function save()
        {

        }

        function update($column, $data)
        {
            // dont let em update id
        }

        function delete()
        {

        }

        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        static function find($search_id)
        {

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

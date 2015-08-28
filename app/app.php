<?php

    // DEPENDENCIES
    require_once __DIR__."/../vendor/autoload.php"; // frameworks
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));

    // Allow PATCH, DELETE HTTP methods
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    /* Helper function to escape apostrophes and other special chars
     * in an associative input array.
     * Designed specifically to act on $_POST, but generalized to
     * work for any associative array. It's safer to not
     * act on $_POST directly, so we return a new escaped array. */
    function escapeCharsInArray($input_associative_array) {
        $escaped_array = array();
        foreach($input_associative_array as $key => $value) {
            $escaped_array[$key] = preg_quote($value, "'");
        }
        return $escaped_array;
    }

    /*******************All Store routes *********************/
    /* [R] Landing page - display all shoe Stores
    ** Allow user to add a store or delete all stores.
    ** Each store listing is a link to its individual page. */
    $app->get("/", function() use ($app) {

    });

    // [C] Create a new Store, then display all existing stores.
    $app->post("/", function() use ($app) {

    });

    // [D] Delete all stores, then show the landing page.
    $app->delete("/", function() use ($app) {

    });


    /*************Individual Store routes *******************/
    /* [R] Display a Store and its brands.
    ** Allow user to update or delete this store.
    ** Allow user to add a brand to this store. */
    $app->get("/store/{id}", function($id) use ($app) {

    });

    /* [C] Create a new brand associated with this store.
    ** Then display all of this store's brands. */
    $app->post("/store/{id}", function($id) use ($app) {

    });

    // [U] Update a Store, then display that store and its brands.
    $app->patch("/store/{id}", function($id) use ($app) {

    });

    /* [D] Delete a Store, then go back to the main page
    ** showing the list of all Stores. */
    $app->delete("/store/{id}", function($id) use ($app) {

    });




    /**************Individual Brand routes *******************/
    /* [R] Display a Brand and its Stores.
    ** Allow user to add a new Store to this brand. */
    $app->get("/brand/{id}", function($id) use ($app) {

    });

    /* [C] Create a new Store associated with this Brand.
    ** Then display all stores for this brand. */
    $app->post("/brand/{id}", function($id) use ($app) {

    });

    /* [U] Update the info for this Brand.
    ** Then display all stores associated with it.
    ** This route is not necessary-- finish if time. */
    $app->patch("/brand/{id}", function($id) use ($app) {

    });





    return $app;

?>

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
        return $app['twig']->render('all_stores.html.twig', array(
            'all_stores' => Store::getAll()
        ));
    });

    // [C] Create a new Store, then display all existing stores.
    $app->post("/", function() use ($app) {
        $escaped_post = escapeCharsInArray($_POST);
        $new_store = new Store(
            $escaped_post['name'],
            $escaped_post['location'],
            $escaped_post['phone']
        );
        $new_store->save();
        return $app['twig']->render('all_stores.html.twig', array(
            'all_stores' => Store::getAll()
        ));
    });

    // [D] Delete all stores, then show the landing page.
    $app->delete("/", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('all_stores.html.twig', array(
            'all_stores' => Store::getAll()
        ));
    });


    /*************Individual Store routes *******************/
    /* [R] Display a Store and its brands.
    ** Allow user to update or delete this store.
    ** Allow user to add an existing brand to this store,
    ** or create a new brand to be added to this store. */
    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array(
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));
    });

    /* [C] Create a new brand associated with this store.
    ** Then display all of this store's brands. */
    $app->post("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $escaped_post = escapeCharsInArray($_POST);

        // if brand already exists, use it
        // else make new brand

            $new_brand = new Brand(
                $escaped_post['name'],
                $escaped_post['website']
            );
            $new_brand->save();
            $store->addBrand($new_brand);

        return $app['twig']->render('store.html.twig', array(
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));

    });

    // [U] Update a Store, then display that store and its brands.
    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $escaped_post = escapeCharsInArray($_POST);

        // check for which post variables we have and update those
        // could be just one or all three
        $store->updateName($escaped_post['name']);
        $store->updateLocation($escaped_post['location']);
        $store->updatePhone($escaped_post['phone']);

        return $app['twig']->render('store.html.twig', array(
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));
    });

    /* [D] Remove all connections between brands and this store.
    ** Don't actually delete any brands or this store.
    ** Then display the normal store page. */
    $app->delete("/store/{id}/deleteBrands", function($id), use ($app) {
        $store = Store::find($id);
        $store->removeBrands();

        return $app['twig']->render('store.html.twig', array(
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));
    });

    /store/{{ store.getId }}/deleteBrands

    /* [D] Delete a Store, then go back to the main page
    ** showing the list of all Stores. */
    $app->delete("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();

        return $app['twig']->render('all_stores.html.twig', array(
            'all_stores' => Store::getAll()
        ));
    });





    /**************Individual Brand routes *******************/
    /* [R] Display a Brand and its Stores.
    ** Allow user to add a new Store to this brand.
    ** Ze may add an existing Store to this brand (e.g. Burch's
    ** starts carrying Nike) or create a new Store which carries
    ** this brand. */
    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);

        return $app['twig']->render('brand.html.twig', array(
            'brand' => $brand,
            'stores' => $brand->getStores(),
            'all_stores' => Store::getAll()
        ));
    });

    /* [C] Create a new Store associated with this Brand.
    ** Then display all stores for this brand. */
    $app->post("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $escaped_post = escapeCharsInArray($_POST);

        // if store already exists, use it
        // else make new store
            $new_store = new Store(
                $escaped_post['name'],
                $escaped_post['location'],
                $escaped_post['phone'],
                $escaped_post['id']
            );
            $new_store->save();

        return $app['twig']->render('brand.html.twig', array(
            'brand' => $brand,
            'stores' => $brand->getStores(),
            'all_stores' => Store::getAll()
        ));
    });

    /* [U] Update the info for this Brand.
    ** Then display all stores associated with it.
    ** This route is not necessary-- finish if time. */
    $app->patch("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $escaped_post = escapeCharsInArray($_POST);

        // check for which post variables we have and update those
        // could be just one or both
        $brand->updateName($escaped_post['name']);
        $brand->updateWebsite($escaped_post['website']);

        return $app['twig']->render('brand.html.twig', array(
            'brand' => $brand,
            'stores' => $brand->getStores(),
            'all_stores' => Store::getAll()
        ));

    });

    return $app;

?>

<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/cart' => [[['_route' => 'get_one_cart', '_controller' => 'App\\Controller\\cartController::getOneCart'], null, ['GET' => 0], null, false, false, null]],
        '/api/orders' => [[['_route' => 'get_all_orders', '_controller' => 'App\\Controller\\orderController::getAllorders'], null, ['GET' => 0], null, false, false, null]],
        '/api/product' => [[['_route' => 'add_product', '_controller' => 'App\\Controller\\productController::addProduct'], null, ['POST' => 0], null, false, false, null]],
        '/api/products' => [[['_route' => 'get_all_products', '_controller' => 'App\\Controller\\productController::getAllproducts'], null, ['GET' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'register_user', '_controller' => 'App\\Controller\\userController::adduser'], null, ['POST' => 0], null, false, false, null]],
        '/api/login' => [[['_route' => 'login_user', '_controller' => 'App\\Controller\\userController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/user' => [[['_route' => 'get_one_user', '_controller' => 'App\\Controller\\userController::getOneuser'], null, ['GET' => 0], null, false, false, null]],
        '/api/get-all' => [[['_route' => 'get_all_users', '_controller' => 'App\\Controller\\userController::getAllusers'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api/(?'
                    .'|cart/(?'
                        .'|([^/]++)(?'
                            .'|(*:34)'
                        .')'
                        .'|validate(*:50)'
                    .')'
                    .'|order/([^/]++)(?'
                        .'|(*:75)'
                    .')'
                    .'|product(?'
                        .'|s/([^/]++)(*:103)'
                        .'|/([^/]++)(?'
                            .'|(*:123)'
                        .')'
                    .')'
                    .'|update/([^/]++)(*:148)'
                    .'|delete/([^/]++)(*:171)'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:208)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        34 => [
            [['_route' => 'add_product_to_cart', '_controller' => 'App\\Controller\\cartController::addProductToCart'], ['id'], ['POST' => 0], null, false, true, null],
            [['_route' => 'delete_product_from_cart', '_controller' => 'App\\Controller\\cartController::deleteProductFromCart'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        50 => [[['_route' => 'validate_cart', '_controller' => 'App\\Controller\\cartController::validateCart'], [], ['GET' => 0], null, false, false, null]],
        75 => [
            [['_route' => 'get_one_order', '_controller' => 'App\\Controller\\orderController::getOneorder'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'delete_order', '_controller' => 'App\\Controller\\orderController::deleteProductFromorder'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        103 => [[['_route' => 'get_one_product', '_controller' => 'App\\Controller\\productController::getOneProduct'], ['id'], ['GET' => 0], null, false, true, null]],
        123 => [
            [['_route' => 'update_product', '_controller' => 'App\\Controller\\productController::updateproduct'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_product', '_controller' => 'App\\Controller\\productController::deleteproduct'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        148 => [[['_route' => 'update_user', '_controller' => 'App\\Controller\\userController::updateuser'], ['id'], ['PUT' => 0], null, false, true, null]],
        171 => [[['_route' => 'delete_user', '_controller' => 'App\\Controller\\userController::deleteuser'], ['id'], ['DELETE' => 0], null, false, true, null]],
        208 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

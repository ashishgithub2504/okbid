<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
define('LAN', '_en');
define('_BASE_', Router::url( "/", true ));
define('DAY',60*60*24, true);
define('MONTH',DAY*30, true);
define('YEAR',DAY*365, true);
define('MINYEAR', '1990',true);
define('MAXYEAR', '2050',true);
define('CURRYEAR', date('Y'),true);
define('BRANCH', serialize(['1'=>'MRM','2'=>'Green','3'=>'SS']),true);
define('CATEGORY_en', serialize(['1'=>'2nd hand','2'=>'commercial','3'=>'Grounds','4'=>'New apartments from contractor','5'=>'Investors','6'=>'Entrepreneur']),true);
define('SUBCATEGORY_en', serialize(['1'=>'2nd hand','2'=>'commercial','3'=>'Grounds','4'=>'New apartments from contractor','5'=>'Investors','6'=>'Entrepreneur']),true);
//define('CATEGORY_hr', ['1'=>'יד 2','2'=>'מסחרי','3'=>'קרקעות','4'=>'דירות חדשות מקבלן','5'=>'משקיעים','6'=>'יזמות']);
//define('COLOR_HORSE',['1'=>'Black','2'=>'Chestnut','3'=>'Liver Chestnut','4'=>'Blond Chestnut','5'=>'Bay','6'=>'Mahogany Bay','7'=>'Seal Bay']);
//define('_MEAL_', array('Breakfast'=>'Breakfast','Lunch'=>'Lunch','Tea'=>'Tea','Snack'=>'Snack','Fruit'=>'Fruit','Dessert'=>'Dessert'));
Router::defaultRouteClass(DashedRoute::class);
Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/about-us', ['controller' => 'Pages', 'action' => 'about-us']);
    $routes->connect('/contact-us', ['controller' => 'Pages', 'action' => 'contact-us']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admin', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('Api', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

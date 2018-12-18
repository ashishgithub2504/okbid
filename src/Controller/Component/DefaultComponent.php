<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
/**
 * Default component
 */
class DefaultComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /*
     * Method : get_errors
     * Params : array of errors from model validation
     * Return : string of errors
     * Desc : convert array of errors in single string
     */

    public function get_errors($errors) {
        if (!empty($errors)) {
            $data = '';
//            pr($errors); die;
            foreach ($errors as $key => $error) {
                foreach ($error as $k => $error_content) {
                    if (is_array($error_content)) {
                        foreach ($error_content as $err) {
                            $data .= $err . ', ';
                        }
                    } else {
                        $data .= $error_content . ', ';
                    }
                }
            }
            return $data;
        } else {
            $data = [];
            return $data;
        }
    }

    public function createImageName($file = NULL, $uploadpath = NULL, $imagenameI = NULL) {

        $imagename = $this->Cleanstring($imagenameI);

        $extname = @end(explode(".", $file));

        $targetFile = str_replace('//', '/', $uploadpath) . $imagename . '.' . $extname;
        $filename = $imagename . '.' . $extname;
        $i = 1;

        while (file_exists($targetFile)) {
            $basefilename = basename($targetFile);
            $ext = @end(explode(".", $basefilename));
            $name = current(explode(".", $basefilename));
            $filenamereplace = str_replace("_" . ($i - 1), "", $name);
            $filename = $filenamereplace . '_' . $i . '.' . $ext;
            $targetFile = str_replace('//', '/', $uploadpath) . $filename;
            $i++;
        }
        return $filename;
    }

    function getplaintextintrofromhtml($html, $numchars = '') {
        // Remove the HTML tags
        $html = strip_tags($html);
        // Convert HTML entities to single characters
        $org_html = $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
        // Make the string the desired number of characters
        // Note that substr is not good as it counts by bytes and not characters

        if ($numchars != 0) {
            $html = mb_substr($html, 0, $numchars, 'UTF-8');
        }
        // $html = ereg_replace("[^A-Za-z0-9]", " ", $html );
        $html = trim($html);
        $html = preg_replace('/\s+/u', ' ', $html);
        $html = str_replace('"', " &ldquo; ", $html);
        $html = str_replace("'", " &apos; ", $html);

        // Add an elipsis
        //  $html .= "…";
        if (strlen($org_html) > $numchars && $numchars != 0) {
            return $html . '...';
        } else {
            return $html;
        }
    }

    /*
     * Method : _sendMail
     * Params : to, from, subject, body, template, layout, files
     * Return : mail status
     * Desc : send mail to recipient
     */

    function _sendMail($sentEmail, $from, $subject, $bodyVars = array(), $template = "default", $layout = 'default', $file = '') {
        $sent = false;
        $email = new Email();
        $email->transport('mygmail');
        if (!empty($bodyVars)) {
            $email->viewVars($bodyVars);
        }
        $bodyVars['template'] = isset($bodyVars['template']) ? $bodyVars['template'] : true;

        $email->template($template, $layout);

        $email->to($sentEmail['to']);
        if (isset($sentEmail['cc'])) {
            $email->cc($sentEmail['cc']);
        }
        if (isset($sentEmail['bcc'])) {
            $email->bcc($sentEmail['bcc']);
        }
        $email->subject($subject);
        $email->from($from);
        if (file_exists($file) && $file != '') {
            $email->attachments([$file]);
        }
        //Send as 'html', 'text' or 'both' (default is 'text')
        $email->emailFormat('html'); // because we like to send pretty mail
        if ($email->send()) {
            $sent = true;
            $email->reset();
        } else {
            $email->reset();
            $sent = false;
        }
        return $sent;
    }

    public function getUniqueAlias($alias, $model, $id = null) {

        $alias = $this->clean(rtrim(strtolower($alias)));
        $alias_ini = trim($alias);
        $i = 0;
        while ($this->isAliasExist($alias, $model, $id)) {
            $alias = $alias_ini . '-' . ++$i;
        }
        return $alias;
    }

    public function getChild($parent) {
        $result = TableRegistry::get('ChildsGuardians')->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'child_id'
                ])->where(['guardian_id' => $parent])->select(['child_id'])->toList(); //,'is_login'=>1
        return $result;
    }

    public function isAliasExist($alias, $model, $id) {
        $modelReg = TableRegistry::get($model);
        $conditions = [];
        $conditions[] = ['alias' => $alias];
        if ($id) {
            $conditions[] = ['id !=' => $id];
        }
        $total = $modelReg->find()->where($conditions)->count();
        return ($total > 0) ? true : false;
    }

    public function getparentinfo($user_id) {
        $result = TableRegistry::get('Users')->find()->where(['id' => $user_id])->select(['name', 'profile_pic'])->first();
        return $result;
    }
    
    

    public function getgroups($id = null) {
        $result = TableRegistry::get('Groups')->find()->where(['user_id' => $id])->toArray();
        return $result;
    }
    
    public function getproptype($id = null , $cat = 'en'){
        if($cat == 'en'){
            $sel = 'name';
        }else{
            $sel = 'namehe';
        }
        $result = TableRegistry::get('propertytypes')->find()->select(['name','namehe'])->where(['id'=>$id])->first();
        if(!empty($result)){
            return $result[$sel];
        }else{
            return '';
        }
    }
    
    public function getpropcat($id = null , $cat = 'en'){
        if($cat == 'en'){
            $sel = 'name';
        }else{
            $sel = 'namehe';
        }
        $result = TableRegistry::get('categories')->find()->select([$sel])->where(['id'=>$id])->first();
        if(!empty($result)){
            return $result[$sel];
        }else{
            return '';
        }
    }
    public function getpropsubcat($id = null, $cat = 'en'){
         if($cat == 'en'){
            $sel = 'name';
        }else{
            $sel = 'namehe';
        }
        $result = TableRegistry::get('subcategories')->find()->select([$sel])->where(['id'=>$id])->first();
        if(!empty($result)){
            return $result[$sel];
        }else{
            return $id;
        }
    }
    
    public function getuserinfo($id = null){
        $userinfo = TableRegistry::get('users')->find()->select(['device_token','device_type'])->hydrate(false)->where(['id'=>$id,'status'=>'1','device_token !='=>''])->toArray();
        return $userinfo;
    }
    
    public function getCountryName($id = null){
        $userinfo = TableRegistry::get('countries')->find()->select(['name'])->hydrate(false)->where(['id'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    public function getStateName($id = null){
        $userinfo = TableRegistry::get('states')->find()->select(['name'])->hydrate(false)->where(['id'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    public function getCityName($id = null){
        $userinfo = TableRegistry::get('cities')->find()->select(['name'])->hydrate(false)->where(['code'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    
    public function getStreetName($id = null){
        $userinfo = TableRegistry::get('streets')->find()->select(['name'])->hydrate(false)->where(['id'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    
	public function getOwners($id = null){
		$results = TableRegistry::get('property_owners')->find()
				->select(['id', 'name', 'cell', 'idno', 'property_id'])
				->where(['property_owners.property_id' => $id])
				->toArray();
		return !empty($results)?$results:[];		
	}
	
	public function getFavourte($id = null){
		$results = TableRegistry::get('property_favourites')->find()
				->where(['property_favourites.property_id' => $id])
				->toArray();
		return !empty($results)?$results:[];		
	}
	
	public function getOwnership($id = null){
		$results = TableRegistry::get('property_ownerships')->find()
				->where(['property_ownerships.property_id' => $id])
				->toArray();
		return !empty($results)?$results:[];		
	}
    
    
    public function dataformat($entity = null){
        
//        $entity['evaculation_date'] = ($this->dateformat($entity['evaculation_date'])== '01/01/1970')?'':$this->dateformat($entity['evaculation_date']);
//        $entity['publish'] = $this->dateformat($entity['publish']);
        $entity['price'] = intval($entity['price']);
        $entity['commission'] = number_format($entity['commission'], 2);
        $entity['name'] = Configure::read('PROTY' . LAN)[$entity['propertytype_id']] . ',' . $entity['city'] . ',' . $entity['no_of_room'];
        $entity['propertytype_id'] = $this->getproptype($entity['propertytype_id']);
        $entity['category'] = $this->getpropcat($entity['category']);
        $entity['sub_category'] = $this->getpropsubcat($entity['sub_category']);

        $entity['air_direction'] = ($entity['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$entity['air_direction']];
        $entity['balcony_type'] = ($entity['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$entity['balcony_type']];
        $entity['parking_type'] = ($entity['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$entity['parking_type']];
        $entity['first_payment'] = ($entity['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$entity['first_payment']];
        $entity['handling'] = ($entity['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$entity['handling']];

        $entity['ac'] = ($entity['ac'] == 0)?'':Configure::read('AIRCOND' . LAN)[$entity['ac']];
        $entity['property_condition'] = ($entity['property_condition'] == 0)?'':Configure::read('PROPCON' . LAN)[$entity['property_condition']];

        $entity['bars'] = ($entity['bars'] == 1) ? 'Yes' : 'No';
        $entity['secure_space'] = ($entity['secure_space'] == 1) ? 'Yes' : 'No';
        $entity['master_badroom'] = ($entity['master_badroom'] == 1) ? 'Yes' : 'No';
        $entity['storage'] = ($entity['storage'] == 1) ? 'Yes' : 'No';
        $entity['disable_access'] = ($entity['disable_access'] == 1) ? 'Yes' : 'No';
        $entity['is_viewed'] = $this->getView($entity['property_id'], $this->loggedInUserId);

        if (!empty($entity['property_favourites'])) {
            $entity['is_favourite'] = '1';
        } else {
            $entity['is_favourite'] = '0';
        }
        $entity['proimagePath'] = _BASE_ . 'uploads/document/';
        $entity['ownershipImagePath'] = _BASE_ . 'uploads/document/';
        //pr($entity); die;
        return $entity;    
    }

        public function getuserinfobyprop($pid = null){
        $push = TableRegistry::get('properties')->find()
                        ->where(['properties.id' => $pid])
                        ->select(['device_token'=>'Users.device_token','device_type'=>'Users.device_type'])
                        ->contain(['Users' => function($q) {
                                return $q->select(['id'=>'Users.id','device_token'=>'device_token','device_type'=>'device_type'])->where(['device_token !=' => '']);
                            }])
                        ->hydrate(false)
                        ->toArray();
        return $push;
    }

    public function pushnotification($message = null, $devices = [], $aps = []) {
        
        foreach ($devices as $key => $val) {
            
            if ($val['device_type'] == 'ios') {
                $deviceToken = isset($val['device_token']) ? $val['device_token'] : '';

                $ctx = stream_context_create();
                // ck.pem is your certificate file

                stream_context_set_option($ctx, 'ssl', 'local_cert', 'pem/nipio_aps_dev.pem');  // For customer


                stream_context_set_option($ctx, 'ssl', 'passphrase', 'manan1234');

                // Open a connection to the APNS server
                $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                if (!$fp)
                    exit("Failed to connect: $err $errstr" . PHP_EOL);

                // Create the payload body
                $body['aps'] = array(
                    'alert' => array(
                        'title' => $message['title'],
                        'body' => $message['body'],
                        'id' => $message['id'],
                    //'order_id' => $body['order_id']
                    ),
                    'sound' => 'default'
                );

                // Encode the payload as JSON
                $payload = json_encode($body);
                //foreach ($deviceToken as $device) {
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                $result = fwrite($fp, $msg, strlen($msg));
                //}
                // Close the connection to the server
                fclose($fp);
            }
            
            else {       
                $device = $val['device_token'];
                if (!empty($device)) {
                    #API access key from Google API's Console
                    $registrationIds = $device;
                    #prep the bundle
                    $msg = array
                        (
                        'title' => $message['title'],
                        'body' => $message['body'],
                        'aps' => $aps
                    );
                    $fields = array
                        (
                        'to' => $registrationIds,
                        'data' => $msg
                    );

                    $headers = array
                        (
                        'Authorization: key=' . Configure::read('API_ACCESS_KEY'),
                        'Content-Type: application/json'
                    );
                    //print_r($fields); die;
                    #Send Reponse To FireBase Server	
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch);
                   
                    curl_close($ch);
                }
            }
        }
    }

    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\_\-]/', '', $string); // Removes special chars.
    }

    function getCommission($cat = null) {
        $result = TableRegistry::get('property_commisions')->find()
                ->where(['category' => $cat, 'status' => '1', 'role_id IN ' => ['2,3']])
                ->hydrate(false)
                ->first();

        if (!empty($result)) {
            return number_format($result['commision'], 2, '.', '');
        } else {
            return 2;
        }
    }
    
    function heigherBidNotification($id = null,$price = null){
        $userdata = TableRegistry::get('property_autobids')
                ->find()
                ->contain(['Users'])
                ->select(['device_token'=>'Users.device_token','device_type'=>'Users.device_type'])
                ->hydrate(false)
                ->where(['property_id' => $id , 'price <' => $price, 'Users.device_token !=' => ''])
                ->toArray();
        
            $message['title'] = 'Okbid Notification';
            $message['body'] = 'Please place bid more than '.$price;
            $aps['id'] = $id;
            $aps['type'] = 'general';
            $this->pushnotification($message, $userdata, $aps);
       
    }
    
    function autobid($data = null , $user_id = null){
        $result = TableRegistry::get('property_autobids')
                ->find()
                ->select(['property_id','user_id','price'])
                ->where(['property_id' => $data['id'] , 'user_id !=' => $user_id , 'price >'=> $data['price']])
                ->hydrate(false)
                ->order('price','asc')
                ->toArray();
        
        if(!empty($result)){
            $this->propertybid = TableRegistry::get('property_bids');
            
            foreach ($result as $key=>$val){
                 $results = $this->propertybid->find()
                        ->where(['property_id' => $val['property_id'] , 'user_id' => $val['user_id']])
                        ->select(['price'=>'max(price)','user_id','property_id'])
                        ->hydrate(false)
                        ->last();
               
                $this->placebid($results ,$val['price']);
            }
        }
    }
    
    function placebid($data = null , $highest = null)
    {
        $x = 1; 
        $this->propertybid = TableRegistry::get('property_bids');
        $this->properties = TableRegistry::get('properties');
        
        
        /* get maximum bid for property */
        $result = $this->propertybid->find()
                ->where(['property_id' => $data['property_id']])
                ->select(['amount' => 'MAX(price)','user_id'])
                ->hydrate(false)
                ->first();
       
        
         $updateprice = $data['price']+AUTOBID;
         
        
        while($x <= 4) {
             
            if(($updateprice >  $result['amount']) && ($updateprice <= $highest)){
                $entity = $this->propertybid->newEntity();
                $entity['property_id'] = $data['property_id'];
                $entity['user_id'] = $data['user_id'];
                $entity['status'] = '1';
                $entity['price'] = $updateprice;

                if($this->propertybid->save($entity)){               

                    if(TableRegistry::get('properties')->updateAll(['updated_price' => $updateprice], ['id' => $data['property_id']])){
                       break;
                    }
                }
            }else{
                 $updateprice = $updateprice+AUTOBID;
            }
            $x++;
        }
    }
            
    function getView($id = null , $user_id = null){
        return $result = TableRegistry::get('property_views')->find()->where(['user_id'=> $user_id, 'property_id' => $id])->count();
        
    }
    
    function getisAutoBidApplied($id = null , $user_id = null){
        return $result = TableRegistry::get('property_autobids')->find()->where(['user_id'=> $user_id, 'property_id' => $id])->count();
    }
    
    function getsigned($id = null , $user_id = null){
        return $result = TableRegistry::get('property_signatures')->find()->where(['user_id'=> $user_id, 'property_id' => $id])->count();
    }

    public function Cleanstring($str, $options = array()) {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );
// Merge options
        $options = array_merge($defaults, $options);
        $char_map = array(
// Latin
            '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'AE', '�' => 'C',
            '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I',
            '�' => 'D', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', 'O' => 'O',
            '�' => 'O', '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'U', 'U' => 'U', '�' => 'Y', '�' => 'TH',
            '�' => 'ss',
            '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'ae', '�' => 'c',
            '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i',
            '�' => 'd', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', 'o' => 'o',
            '�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'u', 'u' => 'u', '�' => 'y', '�' => 'th',
            '�' => 'y',
// Latin symbols
            '�' => '(c)',
// Greek
            '?' => 'A', '?' => 'B', 'G' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', 'T' => '8',
            '?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
            '?' => 'R', 'S' => 'S', '?' => 'T', '?' => 'Y', 'F' => 'F', '?' => 'X', '?' => 'PS', 'O' => 'W',
            '?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
            '?' => 'Y',
            'a' => 'a', '�' => 'b', '?' => 'g', 'd' => 'd', 'e' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
            '?' => 'i', '?' => 'k', '?' => 'l', '�' => 'm', '?' => 'n', '?' => '3', '?' => 'o', 'p' => 'p',
            '?' => 'r', 's' => 's', 't' => 't', '?' => 'y', 'f' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
            '?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
            '?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',
// Turkish
            'S' => 'S', 'I' => 'I', '�' => 'C', '�' => 'U', '�' => 'O', 'G' => 'G',
            's' => 's', 'i' => 'i', '�' => 'c', '�' => 'u', '�' => 'o', 'g' => 'g',
// Russian
            '?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Yo', '?' => 'Zh',
            '?' => 'Z', '?' => 'I', '?' => 'J', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O',
            '?' => 'P', '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'H', '?' => 'C',
            '?' => 'Ch', '?' => 'Sh', '?' => 'Sh', '?' => '', '?' => 'Y', '?' => '', '?' => 'E', '?' => 'Yu',
            '?' => 'Ya',
            '?' => 'a', '?' => 'b', '?' => 'v', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'yo', '?' => 'zh',
            '?' => 'z', '?' => 'i', '?' => 'j', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => 'o',
            '?' => 'p', '?' => 'r', '?' => 's', '?' => 't', '?' => 'u', '?' => 'f', '?' => 'h', '?' => 'c',
            '?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => '', '?' => 'y', '?' => '', '?' => 'e', '?' => 'yu',
            '?' => 'ya',
// Ukrainian
            '?' => 'Ye', '?' => 'I', '?' => 'Yi', '?' => 'G',
            '?' => 'ye', '?' => 'i', '?' => 'yi', '?' => 'g',
// Czech
            'C' => 'C', 'D' => 'D', 'E' => 'E', 'N' => 'N', 'R' => 'R', '�' => 'S', 'T' => 'T', 'U' => 'U',
            '�' => 'Z',
            'c' => 'c', 'd' => 'd', 'e' => 'e', 'n' => 'n', 'r' => 'r', '�' => 's', 't' => 't', 'u' => 'u',
            '�' => 'z',
// Polish
            'A' => 'A', 'C' => 'C', 'E' => 'e', 'L' => 'L', 'N' => 'N', '�' => 'o', 'S' => 'S', 'Z' => 'Z',
            'Z' => 'Z',
            'a' => 'a', 'c' => 'c', 'e' => 'e', 'l' => 'l', 'n' => 'n', '�' => 'o', 's' => 's', 'z' => 'z',
            'z' => 'z',
// Latvian
            'A' => 'A', 'C' => 'C', 'E' => 'E', 'G' => 'G', 'I' => 'i', 'K' => 'k', 'L' => 'L', 'N' => 'N',
            '�' => 'S', 'U' => 'u', '�' => 'Z',
            'a' => 'a', 'c' => 'c', 'e' => 'e', 'g' => 'g', 'i' => 'i', 'k' => 'k', 'l' => 'l', 'n' => 'n',
            '�' => 's', 'u' => 'u', '�' => 'z'
        );
// Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
// Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
// Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
// Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
// Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
// Remove delimiter from ends
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
        return strtolower($cleansedstring);
    }

}

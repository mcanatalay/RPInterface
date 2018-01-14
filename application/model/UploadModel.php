<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class UploadModel {
    
    public static function getFileData($file_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM files WHERE file_id = :file_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':file_id' => $file_id));
        
        return $query->fetch();
    }
    
    public static function getPublicFilePath($master_type, $master_id, $file_name){
        if($master_type == 1){
            $dir = 'user';
        } else if($master_type == 2){
            $dir = 'game';
        }
        $url = Config::get('URL').'files/'.$dir.'/'.$master_id.'/'.$file_name;
        
        return $url;
    }
    
    public static function getAllFilesByType($master_type, $master_id, $file_type){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM files WHERE master_type = :master_type AND master_id = :master_id AND file_type = :file_type";
        $query = $database->prepare($sql);
        $query->execute(array(':master_type' => $master_type, ':master_id' => $master_id,':file_type' => $file_type));
        $files = array();

        foreach($query->fetchAll() as $file){
            $files[$file->file_id] = new stdClass();
            $files[$file->file_id] = $file;
            $files[$file->file_id]->file_url = self::getPublicFilePath($master_type,$master_id,$file->file_name);
        }
        
        return $files;
    }
    
    /**
     * 
     * @param type $file_id
     * @return string
     */
    public static function getPublicFilePathByFileID($file_id){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT master_type, master_id, file_name FROM files WHERE
                                        file_id = :file_id LIMIT 1");
        $query->execute(array(':file_id' => $file_id));
        $data = $query->fetch();
        
        return self::getPublicFilePath($data->master_type, $data->master_id, $data->file_name);
    }
    
   /**
     * 
     * @param type $file
     * @param type $user_id
     * @return boolean
     */
    public static function uploadImg($file,$user_id){
        if(!isset($file) || !isset($user_id)){
            return null;
        }

        $target_file_path = realpath(dirname(__FILE__).'/../../') . '/public/files/post/'.$user_id;
        $file_ext = strtolower(end(explode('.',$file['name'])));
        $file_size = $file['size'];
        $file_name = self::gen_uuid($file['name'],8).".".$file_ext;
        $file_tmp = $file['tmp_name'];
        $file_type = mime_content_type($file_tmp);
        $file_type = substr($file_type,0,strpos($file_type,'/'));
        if(strcasecmp($file_type, "application") == 0){
            $file_type = "text";
        }
        if(self::validateFile($file_size,mime_content_type($file_tmp),$file_tmp)){
            self::writeFileToDir($file_tmp, $target_file_path, $file_name);
            self::writeFileToDatabase($user_id, 5, $user_id, $file_name, $file_type);
        }

        return Config::get('URL')."files/post/".$user_id."/".$file_name;
    }
    
    /**
     * 
     * @param type $files
     * @param type $user_id
     * @return boolean
     */
    public static function uploadFile($files,$user_id,$master_type,$master_id){
        if(!isset($files) || !isset($master_id)){
            return null;
        }
        if($master_type == 1){
            $dir = "user";
        } else if($master_type == 2){
            $dir = "game";
        }
        $file_num = count($files['name']);
        
        if($file_num > 6){
            return false;
        }
        
        for($i=0; $file_num > $i; $i++){
            $target_file_path = realpath(dirname(__FILE__).'/../../') . '/public/files/'.$dir.'/'.$master_id;
            $file_ext = strtolower(end(explode('.',$files['name'][$i])));
            $file_size = $files['size'][$i];
            $file_name = self::gen_uuid($files['name'][$i],8).".".$file_ext;
            $file_tmp = $files['tmp_name'][$i];
            $file_type = mime_content_type($file_tmp);
            $file_type = substr($file_type,0,strpos($file_type,'/'));
            if(strcasecmp($file_type, "application") == 0){
                $file_type = "text";
            }
            if(self::validateFile($file_size,mime_content_type($file_tmp),$file_tmp)){
                self::writeFileToDir($file_tmp, $target_file_path, $file_name);
                $output = self::writeFileToDatabase($user_id, $master_type, $master_id, $file_name, $file_type);
            }
        }
        return $output;
    }
    
    /**
     * 
     * @param type $user_id
     * @param type $file_name
     * @return boolean
     */
    public static function deleteFile($file_id){
        if(!isset($file_id)){
            return false;
        }
        
        $file = self::getFileData($file_id);
        
        if($file->master_type == 1){
            $dir = "user";
        } else if($file->master_type == 2){
            $dir = "game";
        }
        
        $target_file_path = realpath(dirname(__FILE__).'/../../') . '/public/files/'.$dir.'/'.$file->master_id;
        if(!self::deleteFileFromDir($target_file_path, $file->file_name)){
            return false;
        }
        
        if(!self::deleteFileFromDatabase($file_id)){
            return false;
        }
        
        return true;
    }
    
    public static function deleteAllFiles($master_type, $master_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT file_id FROM files WHERE master_type = :master_type AND master_id = :master_id";
        $query = $database->prepare($sql);
        $query->execute(array(':master_type' => $master_type, ':master_id' => $master_id));
        
        foreach($query->fetchAll() as $file){
            self::deleteFile($file->file_id);
        }
        
        return true;
    }
    
    /**
     * 
     * @param type $files
     * @return boolean
     */
    public static function validateFile($size_input, $type_input, $tmp_name){
        $file_type = null;

        $controller = array();
        $controller['types'] = array('image','text');
        $controller['image'] = new stdClass();
        $controller['image']->extensions = array("image/pjpeg","image/jpeg","image/png","image/gif",);
        $controller['image']->FileSize = 5000000;
        $controller['image']->ImageSize = 50;
        $controller['text'] = new stdClass();
        $controller['text']->extensions = array("application/msword","text/plain","application/vnd.ms-powerpoint","application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            ,"application/vnd.openxmlformats-officedocument.presentationml.presentation","application/pdf");
        $controller['text']->FileSize = 5000000;
                    
        $file_size = $size_input;
        $file_ext = $type_input;

        if(in_array($file_ext, $controller['image']->extensions)){
            $file_type = 'image';
        } else if(in_array($file_ext, $controller['text']->extensions)){
            $file_type = 'text';
        } else{
            //UNKNOWN TYPE ERROR FEEDBACK
            return false;
        }

        if($file_size > $controller[$file_type]->FileSize){
            //OVER SIZE ERROR FEEDBACK
            return false;
        }
        
        if($file_type == 'image'){
            $image_proportions = getimagesize($tmp_name);
            if($image_proportions[0] <  $controller['image']->ImageSize 
                    || $image_proportions[1] < $controller['image']->ImageSize){
                //SMALL SIZE IMAGE FEEDBACK
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * 
     * @param type $file_tmp
     * @param type $target_file_path
     * @param type $file_name
     */
    public static function writeFileToDir($file_tmp,$target_file_path,$file_name){
        if(is_dir($target_file_path)==false){
            mkdir($target_file_path, 0755);
        }
        move_uploaded_file($file_tmp,$target_file_path."/".$file_name);
        chmod($file_tmp,$target_file_path."/".$file_name, 0755);
        return true;
    }
    
    public static function writeFileToDatabase($user_id, $master_type, $master_id,$file_name,$file_type){
        $file_creation_timestamp = time();
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("INSERT INTO files (user_id, master_type, master_id, file_name, file_type, file_creation_timestamp)
                 VALUES(:user_id, :master_type, :master_id, :file_name, :file_type, :file_creation_timestamp)");
        $query->execute(array(':user_id' => $user_id, ':master_type' => $master_type, ':master_id' => $master_id, 'file_name' => $file_name,
                            'file_type' => $file_type, 'file_creation_timestamp' => $file_creation_timestamp));
        
        if($query->rowCount() == 1){
            //ADD Feedback Message
            return $database->lastInsertId();
        }
    }
    
    /**
     * 
     * @param type $target_file_path
     * @param type $file_name
     * @return boolean
     */
    public static function deleteFileFromDir($target_file_path, $file_name){
        if (!file_exists($target_file_path.'/'.$file_name)){
            return false;
        }
        
        if (!unlink($target_file_path.'/'.$file_name)) {
            //Feedback Deletion failed!
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * @param type $user_id
     * @param type $file_name
     * @return boolean
     */
    public static function deleteFileFromDatabase($file_id){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM files WHERE file_id = :file_id LIMIT 1");
        $query->execute(array(':file_id' => $file_id));
        
        if($query->rowCount() == 1){
            //ADD Feedback Message
            return true;
        }
    }
    
    /**
     * 
     * @param type $salt
     * @param type $len
     * @return type
     */
    public static function gen_uuid($salt,$len) {

        $hex = md5($salt . uniqid("", true));

        $pack = pack('H*', $hex);
        $tmp =  base64_encode($pack);

        $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);

        $len = max(4, min(128, $len));

        while (strlen($uid) < $len){
            $uid .= gen_uuid(22);
        }

        return substr($uid, 0, $len);
    }
}

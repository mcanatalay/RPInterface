<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class PostModel{
    
    public static function getPostByPostID($post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM posts WHERE post_id = :post_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id));
        $post = $query->fetch();
        if($query->rowCount() == 1){
            return $post;
        }
        //ADD FEEDBACK HERE
        return null;
    }
    
    public static function getNumberOfPostsByToID($post_type,$to_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM posts WHERE post_type = :post_type AND to_id = :to_id";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type'=> $post_type, ':to_id' => $to_id));
        
        return $query->fetchColumn();
    }
    
    public static function getAllPostsByToID($post_type, $to_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT from_id, post_id, post_status, post_text_source,
                    post_text, post_creation_timestamp, post_modified_timestamp
                        FROM posts WHERE post_type = :post_type AND to_id = :to_id
                            ORDER BY post_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type'=> $post_type, ':to_id' => $to_id));
        
        $all_posts = array();
        
        foreach($query->fetchAll() as $post){
            $all_posts[$post->post_id] = new stdClass();
            $all_posts[$post->post_id] = $post;
        }
        
        return $all_posts;
    }
    
    public static function getLimitedPostsByToID($post_type, $to_id, $post_limit=2, $post_page=0){
        $database = Database::getFactory()->getConnection();
        //We are doing pagination.
        $post_offset = $post_page * $post_limit;
        $sql = "SELECT * FROM posts WHERE post_type = :post_type AND to_id = :to_id
                            ORDER BY post_creation_timestamp DESC LIMIT ".$post_limit." OFFSET ".$post_offset."";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type' => $post_type, ':to_id' => $to_id));
        
        $posts = array();
        
        foreach($query->fetchAll() as $post){
            $posts[$post->post_id] = new stdClass();
            $posts[$post->post_id] = $post;
        }
        
        return $posts;
    }
    
    public static function getLastPostsByToID($post_type, $to_id, $days){
        $post_creation_timestamp = strtotime('-'.$days.' day',time());

        $database = Database::getFactory()->getConnection();
        $sql = "SELECT from_id, post_id, post_status, post_text_source, post_text,
                    post_creation_timestamp, post_modified_timestamp
                        FROM posts WHERE post_type = :post_type AND to_id = :to_id 
                            AND post_creation_timestamp >= :post_creation_timestamp
                                ORDER BY post_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type' => $post_type, ':to_id' => $to_id,
            ':post_creation_timestamp' => $post_creation_timestamp));
        
        $posts = array();
        
        foreach($query->fetchAll() as $post){
            $posts[$post->post_id] = new stdClass();
            $posts[$post->post_id] = $post;
        }
        
        return $posts;
    }
    
    public static function newPost($post_type, $from_id, $to_id, $post_text_source, $post_status = 0){
        $post_text = Text::bb_parse($post_text_source);
        $post_creation_timestamp = time();
        
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO posts(post_type, from_id, to_id, post_status,
                    post_text_source, post_text, post_creation_timestamp)
                        VALUES(:post_type, :from_id, :to_id, :post_status, 
                            :post_text_source, :post_text, :post_creation_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type' => $post_type, ':from_id' => $from_id, ':to_id' => $to_id, 
            ':post_status' => $post_status, ':post_text_source' => nl2br($post_text_source), ':post_text' => $post_text, 
            ':post_creation_timestamp' => $post_creation_timestamp));
        
        $count = $query->rowCount();
        $post_id = $database->lastInsertId();
        
        if($count == 1){
            FeedModel::addSubscription($from_id, 5, $post_id);
            FeedModel::pushNotification($from_id, $to_id, $post_type, "NEW_POST");
            return true;
        }
        //Add Feedback for post error sent
        return false;
    }
    
    public static function getPostOwner($post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM posts WHERE post_id = :post_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id));
        $post = $query->fetch();

        if($query->rowCount() == 1){
            return $post->from_id;
        }
        
        //ADD FEEDBACK HERE
        return null;
    }
    
    public static function editPost($post_id, $post_text_source, $post_status = 0){
        $post_text = Text::bb_parse($post_text_source);
        $post_modified_timestamp = time();
        
        $database = Database::getFactory()->getConnection();
        $sql = "UPDATE posts SET post_status = :post_status, post_text_source = :post_text_source,
                    post_text = :post_text, post_modified_timestamp = :post_modified_timestamp
                        WHERE post_id = :post_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id, ':post_status' => $post_status,
            ':post_text_source' => nl2br($post_text_source), ':post_text' => $post_text, 
            ':post_modified_timestamp' => $post_modified_timestamp));
        
        $count = $query->rowCount();
        
        if($count == 1){
            //Add Feedback for post successfuly modified
            return true;
        }
        //Add Feedback for post error modified
        return false;
    }
    
    public static function deletePost($post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM posts WHERE post_id = :post_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id));
        
        $count = $query->rowCount();
        
        if($count != 1){
            return false;
        }
        
        FeedModel::deleteAllSubscription(5, $post_id);
        return CommentModel::deleteAllCommentsByPostID($post_id);
    }
    
    public static function deleteAllPostsByToID($post_type, $to_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT post_id FROM posts WHERE post_type = :post_type AND to_id = :to_id";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type' => $post_type, ':to_id' => $to_id));
        $posts = $query->fetchAll();
        
        $sql = "DELETE FROM posts WHERE post_type = :post_type AND to_id = :to_id";
        $query = $database->prepare($sql);
        $query->execute(array(':post_type' => $post_type, ':to_id' => $to_id));
        
        foreach($posts as $post){
            $sql = "DELETE FROM comments WHERE post_id = :post_id";
            $query = $database->prepare($sql);
            $query->execute(array(':post_id' => $post->post_id));
            FeedModel::deleteAllSubscription(5, $post->post_id);
            $count = $query->rowCount();
        }
        
        //Add Feedback for post success deleted
        return true;
    }
 }

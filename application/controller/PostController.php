<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class PostController extends Controller{
    /**
     * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
     * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
     * needed in the PostController).
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function user(){
        $user_posts = PostModel::getAllPostsByToID(1,Request::post('to_id'));
        return $user_posts;
    }
    
    public function posts(){
        View::render('post/posts', array(
                        'posts' => PostModel::getLimitedPostsByToID(Request::post('post_type'),
                                        Request::post('to_id'),Request::post('post_limit'),Request::post('post_page')),
                        'here' => Request::post('here')
                        )
                    );
    }
    
    public function post($post_id){
        $this->View->renderWithAll('post/index', array(
                        'post' => PostModel::getPostByPostID($post_id)));
    }
    
    public function newPost(){
        if(Auth::checkLogged() && ( (Request::post('post_type') == 1 && (Auth::checkSelf(Request::post('to_id')) || FeedModel::isSubscribeEachOther(Session::get('user_id'), Request::post('to_id')))) || (Request::post('post_type') == 2 && GameModel::isVerifiedPlayer(Session::get('user_id'), Request::post('to_id'))) ) ){
            PostModel::newPost(Request::post('post_type'),Session::get('user_id'),Request::post('to_id'),
                                 Request::post('post_text_source'),0);
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
    
    public function editPost(){
        if(Auth::checkLogged() && PostModel::getPostOwner(Request::post('post_id')) == Session::get('user_id')){
            PostModel::editPost(Request::post('post_id'),Request::post('post_text_source'),0);
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
    
    public function deletePost(){
        $post = PostModel::getPostByPostID(Request::post('post_id'));
        if(Auth::checkLogged() && (Auth::checkSelf($post->from_id) || ($post->post_type == 1 && Auth::checkSelf($post->to_id) || ($post->post_type == 2 && GameModel::isGameMaster(Session::get('user_id'), $post->to_id))))){
            PostModel::deletePost(Request::post('post_id'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
}
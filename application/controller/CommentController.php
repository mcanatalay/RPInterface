<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class CommentController extends Controller{
    /**
     * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
     * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
     * needed in the PostController).
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function comments(){
        if(!Request::post('last_comment_id') || Request::post('last_comment_id') == 0){
            View::render('comment/comments', array(
                            'comments' => CommentModel::getAllCommentsByPostID(Request::post('post_id')),
                            'post_id' => Request::post('post_id'),
                            'here' => Request::post('here'))
                        );
        } else{
            View::render('comment/comments', array(
                            'comments' => CommentModel::getOffsetedCommentsByPostID(Request::post('post_id'), Request::post('last_comment_id')),
                            'post_id' => Request::post('post_id'),
                            'here' => Request::post('here'))
                        );
        }
    }
    
    public function newComment(){
        if(Auth::checkLogged()){
            CommentModel::newComment(Request::post('post_id'),Request::post('from_id'),
                                 Request::post('comment_text_source'));
            Redirect::back(Request::post('redirect'));
        }
    }
    
    public function deleteComment(){
        if(Auth::checkLogged() && (Auth::checkSelf(CommentModel::getCommentOwner(Request::post('comment_id'))) || Auth::checkSelf(CommentModel::getCommentPostOwner(Request::post('comment_id'))))){
            CommentModel::deleteComment(Request::post('comment_id'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
}
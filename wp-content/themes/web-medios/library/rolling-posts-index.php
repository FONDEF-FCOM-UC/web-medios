<?php

class RollingPostsIndex {
    protected static $posts = array();

    public function set($new_posts){
        if($new_posts){
		    $previous_posts = self::get();
		    $posts = array_merge($previous_posts, $new_posts);
		    self::$posts = $posts;
        }
    }

    public function get(){
        return self::$posts;
    }
}

?>

<?php
// function to display number of posts.
function getPostLikes($postID) {
    $count_key = '_post_likes_count';
    $count = get_post_meta($postID, $count_key, false);
    $number = sizeof($count);
    return $number; 
}
function getPostLiked($postID, $ip){
    $count_key = '_post_likes_count';
    $count = get_post_meta($postID, $count_key, false);
    if (in_array($ip, $count)) {
        return true;
    }
    return false; 
}
//var_dump(getPostLiked(1, get_client_ip()));
// function to count views.
function setPostLikes($postID, $ip) {
    $count_key = '_post_likes_count';
    $count = get_post_meta($postID, $count_key, false);
    //var_dump($count);
    if (!in_array($ip, $count)) {
        add_post_meta($postID, $count_key, $ip);
    }
}
//setPostLikes(1, '59.152.91.35');

?>
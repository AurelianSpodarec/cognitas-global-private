<?php 
function cookieCheck($cookie_name,$cookie_value){
    //If the cookies doesn't exist or it does exist but the values are different
    if(!isset($_COOKIE[$cookie_name]) || (isset($_COOKIE[$cookie_name]) && $cookie_value !== $_COOKIE[$cookie_name])):
    //then we want to update the cookie and show the new popup.
    return true;
    endif;
}

function emergency_popup() {
    global $theme_settings;
    global $post;
    $term = get_queried_object();
    $op = '';

    $emergency = $theme_settings['important_notices'];

    if(!empty($emergency)):
        foreach($emergency as $e):
            $cookie_name = '_PU-'.preg_replace('/\\s/','_',$e['title']);
            $cookie_value = sha1($e['content']);
            $show = true;
        
            
            if( $e['enabled'] === true && cookieCheck($cookie_name,$cookie_value) === true):

                if(is_page() || is_front_page()):
                    if( !empty($e['include']) && !in_array($post->ID, $e['include']) ):
                        $show = false;
                    endif;
                    if( !empty($e['exclude']) && in_array($post->ID, $e['exclude']) ):
                        $show = false;
                    endif;
                
                elseif(is_archive()):
                    if(!in_array($term->name, $e['include_on']) ):
                        $show = false;
                    endif;

                elseif(is_single()):
                    if(!in_array(ucfirst($term->post_type), $e['include_on']) ):
                        $show = false;
                    endif;

                else:
                    //If is none of the above post types then probably somewhere dark we don't want to show popups (like error pages)
                    $show = false;
                endif;
                

                if($show == true):
                    setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 1 day

                    $op = '<div class="popup_content">
                    <a href="#" class="close"></a>
                    <h2>'. $e['title'].'</h2>
                    '.$e['content'].'
                    </div>';
                    
                    //return $op;
                endif;
                
            endif;
        endforeach;
    endif;
    return $op;
}
<?php

function get_instagram_recent_photos() {
  global $theme_settings;

  $api = current($theme_settings['api_keys']);

  $endpoint = 'https://api.instagram.com/v1/users/self/media/recent/';
  $token = $api['instagram_access_token'];

  if (empty($token)) {
    return $default_image;
  }

  $key = md5($endpoint . $token . 'instagram_access');
  $key = "get_insta_recent_photo:$key";

  if ($response !== wp_cache_get($key, 'instagram')) {
    // @codingStandardsIgnoreStart
    $request = wp_remote_get("{$endpoint}?access_token=${token}");
    $response = wp_remote_retrieve_body($request);
    $response = json_decode($response);

    //print("<pre>".print_r($response,true)."</pre>");

    $return = array();

    $return[0]['img'] = $response->data[0]->images->standard_resolution->url;
    $return[0]['link'] = $response->data[0]->link;
    $return[0]['caption'] = $response->data[0]->caption->text;
    $return[0]['created_at'] = $response->data[0]->created_time;
    $return[1]['img'] = $response->data[1]->images->standard_resolution->url;
    $return[1]['link'] = $response->data[1]->link;
    $return[1]['caption'] = $response->data[1]->caption->text;
    $return[1]['created_at'] = $response->data[1]->created_time;
    $return[2]['img'] = $response->data[2]->images->standard_resolution->url;
    $return[2]['link'] = $response->data[2]->link;
    $return[2]['caption'] = $response->data[2]->caption->text;
    $return[2]['created_at'] = $response->data[2]->created_time;
    $return[3]['img'] = $response->data[3]->images->standard_resolution->url;
    $return[3]['link'] = $response->data[3]->link;
    $return[3]['caption'] = $response->data[3]->caption->text;
    $return[3]['created_at'] = $response->data[3]->created_time;
    // @codingStandardsIgnoreEnd

    wp_cache_set($key, $response, 'instagram', 600);
  }

  if (wp_remote_retrieve_response_message($request) !== 'OK' || wp_remote_retrieve_response_code($request) !== 200) {
    wp_send_json_error($response);

    return;
  }

  return $return;
};

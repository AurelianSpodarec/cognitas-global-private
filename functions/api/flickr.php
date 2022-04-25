<?php

function get_flickr_recent_photo() {
  global $theme_settings;
  $api_keys = current($theme_settings['api_keys']);
  $card_panel = current($theme_settings['card_panel']);
  $api_key = $api_keys['flickr_api_key'];
  $user_id = $api_keys['flickr_user_id'];
  $format = 'json';
  $method_get_photos = 'flickr.people.getPhotos';
  $endpoint = 'https://www.flickr.com/services/rest/';

  $default_image = $card_panel['flickr_default_image'];

  if (empty($api_key) || empty($user_id)) {
    return $default_image;
  }

  $key = md5($endpoint . $api_key . 'flickr');
  $key = "get_flickr_recent_photo:$key";

  if ($response !== wp_cache_get($key, 'flickr')) {
    // @codingStandardsIgnoreStart
    $request = "${endpoint}?method=${method_get_photos}&format=${format}&user_id=${user_id}&api_key=${api_key}&nojsoncallback=1&page_size=1";
    $result = wp_remote_get($request);
    $response = wp_remote_retrieve_body($result);
    $response = json_decode($response);
    $photo = $response->photos->photo[0];
    $photo_id = $photo->id;
    $farm = $photo->farm;
    $server = $photo->server;
    $secret = $photo->secret;
    $url = "https://farm${farm}.staticflickr.com/${server}/${photo_id}_${secret}_z.jpg";

    // @codingStandardsIgnoreEnd
    wp_cache_set($key, $url, 'flickr', 600);
  }
  if (wp_remote_retrieve_response_message($result) !== 'OK' || wp_remote_retrieve_response_code($result) !== 200) {
    wp_send_json_error($response);
    return;
  }

  return $url;
};

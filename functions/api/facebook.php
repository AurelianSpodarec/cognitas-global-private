<?php

function get_facebook_recent_post() {
  global $theme_settings;

  //$api = current($theme_settings['api_keys']);
  //$page_id = $api['facebook_page_id'];
  //$page_name = $api['facebook_page_name'];
  //$page_url = $api['facebook_page_url'];
  //$token = $api['facebook_access_token'];

  $page_id = '195806190563736';
  $page_name = 'christshospitalschool';
  $page_url = 'https://www.facebook.com/christshospitalschool/';
  $token = 'EAAH7gPbBw9wBAFYcs5ZAPnZAd3tyTi4zXpWNeVsWY27vSiDK3CxR9XmSRUVZCGBUqVWvF9F8RZBOInF3bAoymZCKP39CbCZBlmkoZCTPUs7PFXCuP6ZBDXW8zH6h3ZCIZAyjuXae0jIU8ZBxDFl3bfMoPlOZCn0FX6tZASy7N0vo07EEddRTrUzVPCbE4';
  $endpoint = "https://graph.facebook.com/${page_id}/feed";

  if (empty($token) || empty($page_name) || empty($page_url) || empty($page_id)) {
    $response = [
      'message' => 'Invalid Facebook API settings',
      'post_url' => '#',
      'page_url' => '#',
      'page_name' => 'Facebook',
    ];

    return $response;
  }

  $key = md5($endpoint . $token . 'facebook_access');
  $key = "get_facebook_recent_post:$key";

  $facebookArray = array();
  $postLoop = 1;
  $postLimit = 3;

  if ($response !== wp_cache_get($key, 'facebook')) {
    // @codingStandardsIgnoreStart
    $request = wp_remote_get("{$endpoint}?access_token=${token}");
    $response = wp_remote_retrieve_body($request);
    $response = json_decode($response, true);

    foreach ($response['data'] as $res) {
      if (!empty($res['message'])) {
        $response = $res;

        $attachment = get_facebook_recent_post_attachments($response['id'], $token);

        $post_id = explode('_', $response['id']);
        $post_id = $post_id[1];

        $response = [
          'message' => $response['message'],
          'post_url' => "${page_url}posts/${post_id}",
          'page_url' => $page_url,
          'page_name' => $page_name,
          'create_at' => $response['created_time'],
          'attachment' => '',
        ];
        array_push($facebookArray,$response);

        $postLoop++;

        if($postLoop > $postLimit) {
          break;
        }
      }
    }
    //@codingStandardsIgnoreEnd

    wp_cache_set($key, $facebookArray, 'facebook', 600);
  }

  if (wp_remote_retrieve_response_message($request) !== 'OK' || wp_remote_retrieve_response_code($request) !== 200) {
    return false;
  }

  return $facebookArray;
};

function get_facebook_recent_post_attachments($post_id, $token) {
  if (empty($post_id)) {
    return false;
  }

  $endpoint = "https://graph.facebook.com/${post_id}/attachments";

  $key = md5($endpoint . $token . 'facebook_access');
  $key = "get_facebook_recent_post_attachments:$key";

  //@codingStandardsIgnoreStart
  if ($response !== wp_cache_get($key, 'facebook_attachment')) {
    $request = wp_remote_get("{$endpoint}?access_token=${token}");
    $response = wp_remote_retrieve_body($request);
    $response = json_decode($response, true);
    $response = !empty($response['data'][0]['media']['image']['src']) ? $response['data'][0]['media']['image']['src'] : $response['data'][0]['subattachments']['data'][0]['media']['image']['src'];

    wp_cache_set($key, $response, 'facebook_attachment', 600);
  }
  //@codingStandardsIgnoreEnd

  if (wp_remote_retrieve_response_message($request) !== 'OK' || wp_remote_retrieve_response_code($request) !== 200) {
    return false;
  }

  if (!empty($response)) {
    return $response;
  } else {
    return null;
  }
}

<?php

/*
 * Get tweets
 */

require('inc/twitter/twitter.class.php');

/* implement get_tweets */
function get_tweets($username = '', $count = 15, $options = false) {
  global $theme_settings;

  $api = current($theme_settings['api_keys']);

  $upload_dir = wp_get_upload_dir();

  $twitter = [
      'username' => !empty($username) ? $username : $api['twitter_username'],
      'consumer_key' => $api['twitter_consumer_key'],
      'consumer_secret' => $api['twitter_consumer_secret'],
      'access_token' => $api['twitter_access_token'],
      'access_token_secret' => $api['twitter_access_token_secret'],
  ];

  $config['key'] = $twitter['consumer_key'];
  $config['secret'] = $twitter['consumer_secret'];
  $config['token'] = $twitter['access_token'];
  $config['token_secret'] = $twitter['access_token_secret'];
  $config['screenname'] = $twitter['username'];
  $config['cache_expire'] = 0;
  if ($config['cache_expire'] < 1) {
    $config['cache_expire'] = 0;
  }
  $config['directory'] = $upload_dir['basedir'] . '/';

  $obj = new Twitter($config);
  $res = $obj->getTweets($username, $count, $options);
  update_option('tdf_last_error', $obj->st_last_error);
  return $res;
}

function parse_tweet_message($text) {
  //links
  $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);

  //users
  $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);

  //hashtags
  $text = preg_replace('/\s+#(\w+)/', ' <a href="https://twitter.com/hashtag/$1" target="_blank">#$1</a>', $text);

  return $text;
}

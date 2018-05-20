<?php
/**
 * Get Tweets
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */



function queryTwitterUser($search) {
    $url = "https://api.twitter.com/1.1/search/tweets.json";
    if($search != "")
        $search = $search;
    $query = array( 'count' => 10, 'q' => urlencode($search).' -filter:retweets -filter:replies ', "result_type" => "recent", "tweet_mode" => "extended",);
    $consumer_key = cmb2_get_option('eggman_options', 'twitterconsumerkey');
    $consumer_secret = cmb2_get_option('eggman_options', 'twitterconsumersecret');
    $oauth_access_token = cmb2_get_option('eggman_options', 'twitteraccesstoken');
    $oauth_access_token_secret = cmb2_get_option('eggman_options', 'twitteraccesstokensecret');
    $oauth = array(
      'oauth_consumer_key' => $consumer_key,
      'oauth_nonce' => time(),
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_token' => $oauth_access_token,
      'oauth_timestamp' => time(),
      'oauth_version' => '1.0');

    $base_params = empty($query) ? $oauth : array_merge($query,$oauth);
    $base_info = buildBaseString($url, 'GET', $base_params);
    $url = empty($query) ? $url : $url . "?" . http_build_query($query);

    $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature'] = $oauth_signature;

    $header = array(buildAuthorizationHeader($oauth), 'Expect:');
    $options = array( CURLOPT_HTTPHEADER => $header,
                      CURLOPT_HEADER => false,
                      CURLOPT_URL => $url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_SSL_VERIFYPEER => false);

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);
    parseTwitter(json_decode($json));
}








function queryTwitter($search) {
    $url = "https://api.twitter.com/1.1/search/tweets.json";
    if($search != "")
        $search = "#".$search;
    $query = array( 'count' => 10, 'q' => urlencode($search).' -filter:retweets -filter:replies -from:TheEggmanCanada', "result_type" => "recent", "tweet_mode" => "extended",);
    $consumer_key = cmb2_get_option('eggman_options', 'twitterconsumerkey');
    $consumer_secret = cmb2_get_option('eggman_options', 'twitterconsumersecret');
    $oauth_access_token = cmb2_get_option('eggman_options', 'twitteraccesstoken');
    $oauth_access_token_secret = cmb2_get_option('eggman_options', 'twitteraccesstokensecret');
    $oauth = array(
      'oauth_consumer_key' => $consumer_key,
      'oauth_nonce' => time(),
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_token' => $oauth_access_token,
      'oauth_timestamp' => time(),
      'oauth_version' => '1.0');

    $base_params = empty($query) ? $oauth : array_merge($query,$oauth);
    $base_info = buildBaseString($url, 'GET', $base_params);
    $url = empty($query) ? $url : $url . "?" . http_build_query($query);

    $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature'] = $oauth_signature;

    $header = array(buildAuthorizationHeader($oauth), 'Expect:');
    $options = array( CURLOPT_HTTPHEADER => $header,
                      CURLOPT_HEADER => false,
                      CURLOPT_URL => $url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_SSL_VERIFYPEER => false);

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);
    parseTwitter(json_decode($json));
}


function parseTwitter ($results) {
  foreach ($results->statuses as $tweet) {

    $dt = new DateTime('@'.strtotime($tweet->created_at));
    $dt->setTimeZone(new DateTimeZone('America/Toronto'));

    $args = array(
      'id' => $tweet->id_str,
      'time' => strtotime($dt->format('Y-m-d H:i:s')),
      'text' => $tweet->full_text,
      'name' => $tweet->user->name,
      'user' => $tweet->user->screen_name,
      'avatar' => $tweet->user->profile_image_url,
    );
    if (isset($tweet->entities->media)) {
      $args['media_img'] = $tweet->entities->media['0']->media_url;
      $args['media_type'] = $tweet->extended_entities->media['0']->type;
    }

    if (isset($tweet->quoted_status)) {
      $args['quote']['text'] = $tweet->quoted_status->full_text;
      $args['quote']['name'] = $tweet->quoted_status->user->name;
      $args['quote']['user'] = $tweet->quoted_status->user->screen_name;

      if (isset($tweet->quoted_status->entities->media)) {
        $args['quote']['media_img'] = $tweet->quoted_status->entities->media['0']->media_url;
        $args['quote']['media_type'] = $tweet->quoted_status->entities->media['0']->type;
      }
    }

var_dump($args);
    addSocial('twitter', $args);
  }
}

function buildBaseString($baseURI, $method, $params)
{
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth)
{
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

?>

<?php   

$tt = $_POST['text'];

function gethashtags($text){

  preg_match_all('/(^|[^a-z가-힣0-9_])#([a-z가-힣0-9_]+)[[:space:]]/i', $text, $matchedHashtags);

  $hashtag = '';

  // For each hashtag, strip all characters but alpha numeric

  if(!empty($matchedHashtags[0])) {

      foreach($matchedHashtags[0] as $match) {
          $hash= preg_replace("/[^a-z가-힣0-9]+/i", "", $match);
          $hashtag .= '<div id =\'hash_div\'>
          <input type="hidden" name=\'hash[]\' value=\''.$hash.'\'>
          <input id=\'hash_id\'type="hidden" name=\'hash_id[]\' value=\'0\'>

          <span id= \'hash_span\' >#'.$hash.'</span>
          <span id= \'hash_remove\' >x</span>
          </div>';

      }

  }

/*onclick=\'var a=$(this).parent().children("#hash_id").val();$(this).parent().children("#hash_id").val(1-a);$(this).css("color","rgb(0,0,255)");\'
*/
    //to remove last comma in a string

//return rtrim($hashtag, ',');
  return $hashtag;

}

//usage

//$text = "w3lessons.info - #php programming blog, #facebook wall script";

echo gethashtags($tt); //output - php,facebook


 ?>
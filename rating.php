<?php

// 1. Read existing comments from a file
//    empty array):
$comments = [];
if(file_exists("comments.txt")) {
  $commentString = file_get_contents("comments.txt");
  $comments = json_decode($commentString, true);
}
$count = [];

if (isset($_GET['count'])) {
for($i = 0; $i < count($comments); $i++) {
  if($comments[$i]['postId'] == $_GET['postId']) { //if comments belongs to same post (from URL)
    if($comments[$i]['id'] == $_GET['id']) { //and if comment id (from URL) matches the one in comments.txt/array
      $comments[$i]['count'] = $comments[$i]['count'] + $_GET['count']; //"n" from save function (scrips.js, l. 33) is added to count in comments array
    }
    $counts['amount'] = $comments[$i]['count'];
    $counts['id'] = $comments[$i]['id'];
    array_push($count, $counts); //puts counts into count array //multidimensional array 
  }
}
  file_put_contents('comments.txt', json_encode($comments)); //placing new data (with counts) into comment.txt in JSON format
  //!isset($_GET['count']) --> update
} else if (file_exists('comments.txt')) { //if file already exists
  foreach($comments as $comment) {
    if($comment['postId'] == $_GET['postId']) {
      $counts['amount'] = $comment['count']; //update
      $counts['id'] = $comment['id']; //update
      array_push($count, $counts); //puts counts into count array
    }
  }
}
echo json_encode($count); //XMLHttpResponse
?>

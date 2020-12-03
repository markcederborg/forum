
<?php
include_once('./Includes/header.php');
$posts = [];
if (file_exists("posts.txt"))
{
  $string = file_get_contents("posts.txt");
  $posts  = json_decode($string, true);
}
?>
  <h3>Current post</h3>
  <div class="post">
  <?php
  foreach ($posts as $post) {
      if($post['id'] == $_GET['id']) {
          echo "Author: " . $post['author'] .
          "<br>Title: " . $post["title"] .
          "<br>Content: " . $post["content"];
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == $post['author']) {
                echo '<a href="./edit.php?id='.$post['id'].'" class="goTo">Edit your post</a>';
            }
        }
      }
  }
?>
  </div>

<h3>Comments</h3>
<?php
  $shownComments = [];
if (file_exists("comments.txt"))
{
  $string = file_get_contents("comments.txt");
  $shownComments  = json_decode($string, true);
}

foreach($shownComments as $currentComment) {
  if($currentComment['postId'] == $_GET['id']) {
  ?>
<div class="wrapper">
  <span class="rating" id="rating_<?= $currentComment['id'] ?>">
    <div onclick="save(1, '<?= $currentComment['id'] ?>', '<?= $currentComment['postId'] ?>')">+</div>
    <div id="count_<?= $currentComment['id'] ?>"></div> <!--useful to (scipt.js, l. 13)--->
    <div onclick="save(-1, '<?= $currentComment['id'] ?>', '<?= $currentComment['postId'] ?>')">-</div>
</span>
<span class="comment">
  <p>Written by: <?= $currentComment['author'] ?></p>
  <p><?= $currentComment['text'] ?> </p> <br>
<?php
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == $currentComment['author']) {
            echo '<a href="./edit.php?id='.$currentComment['id'].'" class="goTo"">Edit your comment</a>';
        }
    }
    ?>
    </span>
</div>
  <?php
}
}

if(isset($_SESSION['username'])) {
    ?>
    <br><br><br>
    <form class="newPost" method="post">
        <textarea name="comment" rows="10" cols="80"></textarea>
        <input type="submit" name="addComment" value="Add your comment">
    </form>
  <?php
      if(isset($_POST['addComment'])) {
        $singleComment = [
            "author" => $_SESSION['username'],
            "text" => $_POST['comment'],
            "id" => uniqid("comment_"),
            "postId" => $_GET['id'],
            "count" => 0
        ];

          $comments = [];
          if(file_exists("comments.txt")) {
              $commentString = file_get_contents("comments.txt");
              $comments = json_decode($commentString, true);
          }
          $comments[] = $singleComment;
          $commentString = json_encode($comments);
          file_put_contents("comments.txt", $commentString);
          header('Location: ./singlePost.php?id=' . $_GET['id']);
      }
  }
?>
    <script> ajax("rating.php?postId=<?= $_GET['id'] ?>", update); </script>
<?php
include_once('./Includes/footer.php');
?>

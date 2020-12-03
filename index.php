<?php
include_once('./Includes/header.php');
if(isset($_SESSION['username'])) {
    ?>
      <h1>Create a new post</h1>
       <form class="newPost" method="post">
         <input type="text" name="title" placeholder="Title" value=""> <br>
         <textarea name="content" value="" placeholder="Content" rows="10" cols="80"></textarea>
         <input type="submit" name="submit" value="Submit your post">
       </form>
   <?php
     }

$posts = [];
if (file_exists("posts.txt"))
{
  $string = file_get_contents("posts.txt");
  $posts  = json_decode($string, true);
}
if(!empty($posts)) {
?>
<h3>Posts</h3>
<?php
  foreach ($posts as $post) {
    ?>
    <div class="post">
      <p>Author: <?= $post['author'] ?> </p>
      <p>Title: <?= $post["title"] ?> </p>
      <p>Content: <?= $post["content"] ?> </p>
      <a href="singlePost.php?id=<?= $post['id'] ?>" class="goTo">Go to the post</a>
    </div>
<?php
  }
} else {
  echo "<h3>There's currently no posts</h3>";
}

  if (isset($_POST["submit"])) {
    $post = [
      "id" => uniqid(),
      "title" => $_POST["title"],
      "content" => $_POST["content"],
      "author" => $_SESSION['username']
    ];

    $posts = [];
    if (file_exists("posts.txt"))
    {
      $string = file_get_contents("posts.txt");
      $posts  = json_decode($string, true);
    }
    $posts[] = $post;

    $string = json_encode($posts);
    file_put_contents("posts.txt", $string);
    header("Location:./");
  }

  include_once('./Includes/footer.php');
?>

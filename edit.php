<?php
    include_once('./Includes/header.php');

    //if parrameter two exist in parrameter one
    if(strpos($_GET['id'], 'comment_') !== false) {
        $comments = [];

        if (file_exists("comments.txt"))
        {
            $string = file_get_contents("comments.txt");
            $comments  = json_decode($string, true);
        }

        foreach ($comments as $comment) {
            if($comment['id'] == $_GET['id']) {
                ?>    <form method='post'>
                      <textarea name='commentText'><?= $comment['text'] ?></textarea>
                      <input type='submit' name='editCommentSubmit' value='Submit changes'>
                      </form>
                <?php
            }
        }

        if(isset($_POST['editCommentSubmit'])) {
            for($i = 0; $i < count($comments); $i++) {
                if($comments[$i]['id'] == $_GET['id']) {
                    $comments[$i]['text'] = $_POST['commentText'];
                    $postId = $comments[$i]['postId'];
                }
            }
            file_put_contents("comments.txt", json_encode($comments));
            header('Location: ./singlePost.php?id=' . $postId);
        }

    } else {
        $posts = [];

        if(file_exists("posts.txt")) {
            $string = file_get_contents("posts.txt");
            $posts = json_decode($string, true);
        }

        foreach($posts as $post) {
            if($post['id'] == $_GET['id']) {
                ?>
                    <form class="newPost" method="post">
                        <input type="text" name="title" value="<?= $post['title'] ?>"> <br>
                        <textarea name="content" rows="10" cols="80"><?= $post['content'] ?> </textarea>
                        <input type="submit" name="submit" value="Post">
                    </form>
                <?php
            }
        }

        if(isset($_POST['submit'])) {
            for($i = 0; $i < count($posts); $i++) {
                if($posts[$i]['id'] == $_GET['id']) {
                    $posts[$i]['title'] = $_POST['title'];
                    $posts[$i]['content'] = $_POST['content'];
                }
            }
            file_put_contents("posts.txt", json_encode($posts));
            header('Location: ./singlePost.php?id=' . $_GET['id']);
        }
    }

    include_once('./Includes/footer.php');
?>

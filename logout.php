<?php
//begins session to know which one to destroy, redirects and exits
  session_start();
  session_destroy();
  header('Location: ./');
 ?>

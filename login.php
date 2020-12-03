<?php
include_once('./Includes/header.php');
if (! empty($_SESSION['username'])){
  header('Location:./');
}

if (isset($_POST["submit"])) {
  $users = [];
  if (file_exists("users.txt")){
    $string = file_get_contents("users.txt");
    $users  = json_decode($string, true);
  }

  if (!empty($_POST)){
    foreach ($users as $user) {
      if($_POST["username"] == $user["username"] && $_POST["password"]==$user["password"]){
        $_SESSION["username"] = $user["username"];
        $_SESSION["surname"] = $user["surname"];
        $_SESSION["gender"] = $user["gender"];
        header('Location:./');
      }
    }
  }
}
?>
      <h1>Login page</h1>
      <form method="POST" class="signupLoginSection">
        <i>Please login using the required information</i>
        <table>
          <tr>
            <td>Username: </td>
            <td><input type="text" name="username"></td>
          </tr>
          <tr>
            <td>Password: </td>
            <td><input type=password name=password></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Login"></td>
          </tr>
        </table>
      </form>
<?php
  include_once('./Includes/footer.php');
?>

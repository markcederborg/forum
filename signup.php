<?php
if ($_POST["submit"]) {

  $user = [
    "username" => $_POST["username"],
    "password" => $_POST["password"],
    "firstname" => $_POST["firstname"],
    "surname" => $_POST["surname"],
    "gender"   => $_POST["gender"],
    "birthday" => $_POST["birthday"]
  ];

  $users = [];
  if (file_exists("users.txt"))
  {
    $string = file_get_contents("users.txt");
    $users  = json_decode($string, true);
  }

  $users[] = $user;

  $string = json_encode($users);
  file_put_contents("users.txt", $string);
  header('location: ./');
}

include_once('./Includes/header.php');
?>

  <h1>Signup page</h1>
  <form method="post" class="signupLoginSection" action="signup.php">
  <i>Please fill in required information to create an account.</i>
    <table>
      <tr>
        <td>Username: </td>
        <td> <input type="text" placeholder="Enter Username" name="username" value=""> </td>
      </tr>
      <tr>
        <td>Password: </td>
        <td> <input type="password" placeholder="Enter Password" name="password" value=""> </td>
      </tr>
      <tr>
        <td>Firstname: </td>
        <td> <input type="text" placeholder="Enter firstname" name="firstname" value=""> </td>
      </tr>
      <tr>
        <td>Surname: </td>
        <td> <input type="text" placeholder="Enter Surname" name="surname" value=""> </td>
      </tr>
      <tr>
        <td>Date of birth: </td>
        <td><input type="date" placeholder="Enter Date" name="birthday" value=""></td>
      </tr>
      <tr>
        <td>Gender (Mr./Mrs.): </td>
        <td> <input type="radio" name="gender" value="male"> <input type="radio" name="Gender" value="female"> </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Signup"></td>
      </tr>
    </table>
  </form>
<?php
include_once('./Includes/footer.php');

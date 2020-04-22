<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "DeptNum" => $_POST['DeptNum'],
      "DeptName" => $_POST['DeptName'],
      "managerSSN" => $_POST['managerSSN'],
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"Department",
implode(", ", array_keys($new_user)),
":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['Fname']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
  <label for="DeptNum">Department Number</label>
  <input type="text" name="DeptNum" id="DeptNum">
  <label for="DeptName">Departmant Name</label>
  <input type="text" name="DeptName" id="DeptName">
  <label for="managerSSN">Manager SSN</label>
  <input type="text" name="managerSSN" id="managerSSN">
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

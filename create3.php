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
      "ProjName" => $_POST['ProjName'],
      "ProjNum" => $_POST['ProjNum'],
      "ProjDesc" => $_POST['ProjDesc'],
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"Project",
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
  <label for="ProjName">Project Name</label>
  <input type="text" name="ProjName" id="ProjName">
  <label for="ProjNum">Project Number</label>
  <input type="text" name="ProjNum" id="ProjNum">
  <label for="ProjDesc">Project Description</label>
  <input type="text" name="ProjDesc" id="ProjDesc">
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

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
      "SSN" => $_POST['SSN'],
      "DOB" => $_POST['DOB'],
      "Fname" => $_POST['Fname'],
      "Mname" => $_POST['Mname'],
      "Lname" => $_POST['Lname'],
      "Address" => $_POST['Address'],
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"Employee",
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
  <label for="SSN">SSN</label>
  <input type="text" name="SSN" id="SSN">
  <label for="DOB">DOB</label>
  <input type="text" name="DOB" id="DOB">
  <label for="Fname">First Name</label>
  <input type="text" name="Fname" id="Fname">
  <label for="Mname">Middle Name</label>
  <input type="text" name="Mname" id="Mname">
  <label for="Lname">Last Name</label>
  <input type="text" name="Lname" id="Lname">
  <label for="Address">Address</label>
  <input type="text" name="Address" id="Address">
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

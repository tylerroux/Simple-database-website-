<?php

/**
  * Delete a user
  */

require "../config.php";
require "../common.php";

if (isset($_GET["DeptNum"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $DeptNum = $_GET["DeptNum"];

    $sql = "DELETE FROM Department WHERE Department Number = :Department Number";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':DeptNum', $DeptNum);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Department";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

<h2>Delete users</h2>

<?php if ($success) echo $success; ?>

<table>
  <thead>
    <tr>
      <th>Department Number</th>
      <th>Department Name</th>
      <th>Manager SSN</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["DeptNum"]); ?></td>
      <td><?php echo escape($row["DeptName"]); ?></td>
      <td><?php echo escape($row["managerSSN"]); ?></td>
      <td><a href="delete2.php?DeptNum=<?php echo escape($row["DeptNum"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

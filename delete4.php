<?php

/**
  * Delete a user
  */

require "../config.php";
require "../common.php";

if (isset($_GET["SSN"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $SSN = $_GET["SSN"];

    $sql = "DELETE FROM Works WHERE SSN = :SSN";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':SSN', $SSN);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Works";

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
      <th>SSN</th>
      <th>Project Name</th>
      <th>Project Number</th>
      <th>Department Number</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["SSN"]); ?></td>
      <td><?php echo escape($row["ProjName"]); ?></td>
      <td><?php echo escape($row["ProjNum"]); ?></td>
      <td><?php echo escape($row["DeptNum"]); ?></td>
      <td><a href="delete4.php?SSN=<?php echo escape($row["SSN"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

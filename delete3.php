<?php

/**
  * Delete a user
  */

require "../config.php";
require "../common.php";

if (isset($_GET["ProjName"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $ProjName = $_GET["ProjName"];

    $sql = "DELETE FROM Project WHERE Project Name = :Project Name";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':ProjName', $ProjName);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Project";

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
      <th>Project Name</th>
      <th>Project Number</th>
      <th>Project Description</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["ProjName"]); ?></td>
      <td><?php echo escape($row["ProjNum"]); ?></td>
      <td><?php echo escape($row["ProjDesc"]); ?></td>
      <td><a href="delete3.php?ProjName=<?php echo escape($row["ProjName"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

<?php

/**
  * List all users with a link to edit
  */

try {
  require "../config.php";
  require "../common.php";

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

<h2>Update Project</h2>

<table>
  <thead>
    <tr>
      <th>Project Name</th>
      <th>Project Number</th>
      <th>Project Description</th>
      <th>Edit</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["ProjNum"]); ?></td>
        <td><?php echo escape($row["ProjName"]); ?></td>
        <td><?php echo escape($row["ProjDesc"]); ?></td>
        <td><a href="update-single3.php?ProjName=<?php echo escape($row["ProjName"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

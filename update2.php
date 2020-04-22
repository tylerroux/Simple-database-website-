<?php

/**
  * List all users with a link to edit
  */

try {
  require "../config.php";
  require "../common.php";

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

<h2>Update Department</h2>

<table>
  <thead>
    <tr>
      <th>Department Number</th>
      <th>Department Name</th>
      <th>Manager SSN</th>
      <th>Edit</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["DeptNum"]); ?></td>
        <td><?php echo escape($row["DeptName"]); ?></td>
        <td><?php echo escape($row["managerSSN"]); ?></td>
        <td><a href="update-single2.php?DeptNum=<?php echo escape($row["DeptNum"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

<?php
/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
require "../config.php";
require "../common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user=[
      "id" => $_POST['id'],
      "DeptNum"  => $_POST['DeptNum'],
      "DeptName" => $_POST['DeptName'],
      "managerSSN" => $_POST['managerSSN'],
    ];

    $sql = "UPDATE Department
            SET DeptNum = :DeptNum,
              DeptName = :DeptName,
              managerSSN = :managerSSN,
            WHERE DeptNum = :DeptNum";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['DeptNum'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $DeptNum = $_GET['DeptNum'];
    $sql = "SELECT * FROM Department WHERE Department Number = :Department Number";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':DeptNum', $DeptNum);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['Department']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

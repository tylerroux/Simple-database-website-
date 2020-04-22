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
      "ProjName" => $_POST['ProjName'],
      "ProjNum"  => $_POST['ProjNum'],
      "ProjDesc" => $_POST['ProjDesc'],
    ];

    $sql = "UPDATE Project
            SET ProjName = :ProjName,
              ProjName = :ProjName,
              ProjDesc = :ProjDesc,
            WHERE ProjName = :ProjName";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['ProjName'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $ProjName = $_GET['ProjName'];
    $sql = "SELECT * FROM Project WHERE Project Name = :Project Name";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':ProjName', $ProjName);
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
  <?php echo escape($_POST['Project']); ?> successfully updated.
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

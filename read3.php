    <?php

    /**
      * Function to query information based on
      * a parameter: in this case, location.
      *
      */

    if (isset($_POST['submit'])) {
      try {
        require "../config.php";
        require "../common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT *
        FROM Project
        WHERE ProjName = :ProjName";
        $ProjName = $_POST['ProjName'];


        $statement = $connection->prepare($sql);
        $statement->bindParam(':ProjName', $ProjName, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }
    }
    ?>
    <?php require "templates/header.php"; ?>

    <?php
    if (isset($_POST['submit'])) {
      if ($result && $statement->rowCount() > 0) { ?>
        <h2>Results</h2>

        <table>
          <thead>
            <tr>
              <th>Project Name</th>
              <th>Project Number</th>
              <th>Project Description</th>
            </tr>
          </thead>
        <tbody>
      <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo escape($row["ProjName"]); ?></td>
            <td><?php echo escape($row["ProjNum"]); ?> </td>
            <td><?php echo escape($row["ProjDesc"]); ?></td>
          </tr>
        <?php } ?>
          </tbody>
      </table>
      <?php } else { ?>
        > No results found for <?php echo escape($_POST['Project Name']); ?>.
      <?php }
    } ?>

    <h2>Find user based on Project Name</h2>

    <form method="post">
      <label for="ProjName">ProjName</label>
      <input type="text" id="ProjName" name="ProjName">
      <input type="submit" name="submit" value="View Results">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>

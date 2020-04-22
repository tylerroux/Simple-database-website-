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
        FROM Department
        WHERE DeptNum = :DeptNum";
        $DeptNum = $_POST['DeptNum'];


        $statement = $connection->prepare($sql);
        $statement->bindParam(':DeptNum', $DeptNum, PDO::PARAM_STR);
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
              <th>Department Number</th>
              <th>Department Name</th>
              <th>Manager SSN</th>
            </tr>
          </thead>
        <tbody>
      <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo escape($row["DeptNum"]); ?></td>
            <td><?php echo escape($row["DeptName"]); ?> </td>
            <td><?php echo escape($row["managerSSN"]); ?></td>
          </tr>
        <?php } ?>
          </tbody>
      </table>
      <?php } else { ?>
        > No results found for <?php echo escape($_POST['Department Number']); ?>.
      <?php }
    } ?>

    <h2>Find user based on Department Number</h2>

    <form method="post">
      <label for="DeptNum">DeptNum</label>
      <input type="text" id="DeptNum" name="DeptNum">
      <input type="submit" name="submit" value="View Results">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>

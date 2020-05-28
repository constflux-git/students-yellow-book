<?php
require "pdo.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Student Contact's Book</span>
  </nav>
  <div class="container">
    <?php
    if (isset($_SESSION['error'])) {
      echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
    }
    unset($_SESSION['error']);
    if (isset($_SESSION['success'])) {
      echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
    }
    unset($_SESSION['success']);

    ?>

    <div class="round-container">
      <div class="round">
        <a href="add.php">+</a>
      </div>
    </div>

    <?php
    echo ('<table class="table table-hover table-dark">');
    $data = $pdo->query("SELECT name, class, email,phone, user_id FROM users");
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">#</th>';
    echo '<th>name</th>';
    echo '<th>class</th>';
    echo '<th>phone-number</th>';
    echo '<th>e-mail</th>';
    echo '<th></th>';
    echo '</tr>';
    echo '</thead>';
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      echo '<tbody>';
      echo '<tr>';
      echo '<td scope="row">';
      echo htmlentities($row['user_id']);
      echo '</td>';
      echo '<td>';
      echo htmlentities($row['name']);
      echo '</td>';
      echo '<td>';
      echo htmlentities($row['class']);
      echo '</td>';
      echo '<td>';
      echo htmlentities($row['email']);
      echo '</td>';
      echo '<td>';
      echo htmlentities($row['phone']);
      echo '</td>';
      echo '<td>';
      echo '<a class="btn btn-light" href="edit.php?user_id=' . $row['user_id'] . ' " role="button">Edit</a>';
      echo '<a class="btn btn-outline-light" href="delete.php?user_id=' . $row['user_id'] . ' " role="button">Delete</a>';
      echo '</td>';
    }

    echo '</table>';

    ?>


  </div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
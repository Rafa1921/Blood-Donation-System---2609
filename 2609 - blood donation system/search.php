<?php
// connect to database
$conn = mysqli_connect("localhost", "username", "password", "blood_donation_system");

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// initialize variables
$search_blood_type = "";

// if form is submitted
if (isset($_POST['search'])) {
  $search_blood_type = $_POST['search_blood_type'];
  
  // query database for donors with matching blood type
  $query = "SELECT * FROM donors WHERE blood_type='$search_blood_type'";
  $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Blood Donation System - Search</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-custom">
    <a class="navbar-brand" href="#">Blood Donation System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Search</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container my-4">
    <h1>Search for Donors by Blood Type</h1>
    <form method="POST" action="search.php">
      <div class="form-group">
        <label for="search_blood_type">Blood Type:</label>
        <select class="form-control" id="search_blood_type" name="search_blood_type" required>
          <option value="">-- Select a Blood Type --</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Search</button>
    </form>

    <?php if (isset($_POST['search'])): ?>
    <hr>
    <h2>Search Results</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Blood Type</th>
          <th>Contact Number</th>
        </tr>
      </thead>
      <tbody>
        <?php

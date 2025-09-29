<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "travel_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$destination = $_POST['destination'];
$travel_date = $_POST['date'];
$people = $_POST['people'];

// Insert into database
$sql = "INSERT INTO bookings (name, phone, email, destination, travel_date, people)
        VALUES ('$name', '$phone', '$email', '$destination', '$travel_date', '$people')";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmation</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #ffecd2, #fcb69f);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      max-width: 600px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0px 4px 20px rgba(0,0,0,0.2);
      background: #fff;
    }
    .card h2 {
      color: #28a745;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .btn-home {
      background-color: #ff9800;
      color: #fff;
      font-weight: bold;
    }
    .btn-home:hover {
      background-color: #e68900;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="card text-center">
    <?php
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Booking Successful! 🎉</h2>";
        echo "<p>Thank you, <strong>$name</strong>.</p>";
        echo "<p>Your booking for <strong>$destination</strong> on <strong>$travel_date</strong> for <strong>$people</strong> people is confirmed.</p>";
        echo "<a href='index.html' class='btn btn-home mt-3'>← Back to Home</a>";
    } else {
        echo "<h2 style='color:red;'>Booking Failed ❌</h2>";
        echo "<p>Error: " . $conn->error . "</p>";
        echo "<a href='Index.php' class='btn btn-danger mt-3'>Try Again</a>";
    }
    ?>
  </div>
</body>
</html>

<?php
$conn->close();
?>
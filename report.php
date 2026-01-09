<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/report.css">
</head>
<body>
  

<table border="1px">
 <div class="report"> <h1>Grading Report</h1>

<div class="report1"> <h1><a href="index.php">Return Home</a></h1></div>
</div>


  <tr>
    <th>Student_id</th>
    <th>Name</th>
    <th>Subject</th>
    <th>Grade</th>
  </tr>

<?php 

# database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "students_info";

$Student_id='';
$Score="";
$Name='';
$Subject='';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $conn = new mysqli($servername, $username, $password, $databasename);
} catch (mysqli_sql_exception $e) {
  echo '<p style="color:red;">Database connection failed: ' . htmlspecialchars($e->getMessage()) . '</p>';
  echo '<p>Please ensure the database <strong>grading_system</strong> exists and credentials are correct.</p>';
  exit;
}

/* FETCH RESULT - wrap in try/catch because mysqli_report is strict */
try {
  $result = $conn->query('SELECT * FROM stu_score ORDER BY student_id ASC');
} catch (mysqli_sql_exception $e) {
  echo '<p style="color:red;">Query failed: ' . htmlspecialchars($e->getMessage()) . '</p>';
  echo '<p>Check that the table <strong>stu_score</strong> exists in the database <strong>' . htmlspecialchars($databasename) . '</strong>.</p>';
  exit;
}


/* LOOP THROUGH */
while ($data = $result->fetch_assoc()) {
  echo "
  <tr>
    <td>" . htmlspecialchars($data['student_id']) . "</td>
    <td>" . htmlspecialchars($data['Name']) . "</td>
    <td>" . htmlspecialchars($data['Subject']) . "</td>
    <td>" . htmlspecialchars($data['Score']) . "</td>
  </tr>";
}
?>

</table>
</body>
</html>
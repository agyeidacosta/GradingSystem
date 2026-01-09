<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
  <link rel="stylesheet" href="css/index.css">

</head>

<body>
  <div class="spread">

  <div class="system">Kindly use this application to check our grading system</div>

  <div class="school-imo">
    <img src="IMAGE/2d426ab680598047d06e2ff9c837bc87.jpg" alt="logo">
  </div>
  <form action="index.php" class="form-form" method="post">
    <label for="name"> Enter Name</label>
    <input type="text" required name="name" id="name" autocomplete="name">


    <label for="subject"> Enter Subject</label>
    <input type="text" required name="subject" id="subject" autocomplete="off">


    <label for="score"> Enter Score</label>
    <input type="number" required name="score" id="score" autocomplete="off">
    <button type="submit">Send</button>
  </form>
  </div>

  <div class="view"><a href="report.php">View Grading Report</a></div>
</body>
</html>

<?php 

$servername='localhost';
$username='root';
$password='';
$databasename='students_info';

$grade="";
$score="";
$name='';
$student_id="";

$conn=new mysqli($servername,$username,$password,$databasename);
if($conn->connect_error){
  die("connection".$conn->connect_error);
  }
  
function text_input($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
 return $data;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  $name= text_input($_POST['name']);
  $score=text_input($_POST['score']);
  $subject=text_input($_POST['subject']);

  if (!preg_match("/^[a-zA-Z-' ]*$/",$name)){
    echo"<script>alert('Only letters and white space allowed');</script>";
  } 
  elseif(!preg_match("/^[a-zA-Z-' ]*$/",$subject)){
    echo"<script>alert('Only letters and white space allowed');</script>";

  }
  
  else {
    
    if($score>100){
      $grade="Invalid score";
      echo"<script>alert('Hello $name. Your grade is $grade in $subject');</script>";
    }
    
    elseif($score>=80 && $score<=100){
      $grade="A";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    elseif($score>=75 && $score<=79){
      $grade="B+";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    elseif($score>=70 && $score<=74){
      $grade="B";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    elseif($score>=65 && $score<=69){
      $grade="C+";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    elseif($score>=60 && $score<=64){
      $grade="C";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    elseif($score>=55 && $score<=59){
      $grade="D+";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    elseif($score>=50 && $score<=54){
      $grade="D";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }
    else{
      $grade="Fail";
      echo"<script>alert('Hello $name.Your grade is $grade in $subject');</script>";
    }

  #data insertion
    $stmt=$conn->prepare('INSERT INTO stu_score(Name, Score, Subject) VALUES (?, ?,?)');
    $stmt->bind_param('sss', $name, $grade, $subject);
    
    if($stmt->execute()){
      echo"<script>alert('Student Data recorded successfully');</script>";
    }
    
    $stmt->close();
  }
}

$conn->close();
?>
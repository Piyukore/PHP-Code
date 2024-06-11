<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $batch = $_POST['batch'];
    $email = $_POST['email'];
    $subjects = [
        "English" => $_POST['english'],
        "Hindi" => $_POST['hindi'],
        "Math" => $_POST['math'],
        "Science" => $_POST['science'],
        "History" => $_POST['history'],
        "Geography" => $_POST['geography']
    ];
    $remarks = $_POST['remarks'];

    $totalMarks = array_sum($subjects);
    $maxMarks = 600;

    $percentage = ($totalMarks / $maxMarks) * 100;

    if ($percentage >= 75) {
        $grade = "Distinction";
    } elseif ($percentage >= 60) {
        $grade = "First Class";
    } elseif ($percentage >= 33) {
        $grade = "Pass";
    } else {
        $grade = "Fail";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Report Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        h2 {
            margin-top: 20px;
        }
        ul {
            padding-left: 20px;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Report Card</h1>
        <p>Student ID: <?php echo htmlspecialchars($studentId); ?></p>
        <p>Name: <?php echo htmlspecialchars($firstName . " " . $lastName); ?></p>
        <p>Batch/Class: <?php echo htmlspecialchars($batch); ?></p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <h2>Marks</h2>
        <ul>
            <?php foreach ($subjects as $subject => $marks): ?>
                <li><?php echo htmlspecialchars($subject) . ": " . htmlspecialchars($marks); ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Total Marks: <?php echo htmlspecialchars($totalMarks); ?> / 600</p>
        <p>Percentage: <?php echo htmlspecialchars(number_format($percentage, 2)); ?>%</p>
        <p>Grade: <?php echo htmlspecialchars($grade); ?></p>
        <p>Remarks: <?php echo htmlspecialchars($remarks); ?></p>
        <form action="send_email.php" method="post">
            <input type="hidden" name="report" value="<?php echo base64_encode(serialize($_POST)); ?>">
            <input type="submit" value="Send Report Card to Email">
        </form>
    </div>
</body>
</html>
<?php
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}

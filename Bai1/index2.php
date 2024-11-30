<?php
// Đọc câu hỏi từ file
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Tách câu hỏi thành các nhóm
$parsed_questions = [];
$current_question = [];
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            $parsed_questions[] = $current_question;
        }
        $current_question = [];
    }
    $current_question[] = $line;
}
if (!empty($current_question)) {
    $parsed_questions[] = $current_question;
}

// Nếu form được gửi đi, xử lý bài làm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = [];
    foreach ($questions as $line) {
        if (strpos($line, "Đáp án:") !== false) {
            $answers[] = trim(substr($line, strpos($line, ":") + 1));
        }
    }

    $score = 0;
    foreach ($_POST as $key => $userAnswer) {
        $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
        if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
            $score++;
        }
    }

    $total_questions = count($answers);
    echo "<div class='alert alert-success text-center mt-4'>";
    echo "Bạn trả lời đúng <strong>$score</strong>/$total_questions câu.";
    echo "</div>";
    echo "<a href='index.php' class='btn btn-primary'>Làm lại</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Bài Thi Trắc Nghiệm</h1>
    <form action="" method="post">
        <?php
        $number = 1;
        foreach ($parsed_questions as $question) {
            echo "<div class='card mb-4'>";
            echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
            echo "<div class='card-body'>";
            for ($i = 1; $i <= 4; $i++) {
                $answer = substr($question[$i], 0, 1); // A, B, C, D
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='question{$number}' value='{$answer}' id='question{$number}{$answer}'>";
                echo "<label class='form-check-label' for='question{$number}{$answer}'>{$question[$i]}</label>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
            $number++;
        }
        ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

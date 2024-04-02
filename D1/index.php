<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Score Display</h1>
    <table>
        <thead>
            <tr>
                <th>Question Number</th>
                <th>Actual Answer</th>
                <th>Submitted Answer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $submittedAnswersFile = fopen('submittedAnswers.csv', 'r');
            $actualAnswersFile = fopen('actualAnswers.csv', 'r');
            $correctCount = 0;
            $questionNumber = 1;

            if ($submittedAnswersFile && $actualAnswersFile) {
                while (($submittedAnswer = fgets($submittedAnswersFile)) !== false && ($actualAnswer = fgets($actualAnswersFile)) !== false) {
                    $submittedAnswer = trim($submittedAnswer);
                    $actualAnswer = trim($actualAnswer);

                    echo "<tr>";
                    echo "<td>$questionNumber</td>";
                    echo "<td>$actualAnswer</td>";
                    echo "<td>$submittedAnswer</td>";
                    echo "</tr>";

                    if ($submittedAnswer === $actualAnswer) {
                        $correctCount++;
                    }

                    $questionNumber++;
                }

                fclose($submittedAnswersFile);
                fclose($actualAnswersFile);
            } else {
                echo "<tr><td colspan='3'>Failed to open file</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div>
        Score: <?php echo $correctCount . '/' . ($questionNumber - 1); ?>
    </div>
</body>
</html>

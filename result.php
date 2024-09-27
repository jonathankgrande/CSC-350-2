<?php
function calculate($numA, $operator, $numB) {
    switch ($operator) {
        case '+': return $numA + $numB;
        case '-': return $numA - $numB;
        case '*': return $numA * $numB;
        case '/': return ($numB != 0) ? $numA / $numB : 'Error: Division by zero';
        default: return 'Invalid Operator';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = (float)$_POST['input1'];
    $operator1 = $_POST['operator1'];
    $num2 = (float)$_POST['input2'];
    $operator2 = $_POST['operator2'];
    $num3 = (float)$_POST['input3'];

    if ($operator1 == '*' || $operator1 == '/') {
        $result1 = ($operator1 == '*') ? $num1 * $num2 : ($num2 != 0 ? $num1 / $num2 : 'Error: Division by zero');
        $finalResult = is_numeric($result1) ? calculate($result1, $operator2, $num3) : $result1;
    } elseif ($operator2 == '*' || $operator2 == '/') {
        $result2 = ($operator2 == '*') ? $num2 * $num3 : ($num3 != 0 ? $num2 / $num3 : 'Error: Division by zero');
        $finalResult = is_numeric($result2) ? calculate($num1, $operator1, $result2) : $result2;
    } else {
        $result1 = calculate($num1, $operator1, $num2);
        $finalResult = calculate($result1, $operator2, $num3);
    }

    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Calculation Result</title>
          </head>
          <body>
              <h1>Result: $finalResult</h1>
          </body>
          </html>";
} else {
    echo "Invalid request.";
}
?>

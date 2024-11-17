<?php
$histfile = 'history.txt';

$result = '';
$history = '';

    $history = file_get_contents($histfile);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] : 0;
    $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : 0;
    $operator = $_POST['operator'];

    switch ($operator) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $result = 'Помилка: ділення на нуль';
            }
            break;
    }

    $histdata = "$num1 $operator $num2 = $result\n";
    file_put_contents($histfile, $histdata, FILE_APPEND);
    $history .= $histdata;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
</head>
<body>
    <h1>Калькулятор</h1>
    <form method="post">
        <input type="number" name="num1" step="any" required>
        
        <label>
            <input type="radio" name="operator" value="+" required> +
        </label>
        <label>
            <input type="radio" name="operator" value="-"> -
        </label>
        <label>
            <input type="radio" name="operator" value="*"> *
        </label>
        <label>
            <input type="radio" name="operator" value="/"> /
        </label>

        <input type="number" name="num2" step="any" required>
        <button type="submit">Вичислити</button>
    </form>

    <h2>Результат: <?php echo htmlspecialchars($result); ?></h2>

    <h2>Історія обчислень:</h2>
    <pre><?php echo htmlspecialchars($history); ?></pre>

</body>
</html>

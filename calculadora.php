<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora da Laura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculator-box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 320px;
            box-sizing: border-box;
        }
        .display {
            background-color: #887dff;
            color: #ffffff;
            border-radius: 5px;
            padding: 15px;
            font-size: 24px;
            text-align: right;
            margin-bottom: 10px;
            min-height: 50px;
            line-height: 1.2;
            word-wrap: break-word;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .button {
            background-color: #0097a7;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .button:hover {
            background-color: #00796b;
        }
        .button:active {
            background-color: #887dff;
        }
        .button.operator {
            background-color: #887dff;
        }
        .button.operator:hover {
            background-color: #00332a;
        }
        .button.operator:active {
            background-color: #001c15;
        }
        .button.double {
            grid-column: span 2;
        }
        .button.clear {
            grid-column: span 2;
            background-color: #d32f2f;
        }
        .button.clear:hover {
            background-color: #b71c1c;
        }
        .button.clear:active {
            background-color: #a84360;
        }
    </style>
</head>
<body>
    <div class="calculator-box">
        <div class="display">
            <?php
            session_start();

            // icilializa a sessão
            if (!isset($_SESSION['display'])) {
                $_SESSION['display'] = '';
            }
            // Verifica se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['clear'])) {
                    $_SESSION['display'] = '';
                } elseif (isset($_POST['calculate'])) {
                    // Realiza o cálculo
                    try {
                        $expression = $_SESSION['display'];
                        // Avalia a expressão e armazena o resultado
                        $_SESSION['display'] = eval('return ' . $expression . ';');
                    } catch (Exception $e) {
                        $_SESSION['display'] = 'Erro'; // Exibe erro se a avaliação falhar
                    }
                } else {
                    // Adiciona o valor do botão pressionado ao visor
                    $_SESSION['display'] .= $_POST['value'];
                }
            }
            // Exibe o visor com a expressão ou resultado atual 
            echo htmlspecialchars($_SESSION['display']);
            ?>
        </div>
        <form method="post" action="">
            <div class="buttons">
                <button type="submit" name="value" value="7" class="button">7</button>
                <button type="submit" name="value" value="8" class="button">8</button>
                <button type="submit" name="value" value="9" class="button">9</button>
                <button type="submit" name="value" value="/" class="button operator">÷</button>

                <button type="submit" name="value" value="4" class="button">4</button>
                <button type="submit" name="value" value="5" class="button">5</button>
                <button type="submit" name="value" value="6" class="button">6</button>
                <button type="submit" name="value" value="*" class="button operator">x</button>

                <button type="submit" name="value" value="1" class="button">1</button>
                <button type="submit" name="value" value="2" class="button">2</button>
                <button type="submit" name="value" value="3" class="button">3</button>
                <button type="submit" name="value" value="-" class="button operator">-</button>

                <button type="submit" name="value" value="0" class="button double">0</button>
                <button type="submit" name="value" value="." class="button">.</button>
                <button type="submit" name="calculate" value="1" class="button operator">=</button>
                <button type="submit" name="value" value="+" class="button operator">+</button>

                <button type="submit" name="clear" value="1" class="button clear double">C</button>
            </div>
        </form>
    </div>
</body>
</html>
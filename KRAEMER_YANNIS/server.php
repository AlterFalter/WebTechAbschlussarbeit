<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zinses Zins Rechner</title>
</head>
<body>
    <a href="index.html">Zurück</a>

    <?php
        // helper function
        function getParameter($name) {
            if (isset($_POST[$name])) {
                $value =  $_POST[$name];
                return $value;
            }
            else {
                throw new Exception('Parameter "' . $name . '" isn\'t set!');
            }
        }

        function checkName($name) {
            $regex = "/^([A-Z]{1}[a-z]{1,}\s{1}[A-Z]{1}[a-z]{1,})/";
            if (!preg_match($regex, $name)) {
                throw new Exception('Name has to be valid. Pattern: Max Muster');
            }
        }

        function checkIfNumberIsPositiveOrZero($value, $name) {
            if (!is_numeric($value) || 0 > $value) {
                throw new Exception($name . ' was set to an invalid number');
            }
        }

        // is number a full number and doesn't have comma
        function checkInt($value, $name) {
            if (is_numeric($value)) {
                $value = intval($value);
                if (is_int($value)) {
                    return;
                }
            }
            throw new Exception($name . " has the wrong format! Value: " . $value);
        }

        function formatMoneyNumber($number) {
            return number_format($number, 2, '.', '');
        }

        function calculate($principal, $interestInPercent, $deposit, $frequency, $duration) {
            $factor = (100 + $interestInPercent) / 100;
            for ($i=0; $i < $duration; $i++) {
                if ($frequency == 'monthly') {
                    $principal += 12 * $deposit;
                }
                elseif ($frequency == 'yearly') {
                    $principal += $deposit;
                }
                $principal *= $factor;
                //echo '<p>after ' . ($i+1) . ' years --> ' .$principal . '$</p>';
            }
            return $principal;
        }

        try {
            // decide which function it is
            $methodType = getParameter("methodType");
            if ($methodType === 'interestCalculator') {
                // check parameter
                $name = getParameter('name');
                checkName($name);
                setcookie('name', $name, time() + (3600 * 8));
                $principal = getParameter('principal');
                checkIfNumberIsPositiveOrZero($principal, 'principal');
                $interestInPercent = getParameter('interestInPercent');
                $deposit = getParameter('deposit');
                $frequency = getParameter('frequency');
                $duration = getParameter('duration');
                checkIfNumberIsPositiveOrZero($duration, 'duration ');
                checkInt($duration, 'duration');
                // calculation
                $result = calculate($principal, $interestInPercent, $deposit, $frequency, $duration);
                // format result
                $result = formatMoneyNumber($result);
                // output
                echo '<p>Hallo ' . $name . '</p>';
                echo "At the end of the " . $duration . " year, you have " . $result . "$";
                return;
            }
            elseif ($methodType === 'currencyChanger') {
                ///////////////////////////////////////////////////////////
                // Diese Umsetzung fand vor der Bekanntgabe der letzten Übung statt.
                // Martin Bättig wurde darüber am 25.05.2020 per Email informiert.
                ///////////////////////////////////////////////////////////
                $startPrincipal = getParameter('startPrincipal');
                checkIfNumberIsPositiveOrZero($startPrincipal, 'startprincipal');
                $startCurrency = getParameter('startCurrency');
                $endCurrency = getParameter('endCurrency');

                $connection = mysqli_connect("localhost", "root", "", "currencyChangerDB");
                if (!$connection) {
                    echo "<p>Couldn't connect to DB</p>";
                    return;
                }
                else {
                    $query = "SELECT Factor FROM currency_pair_price WHERE ? = CurrencyStart AND ? = CurrencyEnd";
                    $statement = mysqli_prepare($connection, $query);
                    mysqli_stmt_bind_param($statement, 'ss', $startCurrency, $endCurrency);
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);
                    if ($result) {
                        // only once because multiple results not possible (would be an error)
                        $row = mysqli_fetch_assoc($result);
                        $factor = $row['Factor'];
                        $endPrincipal = $startPrincipal * $factor;
                        // format
                        $endPrincipal = formatMoneyNumber($endPrincipal);
                        $startCurrency = strtoupper($startCurrency);
                        $endCurrency = strtoupper($endCurrency);
                        // output
                        echo '<p>Faktor für ' . $startCurrency . ' zu ' . $endCurrency . ' ist: ' . $factor . "</p>";
                        echo '<p>' . $startPrincipal . ' ' . $startCurrency . ' = ' . $endPrincipal . ' ' . $endCurrency . "</p>";
                        return;
                    }
                    else {
                        echo "<p>Currency pair wasn't found in database<p>";
                        return;
                    }
                }
            }
            else {
                echo "<p>unknown method type</p>";
            }
        } catch (Exception $ex) {
            echo '<p>' . $ex->getMessage() . '</p>';
            return;
        }
    ?>
</body>
</html>
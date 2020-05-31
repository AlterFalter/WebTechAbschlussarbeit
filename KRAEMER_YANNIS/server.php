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
        // const
        const PRINCIPAL_MIN = -1000000;
        const PRINCIPAL_MAX = 1000000;
        const DEPOSIT_MIN = -1000000;
        const DEPOSIT_MAX = 1000000;
        const DURATION_MIN = 1;
        const DURATION_MAX = 200;
        const INTEREST_MIN = -10000;
        const INTEREST_MAX = 10000;

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

        function validateName() {
            $regex = "/^([A-Z]{1}[a-z]{1,}\s{1}[A-Z]{1}[a-z]{1,})\$/";

            try {
                $name = getParameter("name");
                if (!preg_match($regex, $name)) {
                    echo '<p>Name has to be valid. Pattern: Max Muster</p>';
                    return false;
                }
                else {
                    echo "<p>Hallo " . $name . "</p>";
                    setcookie('name', $name, time() + (3600 * 8));
                    return true;
                }
            } catch (Exception $ex) {
                echo '<p>' . $ex->getMessage() . '</p>';
                return false;
            }
        }

        function validatePrincipal($principal) {
            if (PRINCIPAL_MIN <= $principal && $principal <= PRINCIPAL_MAX) {
                return true;
            }
            else {
                echo "<p>principal is not valid</p>";
                return false;
            }
        }

        function validateDeposit($deposit) {
            if (DEPOSIT_MIN <= $deposit && $deposit <= DEPOSIT_MAX) {
                return true;
            }
            else {
                echo "<p>deposit is not valid</p>";
                return false;
            }
        }

        function validateFrequency($frequency) {
            if ($frequency == "noDeposit" || $frequency == "monthly" || $frequency == "yearly") {
                return true;
            }
            else {
                echo "<p>frequency is not valid</p>";
                return false;
            }
        }

        function validateDuration($duration) {
            if (DURATION_MIN <= $duration && $duration <= DURATION_MAX) {
                return true;
            }
            else {
                echo "<p>duration is not valid</p>";
                return false;
            }
        }

        function validateInterest($interest) {
            if (INTEREST_MIN <= $interest && $interest <= INTEREST_MAX) {
                return true;
            }
            else {
                echo "<p>interest is not valid</p>";
                return false;
            }
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
                $nameIsValid = validateName();

                $principal = getParameter('principal');
                $principalIsValid = validatePrincipal($principal);

                $deposit = getParameter('deposit');
                $depositIsValid = validateDeposit($deposit);

                $frequency = getParameter('frequency');
                $frequencyIsValid = validateFrequency($frequency);

                $duration = getParameter('duration');
                $durationIsValid = validateDuration($duration);

                $interestInPercent = getParameter('interestInPercent');
                $interestIsValid = validateInterest($interestInPercent);
                
                if ($nameIsValid && $principalIsValid && $depositIsValid && $frequencyIsValid && $durationIsValid && $interestIsValid) {
                    // round
                    $principal = round($principal, 2);
                    $deposit = round($deposit, 2);
                    $interestInPercent = round($interestInPercent, 2);
                    // calculation
                    $result = calculate($principal, $interestInPercent, $deposit, $frequency, $duration);
                    // format result
                    $result = formatMoneyNumber($result);
                    // output
                    echo "Am Ende des " . $duration . ". Jahres haben Sie " . $result . "$";
                }
            }
            elseif ($methodType === 'currencyChanger') {
                ///////////////////////////////////////////////////////////
                // Diese Umsetzung fand vor der Bekanntgabe der letzten Übung statt.
                // Martin Bättig wurde darüber am 25.05.2020 per Email informiert.
                ///////////////////////////////////////////////////////////
                $startPrincipal = getParameter('startPrincipal');
                $principalIsValid = validatePrincipal($startPrincipal);
                $startCurrency = getParameter('startCurrency');
                $endCurrency = getParameter('endCurrency');

                if ($principalIsValid) {
                    $connection = mysqli_connect("localhost", "root", "", "currencyChangerDB");
                    if (!$connection) {
                        echo "<p>Es kann nicht zur Datenbank verbunden werden</p>";
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
                            echo "<p>Währungspaar wurde nicht gefunden.<p>";
                            return;
                        }
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

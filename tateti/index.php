<?php
    
    @session_start();
    //Variables
    $player = 0;
    // The game is end?
    $win = FALSE; 
    $winCondition = array(
        //  Verticales
        array('1', '2', '3'),
        array('4', '5', '6'),
        array('7', '8', '9'),
        //  Horizontales
        array('1', '4', '7'),
        array('2', '5', '8'),
        array('3', '6', '9'),
        //  Diagonales
        array('3', '5', '7'),
        array('1', '5', '9')
    );

    //Reset Session
    function resetSession() {
        unset($_SESSION['jugador']);
        $win = FALSE;
    }

    //Revisar si debe resetear
    if (isset($_GET['reset'])) {
        resetSession();
    }

    


    if(isset($_SESSION['jugador'])) {
        // Cargar datos de la sesion en la variable Jugador
        //  Revisar si hay informacion que procesar
        if (isset($_GET['value'])&& isset($_GET['player'])) {    
            //Revisar a que jugador va la información
            switch($_GET['player']) {
                case 0:
                    //  Actualizar la sesion
                    if (in_array($_GET['value'], $_SESSION['jugador'][0])) {

                    }
                    else {
                        array_push($_SESSION['jugador'][0], $_GET['value']);
                        $player = 1;
                    }
                    break;
                case 1:
                    if (in_array($_GET['value'], $_SESSION['jugador'][1])) {

                    }
                    else {
                        array_push($_SESSION['jugador'][1], $_GET['value']);
                        $player = 0;
                    }
                    break;
            }
            foreach($winCondition as $d) {
                $win1 = 0;
                $win2 = 0;
                foreach ($_SESSION['jugador'][0] as $i) {
                    if (in_array($i, $d)) {
                        $win1++;
                    }
                    if ($win1 >= 3) {
                        echo '<h1>PLAYER ONE WIN</h1>';
                        $win = TRUE;
                    }
                }
                foreach ($_SESSION['jugador'][1] as $i) {
                    if (in_array($i, $d)) {
                        $win2++;
                    }
                    if ($win2 >= 3) {
                        echo '<h1>PLAYER TWO WIN</h1>';
                        $win = TRUE;
                    }
                }
            }
            if (count($_SESSION['jugador'][0]) + count($_SESSION['jugador'][1]) >= 9 && !$win) {
                echo '<h1>DRAW</h1>';
                $win = TRUE;
            }
        }
        

    } else {
        $_SESSION['jugador'][0] = array();
        $_SESSION['jugador'][1] = array();
    }
    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="author" content="Matias Sanchez">
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>TA-TE-TI</h1>
    </header>
    
    <div class="buttons">
        <form action="index.php" method="GET">
            <input type="Submit" id="send" value="SELECCIONAR">
            <input type="hidden" id="player" name="player" value="<?php echo $player;?>">
            <input type="hidden" id='value' name="value" value='1'>
        </form>
        <table>
        <tbody id="tablero">
            
        </tbody>
    </table>
        <form action="index.php" method="GET">
            <input type="Submit" id='reset' name="reset" value='RESET'>
        </form>
    </div>

</body>
</html>
<script>
    generateTable();
    <?php
    foreach ($_SESSION['jugador'][0] as $i) {
        echo 'updateTable("celda';
        echo $i;
        echo '", "X");';
    }
    foreach ($_SESSION['jugador'][1] as $i) {
        echo 'updateTable("celda';
        echo $i;
        echo '", "O");';
    }
    //  Detecta si el juego termino
    if ($win == TRUE) {
        echo 'winEndGame();';
    }
    ?>

</script>

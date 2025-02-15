<?php
    include("connessione.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato ricerca attori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $annoNasciataMIN = $_GET["annoNascitaMIN"];
        $annoNascitaMAX = $_GET["annoNascitaMAX"];
        $campoOrdine = $_GET["campoOrdine"];

        $sql = "SELECT * FROM attori WHERE AnnoNascita BETWEEN $annoNasciataMIN AND $annoNascitaMAX ORDER BY $campoOrdine";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql2 = "DESCRIBE attori";
            $resSql2 = $conn->query($sql2);
            if ($resSql2->num_rows > 0) {
                showData($annoNasciataMIN, $annoNascitaMAX, $campoOrdine, $result, $resSql2);
            }
        } else {
            showDataErr($annoNasciataMIN, $annoNascitaMAX);
        }

        function showData($anMIN, $anMAX, $co, $res, $res2) {
            echo "<div class='divShowData'>";
                echo "<h1 class='correct'>ATTORI TROVATI</h1>";
                    echo "<table>";
                        echo "<tr>";
                            while ($row2 = $res2->fetch_assoc()) {
                                echo "<th>" . $row2["Field"] . "</th>";
                            }
                        echo "</tr>";

                        echo "<tr>";
                            while ($row = $res->fetch_assoc()) {
                                echo "<tr>";
                                    foreach($row as $value){
                                        echo "<td> $value </td>";
                                    }
                                echo "</tr>";
                            }
                        echo "</tr>";
                    echo "</table>";
                    echo "<br>";
                    echo "<br>";
                    echo "<a class='sendButton' href='attorieta.html'>HOME</a>";
            echo "</div>";
        }

        function showDataErr($MIN, $MAX){
            echo "<div class='divShowData'>";
                echo "<h1 class='error'>NESSUN ATTORE CON ANNO DI NASCITA COMPRESO TRA $MIN E $MAX</h1>";
                echo "<br>";
                echo "<br>";
                echo "<a class='sendButton' href='attorieta.html'>HOME</a>";
            echo "</div>";
        }
    ?>
</body>
</html>
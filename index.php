<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .green {
            color: white;
            background-color: green;
        }

        .red {
            color: white;
            background-color: red;
        }
    </style>
    <title>Hotel</title>
</head>

<body>
    <div class="container d-flex justify-content-center text-center mb-5 mt-5">
        <form method="get">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="parcheggio" value="conParcheggio">
                <label class="form-check-label" for="conParcheggio">
                    CON PARCHEGGIO
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="parcheggio" value="senzaParcheggio">
                <label class="form-check-label" for="senzaParcheggio">
                    SENZA PARCHEGGIO
                </label>
            </div>
            <div class="mb-3">
                <input type="number" name="vote" placeholder="filtra per voto">
            </div>
            <input type="submit" value="cerca">
        </form>
    </div>
    <?php
    // array dell'hotel
    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ]
    ];
/*
        // stampo tutto l'array

        echo "<pre>";
        var_dump($hotels);
        echo "</pre>";

        //ciclo l'array

        //ogni hotel
        foreach ($hotels as $key => $hotel) {
            echo "<br />";
            var_dump($hotel);

            //caratteristiche hotel
            foreach ($hotel as $key => $value) {
                echo "<br />";
                echo $key . " => " . $value;
            }
        }
*/
?>

    <!-- tabella bootstrap -->
    <div class="container">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <?php
                    //array con le keys
                    $keys = [];
                    $searchVote = 0;
                    foreach ($hotels as $key => $hotel) {
                        //ciclo per la th con keys
                        foreach ($hotel as $key => $value) {
                            if (!in_array($key, $keys)) {
                                $keys[] = $key;
                                echo "<th scope='col'>" . $key . "</th>";
                            }
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                //imposto searchVote
                if (isset($_GET["vote"])) {
                    $searchVote = intval($_GET["vote"]);
                }
                echo "ecco il valore cercato:";
                var_dump($searchVote);
                // se è vuoto $_GET, mostro tutto
                if ($_GET == [] || !isset($_GET["parcheggio"])) {
                    foreach ($hotels as $key => $hotel) {
                        if ($searchVote <= $hotel['vote']) {
                            echo "<tr>";
                            foreach ($hotel as $key => $value) {
                                if ($key == 'name') {
                                    echo "<th>" . $value . "</th>";
                                } elseif ($key == 'parking') {
                                    echo "<td>" . ($value ? 'Si' : 'No') . "</td>";
                                } else {
                                    echo "<td>" . $value . "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                } else {
                    $parcheggio = $_GET["parcheggio"];
                    if ($parcheggio == "conParcheggio") {
                        // Stampa solo gli hotel con parcheggio
                        foreach ($hotels as $key => $hotel) {
                            if ($hotel['parking'] && $searchVote <= $hotel['vote']) {
                                echo "<tr>";
                                foreach ($hotel as $key => $value) {
                                    if ($key == 'name') {
                                        echo "<th>" . $value . "</th>";
                                    } elseif ($key == 'parking') {
                                        echo "<td>Si</td>";
                                    } else {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                        }
                    } elseif ($parcheggio == "senzaParcheggio") {
                        // Stampa solo gli hotel senza parcheggio
                        foreach ($hotels as $key => $hotel) {
                            if (!$hotel['parking'] && $searchVote <= $hotel['vote']) {
                                echo "<tr>";
                                foreach ($hotel as $key => $value) {
                                    if ($key == 'name') {
                                        echo "<th>" . $value . "</th>";
                                    } elseif ($key == 'parking') {
                                        echo "<td>No</td>";
                                    } else {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
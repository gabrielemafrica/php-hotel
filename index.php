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
    <div class="container d-flex justify-content-center">

        <form method="get">
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="conParcheggio">
                <label class="form-check-label" for="conParcheggio">
                    CON PARCHEGGIO
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="senzaParcheggio">
                <label class="form-check-label" for="senzaParcheggio">
                    SENZA PARCHEGGIO
                </label>
            </div>
            <input type="submit" value="parcheggio">
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
                            foreach ($hotels as $key => $hotel) {

                                foreach ($hotel as $key => $value){
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
                    if ($_GET == []) {
                       
                        foreach ($hotels as $key => $hotel) {
                            echo "<tr>";
                            foreach ($hotel as $key => $value) {
                                if ($key == 'name') {
                                    echo "<th>". $value. "</th>";
                                }elseif ($key == 'parking'){
                                    if($value){
                                        echo "<td>Si</td>";
                                    }else{
                                        echo "<td>No</td>";
                                    }
                                }else{
                                    echo "<td>". $value. "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    } elseif (isset($_GET["conParcheggio"])) {
                        // Stampa solo gli hotel con parcheggio
                        foreach ($hotels as $key => $hotel) {
                            if ($hotel['parking']) {
                                echo "<tr>";
                                foreach ($hotel as $key => $value) {
                                    if ($key == 'name') {
                                        echo "<th>". $value. "</th>";
                                    } elseif ($key == 'parking'){
                                        echo "<td>Si</td>";
                                    } else {
                                        echo "<td>". $value. "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                    } elseif (isset($_GET["senzaParcheggio"])) {
                        // Stampa solo gli hotel con parcheggio
                        foreach ($hotels as $key => $hotel) {
                            if (!$hotel['parking']) {
                                echo "<tr>";
                                foreach ($hotel as $key => $value) {
                                    if ($key == 'name') {
                                        echo "<th>". $value. "</th>";
                                    } elseif ($key == 'parking'){
                                        echo "<td>No</td>";
                                    } else {
                                        echo "<td>". $value. "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                    }
                    ?>  
                </tbody>
            </table>

        </div>
 </body>

</html> 
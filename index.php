<?php 
    
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *"); //-- CORS kikapcsolás
    //$data=array('test' => 'valami');
    //echo json_encode($data);
    require_once './connect.php';
    
    $keres = explode("/", $_SERVER["QUERY_STRING"]);
    
    switch ($keres[0]) 
    {
        case 'dolgozok':
            switch ($_SERVER["REQUEST_METHOD"]) 
            {
                case 'GET':
                    $valasz = $conn -> query("SELECT * FROM `dolgozok`");
                    http_response_code(201);
                    echo json_encode($valasz->fetch_all(MYSQLI_ASSOC));
                    break;
                
                case 'POST':
                    $nev=$_POST['nev'];
                    $neme = $_POST['neme'];
                    $reszleg = $_POST['reszleg'];
                    $belepesev = filter_input($_POST, 'belepesev', FILTER_SANITIZE_NUMBER_INT);
                    $ber = $_POST['ber'];
                    
                    $stmt = $conn -> prepare("INSERT INTO `dolgozok` (`dolgozoid`, `nev`, `neme`, `reszleg`, `belepesev`, `ber`) VALUES (NULL, ?, ?, ?, ?, ?);");
                    $stmt -> bind_param("sssii", $nev, $neme, $reszleg, $belepsev, $ber);
                    $stmt -> execute();
                    http_response_code(201);
                    
                    break;
                

                default:
                    break;
            }
            break;
        default:
            http_response_code(401);
            echo json_encode(array("HIBA" => "ismeretlen keresés!"));
            break;
    }
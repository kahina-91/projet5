<?php

/*namespace kah\src\controller;

use kah\app\core\Controller;*/

include_once (CORE.'Session.php');
include_once (MODEL.'AgenceManager.php');
    $session = new Session();
 
    $agenceManager = new AgenceManager();
            $getAgences = $agenceManager->getAgences();
 var_dump($getAgences);
            if($getAgences->rowCount() > 0){
            // On initialise un tableau associatif
                $tableauAgences = [];
                $tableauAgences['agences'] = [];

                // On parcourt les agences
                while($row = $getAgences->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                    $agen = [
                        "id" => $id,
                        "lat" => $lat,
                        "lon" => $lon,
                    ];

                    $tableauAgences['agences'][] = $agen;
                }

                http_response_code(0);
                // On encode en json et on envoie
                echo json_encode($tableauAgences);

            }else{
                // On gère l'erreur
                http_response_code(405);
                echo json_encode(["message" => "La méthode n'est pas autorisée"]);
            }
?>
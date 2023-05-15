<?php
$connection = mysqli_connect("localhost", "root", "", "centre_formation");
session_start();
if (isset($_GET['joinSession'])) {
    $idApp = $_SESSION["ID_apprenant"];
    $idSess = $_GET["id_session"];
    $result = mysqli_query($connection, "SELECT * FROM apprenant WHERE ID_apprenant = $idApp");
    $row = mysqli_fetch_assoc($result);

    $sQldispo = mysqli_query($connection,"SELECT * FROM `session` WHERE ID_session= $idSess ");
    $fetch = mysqli_fetch_assoc($sQldispo);

    $ChauvechementCount_All = mysqli_query(

        $connection, "SELECT COUNT(*) FROM inscription i 
        INNER JOIN session s ON s.ID_session = i.ID_session
        WHERE ID_apprenant = $idApp
        
        AND ( 
            (s.date_debut >  (SELECT date_debut FROM session s WHERE ID_session = $idSess) AND s.date_debut <  (SELECT date_fin FROM session s WHERE ID_session = $idSess))
        
        OR  (s.date_fin >  (SELECT date_debut FROM session s WHERE ID_session = $idSess) AND s.date_fin < (SELECT date_fin FROM session s WHERE ID_session = $idSess) )
        
        OR  (s.date_debut <  (SELECT date_debut FROM session s WHERE ID_session = $idSess) AND s.date_fin >  (SELECT date_fin FROM session s WHERE ID_session = $idSess)) 
        )"
    );


    $ChauvechementCount = mysqli_fetch_row($ChauvechementCount_All)[0];


    $sql_num_session = mysqli_query($connection,
        "SELECT s.ID_session FROM inscription i 
                    INNER JOIN session s ON s.ID_session = i.ID_session
                    WHERE i.ID_apprenant = $idApp
                    AND YEAR (s.date_debut) = YEAR (NOW())");

    $num_session_Data = mysqli_fetch_all($sql_num_session);
    $num_session = COUNT($num_session_Data);
    $sql_formation = mysqli_query($connection,
        "SELECT s.Id_formation
         FROM session s
         WHERE ID_session = $idSess;"
    );
    $id_formation = mysqli_fetch_all($sql_formation)[0][0];

                if($fetch["etat_session"] != 'en cours d\'inscription'){
                header("location : session.php?response=etat&ID_formation=".$id_formation);
                }
            elseif ($num_session < 2 && !checksession($num_session_Data,$idSess) && $ChauvechementCount == 0 ) {
                $checkres = mysqli_query($connection, "SELECT * FROM session WHERE ID_session = '$idSess'");
                $sqljoin= mysqli_query($connection, "INSERT INTO inscription(ID_apprenant, ID_session) VALUES ('$idApp', '$idSess')");
                header("Location: session.php?response=done&ID_formation=".$id_formation);
                exit();
            }elseif(checksession($num_session_Data,$idSess)){
                header("Location: session.php?response=already_joined&ID_formation=".$id_formation);
                exit();
            }elseif($num_session == 2){
                header("Location: session.php?response=2sessionsd&ID_formation=".$id_formation);
                exit();
            }
            else{
                header("Location: session.php?response=cannot&ID_formation=".$id_formation);
            }
}
function checksession($array, $idApp)
{
    foreach ($array as $item) {
        if ($item[0] == $idApp) return true;
        return false;
    }
}

?>
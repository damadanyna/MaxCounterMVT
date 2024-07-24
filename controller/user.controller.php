<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    getMetaDATA($data);
}

function getMetaDATA($params)
{
    $bdb_auth_sipem = creat_cnx('192.168.1.253', 'root', 'clvohama', $params['data']);
    echo json_encode(getData($bdb_auth_sipem, $params['data']));
}


function creat_cnx($host_, $user_, $pwd_, $db_)
{
    $user_con = new mysqli($host_, $user_, $pwd_, $db_);
    if ($user_con->connect_error) {
        return ($user_con->connect_error);
    }
    // return [$db_, 'success'];
    return $user_con;
}

function getData($con, $db)
{
    try {
        // Démarrer une seule transaction pour toutes les opérations
        $con->begin_transaction();

        // Requête pour obtenir le max de mvt_inum
        $stmt = $con->prepare("SELECT MAX(mvt_inum) AS max_mvt_inum FROM mvt");
        $stmt->execute();
        $result = $stmt->get_result();
        $maxMvtInum = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Requête pour obtenir le max de dmv_inum
        $stmt_ = $con->prepare("SELECT MAX(dmv_inum) AS max_dmv_inum FROM detail_mvt");
        $stmt_->execute();
        $result = $stmt_->get_result();
        $maxDmvInum = $result->fetch_all(MYSQLI_ASSOC);
        $stmt_->close();

        // Commit de la transaction après toutes les opérations
        $con->commit();

        return ['agency' => $db, 'movement' => $maxMvtInum, 'detail' => $maxDmvInum];
    } catch (Exception $e) {
        // Rollback en cas d'erreur
        $con->rollback();
        return $e->getMessage();
    }
}

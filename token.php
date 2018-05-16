<?php
include("jsonWrapper.php");

function checkToken(PDO $pdo, $token)
{
    $sql = $pdo->prepare("SELECT `id` FROM `person` WHERE `token` = ?");
    $sql->execute(array($token));
    if ($row = $sql->fetch(PDO::FETCH_NAMED)) {
        return $row["id"];
    } else {
        other_encode(401, "错误的token:{$token}");
        return null;
    }
}
function create_unique(PDO $pdo, $id)
{
    $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'].time().rand();
    $data = sha1($data);
    $pdo->prepare("UPDATE person SET `token` = ? WHERE `id` = ?")->execute(array($data, $id));
    return $data;
}

?>

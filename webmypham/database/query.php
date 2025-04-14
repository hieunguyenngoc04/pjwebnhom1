<?php 

function queryResult($conn, $sql){
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        return $result;
    } else {
        return 0;
    }
}

function queryExecute($conn, $sql){
    try {
        $stmt = $conn->exec($sql);
        return TRUE;
    } catch(PDOException $e) {
        // Log or handle the error appropriately
        // For simplicity, just returning FALSE here
        return FALSE;
    }
}

?>

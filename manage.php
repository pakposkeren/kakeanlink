<?php
function readFromCsv($filename) {
    $data = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = $row;
        }
        fclose($handle);
    }
    return $data;
}

function writeToCsv($filename, $data) {
    if (($handle = fopen($filename, 'w')) !== false) {
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}

$filename = 'data/links.csv';
$data = readFromCsv($filename);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $newRow = [
                count($data) + 1,
                $_POST['icon'],
                $_POST['link'],
                $_POST['title'],
                $_POST['description']
            ];
            $data[] = $newRow;
            writeToCsv($filename, $data);
            header('Location: index.php');
            exit();
        } elseif ($_POST['action'] === 'delete') {
            $index = $_POST['deleteIndex'];
            array_splice($data, $index, 1);
            foreach ($data as $i => $row) {
                $data[$i][0] = $i + 1;
            }
            writeToCsv($filename, $data);
            header('Location: index.php');
            exit();
        }
    }
}
?>

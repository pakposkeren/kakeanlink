<?php
$filename = 'data/links.csv'; // File CSV yang menyimpan data link
$indexHtml = 'index.html';

// Fungsi untuk menulis data ke file CSV
function writeToCsv($filename, $data) {
    $file = fopen($filename, 'w');
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    fclose($file);
}

// Fungsi untuk membaca data dari file CSV
function readFromCsv($filename) {
    $data = [];
    if (($file = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = $row;
        }
        fclose($file);
    }
    return $data;
}

// Fungsi untuk menulis data ke index.html
function updateIndexHtml($data, $indexHtml) {
    $html = '<body>
        <div class="container">
            <h1>Kakean Link Disatuin!</h1>
            <p>Monggo Dipilih Anunya Sesuai Selera :</p>
            <div class="link-wrapper">';
    foreach ($data as $row) {
        list($icon, $link, $title, $description) = $row;
        $html .= "<a href=\"$link\" target=\"_blank\">
            <div class=\"service-box\">
                <i class=\"$icon\"></i>
                <h3>$title</h3>
                <p>$description</p>
            </div>
        </a>";
    }
    $html .= '</div>
        </div>
    </body>';
    file_put_contents($indexHtml, $html);
}

// Menangani form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Tambah data
    if ($action === 'add') {
        $icon = $_POST['icon'];
        $link = $_POST['link'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $data = readFromCsv($filename);
        $data[] = [$icon, $link, $title, $description];
        writeToCsv($filename, $data);
        updateIndexHtml($data, $indexHtml);
        echo "Link added successfully.";
    }

    // Hapus data
    if ($action === 'delete') {
        $indexToDelete = (int)$_POST['deleteIndex'];
        
        $data = readFromCsv($filename);
        if (isset($data[$indexToDelete])) {
            unset($data[$indexToDelete]);
            $data = array_values($data); // Re-index array
            writeToCsv($filename, $data);
            updateIndexHtml($data, $indexHtml);
            echo "Link deleted successfully.";
        } else {
            echo "Invalid index.";
        }
    }
}
?>

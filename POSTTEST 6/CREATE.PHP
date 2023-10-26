<?php

$db = new mysqli("localhost", "username", "password", "mydatabase");

if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $nomor_punggung = $_POST['nomor_punggung'];
    $negara = $_POST['negara'];

    $nama = mysqli_real_escape_string($db, $nama);
    $umur = mysqli_real_escape_string($db, $umur);
    $nomor_punggung = mysqli_real_escape_string($db, $nomor_punggung);
    $negara = mysqli_real_escape_string($db, $negara);

    // File Upload
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];

    if ($file_name !== '') {
        $upload_dir = 'uploads/'; 
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            $query = "INSERT INTO pemain (nama, umur, nomor_punggung, negara, file_path) VALUES ('$nama', '$umur', '$nomor_punggung', '$negara', '$file_path')";

            if ($db->query($query) === true) {
                header("Location: index.php");
            } else {
                echo "Error: " . $query . "<br>" . $db->error;
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Please choose a file to upload.";
    }
}

$db->close();
?>

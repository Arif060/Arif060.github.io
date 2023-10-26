<?php

date_default_timezone_set('Asia/Makassar'); // Set the timezone to Makassar

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


    $date = DateTime::createFromFormat('d-m-Y', $_POST['date']);
    $formattedDate = $date->format('Y-m-d');

    
    $query = "INSERT INTO pemain (nama, umur, nomor_punggung, negara, tanggal) VALUES ('$nama', '$umur', '$nomor_punggung', '$negara', '$formattedDate')";

    if ($db->query($query) === true) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

$db->close();
?>

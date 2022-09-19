<?php
function Koneksi()
{
    return mysqli_connect("localhost", "root", "", "wp");
}

function Index($query)
{
    $koneksi = Koneksi();
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function Add($table, $data)
{
    $koneksi = Koneksi();
    $idproduk = htmlspecialchars($data["id_produk"]);
    $idkriteria = htmlspecialchars($data["id_kriteria"]);
    $nilai = htmlspecialchars($data["nilai"]);
    $query = "INSERT INTO $table VALUES (null, '$idproduk', '$idkriteria','$nilai')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function Edit($table, $data)
{
    $koneksi = Koneksi();
    $idnilai = htmlspecialchars($data["id_nilai"]);
    $idproduk = htmlspecialchars($data["id_produk"]);
    $idkriteria = htmlspecialchars($data["id_kriteria"]);
    $nilai = htmlspecialchars($data["nilai"]);
    $query = "UPDATE $table SET id_produk = '$idproduk', id_kriteria = '$idkriteria', nilai = '$nilai' WHERE id_nilai = $idnilai";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function Delete($table, $tableid, $id)
{
    $koneksi = Koneksi();
    $query = "DELETE FROM $table WHERE $tableid = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

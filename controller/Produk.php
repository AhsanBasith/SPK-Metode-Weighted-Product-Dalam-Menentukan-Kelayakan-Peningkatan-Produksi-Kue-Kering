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
    $kode = htmlspecialchars($data["kode_alternatif"]);
    $produk = htmlspecialchars($data["nm_produk"]);
    $satuan = htmlspecialchars($data["satuan"]);
    $query = "INSERT INTO $table VALUES (null, '$kode', '$produk', '$satuan')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function Edit($table, $data)
{
    $koneksi = Koneksi();
    $idproduk = htmlspecialchars($data["id_produk"]);
    $kode = htmlspecialchars($data["kode_alternatif"]);
    $produk = htmlspecialchars($data["nm_produk"]);
    $satuan = htmlspecialchars($data["satuan"]);
    $query = "UPDATE $table SET kode_alternatif = '$kode', nm_produk = '$produk', satuan = '$satuan' WHERE id_produk = $idproduk";

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

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>

<h1>Data Mahasiswa</h1>

<table border="1">
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Umur</th>
    </tr>
    <?php
    // Data Mahasiswa
    $mahasiswa = [
        ['221511049', 'Fahrizal Mudzaqi Maulana', 20],
        // Tambahkan data mahasiswa lainnya di sini jika diperlukan
    ];

    // Ambil data mahasiswa secara acak dari array
    $random_mahasiswa = $mahasiswa[array_rand($mahasiswa)];
    echo "<tr>";
    echo "<td>" . $random_mahasiswa[0] . "</td>";
    echo "<td>" . $random_mahasiswa[1] . "</td>";
    echo "<td>" . $random_mahasiswa[2] . "</td>";
    echo "</tr>";
    ?>
</table>

</body>
</html>
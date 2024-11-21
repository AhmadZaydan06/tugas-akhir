<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}

include 'siswa.php';


$siswaFile = 'data/siswa.json';
$siswaObj = new Siswa();


if (file_exists($siswaFile)) {
    $data = json_decode(file_get_contents($siswaFile), true);
    foreach ($data as $siswa) {
        $siswaObj->tambahSiswa($siswa);
    }
}


if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_siswa'];
    $siswaObj->tambahSiswa($nama);

    
    file_put_contents($siswaFile, json_encode($siswaObj->getSemuaSiswa()));
}


$hadirHariIni = 0;
$absensiHadir = []; //Modul 1 array
if (isset($_POST['submit_absensi'])) { //Modul 2 pengkondisian
    if (isset($_POST['absensi'])) {
        $hadirHariIni = count($_POST['absensi']); 
        $absensiHadir = $_POST['absensi']; 
    }
}


$daftarSiswa = $siswaObj->getSemuaSiswa();
$totalSiswa = count($daftarSiswa);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        
        .header {
            background-image: url('bg.png');
            background-position: center;
            background-size: cover;
            padding: 15px;
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        
        .logout {
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .logout:hover {
            background-color: #d32f2f;
        }

        
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        
        .popup-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    
    <div class="header">
        Absensi Siswa
    </div>

    
    <a href="logout.php" class="logout">Logout</a>

    
    <div class="container">
        
        <form method="POST">
            <input type="text" name="nama_siswa" placeholder="Nama Siswa" required>
            <button type="submit" name="tambah">Tambah Siswa</button>
        </form>

        
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftarSiswa as $siswa): ?> <!-- Modul 3 perulangan-->
                        <tr>
                            <td><?= htmlspecialchars($siswa) ?></td>
                            <td>
                                <input type="checkbox" name="absensi[]" value="<?= htmlspecialchars($siswa) ?>"
                                    <?php if (in_array($siswa, $absensiHadir)) echo 'checked'; ?>>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="submit_absensi">Simpan Kehadiran</button>
        </form>

        
        <div style="text-align: center; margin-top: 20px;">
            <button onclick="showPopup()">Tampilkan Total Kehadiran</button>
        </div>
    </div>

    
    <div class="popup-background" id="popupBackground">
        <div class="popup-box">
            <h3>Total Kehadiran Hari Ini</h3>
            <p><?= $hadirHariIni ?> dari <?= $totalSiswa ?> siswa hadir</p>
            <button onclick="closePopup()">Tutup</button>
        </div>
    </div>

    <script>
        
        function showPopup() { //Modul 4 Function Method
            document.getElementById('popupBackground').style.display = 'flex';
        }

        
        function closePopup() {
            document.getElementById('popupBackground').style.display = 'none';
        }
    </script>
</body>
</html>

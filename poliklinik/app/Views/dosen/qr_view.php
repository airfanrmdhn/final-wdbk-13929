<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Dosen</title>
  <style>
    body {
      text-align: center;
      margin: 50px;
    }

    img {
      margin-top: 20px;
    }

    /* Hide all elements except for the QR Code section in print mode */
    @media print {
      body * {
        visibility: hidden;
      }

      body {
        text-align: center;
        margin: 50px;
      }

      img {
        margin-top: 20px;
      }


      h1,
      p,
      img {
        visibility: visible;
      }
    }
  </style>
</head>

<body>
  <h1>QR Code Dosen</h1>
  <p>Nama Dosen: <?= esc($dosen['nama_dosen']) ?></p>
  <img src="<?= esc($qrCode) ?>" alt="QR Code">
  <br>
  <button onclick="window.print()">Print</button>
</body>

</html>
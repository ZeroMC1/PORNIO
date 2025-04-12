<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Album Foto Otomatis</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #111;
      color: #fff;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .album-container {
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-height: 90vh;
      overflow-y: auto;
      padding-right: 10px;
    }

    .album-container::-webkit-scrollbar {
      width: 10px;
    }

    .album-container::-webkit-scrollbar-thumb {
      background: #444;
      border-radius: 10px;
    }

    .photo {
      width: 100%;
      max-width: 600px;
      margin: auto;
      background-color: #222;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(255, 255, 255, 0.1);
    }

    .photo img {
      width: 100%;
      height: auto;
      display: block;
    }
  </style>
</head>
<body>
  <h1>Album Foto</h1>
  <div class="album-container">
    <?php
      $folder = "uploads/";
      $gambar = glob($folder . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

      // Sort berdasarkan waktu upload (paling baru di atas)
      usort($gambar, function($a, $b) {
        return filemtime($b) - filemtime($a);
      });

      foreach ($gambar as $file) {
        echo "<div class='photo'><img src='$file' alt='Foto'></div>";
      }
    ?>
  </div>
</body>
</html>

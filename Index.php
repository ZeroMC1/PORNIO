<?php
// Proses upload jika ada file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploadDir = 'uploads/';
  foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
    $fileName = basename($_FILES['images']['name'][$key]);
    $targetFile = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($fileType, $allowed)) {
      move_uploaded_file($tmpName, $targetFile);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Upload & Album Foto</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #111;
      color: #fff;
    }

    h1, h2 {
      text-align: center;
    }

    .upload-panel {
      background-color: #222;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: 0 auto 30px auto;
      box-shadow: 0 2px 10px rgba(255,255,255,0.1);
    }

    .upload-panel input[type="file"] {
      display: block;
      margin-bottom: 10px;
      color: #fff;
    }

    .upload-panel input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
    }

    .album-container {
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-height: 70vh;
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

  <h1>Panel Upload Gambar</h1>

  <div class="upload-panel">
    <form action="" method="post" enctype="multipart/form-data">
      <label for="images">Pilih Gambar (bisa lebih dari satu):</label>
      <input type="file" name="images[]" id="images" accept="image/*" multiple required>
      <input type="submit" value="Upload">
    </form>
  </div>

  <h2>Album Foto</h2>
  <div class="album-container">
    <?php
      $folder = "uploads/";
      $gambar = glob($folder . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

      // Urutkan terbaru ke atas
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

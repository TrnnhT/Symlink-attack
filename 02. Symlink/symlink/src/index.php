<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload a ZIP File</title>
</head>
<body>
    <h1>Upload a ZIP File</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="zip_file" accept=".zip" required>
        <button type="submit" name="upload">Upload</button>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        if (isset($_FILES['zip_file']) && $_FILES['zip_file']['error'] === UPLOAD_ERR_OK) {
            $uploadFile = '/tmp/' . basename($_FILES['zip_file']['name']);
            move_uploaded_file($_FILES['zip_file']['tmp_name'], $uploadFile);
            $extractTo = __DIR__ . '/upload/';
            mkdir($extractTo, 0755, true);
            exec("unzip $uploadFile -d $extractTo");
            echo "File uploaded and extracted to 'upload/' directory.";
        }
    }
    ?>
</body>
</html>

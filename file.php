<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretty File Input</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .file-input-container {
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        label {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        label:hover {
            background-color: #0056b3;
        }

        input[type="file"] {
            display: none;
        }

        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        button {
            margin-block: 10px;
            padding-inline: 5px;
            padding-block: 10px;
        }

        .output {
            display: block;
            display: flex;
        }
    </style>
</head>

<body>

    <form method="POST" action="" enctype="multipart/form-data" class="file-input-container">
        <label for="fileUpload">Choose File</label>
        <input name="uploadedFile" type="file" id="fileUpload">

        <button>
            Submit
        </button>
    </form>


    <div class="file-input-container">
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // check if the user upload a file
            if (!isset($_FILES['uploadedFile']) || $_FILES['uploadedFile']['error'] === UPLOAD_ERR_NO_FILE) {
                echo "no file uploaded";
                exit;
            }
            $file = $_FILES['uploadedFile'];

            // check if there is errors when upload the file
            $error = $file['error'];
            if ($error !== UPLOAD_ERR_OK) {
                echo "upload error: " . $error;
                exit;
            }

            // check if the file size is less then 1MB
            $size = $file['size'];
            if ($size > 0.2 * 1024 * 1024) {
                echo "file is too large! Max 1MB allowed, your file has " . round($size / 2048) . 'KB';
                exit;
            }

            // check the extention of the file
            $allowedExtentions = [
                'jpg',
                'png',
                'jpeg'
            ];
            $name = $file['name'];
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExtentions)) {
                echo "invalid file extension";
                exit;
            }

            // check the type of teh file must be image in this case
            $allowedMime = [
                'image/jpeg',
                'image/png',
                'image/jpg'
            ];
            $tmp = $file['tmp_name'];
            $mime = mime_content_type($tmp);

            if (!in_array($mime, $allowedMime)) {
                echo "invalid file type";
                exit;
            }

            echo "file uploaded successfully";
        }
        ?>

    </div>


</body>

</html>
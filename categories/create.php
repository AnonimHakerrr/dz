<?php
$name = "";
$image = "";
$description = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
    $name = $_POST["name"];
    $description = $_POST["description"];

    $target_dir = $_SERVER["DOCUMENT_ROOT"]."/uploads/";
    $image = $_FILES["image"]["name"];
    $imageFileType = strtolower(pathinfo(basename($image),PATHINFO_EXTENSION));
    $fileName = uniqid().".".$imageFileType;
    $fileSaveDir = $target_dir.$fileName;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $fileSaveDir)) {
        $sql = "INSERT INTO tbl_categories (name, image, description) VALUES (?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$name, $fileName, $description]);
        header("location: /");
        exit();
    } else {
        $problem = "Error save iamge";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?>


<h1 class="text-center">Додати категорій</h1>
<div class="container">
    <div class="row">
        <form method="post" class="offset-md-3 col-md-6" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" class="form-control" value="<?php echo $name; ?>" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">
                    <img src="/uploads/select.png" alt="image" width="200"
                         id="selectImage"
                         style="cursor: pointer">
                </label>
                <input type="file" class="form-control d-none"
                       id="image" name="image">
            </div>

            <div class="mb-3">
                <label for="description">Опис</label>
                <textarea class="form-control" placeholder="Leave a comment here"
                          name="description"
                          id="description"><?php echo $description; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Додати</button>
        </form>
    </div>

</div>


<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener("load", (event) => {
        const image = document.getElementById("image");
        image.onchange=(e) => {
            const file = e.target.files[0];
            document.getElementById("selectImage").src=URL.createObjectURL(file);
            //console.log("select file", e.target.files);
        }
    });
</script>
</body>
</html>
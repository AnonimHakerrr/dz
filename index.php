<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?>


<h1 class="text-center">Список категорій</h1>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>

<div class="container">
    <a href="/categories/create.php" class="btn btn-success">Додати категорію</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Фото</th>
            <th scope="col">Назва</th>
            <th scope="col">Опис</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM tbl_categories";
        $command = $dbh->query($sql);
        foreach ($command as $row) {
            $image = $row["image"];
            $id = $row["id"];
            $name = $row["name"];
            $description = $row["description"];
            echo "
            <tr>
                <th><img src='/uploads/$image' alt='' width='50'></th>
                <td>$name</td>
                <td>$description</td>
                <td>
                <a href='/categories/edit.php?id=$id' class='btn btn-primary'>
                    <i class='fa fa-pencil fs-4'></i>
                </a>
                
                <a href='/categories/delete.php?id=$id' class='btn btn-danger' data-delete>
                     <i class='fa fa-times fs-4'></i>
                </a>
                </td>
                
            </tr>
            ";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/modal/deleteModal.php"); ?>
<script src="/js/delete.js"></script>
</body>
</html>
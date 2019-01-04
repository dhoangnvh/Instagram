<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php
        // chạy terminal
        $ter = shell_exec("php uploadPhoto.php");

        // get data -> array
        $array = explode("RESPONSE: ",$ter);
        $responseLast = end($array);
        $data = strstr($responseLast, "{");
        $dataArr = json_decode($data, true);

        print_r($dataArr);
        // Id bài viết "https://www.instagram.com/p/" . $dataArr['media']['code']
        echo "<hr>";
        echo $dataArr['media']['code'];

        // Url Image
        echo "<hr>";
        print_r ($dataArr['media']['image_versions2']['candidates']);
        echo "<hr>";

        // Content post, thông tin người đăng ...
        print_r ($dataArr['media']['caption']);
        echo "<hr>";

    ?>
    </body>
</html>
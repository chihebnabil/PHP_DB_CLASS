<?php
/**
 * Created by PhpStorm.
 * User: Nabil Chiheb
 * Date: 19/01/2015
 * Time: 12:29
 */
require "db.php";


if(isset($_GET["id"]) && !empty($_GET['id'])){

    $id = $_GET['id'];
    $database->query('SELECT * FROM links WHERE link  = :id ');
    $database->bind(':id', $id);
    $res =  $database->resultset();
    // var_dump($res[0]["expire"]);
    if(  !empty($res)  && $res[0]["expire"] + 259200 > time()   ) {

        $file= "*.zip";



        if (($file != "") && (file_exists(basename($file))))
        {
            $size = filesize(basename($file));
            header("Content-Type: application/force-download; name=\"" . basename($file) . "\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
            header("Expires: 0");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            readfile(basename($file));
            exit();
        }




    }else{
        echo '<div data-alert class="alert-box alert  radius">';

        echo    "Error 2";

        echo "<a href='' class='close'>&times;</a></div>";
    }



}else{
    echo '<div data-alert class="alert-box alert  radius">';

    echo    "ثErreur";

    echo "<a href='' class='close'>&times;</a></div>";
}
?>

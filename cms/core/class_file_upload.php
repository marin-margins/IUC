<?php

class class_file_upload
{

    const TARGET_FOLDER = "files/";

    const ALLOWED_TYPES = array("jpg",
        "png",
        "gif",
        "jpeg",
    );

    /**
     * $files = array of files
     * $folder_name = folder inside folder named /files located at cms/files
     * $max_size_in_bytes = max size in mytes default = 5 mb
     */

    function upload_file($files, $folder_name_in_files, $max_size_in_bytes = 5000000)
    {
        $errors = "";
        $success = "";

        $target_dir = self::TARGET_FOLDER . $folder_name_in_files;

        if (file_exists($target_dir)) {
            $total = count($files['name']);
            $uploadOk = 1;
            for ($i = 0; $i < $total; $i++) {
                if ($total == 1) {
                    $target_file = $target_dir . "/" . basename($files["name"]);
                    $original_name = $files["name"];
                    if ($files["size"] > $max_size_in_bytes) {
                        $errors .= "Sorry, " . $original_name . " is too large.<br>";
                        $uploadOk = 0;}
                    //ako mi provjerava $files["tmp_name"] onda mi uvijek kaze da file vec postoji, pa sam stavio da provjerava obicno ime
                    // postoji samo jedan problem, moze se uploadat ista slika milijun puta jer ti generiras posebno ime za svaku(pretpostavljam da je zato)
                    //ako mi provjerava $files["tmp_name"] onda mi uvijek kaze da file vec postoji, pa sam stavio da provjerava obicno ime
                    // postoji samo jedan problem, moze se uploadat ista slika milijun puta jer ti generiras posebno ime za svaku(pretpostavljam da je zato)
                    //ako mi provjerava $files["tmp_name"] onda mi uvijek kaze da file vec postoji, pa sam stavio da provjerava obicno ime
                    // postoji samo jedan problem, moze se uploadat ista slika milijun puta jer ti generiras posebno ime za svaku(pretpostavljam da je zato)
                    if (file_exists($files["name"])) {
                        $errors .= "Sorry, " . $original_name . " file already exists.<br>";
                        $uploadOk = 0;
                    }
                } else {
                    $target_file = $target_dir . "/" . basename($files["name"][$i]);
                    $original_name = $files["name"][$i];
                    if ($files["size"][$i] > $max_size_in_bytes) {
                        $errors .= "Sorry, " . $original_name . " is too large.<br>";
                        $uploadOk = 0;}
                    //isti komentar kao gore
                    //isti komentar kao gore
                    //isti komentar kao gore
                    //isti komentar kao gore
                    if (file_exists($files["name"][$i])) {
                        $errors .= "Sorry, " . $original_name . " file already exists.<br>";
                        $uploadOk = 0;
                    }
                }
                $fileFileType = pathinfo(strtolower($target_file), PATHINFO_EXTENSION);
                $target_file = $target_dir . "/" . uniqid('iuc_file_') . "." . $fileFileType;
                if (!in_array($fileFileType, self::ALLOWED_TYPES)) {
                    $errors .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                    $uploadOk = 0;
                }
                //Make sure we have a file path
                if ($uploadOk == 0) {
                    $errors .= "Sorry, " . $original_name . " was not uploaded.<br>";
                } else {
                    if ($total == 1) {
                        if (move_uploaded_file($files["tmp_name"], $target_file)) {
                            $success .= "The file " . basename($files["name"]) . " has been uploaded.<br>";
                        } else {
                            $errors .= "Sorry, " . $original_name . " there was an error uploading your file.<br>";
                        }
                    } else {
                        if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
                            $success .= "The file " . basename($files["name"][$i]) . " has been uploaded.<br>";
                        } else {
                            $errors .= "Sorry, " . $original_name . " there was an error uploading your file.<br>";
                        }
                    }
                }
            }
        } else {
            $errors .= "Directory " . $target_dir . " doesn't exist";
        }
        if (!empty($errors)) {
            return $errors;
        } else {
            return $target_file;
        }

    }
}
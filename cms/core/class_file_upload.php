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

    static function upload_file($files, $folder_name_in_files, $max_size_in_bytes = 5000000)
    {
        $errors = "";
        $success = "";

        $target_dir = self::TARGET_FOLDER . $folder_name_in_files;

        if (file_exists($target_dir)) {

            $total = count($files['name']);

            for ($i = 0; $i < $total; $i++) {
                $target_file = $target_dir . "/" . basename($files["name"][$i]);
                $uploadOk = 1;
                $fileFileType = pathinfo(strtolower($target_file), PATHINFO_EXTENSION);
                $original_name = $files["name"][$i];
                $target_file = $target_dir . "/" . uniqid('iuc_file_') . "." . $fileFileType;


                if (file_exists($files["tmp_name"])) {
                    $errors .= "Sorry, " . $original_name . " file already exists.<br>";
                    $uploadOk = 0;
                }

                if ($files["size"][$i] > $max_size_in_bytes) {
                    $errors .= "Sorry, " . $original_name . " is too large.<br>";
                    $uploadOk = 0;
                }

                if (!in_array($fileFileType, self::ALLOWED_TYPES)) {
                    $errors .= "Sorry, " . $original_name . " only JPG, JPEG, PNG & GIF files are allowed.<br>";
                    $uploadOk = 0;
                }
                //Make sure we have a file path
                if ($uploadOk == 0) {
                    $errors .= "Sorry, " . $original_name . " was not uploaded.<br>";


                } else {


                    if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
                        $success .= "The file " . basename($files["name"][$i]) . " has been uploaded.<br>";
                    } else {
                        $errors .= "Sorry, " . $original_name . " there was an error uploading your file.<br>";
                    }
                }


            }
        } else {
            $errors .= "Directory " . $target_dir . " doesn't exist";
        }
        if (!empty($errors)) {
            return $errors;
        } else {
            return $success;
        }


    }
}







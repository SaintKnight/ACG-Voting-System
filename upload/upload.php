<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../configuration.php");
// assume all space are filled
//var_dump($_FILES);
if(!$_POST){
    echo "404";
    goto end;
}
if($_POST["first"] == "Update"){
    var_dump($_POST);
    echo "<br>files:<br>";
    $counter = 1;
    $workname = $_POST["select"];
    $chpfil = $_POST["name"];
    $query = "SELECT * FROM workinfo WHERE workname = :workname";
    $stmt = $db->prepare($query);
    $exe = $stmt->execute(array(":workname"=>$workname));
    $content = $stmt->fetch();
    $workID = $content["workID"];
    $newestchp = $content["newestchp"];
    $type = $content["form"];

    // create an empty folder named the new chporfilID;
    $newestchp++;
    $filename = "bla";
    if($type == "Manga"){
        $filename = "第 $newestchp 话";
    } else {
        $filename = "第 $newestchp 章";
    }
mkdir("uploads/W$workID/$filename",0755,true);

// upload files;
var_dump($_FILES);
$target_dir = "uploads/W$workID/$filename/";
while($_FILES["fileToUpload$counter"]){
    $temp = $target_dir . basename($_FILES["fileToUpload$counter"]["name"]);
    $FileType = pathinfo($temp,PATHINFO_EXTENSION);
    $target_file = $target_dir . $counter. '.'.$FileType;
    $uploadOk = 1;
    echo "<br><br><br>";

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload$counter"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($type == "Manga"){
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = filesize($_FILES["fileToUpload$counter"]["tmp_name"]);
            var_dump("fileToUpload$counter");
            var_dump($check);
            echo "<br>";
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
        && $FileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for Manga.";
            $uploadOk = 0;
        }
    } else {
        if($FileType != "txt") {
            echo "Sorry, only TXT files are allowed for Light Novel.";
            $uploadOk = 0;
        }
        if($counter > 1) {
            echo "Sorry, TXT files can only be submitted once at a time!!!!!!!!!";
            //$uploadOk = 0;
            break;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
        // later delete file and jump
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload$counter"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload$counter"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            $uploadOK = 0;
        }
    }

    if($uploadOk == 0){
        //remove the file
        delTree($target_dir);
        echo "<script>alert ('Sorry, your file was not uploaded.')</script>";
        echo "<script>window.location = '../hexa/hexa.php?page=$page&rank=$rank'</script>";
        exit;
        break;
    } else {
        // create a new table named Wid;
        
    }
    echo "<br>";
    $counter++;
    }//////while////////

    $worktable = "W".$workID;
    // add a new entry to Wid;
    $query = "INSERT INTO $worktable (num, name) VALUES (:newestchp,:name);";
    $stmt = $db->prepare($query);
    $exe = $stmt->execute(array(":newestchp"=>$newestchp, ":name"=>$chpfil));

    // update newestchp in workinfo;
    $query = "UPDATE workinfo SET newestchp = :newestchp WHERE workID = :workID";
    $stmt = $db->prepare($query);
    $exe = $stmt->execute(array(":newestchp"=>$newestchp, ":workID"=>$workID));

    echo "<script>alert ('Files upload success!')</script>";
    echo "<script>window.location = '../hexa/hexa.php?page=home&rank=total'</script>";

} else { ////////////////////////////////////////////////////////////////////////////////////////////
    $counter = 1;
    $title = $_POST["title"];
    $desci = $_POST["desc"];
    $type = $_POST["type"];
    $chpfil = $_POST["name"];

    // grab authorID;
    $query = "SELECT userID FROM userinfo where username = :user;";
    $stmt = $db->prepare($query);
    $exe = $stmt->execute(array(":user"=>$_SESSION["a"]));
    $content = $stmt->fetch();
    $authorID = $content["userID"];

    // add a new entry to workinfo;
    $query = "INSERT INTO workinfo (workname, authorID, form, uptime, newestchp, lastmod, votetotal, voteyear, voteseason, votemonth, voteday, description) VALUES (:name, :author, :type, NOW(), 1, NOW(),0,0,0,0,0,:desci);";
    $stmt = $db->prepare($query);
    $exe = $stmt->execute(array(":name"=>$title,":author"=>$authorID, ":type"=>$type, ":desci"=>$desci));

    // grab the new workID; 
    $workID = "SELECT workID FROM workinfo ORDER BY workID DESC LIMIT 1;";
    $stmt = $db->prepare($workID);
    $exe = $stmt->execute();
    $content = $stmt->fetch();
    $workID = $content["workID"];

    // create an empty folder named the new workID;
    mkdir("uploads/W$workID",0755,true);

    // upload cover;
    $target_dir = "uploads/W$workID/";
    $cover = "C0VER";
    $temp = $target_dir . basename($_FILES["cover"]["name"]);
    $FileType = pathinfo($temp,PATHINFO_EXTENSION);
    $target_file = $target_dir . $cover. '.'.$FileType;
    $coverOk = 1;

    // Check if cover already exists
    if (file_exists($target_file)) {
        echo "Sorry, cover already exists.";
        $coverOk = 0;
    }
    // Check cover size;
    if ($_FILES["cover"]["size"] > 500000000) {
        echo "Sorry, your cover is too large.";
        $coverOk = 0;
    }
    // Check cover type;    
    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
    && $FileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for cover.";
        $coverOk = 0;
    }
    if ($coverOk != 0) {
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["cover"]["name"]). " has been uploaded.";
            // create an empty folder named the new chporfilID;
            $filename = "bla";
            if($type == "Manga"){
                $filename = "第 1 话";
            } else {
                $filename = "第 1 章";
            }
            mkdir("uploads/W$workID/$filename",0755,true);

            // upload files;
            //var_dump($_FILES);
            $target_dir = "uploads/W$workID/$filename/";
            $create_table = true;
            while($_FILES["fileToUpload$counter"]){////////////while

            $temp = $target_dir . basename($_FILES["fileToUpload$counter"]["name"]);
            $FileType = pathinfo($temp,PATHINFO_EXTENSION);
            $target_file = $target_dir . $counter. '.'.$FileType;
            $uploadOk = 1;

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload$counter"]["size"] > 500000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($type == "Manga"){
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = filesize($_FILES["fileToUpload$counter"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
                && $FileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for Manga.";
                    $uploadOk = 0;
                }
            } else {
                if($FileType != "txt") {
                    echo "Sorry, only TXT files are allowed for Light Novel.";
                    $uploadOk = 0;
                }
                if($counter>1){
                    echo "Only one txt allowed";
                    break;
                }
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk != 0){
                if (move_uploaded_file($_FILES["fileToUpload$counter"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload$counter"]["name"]). " has been uploaded.";
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $uploadOK = 0;
                }
            }

            if($uploadOk == 0) {
                // delete the new entry and remove the file
                $query = "DELETE FROM workinfo where workID = $workID";
                $stmt = $db->prepare($query);
                $exe = $stmt->execute();

                $query = "DELETE FROM U$authorID where workID = $workID";
                $stmt = $db->prepare($query);
                $exe = $stmt->execute();

                //remove the file
                //mkdir("uploads/W$workID/$filename/testfolder",0755,true);
                /*$ftodelete = scandir($target_dir);
                while($ftodelete[2]){
                    var_dump($ftodelete);
                    unlink("$target_dir".$ftodelete[2]);
                    $ftodelete = scandir($target_dir);
                }
                rmdir("uploads/W$workID/".$filename);
                unlink("uploads/"."W$workID/");*/
                delTree("uploads/W$workID/");
                echo "<script>alert ('Sorry, your file was not uploaded.')</script>";
                break;
            } else {
                
                // create a new table named Wid;
                if($create_table){
                    $worktable = "W".$workID;
                    $query = "CREATE TABLE $worktable (num INT, name TEXT);";
                    $stmt = $db->prepare($query);
                    $exe = $stmt->execute();

                    $query = "INSERT INTO U$authorID (workID, type) VALUES (:work, 'upload');";
                    $stmt = $db->prepare($query);
                    $exe = $stmt->execute(array(":work"=>$workID));

                    $create_table = false;
                
                    // add a new entry to Wid;
                    $query = "INSERT INTO $worktable (num, name) VALUES (1,:name);";
                    $stmt = $db->prepare($query);
                    $exe = $stmt->execute(array(":name"=>$chpfil));
                }
            }

            $counter++;
        }//while
        } else {
            $coverOk = 0;
            //echo "Sorry, there was an error uploading your cover.";
            //remove the file
            //unlink("uploads/"."W$workID");
            //echo "<script>alert ('Sorry, your cover was not uploaded.')</script>";
        }
    }
    if($coverOk == 0) {
        // delete the new entry and remove the file
        $query = "DELETE FROM workinfo where workID = $workID";
        $stmt = $db->prepare($query);
        $exe = $stmt->execute();
        rmdir("uploads/W$workID");
        echo "<script>alert ('Sorry, your cover was not uploaded.')</script>";
        echo "<script>window.location = '../hexa/hexa.php?page=home&rank=rank'</script>";
    }
    echo "<script>alert ('Files upload success!')</script>";
    echo "<script>window.location = '../hexa/hexa.php?page=home&rank=total'</script>";
}
end:
?>
<?php

        //限制圖片型別格式，大小
        /*if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg"))
            && ($_FILES["file"]["size"] < 200000)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                echo "檔名: " . $_FILES["file"]["name"] . "<br />";
                echo "檔案型別: " . $_FILES["file"]["type"] . "<br />";
                echo "檔案大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "快取檔案: " . $_FILES["file"]["tmp_name"] . "<br />";*/

            //設定檔案上傳路徑，選擇指定資料夾

           // }
       // } else {
       //     echo "上傳失敗！";//上傳失敗後顯示錯誤資訊
       // }
        move_uploaded_file(
              $_FILES["file"]["tmp_name"],
              "image/" . $_FILES["file"]["name"]
        );
        echo json_encode(array("message"=> $_FILES["file"]["name"]));//上傳成功後提示上傳資訊
        /*$file = "image/" . $image->name;
        $sql = "INSERT INTO post(ImageName)
            VALUES
            ('$file')";
        if (!mysqli_query($conn,$sql)) {
            die('Error: ' . mysqli_error($conn));
        }
        echo "成功新增一條記錄";//成功傳入資料後顯示成功新增一條資料
        //header("Refresh:1;url=XXX.html");//成功插入資料後返回某個網頁*/
        ?>
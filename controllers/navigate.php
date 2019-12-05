<?php 
    session_start();
    include "../model/DBConfig.php";
    $db = new Database;
    $db->connect();
    
    $action = 'homepage';
    if (isset($_POST['controllers'])) {
        $action = $_POST['controllers'];
    }
    // if (isset($_FILES['file'])) {
    //     $action = "insertimg";  
    //     print_r($_POST['controllers']);       
    // }
    // echo $action;
    switch($action) {
        case "deleteitem": {
            $event = $_POST['eventn'];
            $stime = $_POST['starttime'];
            $etime = $_POST['endtime'];
            

            $sql = "SELECT * FROM eventTable WHERE EventName = '$event' and StartTime = '$stime' and EndTime = '$etime'";
            if ($db->execute($sql)) {
                $row = $db->getData();
            }
            else {
                echo "NO1";
            }
            $eventid = $row['EVENT_ID'];

            $sql1 = "DELETE FROM weekDays WHERE EVENT_ID='$eventid'";
            // echo $sql1;
            $sql2 = "DELETE FROM eventTable WHERE ID_CARD='".$_SESSION['userid']."' and EVENT_ID='$eventid'";
            if ($db->execute($sql1)) {
                if ($db->execute($sql2)) {
                    echo "YES";
                }
            }
            else {
                echo "NO2";
            }
            break;
        }
        case "editdisplayevent": {
            $location = $_POST['editlocation'];
            $event = $_POST['event'];
            $checkedDays = $_POST['checkedDays'];  // array to save days ['mon', 'tues']
            $editendtime = $_POST['editendtime'];
            $editstartime = $_POST['editstartime'];
            $eventid = $_POST['eventid'];
            $query = "UPDATE eventTable SET EventName='$event', StartTime='$editstartime', EndTime='$editendtime', location='$location' WHERE ID_CARD='".$_SESSION["userid"]."' and EVENT_ID='$eventid'";
            if($db->execute($query)) {
                echo "YES";
            } else {
                echo "NO";
            }
            break;
        }
        case "updateeventinshow": {
            $event = $_POST['eventn'];
            $stime = $_POST['starttime'];
            $etime = $_POST['endtime'];
            // echo $event;
            // echo $stime;
            // echo $etime;
            $sql = "SELECT * FROM eventTable WHERE EventName = '$event' and StartTime = '$stime' and EndTime = '$etime'";
            if ($db->execute($sql)) {
                $events = array();
                $row = $db->getData();
                array_push($events, $row["ID_CARD"]);
                array_push($events, $row["EVENT_ID"]);
                echo json_encode($events);
                error_log('JSON ENCODE ok ...');  
                die();
            }
            else {
                echo "NO";
            }
            break;
        }
        case "showitem": {
            $sql = "SELECT * FROM eventTable WHERE ID_CARD='".$_SESSION['userid']."'";
            if ($db->execute($sql)) {
                $events = array();
                while($row = $db->getData()){
                    array_push($events, (array)$row);
                }
                echo json_encode($events);
                error_log('JSON ENCODE ok ...');  
                die();
            }
            else {
                echo "NO";
            }
            break;
        }
        case "displayallevent": {
            $sql = "SELECT USER_INFO.ID_CARD, eventTable.EventName, eventTable.StartTime, eventTable.EndTime, eventTable.location, weekDays.WEEKDAY FROM weekDays JOIN eventTable ON weekDays.EVENT_ID = eventTable.EVENT_ID JOIN USER_INFO ON USER_INFO.ID_CARD = eventTable.ID_CARD WHERE USER_INFO.ID_CARD = '".$_SESSION['userid']."'";
            if ($db->execute($sql)) {
                $events = array();
                while($row = $db->getData()){
                    array_push($events, (array)$row);
                }
                echo json_encode($events);
                error_log('JSON ENCODE ok ...');  
                die();
            }
            else {
                echo "NO";
            }
        }
        case "addevent": {
            $location = $_POST['addlocation'];
            $event = $_POST['event'];
            $checkedDays = $_POST['checkedDays'];  // array to save days ['mon', 'tues']
            $addendtime = $_POST['addendtime'];
            $addstartime = $_POST['addstartime'];
            // print_r ($checkedDays);
            // echo $addstartime;
            if (!isset($_SESSION['userevent'])) {
                $sql = "SELECT * FROM eventTable WHERE ID_CARD='".$_SESSION['userid']."'";
                if ($db->execute($sql)) {
                    $row_num = $db->num_rows();
                    // number of records;
                    $_SESSION['eventnum'] = (int)$_SESSION['userid'] + $row_num + 1;
                }                              
                
            }
            
            
            // set global variable to count events
            $_SESSION['eventnum'] += 1;            
            
            $query = "INSERT INTO eventTable values('".$_SESSION['eventnum']."', '$event','$addstartime', '$addendtime', '$location', '".$_SESSION['userid']."')";
            // echo  $query;
            if ($db->execute($query)) { 
                $counter = 0;   
                // echo "OKAY";                
                foreach ($checkedDays as $day) {
                    // echo $day;
                    if ($day != "") {
                        $sql = "INSERT INTO weekDays values('".$_SESSION['eventnum']."', '$day')";
                        // echo $sql;
                        if ($db->execute($sql)) {
                            $counter += 1;                      
                        }
                    }
                    
                    
                }
                echo "Added ".$counter. " events.";
            }    
            else {
                echo "NO";
            }
            // echo $day;
            
            break;
        }
        case "updateimg": {
            $filename = $_FILES['file']['name'];
            // echo $_SESSION["userimage"];
            /* Location */
            $location = "upload/".$filename;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions = array("jpg","jpeg","png");
            /* Check file extension */
            if( in_array(strtolower($imageFileType),$valid_extensions) ) {
                $sql = "SELECT * FROM tbl_images WHERE ID_CARD='".$_SESSION['userid']."'";
                    // echo $sql;
                    if ($db->execute($sql)) {
                        $row = $db->getData();
                        if ($row == 0) {
                            $query = "INSERT INTO tbl_images values(null, '$filename','$location', '".$_SESSION['userid']."')";
                
                            // echo $query;
                            if ($db->execute($query)) {
                                $sql = "SELECT * FROM tbl_images WHERE ID_CARD='".$_SESSION['userid']."'";
                                // echo $sql;
                                if ($db->execute($sql)) {
                                    $row = $db->getData();
                                    $_SESSION["userimage"] = $row['id'];                      
                                }
                                // image in upload/ folder in controllers
                                // Upload file
                                move_uploaded_file($_FILES['file']['tmp_name'],$location);
                                echo $location;
                            }    
                            else {
                                echo "NO";
                            }
                        } else { // if $row exist
                            $query = "UPDATE tbl_images SET imagepath='$location' WHERE id='".$_SESSION["userimage"]."'";
                
                            // echo $query;
                            if ($db->execute($query)) {
                                
                                // Upload file
                                move_uploaded_file($_FILES['file']['tmp_name'],$location);
                                echo $location;
                            }    
                            else {
                                echo "NO";
                            }
                        } // check row
                                              
                    } // process select                         
                
            } // check image
            break;
            
        }
        case "getimg": {
            $sql = "SELECT * FROM tbl_images WHERE ID_CARD='".$_SESSION['userid']."'";
            // echo $sql;
            if ($db->execute($sql)) {
                $row = $db->getData();
                echo $row['imagepath'];                      
            }
            break;
        }
        // case "insertimg": {
        //     $filename = $_FILES['file']['name'];

        //     /* Location */
        //     $location = "upload/".$filename;
        //     $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        //     /* Valid Extensions */
        //     $valid_extensions = array("jpg","jpeg","png");
        //     /* Check file extension */
        //     if( in_array(strtolower($imageFileType),$valid_extensions) ) {
        //         $query = "INSERT INTO tbl_images values(null, '$filename','$location', '".$_SESSION['userid']."')";
                
        //         // echo $query;
        //         if ($db->execute($query)) {
        //             $sql = "SELECT * FROM tbl_images WHERE ID_CARD='".$_SESSION['userid']."'";
        //             // echo $sql;
        //             if ($db->execute($sql)) {
        //                 $row = $db->getData();
        //                 $_SESSION["userimage"] = $row['id'];                      
        //             }
        //               // image in upload/ folder in controllers
        //             // Upload file
        //             move_uploaded_file($_FILES['file']['tmp_name'],$location);
        //             echo $location;
        //         }    
        //         else {
        //             echo "NO";
        //         }        
                
        //     }
        //     // echo $action;
        //     break;
        // }
        case "updatepass": {
            $idcard = $_SESSION['userid'];
            $passwordold = $_POST['passwordold'];
            $passwordnew = $_POST['passwordnew'];
            $passwordconfirm = $_POST['passwordconfirm'];

            $sql1 = "SELECT * FROM ACCOUNT WHERE ID_CARD='$idcard'";
            $db->execute($sql1);
            $row = $db->getData();
            if ($row['PASS_WORD'] == $passwordold && $passwordnew == $passwordconfirm) {
                # code...
                $sql2 = "UPDATE ACCOUNT SET PASS_WORD = '$passwordnew' WHERE ID_CARD='$idcard'";
                
                if ($db->execute($sql2)) {
                    echo "YES";
                    
                } else {
                    echo "Failed";
                }
            } else { 
                echo "Failed";
            }
            // print_r($row);
            break;
        }
        case "updateinfo": {
            $fullname = $_POST['fullname'];
            $idcard = $_SESSION['userid'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $address = $_POST['address'];
            $phonenum = $_POST['phonenum'];
            $email = $_POST['email'];
            // sql
            $sql = "UPDATE USER_INFO SET NAME='$fullname', GENDER='$gender', DOB='$dob', ADDRESS='$address', PHONE_NUM='$phonenum', EMAIL='$email' WHERE ID_CARD='$idcard'";
            if ($db->execute($sql)) {
                echo "YES";
		    
            } else {
                echo "Failed";
            }
            break;
        }
        case "register": {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $idcard = $_POST['idcard'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $address = $_POST['address'];
            $phonenum = $_POST['phonenum'];
            $email = $_POST['email'];

            $sql1 = "INSERT USER_INFO VALUES ('$idcard','$fullname','$gender','$dob','$address','$phonenum','$email')";
            $check1 = false;
            $check2 = false;
            if ($db->execute($sql1)) {
                $check1 = true;
            }
            $sql2 = "INSERT ACCOUNT VALUES ('$idcard','$username','$password')";
            if ($db->execute($sql2)) {
                $check2 = true;
            }
            if($check1 == true && $check2 == true) {
                echo "YES";
            } else {
                echo "NO";
            }
            // echo $username;
            break;
        }
        case "profile": {
            $sql = "SELECT * FROM USER_INFO WHERE USER_INFO.ID_CARD = '".$_SESSION['userid']."'";
            if ($db->execute($sql)) {
                $row = $db->getData();
                $name = $row['NAME'];
                $idcard = $row['ID_CARD'];
                $gender = $row['GENDER'];
                $dob = $row['DOB'];
                $add = $row['ADDRESS'];
                $phone = $row['PHONE_NUM'];
                $mail = $row['EMAIL'];

                $output = '<div>
                <p id="idcardshow" name="idcardshow">Số chứng minh nhân dân: '.$idcard.'</p>
                <p>Họ và tên: '.$name.'</p>
                <p>Giới tính: '.$gender.'</p>
                <p>Ngày sinh: '.$dob.'</p>
                <p>Địa chỉ: '.$add.'</p>
                <p>Số điện thoại: '.$phone.'</p>
                <p>Email: '.$mail.'</p>
                </div>';
            }
            
            echo $output;
            // create div and return             
            break;
        }
    // //     case 'updateavatar': {
    // //         include "../model/insert.php";
    // //         $name = $_POST['name'];
    // //         $img = $_FILES['image']['name'];
            
    // //         $avatarid = $_SESSION['userid'];
    // //         require_once("../views/Profile.php");
    // //         break;
    // //     }

        case "login": {                 
            
            if (isset($_POST['username'])) {
                // Get values from LoginForm.php
                $username = $_POST['username'];
                $password = $_POST['password'];
        
                $sql = "SELECT * FROM ACCOUNT WHERE USERNAME = '$username' AND PASS_WORD = '$password'";
                if ($db->execute($sql)) {
                    $data = $db->getData();
                    // print_r($data);
                    if ($data['USERNAME'] == $username && $data['PASS_WORD'] == $password) {
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['userid'] = $data['ID_CARD'];
                        echo "YES";
                    }
                    else {
                        echo "Failed";
                    }
                }                
            //     // require_once("/var/www/html/WebApp/views/Test.php");
            }
            
            break;
        }

    // //     case "logout": {
    // //         include "/var/www/html/WebApp/model/Process.php";
    // //         break;
    // //     }

        

        default: {
                    require_once('../views/HomePage.php');
                    break;  
                }
    }
?>
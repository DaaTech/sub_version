<?php

    try {
        
        require_once('dbcon.php');
        require_once('getInternet.php');
        @session_start();
        if ($_SESSION['reload_state'] == "disable") {
                $_SESSION['status'] = "failed";
                $_SESSION['err_msg'] = "Previous action was save. Redo is not permitted";
                header('location: /firebase/');
                exit;
        }
        $today = date("Y-m-d h:i:s");
        $appUser = "Dev Test";
        extract($_POST);
        if (isset($add_client)) {
            function setUniqness(){
                
                $thisClientId = '';
                $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                .'0123456789'
                .time()
                ); // and any other characters
                shuffle($seed); // probably optional since array_is randomized; this may be redundant

                foreach (array_rand($seed, 12) as $k) $thisClientId .= $seed[$k];
                $_SESSION['UiD'] = "Current Id: $thisClientId";
                $refTarget = "dehims_clients/$thisClientId";
                $thisChecker = $database->getReference($refTarget)->getValue();
                if ($thisChecker > 0) { # IF THERE'S AN EXISTING CLIENT WITH NEWLY GENERATED ID, RECALL THE METHOD TO CHANGE THE ID.
                    $setUniqness(); # RECALLING METHOD
                }
                else { # THERE ISN'T ANY CLIENT WITH THE NEWLY GENERATED ID, INSERT CURRENT CLIENT
                $postOnlineData =[
                    'UiD' => $thisClientId,
                    'surname' => $sName,
                    'otherNames' => $oName,
                    'phone' => $phone,
                    'email' => $email,
                    'facility' => $fName,
                    'type' => $fType,
                    'ownership' => $fOwner,
                    'region' => $fRegion,
                    'district' => $fDistrict,
                    'town' => $fTown,
                    'landmarks' => $fLandmarks,
                    'latitude' => $fLat,
                    'longitude' => $fLong,
                    'remarks' => $remarks,
                    'status' => '',
                    'last_update' => '',
                    'last_updater' => '',
                    'Created_By' => $appUser,
                    'timestamp' => $today
                    ];
                    $sender = $database->getReference($refTarget)->push($postOnlineData);
                    if ($sender) {
                        $_SESSION['reload_state'] = "disable";
                        $_SESSION['status'] = "Client Created Successfully";
                        header('location: /firebase/');
                    }else {
                        $_SESSION['reload_state'] = "";
                        $_SESSION['status'] = "Client Failed";
                        header('location: /firebase/');
                    }
                }
            }
        }
        elseif (isset($edit_client)) {
            $postOnlineData =[
                'surname' => $sName,
                'otherNames' => $oName,
                'phone' => $phone,
                'email' => $email,
                'facility' => $fName,
                'type' => $fType,
                'ownership' => $fOwner,
                'region' => $fRegion,
                'district' => $fDistrict,
                'town' => $fTown,
                'landmarks' => $fLandmarks,
                'latitude' => $fLat,
                'longitude' => $fLong,
                'remarks' => $remarks,
                'status' => '',
                'last_update' => $today,
                'last_updater' => $appUser
            ];
            $targetClient = $_SESSION['target'];
            $refTarget = "dehims_clients/".$targetClient;
            $sender = $database->getReference($refTarget)->update($postOnlineData);
            unset($_SESSION['target']); #REMOVE CLIENT ID IMMEDIATELY AFTER USING IT.
            if ($sender) {
                $_SESSION['reload_state'] = "disable";
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Client Updated Successfully";
                header('location: /firebase/');
            }else {
                $_SESSION['reload_state'] = "";
                $_SESSION['status'] = "failed";
                $_SESSION['msg'] = "Client Update Failed";
                header('location: /firebase/edit.php');
            }
        } elseif (isset($act)) {
            if ($act == 'deact') {
            
             $postOnlineData =[
                'status' => '1',
                'last_update' => $today,
                'last_updater' => $appUser
            ];
            $refTarget = "dehims_clients/".$id;
            $sender = $database->getReference($refTarget)->update($postOnlineData);
            $id="";
            if ($sender) {
                $_SESSION['reload_state'] = "disable";
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Client Updated Successfully";
                header('location: /firebase/');
            }else {
                $_SESSION['reload_state'] = "";
                $_SESSION['status'] = "failed";
                $_SESSION['msg'] = "Client Update Failed";
                header('location: /firebase/edit.php');
            }
            }
        }
        else {
            
            $_SESSION['reload_state'] = "";
            $_SESSION['status'] = "failed";
            $_SESSION['err_msg'] = "Error code: SHCO232 - No request identified";
            header('location: /firebase/');
            exit;
                                    

        }
    } 
    catch (\Throwable $th) {
                if (isset($_SESSION['internet_acess'])) {
                    # code...
                ?>
                    <tr>
                    <td colspan="7"><center><h1 class='alert alert-danger'><?php echo($_SESSION['internet_acess']); unset($_SESSION['internet_acess']);?></h1></center></td>
                    </tr>
                
                <?php
                }
    }


?>
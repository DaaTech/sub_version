<?php
    require_once('includes/header.php');

    require_once('includes/navbar.php');
    session_start();

?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <a href="/firebase/" class="btn btn-danger float-end">Back</a> &ThickSpace;
                            DeHiMS - Update Customer Details
                        </h4>
                <?php

                if (isset($_SESSION['status'])) {
                    if (isset($_SESSION['msg']) && $_SESSION['status']=='success') {
                    echo("<h5 class='alert alert-success'>".$_SESSION['msg']."</h5>");
                    unset($_SESSION['status']);
                    unset($_SESSION['msg']);
                    }
                    elseif (isset($_SESSION['msg']) && $_SESSION['status']=='failed') { 
                        echo("<h5 class='alert alert-warning'>".$_SESSION['err_msg']."</h5>");
                        unset($_SESSION['status']);
                        unset($_SESSION['err_msg']);
                    }
                
                }
                ?>
                    </div>
                       <form action="code.php" method="POST">
                    <div class="card-body" style="height: 30rem; overflow: auto;">
                        <?php
                                try {
                                    //code...
                                
                                    require_once('dbcon.php');
                                    unset($_SESSION['target']);  #REMOVE ANY EXISTING CLIENT ID BEFORE SETTING ANOTHER.
                                    $today = date("Y-m-d h:i:s");
                                    $appUser = "Dev Test";
                                    extract($_GET);
                                    if (isset($id)) {
                                        $refTarget = "dehims_clients";
                                        $sender = $database->getReference($refTarget)->getChild($id)->getValue();
                                        if ($sender) {
                                            $_SESSION['target'] = $id;
                                        ?>
                
                                <h6 class="alert alert-primary">HEALTH FACILITY CONTACT PERSON</h6>
                                 

                                        <div class="form-group mb-3">
                                            <label for="txt_sName">Surname</label>
                                            <input required type="text" name="sName" value="<?= $sender['surname'];?>" id="txt_sName"class="form-control" placeholder="Surname">
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="txt_oName">Other Names</label>
                                            <input required type="text" name="oName" value="<?= $sender['otherNames'];?>" id="txt_oName"class="form-control" placeholder="Other Names">
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="txt_phone">Phone Number</label>
                                            <input required type="number" name="phone" value="<?= $sender['phone'];?>"  id="txt_phone"class="form-control" placeholder="Phone Number">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="txt_email">Email</label>
                                            <input required type="email" name="email" value="<?= $sender['email'];?>"  id="txt_email"class="form-control" placeholder="Email">
                                        </div>
                                        <h6 class="alert alert-primary">HEALTH FACILITY DETAILS</h6>

                                            <div class="form-group mb-3">
                                                <label for="txt_fName">Health Facility Name</label>
                                                <input required type="text" value="<?= $sender['facility'];?>" name="fName" id="txt_fName"class="form-control" placeholder="Facility Name">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="txt_fType">Health Facility Type</label>
                                                
                                                <select required name="fType" id="txt_fType" class="form-control custom-select-lg">
                                                    <option value="">--select--</option>
                                                    <?php
                                                    switch ($sender['type']) {
                                                        case '1':
                                                            ?>
                                                            <option selected="selected" value="1">Clinic</option>
                                                            <option value="2">Health Centre</option>
                                                            <option value="3">Hospital</option>
                                                             <?php
                                                            break;
                                                        case '2':
                                                            ?>
                                                            <option value="1">Clinic</option>
                                                            <option selected="selected" value="2">Health Centre</option>
                                                            <option value="3">Hospital</option>
                                                             <?php
                                                            break;
                                                        case '3':
                                                            ?>
                                                            <option value="1">Clinic</option>
                                                            <option value="2">Health Centre</option>
                                                            <option selected="selected" value="3">Hospital</option>
                                                             <?php
                                                            break;
                                                        
                                                        default:
                                                            ?>
                                                            <option value="1">Clinic</option>
                                                            <option value="2">Health Centre</option>
                                                            <option value="3">Hospital</option>
                                                             <?php
                                                            break;
                                                    }
                                                    ?>

                                                </select>

                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="txt_fOwner">Health Facility Ownership</label>
                                                <select required name="fOwner" id="txt_fOwner" class="form-control custom-select-lg">
                                                    <option value="">--select--</option>
                                                 <?php
                                                    switch ($sender['ownership']) {
                                                        case '1':
                                                            ?>
                                                            <option selected="selected" value="1">Public</option>
                                                            <option value="2">Private</option>
                                                            <option value="3">Qausi</option>
                                                             <?php
                                                            break;
                                                        case '2':
                                                            ?>
                                                            <option value="1">Public</option>
                                                            <option selected="selected" value="2">Private</option>
                                                            <option value="3">Qausi</option>
                                                             <?php
                                                            break;
                                                        case '3':
                                                            ?>
                                                            <option value="1">Public</option>
                                                            <option value="2">Private</option>
                                                            <option selected="selected" value="3">Qausi</option>
                                                             <?php
                                                            break;
                                                        
                                                        default:
                                                            ?>
                                                            <option value="1">Public</option>
                                                            <option value="2">Private</option>
                                                            <option value="3">Qausi</option>
                                                             <?php
                                                            break;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h6 class="alert alert-primary">GEOGRAPHYCAL LOCATION</h6>
                                            
                                            <div class="form-group mb-3">
                                                <label for="txt_fRegion">Region</label>
                                                <input required type="text" value="<?= $sender['region'];?>" name="fRegion" id="txt_fRegion"class="form-control" placeholder="Region/Province">
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="txt_fDistrict">District</label>
                                                <input required type="text" value="<?= $sender['district'];?>" name="fDistrict" id="txt_fDistrict"class="form-control" placeholder="District">
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="txt_fTown">Town</label>
                                                <input required type="text" value="<?= $sender['town'];?>" name="fTown" id="txt_fTown"class="form-control" placeholder="Town/locality">
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="txt_fLandmarks">Landmarks</label>
                                                <input required type="text" value="<?= $sender['landmarks'];?>" name="fLandmarks" id="txt_fLandmarks"class="form-control" placeholder="Landmarks">
                                            </div>
                                            <h6 class="alert alert-primary">GEOGRAPHYCAL COORDINATES</h6>

                                        <div class="row"> <!-- Educational Level and Marital Status Row -->

                                        <div class="col-md-3">


                                        <div class="form-group row" title="Input the GPS Latitudes of the facility">
                                        <!-- title="The highers educational level reached, Even if not completed. Mandatory field" -->
                                        <label style="justify-content: flex-end; " for="txt_fLandmarks" class="col-sm-5 col-form-label text-right" >Latitude</label>
                                        <div class="col-sm-7">
                                        <input required type="text" value="<?= $sender['latitude'];?>" name="fLat" id="txt_fLandmarks"class="form-control" placeholder="Latitude">
                                        </div>
                                        </div>




                                        </div>

                                        <div class="col-md-3" >
                                        <div class="form-group row" title="Input the GPS longitude of the facility">
                                        <label  style="justify-content: flex-end;" title="Input the GPS Longitude of the facility"  for="txt_fLong" class="col-sm-5 col-form-label text-right">Longitude</label>
                                        <div class="col-sm-7">
                                        <input required type="text" value="<?= $sender['longitude'];?>" name="fLong" id="txt_fLong"class="form-control" placeholder="Longitude">

                                        </div>
                                        </div>


                                        </div>

                                        </div> <!-- End of Educational Level and Marital Status Row -->
                                            
                                            <div class="form-group mb-3">
                                                <label for="txt_remarks">REMARKS</label>
                                                <textarea class="form-control custom-select-lg" name="remarks" id="txt_remarks" > <?= $sender['remarks'];?></textarea>
                                            </div>

                                        
                                        <?php
                                        }else {
                                            $_SESSION['status'] = "failed";
                                            $_SESSION['err_msg'] = "Unknown user";
                                            header('location: /firebase/');
                                        }
                                    }

                                    else {            
                                        $_SESSION['status'] = "failed";                    
                                        $_SESSION['err_msg'] = "Error code: E8X7ISSD";
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
                        
                    </div>
                    <div class="card-footer">

                                <div class="form-group mb-3">
                                    <button type="submit" name="edit_client" class="btn btn-success">Update Customer</button>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
    
    require_once('includes/footer.php');

?>
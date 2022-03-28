<?php
    require_once('includes/header.php');

    require_once('includes/navbar.php');

?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="height: 3rem;">
                        <h4>
                            <a href="/firebase/" class="btn btn-danger float-end" style="margin: 1px 1px; padding: 1px 1px;">Back</a> &ThickSpace;
                            DeHiMS Add Customer
                        </h4>
                    </div>
                    <div class="card-body" style="height: 30rem; overflow: auto;">
                        
                            <form action="code.php" method="POST">

                                <h6 class="alert alert-primary">HEALTH FACILITY CONTACT PERSON</h6>
                                <div class="form-group mb-3">
                                    <label for="txt_sName">Surname</label>
                                    <input required type="text" name="sName" id="txt_sName"class="form-control" placeholder="Surname">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="txt_oName">Other Names</label>
                                    <input required type="text" name="oName" id="txt_oName"class="form-control" placeholder="Other Names">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="txt_phone">Phone Number</label>
                                    <input required type="number" name="phone" id="txt_phone"class="form-control" placeholder="Phone Number">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="txt_email">Email</label>
                                    <input required type="email" name="email" id="txt_email"class="form-control" placeholder="Email">
                                </div>

                                <h6 class="alert alert-primary">HEALTH FACILITY DETAILS</h6>

                                <div class="form-group mb-3">
                                    <label for="txt_fName">Health Facility Name</label>
                                    <input required type="text" name="fName" id="txt_fName"class="form-control" placeholder="Facility Name">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="txt_fType">Health Facility Type</label>
                                    
                                    <select required name="fType" id="txt_fType" class="form-control custom-select-lg">
                                        <option value="">--select--</option>
                                        <option value="1">Clinic</option>
                                        <option value="2">Health Centre</option>
                                        <option value="3">Hospital</option>
                                    </select>

                                </div>

                                <div class="form-group mb-3">
                                    <label for="txt_fOwner">Health Facility Ownership</label>
                                    <select required name="fOwner" id="txt_fOwner" class="form-control custom-select-lg">
                                        <option value="">--select--</option>
                                        <option value="1">Public</option>
                                        <option value="2">Private</option>
                                        <option value="3">Qausi</option>
                                    </select>
                                </div>
                                <h6 class="alert alert-primary">GEOGRAPHYCAL LOCATION</h6>
                                
                                <div class="form-group mb-3">
                                    <label for="txt_fRegion">Region</label>
                                    <input required type="text" name="fRegion" id="txt_fRegion"class="form-control" placeholder="Region/Province">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="txt_fDistrict">District</label>
                                     <input required type="fDistrict" name="fRegion" id="txt_fDistrict"class="form-control" placeholder="District">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="txt_fTown">Town</label>
                                    <input required type="text" name="fTown" id="txt_fTown"class="form-control" placeholder="Town/locality">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="txt_fLandmarks">Landmarks</label>
                                    <input required type="text" name="fLandmarks" id="txt_fLandmarks"class="form-control" placeholder="Landmarks">
                                </div>
                                <h6 class="alert alert-primary">GEOGRAPHYCAL COORDINATES</h6>

<div class="row"> <!-- Educational Level and Marital Status Row -->

<div class="col-md-3">

  
    <div class="form-group row" title="Input the GPS Latitudes of the facility">
      <!-- title="The highers educational level reached, Even if not completed. Mandatory field" -->
      <label style="justify-content: flex-end; " for="txt_fLandmarks" class="col-sm-5 col-form-label text-right" >Latitude</label>
      <div class="col-sm-7">
        <input required type="text" name="fLat" id="txt_fLat"class="form-control" placeholder="Latitude">
      </div>
    </div>
  
 


</div>

<div class="col-md-3" >
  <div class="form-group row" title="Input the GPS longitude of the facility">
    <label  style="justify-content: flex-end;" title="Input the GPS Longitude of the facility"  for="txt_fLong" class="col-sm-5 col-form-label text-right">Longitude</label>
    <div class="col-sm-7">
        <input required type="text" name="fLong" id="txt_fLong"class="form-control" placeholder="Longitude">
  
    </div>
  </div>


</div>

</div> <!-- End of Educational Level and Marital Status Row -->
                                
                                <div class="form-group mb-3">
                                    <label for="txt_remarks">REMARKS</label>
                                    <textarea class="form-control custom-select-lg" name="remarks" id="txt_remarks" ></textarea>
                                </div>

                                <hr>
                                <div class="form-group mb-5">
                                    <button type="submit" name="add_client" class="btn btn-success">Save Customer</button>
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
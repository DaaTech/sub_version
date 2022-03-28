<?php
 
    require_once('includes/header.php');

    require_once('includes/navbar.php');

?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                session_start();
                if (isset($_SESSION['status'])) {
                    if (isset($_SESSION['msg']) && $_SESSION['status']=='success') {
                    echo("<h5 class='alert alert-success'>".$_SESSION['msg']."</h5>");
                    unset($_SESSION['status']);
                    unset($_SESSION['msg']);
                    }
                    elseif (isset($_SESSION['msg']) && $_SESSION['status']=='failed') { 
                        echo("<h5 class='alert alert-warning'>".$_SESSION['err_msg']."</h5>");
                        unset($_SESSION['status']);
                        unset($_SESSION['msg']);
                    }
                
                }
                ?>
                <div class="card" id="cardBody">
                    <div class="card-header">
                        <h4>
                            DeHiMS CLIENTS MANAGER
                            <a href="add-user.php" id="cmdAddClient" class="btn btn-primary float-end">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-tripped table-bordered id='example'">
                            <thead>
                                <tr>
                                    <th>SERIAL</th>
                                    <th>SURNAME</th>
                                    <th>OTHER NAMES</th>
                                    <th>PHONE NUMBER</th>
                                    <th>EMAIL ADDRESS</th>
                                    <th>PROVIDER</th>
                                    <th>ACTION</th>
                                    
                                </tr>
                            </thead>
                            
                            
                            <tbody>
                                <?php
                                try {
                                    require_once("dbcon.php");
                                    $refTarget = "dehims_clients";
                                    $getter = $database->getReference($refTarget)->getValue();
                                    $setSerial = 1;
                                    
                                    if ($getter > 0) { 
                                        
                                        foreach ($getter as $key => $customer) {
                                           $id = str_split($key,2);
                                           $thidId = implode("-~", $id);
                                            $deleteAction = '<button type="button" class="btn btn-danger de-user" data-target="'.$key.'" title="Click to Delete client"><i class="fa fa-trush"></i>Delete</button>';
                                            $editAction = '&ThinSpace;<a href="edit.php?id='.$key.'" class="btn btn-success ed-user" title="Click to edit client\'s details"><i class="fa fa-pencil"></i>Edit</a>';
                                            $activate = '<a  href="code.php?id='.$key.'" class="btn btn-primary act-user" title="Click to Re-activate client for service"><i class="fa fa-edit"></i>Activate</a>';
                                                
                                        ?>
                                        
                                        <tr>
                                        <td><?= $customer['surname'];?></td>
                                        <td><?= $customer['otherNames'];?></td>
                                        <td><?= $customer['phone'];?></td>
                                        <td><?= $customer['email'];?></td>
                                        <td><?= $customer['timestamp'];?></td>
                                        <td><?= $customer['Created_By'];?></td>
                                        <td><?= $action = ($customer['status'] == "") ? $deleteAction .  $editAction : $activate; ?></td>
                                        </tr>
                                    <?php   
                                        } #END OF FOREACH LOOP
                                         }else { ?>
                                        <tr>
                                        <td colspan="7">No Customer Found</td>
                                        </tr>
                                    <?php
                                    }
                                
                                    //code...
                                } catch (\Throwable $th) {
                                    if (isset($_SESSION['internet_acess'])) {
                                        # code...
                                    ?>
                                        <tr>
                                        <td colspan="7"><center><h1 class='alert alert-danger'><?php echo($_SESSION['internet_acess']); unset($_SESSION['internet_acess']);?></h1></center></td>
                                        </tr>
                                     <script src="/firebase/includes/jsFiles/jquery-3.3.1.js"></script>
                                    <script type="text/javaScript">
                                        $(function() {
                                         $("cmdAddClient").hide();
                                        //   alert("Poor Network");
                                        })
                                    </script>
                                    <?php
                                    }
                                }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
                
  
    
   
            </div>
        </div>
    </div>


<?php
    
    require_once('includes/footer.php');

?>
     <script type="text/javascript">

        $(function(){
        $(".de-user").on("click", function () {
            
     Swal.fire({
        title: 'Deleting Client',
        html: "",
        icon: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'No, Cancel',
        confirmButtonText: 'Yes, Delete'
      }).then((result) => {
            $.ajax({
                          url:  '/firebase/code.php',
                          data: {
                              act: 'deact',
                              id: $(this).attr("data-target")
                          },
                          method: "post",
                          success: function(data) {
                            data = $.parseJSON(data);
                            if (data.status == "success") {
                            
                            } else if (data.status == "fail") {
                             
                            }

                          },
                          fail: function(data) {
                            
                          }
                        });
            });

            var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [ 'copy', 'print', 'excel', 'csv', 'pdf', 'colvis' ]
            } );

            table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        });


        });
     </script>
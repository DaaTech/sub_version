
<script>
   
   
    function checkInternet() {
         fetch("https://static-global-s-msn-com.akamaized.net/hp-neu/sc/2b/a5ea21.ico?d="+Date.now())
                    .then(response => {
                    // Check if the response is successful
                        if (!response.ok)
                        throw new Error("Network response was not ok");

                    // At this point we can safely say the user has connection to the internet
                            console.log("Internet available"); 
                    })
                    .catch(error => {
                    // The resource could not be reached
                            // alert("No Internet Connection");
                            console.log("No Internet connection", error);
                            document.getElementsByClassName('card').innerHTML = "<center><h1 class='alert alert-success'>No Internet Connection</h1></center><?php @session_start(); $_SESSION['internet_acess'] = "No Internet Connection"?>";
                            
                            
                    });

    }checkInternet();
</script>
<?php
session_start();
$_SESSION = [];
session_destroy();
echo '<script>
    localStorage.removeItem("loggedin");
     localStorage.removeItem("username");
    window.location.href = "login.php";
</script>';
exit();

?>
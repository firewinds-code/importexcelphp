<?php 
include 'connection.php';
include 'header.php';

?>
<?php
if (isset($_POST['import'])) {
    $filename = $_FILES['file']['name'];
    //echo $filename;
    //die;
    $filetmp = $_FILES['file']['tmp_name'];
    //echo $filetmp;
    // die;
    if ($_FILES['file']['name']) {
        $filename = explode(".", $_FILES['file']['name']);
        //print_r($filename);
        //die;
        $handle = fopen($_FILES['file']['tmp_name'], 'r');
         //echo $handle;
        // die;
        while ($data = fgetcsv($handle)) 
        {
            $name = mysqli_real_escape_string($conn, $data[0]);
            $email = mysqli_real_escape_string($conn, $data[1]);
            $phone = mysqli_real_escape_string($conn, $data[2]);
            $type = mysqli_real_escape_string($conn, $data[3]);

            $sql = "INSERT INTO `ekta`.`data`(`name`,`email`,`phone`,`type`)
                values('" . $name . "','" . $email . "', '" . $phone . "','" . $type . "')";
                
            $result = mysqli_query($conn, $sql);
          
        }
        fclose($handle);
        if ($result) 
        {
            echo "<div class='alert alert-success' role='alert'>
            <h4 class='alert-heading'>Well done!</h4>
            <hr>
            <p> Data Uploaded Successfully </p>
            </div>";
            die;
        } 
        else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed</strong>  ' . mysqli_error($conn) . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
}
?>
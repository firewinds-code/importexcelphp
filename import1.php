<?php include("connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for errors during file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Specify the directory to save the uploaded file
        $uploadDir = 'uploads/';

        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique name for the file to avoid conflicts
        $fileName = uniqid('excel_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // File upload successful

            // Parse the Excel file
            $excelData = parseExcelFile($filePath);
            if ($excelData !== false) {
                // Display the Excel data
                echo '<pre>';
                print_r($excelData);
                echo '</pre>';
            } else {
                // Error in parsing the Excel file
                echo 'Error parsing the Excel file.';
            }
        } else {
            // Error in moving the file
            echo 'Error uploading file. Please try again.';
        }
    } else {
        // Error during file upload
        echo 'Error: ' . $file['error'];
    }
}

/**
 * Parse an Excel file and retrieve the data.
 * @param string $filePath The path to the Excel file.
 * @return array|false The parsed Excel data as an array, or false on failure.
 */
function parseExcelFile($filePath)
{
    $excelData = [];

    // Open the Excel file
    $handle = fopen($filePath, 'r');
    if ($handle !== false) {
        // Loop through each row in the Excel file
        while (($row = fgetcsv($handle)) !== false) {
            $excelData[] = $row;
        }

        // Close the Excel file
        fclose($handle);

        return $excelData;
    }

    return false;
}
if (isset($_POST['import'])) 
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

//sql query to be executed for inserting data
                        $sql = "INSERT INTO `ekta`.`data`
                            (`name`,`email`,
                            `phone`,
                            `type`)
                            VALUES('$name','$email','$phone','$type')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            //echo "Data inserted";
                            $insert = true;
                        } else {
                            echo "Error in insertion" . mysqli_error($conn);
                        }
                        if ($insert) {
                            echo "<div class='alert alert-success' role='alert'>
                                <h4 class='alert-heading'>Well done!</h4><hr>
                                <p> Data Uploaded in Database....! </p>
                                </div>";
                        }
}
?>
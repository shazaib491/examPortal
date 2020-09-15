<?php require 'database.php';


if (isset($_REQUEST["file"])) {
    // Get parameters
    $ext = explode(".", $_REQUEST['file']); // explode filename by "."
$extension = $ext[1]; // get extension.
    if ($extension == "jpg" || $extension == "png") {
        $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string

        /* Test whether the file name contains illegal characters
        such as "../" using the regular expression */
        if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)) {
            $filepath = "questions/" . $file;

            // Process download
            if (file_exists($filepath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));
                flush(); // Flush system output buffer
                readfile($filepath);
                die();
            } else {
                http_response_code(404);
                die();
            }
        } else {
            die("Invalid file name!");
        }
    } elseif ($extension == 'pdf') {
        $file = "questions/" . $_REQUEST["file"];

        // We will be outputting a PDF
        header('Content-Type: application/pdf');

        header("Content-Disposition: attachment; filename=" . urlencode($file));
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: " . filesize($file));

        flush(); // This doesn't really matter.

        $fp = fopen($file, "r");
        while (!feof($fp)) {
            echo fread($fp, 65536);
            flush(); // This is essential for large downloads
        }

        fclose($fp);

        echo $imagepdf;
    }
}

<?php
$success = mail('manivannan23111996@gmail.com', 'My Subject', "mdgcv");
if (!$success) {
    $errorMessage = error_get_last()['message'];
    echo $errorMessage;
}else{
	echo "Sent";
}
?> 
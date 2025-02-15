<?php
// Hash and password for testing
$hashed_password = '$2y$10$iEWOzbNvcK5.iEqsOkI/YOEy22bf73azf9wwLtDQ/WW.UJJI6.dZS';
$password = 'user1301!#';

// Verify password
if (password_verify($password, $hashed_password)) {
    echo "Password is valid!";
} else {
    echo "Invalid password.";
}
?>

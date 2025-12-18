<?php
$hash = '$2y$10$FHL7iT7C3uPC/EcoqXnW8u3eMbAa6T/jYTKY1CTN3SxC3zp0GhZEq';
$password_input = "Terka17";

if (password_verify($password_input, $hash)) {
    echo "✔ PASSWORD BENAR";
} else {
    echo "✘ PASSWORD SALAH";
}
?>
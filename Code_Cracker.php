<?php
  
// Store a string into the variable to be Encrypted
$string = "a b c d e f g h i j k l m n o p q r s t u v w x y z";
  
// Display the original string
echo "Original String: " . $string. "<br>";
  
// Store the cipher method
$ciphering = "AES-128-CTR";
  
// The encryption key
$encryption_key = '£ * % & > < ! ) " ( @ a b c d e f g h i j k l m n o';
  
// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($string, $ciphering,
            $encryption_key);
  
// Display the encrypted string
echo "Encrypted String: " . $encryption . "<br>";
  
// The decryption key
$decryption_key = '£ * % & > < ! ) " ( @ a b c d e f g h i j k l m n o';
  
// Use openssl_decrypt() function to decrypt the data
$decryption=openssl_decrypt ($encryption, $ciphering, 
        $decryption_key);
  
// Display the decrypted string
echo "Decrypted String: " . $decryption;
  
?>
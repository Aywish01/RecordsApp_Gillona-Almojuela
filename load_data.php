<?php
require_once __DIR__ . '/vendor/autoload.php'; 

// Database connection
$conn = mysqli_connect("127.0.0.1", "root", "pass123", "recordsapp");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$faker = Faker\Factory::create('fil_PH'); // Create a Faker instance with Philippine Locale

// Generating and inserting fake data into the Employee table (200 rows)
for ($i = 0; $i < 200; $i++) {
    $lastName = $faker->lastName;
    $firstName = $faker->firstName;
    $office_id = rand(1, 50); 
    $address = $faker->address;

    $sql = "INSERT INTO Employee (id, lastname, firstname, office_id, address) 
            VALUES (NULL, '$lastName', '$firstName', $office_id, '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "Record $i inserted successfully into Employee table.<br>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Generating and inserting fake data into the Office table (50 rows)
for ($i = 0; $i < 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->email;
    $address = $faker->address;
    $city = $faker->city;
    $country = $faker->country;
    $postal = $faker->postcode;

    $sql = "INSERT INTO Office (id, name, contactnum, email, address, city, country, postal) 
            VALUES (NULL, '$name', '$contactnum', '$email', '$address', '$city', '$country', '$postal')";

    if (mysqli_query($conn, $sql)) {
        echo "Record $i inserted successfully into Office table.<br>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Generating and inserting fake data into the Transaction table (500 rows)
for ($i = 0; $i < 500; $i++) {
    $employee_id = rand(1, 200); 
    $office_id = rand(1, 50); 
    $datelog = $faker->dateTimeThisDecade('now', 'Asia/Palawan')->format('Y-m-d H:i:s');
    $action = $faker->randomElement(['IN', 'OUT', 'COMPLETE']);
    $remarks = $faker->sentence;
    $documentcode = $faker->numerify('DOC#####');

    $sql = "INSERT INTO Transaction (id, employee_id, office_id, datelog, action, remarks, documentcode) 
            VALUES (NULL, $employee_id, $office_id, '$datelog', '$action', '$remarks', '$documentcode')";

    if (mysqli_query($conn, $sql)) {
        echo "Record $i inserted successfully into Transaction table.<br>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

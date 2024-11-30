<?php
// Task 1: Data Retrieval
$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch API data
$response = file_get_contents($api_url);

// Check if the API call was successful
if ($response === FALSE) {
    die("Error retrieving data from API.");
}

// Decode JSON response
$data = json_decode($response, true);

// Extract records from the API response
$records = $data['records'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationality Data</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

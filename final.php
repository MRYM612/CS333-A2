<?php
$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    die("Error retrieving data from API: " . curl_error($ch));
}

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    die("API request failed with HTTP status code: $http_code");
}

$data = json_decode($response, true);
if ($data === null) {
    die("Failed to decode JSON: " . json_last_error_msg());
}

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
<body>
    <main class="container">
        <h1>UOB Student Nationality Data</h1>

        <?php if (count($records) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <?php 
                    // Access fields within the record
                    $fields = $record['record']['fields'] ?? []; 
                ?>
                <tr>
                    <td><?= htmlspecialchars($fields['academic_year'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($fields['semester'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($fields['the_programs'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($fields['nationality'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($fields['colleges'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($fields['students_count'] ?? 'N/A') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No data found.</p>
        <?php endif; ?>
    </main>
</body>
</html>

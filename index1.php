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
                    $fields = $record['fields'] ?? []; 
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
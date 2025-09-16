<?php
include "config/db.php";

$appID = $_GET['appID'] ?? '';
$appName = $_GET['appName'] ?? '';
$add_new = isset($_GET['add']);

// Add functionality
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save_new'])) {
    $role = $_POST['RoleName'];
    $resID = $_POST['ResourceID'];
    $resName = $_POST['ResourceName'];
    $rate = floatval($_POST['Rate']);
    $grade = $_POST['Grade'];

    // Ensure Role exists
    $stmt = $conn->prepare("SELECT RoleName FROM Role WHERE RoleName = ?");
    $stmt->bind_param("s", $role);
    $stmt->execute();
    if (!$stmt->fetch()) {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO Role (RoleName, Rate) VALUES (?, ?)");
        $stmt->bind_param("sd", $role, $rate);
        $stmt->execute();
    }
    $stmt->close();

    // Ensure Resource exists
    $stmt = $conn->prepare("SELECT ResourceID FROM Resource WHERE ResourceID = ?");
    $stmt->bind_param("i", $resID);
    $stmt->execute();
    if (!$stmt->fetch()) {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO Resource (ResourceID, ResourceName) VALUES (?, ?)");
        $stmt->bind_param("is", $resID, $resName);
        $stmt->execute();
    }
    $stmt->close();

    // Calculate efforts
    $totalEffort = 0;
    $dateEfforts = [];
    foreach ($_POST as $key => $val) {
        if (strpos($key, 'date_') === 0) {
            $col = substr($key, 5);
            $effort = floatval($val);
            $dateEfforts[$col] = $effort;
            $totalEffort += $effort;
        }
    }
    $totalEffort *= 5;
    $totalCost = $totalEffort * $rate;

    // Build query dynamically
    $columns = "ApplicationID, ApplicationName, ResourceID, ResourceName, RoleName, Grade, TotalEffort, Rate, TotalCost";
    $values = "'$appID', '$appName', '$resID', '$resName', '$role', '$grade', '$totalEffort', '$rate', '$totalCost'";

    foreach ($dateEfforts as $col => $val) {
        $columns .= ", `$col`";
        $values .= ", '$val'";
    }

    $conn->query("INSERT INTO master ($columns) VALUES ($values)");

    header("Location: application_view.php?appID=" . urlencode($appID) . "&appName=" . urlencode($appName));
    exit();
}

// Fetch weekly effort columns
$colsResult = $conn->query("SHOW COLUMNS FROM master");
$monday_columns = [];
while ($col = $colsResult->fetch_assoc()) {
    if (preg_match('/^\d{Ymd}$/', $col['Field'])) {
        $monday_columns[] = $col['Field'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Application View</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: center; }
        .button-add { background: green; color: white; padding: 5px 10px; border: none; }
        .button-cancel { background: red; color: white; padding: 5px 10px; border: none; }
    </style>
</head>
<body>
    <h2>Application: <?= htmlspecialchars($appName) ?> (ID: <?= htmlspecialchars($appID) ?>)</h2>

    <a href="application_view.php?appID=<?= urlencode($appID) ?>&appName=<?= urlencode($appName) ?>&add=1">
        <button class="button-add">Add New Row</button>
    </a>
    <br><br>

    <table>
        <tr>
            <th>RoleName</th>
            <?php foreach ($monday_columns as $week): ?>
                <th><?= htmlspecialchars($week) ?></th>
            <?php endforeach; ?>
            <th>TotalEffort</th>
            <th>Rate</th>
            <th>TotalCost</th>
            <th>ResourceID</th>
            <th>ResourceName</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>

        <?php if ($add_new): ?>
        <form method="post" id="addRowForm"><tr>
            <td><input type="text" name="RoleName" id="addRoleName" required 
                       onblur="fetchDetails('role', this.value, 'rateInput')"></td>

            <?php foreach ($monday_columns as $week): ?>
                <td><input type="number" step="0.01" name="date_<?= $week ?>" 
                           class="effort-input" oninput="calculateEffortAndCost()" value="0"></td>
            <?php endforeach; ?>

            <td><input type="number" step="0.01" name="TotalEffort" id="totalEffort" value="0" readonly></td>
            <td><input type="number" step="0.01" name="Rate" id="rateInput" oninput="calculateEffortAndCost()" required></td>
            <td><input type="number" step="0.01" name="TotalCost" id="totalCost" value="0" readonly></td>
            <td><input type="text" name="ResourceID" id="resourceID" required 
                       onblur="fetchDetails('resource', this.value, 'resourceName')"></td>
            <td><input type="text" name="ResourceName" id="resourceName" required></td>
            <td>
                <select name="Grade" required>
                    <option value="">--Select--</option>
                    <option value="PM">PM</option>
                    <option value="PAT">PAT</option>
                    <option value="PA">PA</option>
                    <option value="A">A</option>
                </select>
            </td>
            <td>
                <button type="submit" name="save_new">Save</button>
                <button type="button" class="button-cancel" 
                        onclick="window.location='application_view.php?appID=<?= urlencode($appID) ?>&appName=<?= urlencode($appName) ?>'">
                        Cancel
                </button>
            </td>
        </tr></form>
        <?php endif; ?>

        <!-- Existing rows -->
        <?php
        $result = $conn->query("SELECT * FROM master WHERE ApplicationID='$appID'");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['RoleName']) ?></td>
            <?php foreach ($monday_columns as $week): ?>
                <td><?= htmlspecialchars($row[$week] ?? 0) ?></td>
            <?php endforeach; ?>
            <td><?= htmlspecialchars($row['TotalEffort']) ?></td>
            <td><?= htmlspecialchars($row['Rate']) ?></td>
            <td><?= htmlspecialchars($row['TotalCost']) ?></td>
            <td><?= htmlspecialchars($row['ResourceID']) ?></td>
            <td><?= htmlspecialchars($row['ResourceName']) ?></td>
            <td><?= htmlspecialchars($row['Grade']) ?></td>
            <td>--</td>
        </tr>
        <?php endwhile; ?>
    </table>

    <script>
    function calculateEffortAndCost() {
        let inputs = document.querySelectorAll('.effort-input');
        let total = 0;
        inputs.forEach(input => {
            let val = parseFloat(input.value);
            if (!isNaN(val)) total += val;
        });

        total = total * 5;
        document.getElementById('totalEffort').value = total.toFixed(2);

        let rate = parseFloat(document.getElementById('rateInput').value);
        if (!isNaN(rate)) {
            document.getElementById('totalCost').value = (total * rate).toFixed(2);
        }
    }

    function fetchDetails(type, value, targetId) {
        if (value === '') return;
        let url = `fetch_details.php?type=${type}&${type === 'role' ? 'name' : 'id'}=${encodeURIComponent(value)}`;
        fetch(url)
            .then(res => res.text())
            .then(data => {
                document.getElementById(targetId).value = data.trim();
                if (targetId === 'rateInput') calculateEffortAndCost();
            });
    }
    </script>
</body>
</html>

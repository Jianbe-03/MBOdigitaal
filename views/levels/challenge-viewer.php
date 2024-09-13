<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbconnection.php';

// Query to get all levels with associated deliverable IDs
$sql = "SELECT id, educationId, level, subject, description, deliverables FROM levels";
$stmt = $db->prepare($sql);
$stmt->execute();
$levels = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='mt-6 mb-16 w-11/12 p-6 space-y-8 sm:p-8 bg-white mx-auto'> 
    <h2 class='text-2xl font-bold dark:text-black'>Levels</h2>
    <p class='my-4 font-bold text-gray-700'>Hieronder staan alle levels en hun bijhorende informatie</p>";

// Loop through each level
foreach ($levels as $level) {
    // Extract deliverable IDs
    $deliverableIds = explode(',', $level['deliverables']);
    
    // Get deliverables from the database
    $inQuery = implode(',', array_fill(0, count($deliverableIds), '?')); // prepare placeholders
    $deliverablesStmt = $db->prepare("SELECT id, DeliverableName, DeliverableDesc FROM deliverables WHERE id IN ($inQuery)");
    $deliverablesStmt->execute($deliverableIds);
    $deliverables = $deliverablesStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Display level information and create a button for each level
    echo "<div class='level'>
            <h3 class='text-xl font-semibold text-gray-800'>Level: {$level['level']}</h3>
            <p>{$level['description']}</p>
            <button class='toggle-deliverables' data-level-id='{$level['id']}'>View Deliverables</button>
            <ul id='deliverables-{$level['id']}' class='hidden'>";
    
    // Display deliverables for the level
    foreach ($deliverables as $deliverable) {
        echo "<li>
                <button class='toggle-description' data-deliverable-id='{$deliverable['id']}'>{$deliverable['DeliverableName']}</button>
                <p id='description-{$deliverable['id']}' class='deliverable-description hidden'>{$deliverable['DeliverableDesc']}</p>
              </li>";
    }

    echo "</ul></div>";
}

echo "</div>";
?>
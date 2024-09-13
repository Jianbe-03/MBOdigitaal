<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbconnection.php';

// Query om alle levels met bijbehorende deliverable-ID's op te halen
$sql = "SELECT id, educationId, level, subject, description, deliverables FROM levels";
$stmt = $db->prepare($sql);
$stmt->execute();
$levels = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='mt-6 mb-16 w-11/12 p-6 space-y-8 sm:p-8 bg-white mx-auto'> 
    <h2 class='text-2xl font-bold dark:text-black'>Levels</h2>
    <p class='my-4 font-bold text-gray-700'>Hieronder staan alle levels en hun bijhorende informatie</p>";

// Loop door elk level
foreach ($levels as $level) {
    // Haal de deliverable-ID's uit elkaar
    $deliverableIds = explode(',', $level['deliverables']);
    
    // Query om deliverables uit de database op te halen
    $inQuery = implode(',', array_fill(0, count($deliverableIds), '?')); // voorbereiden van placeholders
    $deliverablesStmt = $db->prepare("SELECT id, DeliverableName, DeliverableDesc FROM deliverables WHERE id IN ($inQuery)");
    $deliverablesStmt->execute($deliverableIds); // Uitvoeren van de query met de deliverable-ID's
    $deliverables = $deliverablesStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Toon de level-informatie en maak een knop voor elk level
    echo "<div class='level'>
            <h3 class='text-xl font-semibold text-gray-800'>Level: {$level['level']}</h3>
            <p>{$level['description']}</p>
            <button class='toggle-deliverables' data-level-id='{$level['id']}'>Bekijk Deliverables</button>
            <ul id='deliverables-{$level['id']}' class='hidden'>";
    
    // Toon de deliverables voor het huidige level
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
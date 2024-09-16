<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbconnection.php';

// Query om alle levels met bijbehorende deliverable-ID's op te halen
$sql = "SELECT id, educationId, level, subject, description, deliverables FROM levels ORDER BY level ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
$levels = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='mt-6 mb-16 w-11/12 p-6 space-y-8 sm:p-8 bg-gray-100 shadow-lg rounded-lg mx-auto'> 
    <h2 class='text-3xl font-bold text-gray-800 mb-4'>Levels</h2>
    <p class='my-4 text-lg font-semibold text-gray-600'>Hieronder staan alle levels en hun bijhorende informatie</p>";

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
    echo "<div class='bg-white shadow-md p-6 rounded-lg'>
            <h3 class='text-2xl font-semibold text-gray-700 mb-2'>Level: {$level['level']}</h3>
            <p class='text-gray-600 mb-4'>{$level['description']}</p>
            <button class='toggle-deliverables bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-500 transition' data-level-id='{$level['id']}'>Bekijk Deliverables</button>
            <ul id='deliverables-{$level['id']}' class='collapsible-content mt-4 space-y-2'>";
    
    // Toon de deliverables voor het huidige level
    foreach ($deliverables as $deliverable) {
        echo "<li class='bg-gray-50 p-4 rounded-lg'>
                <button class='toggle-description flex items-center justify-between w-full text-blue-600 font-semibold hover:underline' data-deliverable-id='{$deliverable['id']}'>
                    <span>{$deliverable['DeliverableName']}</span>
                    <img src='/images/dropdown.png' alt='dropdown image' class='ml-2 w-4 h-4 dropdown'>
                </button>
                <p id='description-{$deliverable['id']}' class='deliverable-description text-gray-600 mt-2 hidden'>{$deliverable['DeliverableDesc']}</p>
              </li>";
    }

    echo "</ul></div>";
}

echo "</div>";
?>
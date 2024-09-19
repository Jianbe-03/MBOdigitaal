<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/docroot.php';
require_once __DOCUMENTROOT__ . '/config/globalvars.php';
require_once __DOCUMENTROOT__ . '/errors/default.php';
require_once __DOCUMENTROOT__ . '/database/dbconnection.php';
require_once __DOCUMENTROOT__ . '/vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class Level
{
    // insert voegt één nieuw level toe aan de tabel levels.
    public static function insert(
        $educationId,
        $level,
        $subject,
        $description,
        $deliverables
    ) {
        global $db;

        $sql_insert_into_levels = "INSERT INTO levels (educationId, level, subject, description, deliverables)
        VALUES (?, ?, ?, ?, ?);";

        $stmt = $db->prepare($sql_insert_into_levels);

        if (
            $stmt->execute([
                $educationId,
            	$level,
                $subject,
                $description,
                $deliverables
            ])
        ) {
            return true;
        } else {
            return false;
        }
    }

    // select selecteert één level op basis van een gegeven id.
    // Er wordt een associative array ($level["id"]) van de opleiding gereturneerd.
    public static function select($id)
    {
        global $db;

        $sql_select_levels_by_id = "SELECT * FROM levels WHERE id=?;";

        $stmt = $db->prepare($sql_select_levels_by_id);

        if ($stmt->execute([$id])) {
            $levels = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($levels as $level) {
                return $level;
            }
        }
    }

    // selectAll selecteert alle levels geordend op level scending.
    // Er wordt een associative array met meerdere rijen gereturneerd.
    public static function selectAll()
    {
        global $db;

        $sql_selectAll_levels = "SELECT * FROM levels ORDER by level ASC;";

        $stmt = $db->prepare($sql_selectAll_levels);

        if ($stmt->execute()) {
            $levels = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $levels;
        }
    }

    // update werkt de informatie van een record van een bepaalde id bij.
    // De functie returneerd true als dit gelukt is en false als het niet
    // gelukt is.
    public static function update(
        $educationId,
        $level,
        $subject,
        $description,
        $deliverables
    ) {
        global $db;

        $sql_update_level_by_id = "UPDATE levels
        SET educationId=?, level=?, subject=?, description=?, deliverables=?
        WHERE id=?";

        $stmt = $db->prepare($sql_update_level_by_id);

        if (
            $stmt->execute([
                $educationId,
                $level,
                $subject,
                $description,
                $deliverables,
                $id
            ])
        ) {
            return true;
        } else {
            return false;
        }

    }

    // delete verwijdert een record uit de tabel levels met een bepaald id.
    // De functie returneert true als dit gelukt is en false als dit niet gelukt is.
    public static function delete($id)
    {
        global $db;

        $sql_delete_level_by_id = "DELETE FROM levels WHERE id=?;";
        $stmt = $db->prepare($sql_delete_level_by_id);
        if ($stmt->execute([$id])) {
            return true;
        } else {
            return false;
        }
    }

}
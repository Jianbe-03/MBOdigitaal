<!DOCTYPE html>
<html lang="nl">

<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/views/templates/head.php' ?>
</head>

<body class="bg-zinc-900">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/views/admin/templates/topbar.php' ?>
    <div class="mt-6 mx-auto px-4 bg-zinc-900">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/views/admin/templates/menu.php' ?>
        <div class="p-6 text-medium text-stone-50 rounded w-full min-h-screen">
            <h3 class="text-lg font-bold text-stone-100 text-white mb-2">Levels beheren</h3>
            <p class="mb-2 text-red-400">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </p>
            <table class="table-auto w-full bg-zinc-700 text-white">
                <thead>
                    <tr class="bg-zinc-800">
                        <th class="px-4 py-2 text-left">Delete</th>
                        <th class="px-4 py-2 text-left">opleiding Naam</th>
                        <th class="px-4 py-2 text-left">Level</th>
                        <th class="px-4 py-2 text-left">Beschrijving</th>
                        <th class="px-4 py-2 text-left">Deliverables ID's</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($levels as $level) {
                        ?>
                        <tr class="even:bg-zinc-700 odd:bg-zinc-900">
                            <td class="px-4 py-2">
                                <a href="/admin/levels/delete?id=<?php echo $level["id"]; ?>"
                                    onclick="return confirm('Weet je zeker dat je dit level wilt verwijderen?');">
                                    <img src=" /images/trash.svg" alt="Trash" />
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                <?php $education = Education::select($level["educationId"]); ?>
                                <a class="underline" href="/admin/educations/detail?id=<?php echo $education["id"]; ?>">
                                    <?php echo $education["name"]; ?>
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                <a class="underline" href="/admin/levels/detail?id=<?php echo $level["id"]; ?>">
                                    <?php echo $level["level"]; ?>
                                </a>
                            </td>
                            <td class="px-4 py-2"> <?php echo $level["description"]; ?></td>
                            <td class="px-4 py-2"> <?php echo $level["deliverables"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
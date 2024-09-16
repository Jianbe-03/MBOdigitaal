<!DOCTYPE html>
<html lang="nl">

<head>
    <?php require '../views/templates/head.php' ?>
</head>

<body>
    <?php require '../views/templates/menu.php' ?>
    <?php require 'level-viewer.php' ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle deliverables voor elk level
        const levelButtons = document.querySelectorAll('.toggle-deliverables');
        levelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const levelId = this.getAttribute('data-level-id');
                const deliverablesList = document.getElementById('deliverables-' + levelId);

                if (deliverablesList.classList.contains('show')) {
                    // Inklappen
                    deliverablesList.classList.remove('show');
                } else {
                    // Uitklappen
                    deliverablesList.classList.add('show');
                }
            });
        });

        // Toggle beschrijving voor elke deliverable en roteer de afbeelding
        const descriptionButtons = document.querySelectorAll('.toggle-description');
        descriptionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const deliverableId = this.getAttribute('data-deliverable-id');
                const description = document.getElementById('description-' + deliverableId);
                const dropdownImg = this.querySelector('img');

                if (description.classList.contains('hidden')) {
                    description.classList.remove('hidden');
                    description.classList.add('show');
                } else {
                    description.classList.remove('show');
                    description.classList.add('hidden');
                }
            
                // Toggle de rotatieklasse voor de dropdown-afbeelding
                dropdownImg.classList.toggle('rotate-180');
            });
        });
    });
    </script>

    <div class="mt-6 mb-16 w-11/12 p-6 space-y-8 sm:p-8 bg-white mx-auto">

        <h2 class="text-2xl font-bold dark:text-white">Levels</h2>
        <p class="my-4 font-bold text-gray-700">Hieronder staat het overzicht van die te maken hebben met het
            ontwikkelen van de levels binnen het systeem van mbogodigital.nl</p>

        <div class="w-full">
            <div class="flex border-b border-gray-300">
                <button
                    class="w-1/2 py-4 text-center font-medium text-gray-700 bg-gray-100 rounded-tl-lg focus:outline-none active:bg-gray-200"
                    onclick="openTab(event, 'tab1')">Case</button>
                <button
                    class="w-1/2 py-4 text-center font-medium text-gray-700 bg-gray-100 rounded-tl-lg focus:outline-none active:bg-gray-200"
                    onclick="openTab(event, 'tab2')">Challenge 13</button>
                <button
                    class="w-1/2 py-4 text-center font-medium text-gray-700 bg-gray-100 rounded-tr-lg focus:outline-none"
                    onclick="openTab(event, 'tab3')">Challenge 14</button>
                <button
                    class="w-1/2 py-4 text-center font-medium text-gray-700 bg-gray-100 rounded-tr-lg focus:outline-none"
                    onclick="openTab(event, 'tab4')">Challenge 15</button>
            </div>
            <div id="tab1" class="tabcontent p-4">
                <?php require 'challenges-tab1.inc.php' ?>
            </div>
            <div id="tab2" class="tabcontent p-4 hidden">
                <?php require 'challenges-tab2.inc.php' ?>
            </div>
            <div id="tab3" class="tabcontent p-4 hidden">
                <?php require 'challenges-tab3.inc.php' ?>
            </div>
            <div id="tab4" class="tabcontent p-4 hidden">
                <?php require 'challenges-tab4.inc.php' ?>
            </div>
        </div>

        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].classList.add("hidden");
                }
                tablinks = document.getElementsByTagName("button");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].classList.remove("active:bg-gray-200");
                }
                document.getElementById(tabName).classList.remove("hidden");
                evt.currentTarget.classList.add("active:bg-gray-200");
            }
        </script>



        <?php require '../views/templates/footer.php' ?>

    </div>


</body>

</html>
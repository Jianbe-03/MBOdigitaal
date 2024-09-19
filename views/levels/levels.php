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
    
        <?php require '../views/templates/footer.php' ?>

    </div>


</body>

</html>
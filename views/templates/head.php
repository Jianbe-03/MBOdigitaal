    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="icon" type="image/x-icon" href="/images/mbo.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .collapsible-content {
            overflow: hidden;
            opacity: 0;
            height: 0;
            transition: opacity 0.3s ease, height 0.3s ease;
        }

        .collapsible-content.show {
            opacity: 1;
            height: auto;
        }
        
        .dropdown {
            transition: transform 0.2s ease;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
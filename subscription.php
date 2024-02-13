<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Styles for the context menu */
        #context-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #context-menu li {
            padding: 8px 12px;
            list-style: none;
            cursor: pointer;
        }

        #context-menu li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<!-- Context menu structure -->
<ul id="context-menu">
    <li id="menu-item-1">Option 1</li>
    <li id="menu-item-2">Option 2</li>
    <li id="menu-item-3">Option 3</li>
</ul>

<!-- Sample element to trigger the context menu -->
<div id="context-trigger" style="width: 200px; height: 200px; background-color: #e0e0e0; padding: 20px;">
    Right-click me
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the context menu and the trigger element
        var contextMenu = document.getElementById('context-menu');
        var contextTrigger = document.getElementById('context-trigger');

        // Show the context menu
        function showContextMenu(x, y) {
            contextMenu.style.display = 'block';
            contextMenu.style.left = x + 'px';
            contextMenu.style.top = y + 'px';
        }

        // Hide the context menu
        function hideContextMenu() {
            contextMenu.style.display = 'none';
        }

        // Handle right-click on the trigger element
        contextTrigger.addEventListener('contextmenu', function (e) {
            e.preventDefault(); // Prevent the default context menu
            showContextMenu(e.clientX, e.clientY); // Show custom context menu
        });

        // Hide context menu on document click
        document.addEventListener('click', function () {
            hideContextMenu();
        });

        // Hide context menu on window resize
        window.addEventListener('resize', function () {
            hideContextMenu();
        });

        // Handle context menu item clicks
        contextMenu.addEventListener('click', function (e) {
            // You can customize this part based on which menu item was clicked
            switch (e.target.id) {
                case 'menu-item-1':
                    alert('Option 1 selected');
                    break;
                case 'menu-item-2':
                    alert('Option 2 selected');
                    break;
                case 'menu-item-3':
                    alert('Option 3 selected');
                    break;
            }
            hideContextMenu();
        });
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Style for the tabs */
        .tab {
            display: none;
        }

        /* Style for the active tab */
        .active-tab {
            display: block;
        }

        /* Style for the tab buttons */
        .tab-button {
            cursor: pointer;
            padding: 10px 20px;
            margin: 5px;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<!-- Tab buttons -->
<button class="tab-button" onclick="showTab('newYork')">New York</button>
<button class="tab-button" onclick="showTab('nairobi')">Nairobi</button>
<button class="tab-button" onclick="showTab('kremlin')">Kremlin</button>

<!-- Tab content -->
<div id="newYork" class="tab active-tab">This is New York.</div>
<div id="nairobi" class="tab">This is Nairobi.</div>
<div id="kremlin" class="tab">This is Kremlin.</div>

<script>
    function showTab(tabName) {
        // Hide all tabs
        var tabs = document.getElementsByClassName('tab');
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove('active-tab');
        }

        // Show the selected tab
        document.getElementById(tabName).classList.add('active-tab');
    }
</script>

</body>
</html>

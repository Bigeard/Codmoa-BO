<?php require "./header.php"; ?> 

<!-- <body> -->
    <a href="./requests.php" class="return">Return</a>
    <h1>Import Database</h1>

    <form id="import_file_form" action="../library/import.php" method="post" enctype="multipart/form-data" name="import">
        <label for="input_import_file">Select file format SQL / UTF8</label>
        <input type="file" name="import_file" id="input_import_file" accept=".sql">
        <input type="submit" name="submit" value="Import">
    </form>
</body>

</html>
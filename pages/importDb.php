<?php require "./header.php"; ?> 

<!-- <body> -->
    <a href="./requests.php" class="return">Return</a>
    <h1>Import Database</h1>

    <form id="import_file_form" action="../library/sql.php" method="post" enctype="multipart/form-data">
        <label for="input_import_file">Select file format SQL / UTF8</label>
        <input type="file" name="fileToUpload" id="input_import_file" accept=".sql">
        <input type="submit" name="import" value="Import">
    </form>
</body>

</html>
<?php require "./header.php"; ?> 

<!-- <body> -->
    <a href="./requests.php" class="return">Return</a>
    <h1>Import Database</h1>

    <form id="import_file_form" action="../library/sql.php" method="post" enctype="multipart/form-data">
        <label for="input_import_file">Select file format SQL / UTF8</label>
        <input type="file" name="fileToUpload" id="input_import_file" accept=".sql" required>
        <input type="submit" name="import" value="Import">
    </form>

    <?php if(isset($_GET['success'])) { ?>
        <?php if($_GET['success'] == 1) : ?>
            <p>SQL file imported successfully</p>
        <?php endif; ?>
    <?php } ?>

    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] == 1) : ?>
            <p>Problem in executing the SQL query</p>
        <?php endif; ?>
    <?php } ?>
</body>

</html>
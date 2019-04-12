<?php require "./header.php"; ?> 
    <a href="./requests.php" class="return" style="position:fixed;">Return</a>
    <h1>Add Table</h1>

    <form action="../library/processing.php" method="POST">
        <div class="form-wrapper">
            <label for="add_table_name">Name: </label>
            <input type="text" name="add_schema_name" id="add_schema_name" required>
        </div>
        <div class="form-wrapper">
            <input type="hidden" name="add_table_schema" id="add_table_schema" value="<?= $_GET['schema'] ?>">
        </div>
        <input type="submit" value="Send">
    </form>
</body>

</html>

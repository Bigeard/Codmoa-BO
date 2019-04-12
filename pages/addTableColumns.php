<?php require "./header.php"; ?> 
    <a href="./addTable.php" class="return" style="position:fixed;">Return</a>
    <h1>Add Columns</h1>

    <form action="../library/processing.php" method="POST">
        <div class="form-wrapper">
            <input type="hidden" name="add_table_name" id="add_table_name" value="<?= $_POST['add_table_name'] ?>">
        </div>
        <div class="form-wrapper">
            <input type="hidden" name="add_table_schema" id="add_table_schema" value="<?= $_POST['add_table_schema'] ?>">
        </div>

        <?php for ($i=0; $i < $_POST['add_table_columns']; $i++) { ?>
            <div class="add-column">
                <input type="text" name="add_column_name_<?= $i ?>" id="add_column_name_<?= $i ?>" placeholder="Column Name" required>
                <select id="add_column_type_<?= $i ?>" name="add_column_type_<?= $i ?>">
                    <option value="VARCHAR" selected>VARCHAR</option>
                    <option value="TEXT">TEXT</option>
                    <option value="INT">INT</option>
                    <option value="DOUBLE">DOUBLE</option>
                    <option value="DATE">DATE</option>
                    <option value="TIMESTAMP">TIMESTAMP</option>
                    <option value="BOOLEAN">BOOLEAN</option>
                </select>
                <input type="checkbox" name="add_column_null_<?= $i ?>" id="add_column_null_<?= $i ?>" title="NULL">
            </div>
        <?php } ?>
        <input type="submit" value="Send">
    </form>
</body>

</html>

<?php require "./header.php"; ?>
<?php require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();

$schemas = $api->selectAllSchemas();
$tables = $api->selectAllTables();
?>

<body class="modifyDb">
<a href="./requests.php" class="return">Return</a>
<h1>Modify Database</h1>

<div class="database-wrapper">
    <?php foreach ($schemas as $schema) { ?>
        <div class="schema-wrapper">
            <div class="schema-left">
                <h2><?= $schema->schema_name ?></h2>
            </div>
            <div class="schema-right">
                <div class="icons-wrapper">
                    <a href="../library/processing.php?remove=true&schema=<?= $schema->schema_name ?>" class="icon"><img src="../assets/icons/delete.svg"></a>
                </div>
            </div>
        </div>
        

        <?php foreach ($tables as $table) { ?>
            <?php if ($table->table_schema == $schema->schema_name) { ?>
                <div class="table-wrapper">
                    <div class="table-left">
                        <h3><?= $table->table_name ?></h3>
                    </div>
                    <div class="table-right">
                        <div class="icons-wrapper">
                            <a href="#" class="icon"><img src="../assets/icons/edit.svg"></a>    
                            <a href="../library/processing.php?remove=true&schema=<?= $schema->schema_name ?>&table=<?= $table->table_name ?>" class="icon"><img src="../assets/icons/delete.svg"></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <a href="./addTable.php?schema=<?= $schema->schema_name ?>" class="addTable">Add Table</a>
    <?php } ?>
    <a href="./addSchema.php" class="addSchema">Add Schema</a>
</div>

</body>

</html>
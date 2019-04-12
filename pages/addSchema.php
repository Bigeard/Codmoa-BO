<?php require "./header.php"; ?> 
    <a href="./requests.php" class="return" style="position:fixed;">Return</a>
    <h1>Add Schema</h1>

    <form action="../library/processing.php" method="POST">
        <div class="form-wrapper">
            <label for="add_schema_name">Name: </label>
            <input type="text" name="add_schema_name" id="add_schema_name" required>
        </div>
        <input type="submit" value="Send">
    </form>
</body>

</html>

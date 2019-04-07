<?php require "./header.php"; ?> 

<!-- <body> -->
    <a href="./requests.php" class="return">Return</a>
    <h1>Script SQL</h1>

    <form id="form_sql" action="../library/sql.php" method="post" enctype="multipart/form-data">
        <textarea name="sql" id="script" cols="100" rows="20"></textarea>
        <input type="submit" name="script" value="Execute">
    </form>
</body>

</html>
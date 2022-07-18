<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текущее расписание</title>
    <!--link rel="stylesheet" href="css/twofail.css"-->
    <script src="js/link.js"></script>
    <?php
       require_once 'php/ToDb.php';
    ?>
</head>
<body>
    <header>
    <div class="links">
            <p class="p_header">Расписания занятий</p>
            <p class="p_header_0">&raquo;&raquo;&raquo;</p>
            <p class="p_header_1">Вторая пересдача</p>
        </div>          
        <button class="enter">Войти</button>
    </header>
    <div class="telo_0">
        <div class="week">

            <?php require_once 'php/Tttp.php';?>
           
        </div>

        


    </div>
</body>
</html>
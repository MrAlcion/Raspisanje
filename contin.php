<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текущее расписание</title>
    <link rel="stylesheet" href="css/contin/contin_head.css">
    <link rel="stylesheet" href="css/contin/contin_t-0.css">
    <link rel="stylesheet" href="css/contin/contin_-840.css">
    <link rel="stylesheet" href="css/contin/contin_841-1031.css">
    <link rel="stylesheet" href="css/contin/contin_1032-1549.css">
    <link rel="stylesheet" href="css/contin/contin_1550+.css">
    <script src="js/link.js"></script>
    <?php require_once 'php/ToDb.php';?>
</head>
<body>
    <header>
        <div class="line-1">
            <div class="links">
                <p class="p_header">Расписания занятий</p>
                <p class="p_header_0">&raquo;&raquo;&raquo;</p>
                <p class="p_header_1">Текущее расписание</p>
            </div>                 
            <button class="enter">Обновить</button>
        </div>
        <div class="line-2"></div>  
    </header>
    <div class="telo_0">
        <div class="nweek">
            <form method="POST" class="SearchGroup">
                <p class=Tname>Введите название группы:</p>              
                    <input type="text" class="namegroup" name="mygroup">
                    <input type="submit" class="Search" value="Поиск">  
            </form>
        </div>
        <div class="uberweek">
            <div class="week">
                <?php require_once 'php/ToLinks.php';?>
            </div>
        </div>      
    </div>
</body>
</html>
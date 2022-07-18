<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текущее расписание</title>
    <link rel="stylesheet" href="css/edit/edit1.css">
    <link rel="stylesheet" href="css/edit/edit2.css">
    <script src="js/link.js"></script>
    <?php require_once 'php/ToDb.php';?>
</head>
<body>
    <header>
        <div class="line-1">
            <div class="links">
                <p class="p_header">Расписания занятий</p>
                <p class="p_header_0">&raquo;&raquo;&raquo;</p>
                <p class="p_header_1">Редакция расписания</p>
            </div>                 
            <button class="enter">Обновить</button>
        </div>
        <div class="line-2"></div>  
    </header>
    <form method="POST" class="panel">
        <input type="submit" value="Группы"             name="groups"       class="q1" id="bt">
        <input type="submit" value="Типы занятий"       name="types"        class="q2" id="bt">
        <input type="submit" value="Аудитории"          name="locations"    class="q3" id="bt">
        <input type="submit" value="Предметы"           name="lessons"      class="q4" id="bt">
        <input type="submit" value="Преподаватели"      name="teachers"     class="q5" id="bt">
        <input type="submit" value="Расписание"         name="plane"        class="q6" id="bt">
        <input type="submit" value="Группы/Предметы"    name="gr-les"       class="q7" id="bt">
        <input type="submit" value="Преподаватели/Предметы"name="tea-les"   class="q8" id="bt">
    </form>
    <div class="telo_0">
        <div class="tables">
            <?php require_once 'php/editing.php';?>
        </div>    
    </div>
</body>
</html>
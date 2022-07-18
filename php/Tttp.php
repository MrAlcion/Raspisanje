<?php

$db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
    $id = "181-721";
    $stmt = $db->prepare(
    "SELECT gr.GrNum,  pl.LNumber, wd.DName, lo.LocNumber, ll.LName, lt.TName, pt.TFullName, idPL
    FROM plane.planelessons as pl
    inner join plane.teachers_has_planelessons as thpl
    on pl.idPL = thpl.PlaneLessons_idPL
    inner join plane.teachers as pt
    on pt.idT = thpl.Teachers_idT
    inner join plane.lessontypes as lt
    on pl.LessonTypes_idLType = lt.idLType
    inner join plane.lessons as ll
    on pl.Lessons_idLs = ll.idLs
    inner join plane.locations as lo
    on lo.idLoc = pl.Locations_idLoc
    inner join plane.groups_has_planelessons as ghp
    on pl.idPL = ghp.PlaneLessons_idPL
    inner join plane.groupes as gr
    on gr.idGr = ghp.Groups_idGr
    inner join plane.weekdays as wd
    on pl.WeekDays_idDay = wd.idDay
    where `GrNum` = ?
    order by pl.WeekDays_idDay");
    $stmt->execute([$id]);
    
    $Wday[7][] = "1";   
    while ($row = $stmt->fetch(PDO::FETCH_LAZY))
    {    
        $Wday[0][] = $row->GrNum;       // Номер группы
        $Wday[1][] = $row->LNumber;     // Номер пары (внутри дня)
        $Wday[2][] = $row->DName;       // День недели
        $Wday[3][] = $row->LocNumber;   // Локация
        $Wday[4][] = $row->LName;       // Название предмета
        $Wday[5][] = $row->TName;       // Типы занятий
        $Wday[6][] = $row->TFullName;   // Товарищи преподы
    }




    for($p=0;$p<count($Wday[0]);$p++)
    {
        echo $Wday[1][$p]."---".$Wday[6][$p]."<div></div>";
    }
    echo "<p>ooodooddido</p>";

    
    $tet ="";
    $tea ="";
    for($m=0;$m<count($Wday[0]);$m++)
    {
        if($Wday[1][$m]==$tet)
        { 
            echo $Wday[1][$m]."+++"."<div></div>";
            $tea = $tea.", ".$Wday[6][$m];
            echo "<div>".$tea."</div>";
        }
        else
        {
            echo $Wday[1][$m]."-----"."<div></div>";
            $tet = $Wday[1][$m];
            $tea = $Wday[6][$m];
        }
    }















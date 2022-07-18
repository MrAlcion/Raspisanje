<?php

$Mgroup = "nnn-1-error";
if(isset($_POST['mygroup'])) $Mgroup = $_POST['mygroup'];
//echo "До:".$Mgroup;       //отладка "до"
$noSymb = array ("<", ">", "?", "=", "'", "/", "*", "+", ";", ":", "%", "$", "#", "@", ")", "(", "&", "^", "№", "!", "[", "]","{", "}", ".", ",", "_", '"');
$MnSgroup = str_replace($noSymb, "", $Mgroup);  // очистка запроса от вреда
//echo "После:".$MnSgroup;  //отладка "после"

function NoFound()
{
    echo "<div class='NTAlert'>
    <p class='TAlert'>Группа не найдена</p>
    <p class='TAlert'>Введите название группы</p>
    </div>";
}
if($MnSgroup == "" or $MnSgroup == "nnn-1-error")
{
    NoFound();
}
else
{
    $id = $MnSgroup;
    
    $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
    //$id = "181-721";  test
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

    $Ltime = array(                     // Время проведения каждой пары
        1 => "9:00-10:30",
        2 => "10:40-12:10",
        3 => "12:20-13:50",
        4 => "14:30-16:00",
        5 => "16:10-17:40",
        6 => "17:50-19:20",
        7 => "19:30-21:00");

    $Wday[7][] = "1";

    $row = $stmt->fetch(PDO::FETCH_LAZY);
    $Wday[0][] = $row->GrNum;       // Номер группы
    $Wday[1][] = $row->LNumber;     // Номер пары (внутри дня)
    $Wday[2][] = $row->DName;       // День недели
    $Wday[3][] = $row->LocNumber;   // Локация
    $Wday[4][] = $row->LName;       // Название предмета
    $Wday[5][] = $row->TName;       // Типы занятий
    $Wday[6][] = $row->TFullName;   // Товарищи преподы

    if( $Wday[0][0]==""){ NoFound();}
    else
    {
        while ($row = $stmt->fetch(PDO::FETCH_LAZY))
        {    
        //echo $row->GrNum." ".$row->LNumber." ".$row->DName." ".$row->LocNumber." ".$row->LName." ".$row->TName." ".$row->TFullName.'<br>';
        $Wday[0][] = $row->GrNum;       // Номер группы
        $Wday[1][] = $row->LNumber;     // Номер пары (внутри дня)
        $Wday[2][] = $row->DName;       // День недели
        $Wday[3][] = $row->LocNumber;   // Локация
        $Wday[4][] = $row->LName;       // Название предмета
        $Wday[5][] = $row->TName;       // Типы занятий
        $Wday[6][] = $row->TFullName;   // Товарищи преподы
        }
        for($a=0;$a<count($Wday[0]);$a++) {$Wday[7][$a] = $Ltime[$Wday[1][$a]];} //Подставление времени под каждую пару в общем списке

        //----------------------------------------------

        $Wdn = ""; //начальное значение проверочного значения дня недели
        $pp = "-1"; //начальное значение проверочного значения номера пары

        for($j=0;$j<count($Wday[0]);$j++)
        {
            if($Wday[2][$j]!=$Wdn) //если день недели не совпадает с прошлым значением $Wdn
            {
                echo "<div class='its-day'>";
                echo  "<div class='nameday'>".$Wday[2][$j]."</div>";
           
                $Wdn = $Wday[2][$j];
                echo "<div class='lessons'>";


                for($i=0;$i<count($Wday[0]);$i++)
                {
                    if($Wday[2][$i]==$Wday[2][$j] and $Wday[1][$i]!=$pp) //если это этот день недели, но не тот же самый предмет
                    {
                        echo "<div class='lesson'>"; //показать этот предмет

                        echo "<div class='lhead'>"; //Крыша предмета
                        echo  "<div class='ltime'>".$Wday[7][$i]."</div>"; //номер пары
                        echo  "<div class='ltype'>".$Wday[5][$i]."</div>"; // тип пары
                        echo "</div>";
    
                        echo  "<div class='lname'>".$Wday[4][$i]."</div>"; //название предмета
                        echo  "<div class='loc'>".$Wday[3][$i]."</div>"; //место пары


                        $teach = ""; // строчный список преподов
                        $tet =""; //проверка на дубляж пар в массиве
                        $tea =""; //тоже типа строчный список преподов, ток не полный
                        for($m=0;$m<count($Wday[0]);$m++)
                        {
                            if($Wday[1][$m]==$tet)
                            { 
                                //echo $Wday[1][$m]."+++"."<div></div>";
                                $tea = $tea.", ".$Wday[6][$m];
                                //echo "<div>".$tea."</div>";
                            }
                            else
                            {
                                //echo $Wday[1][$m]."-----"."<div></div>";
                                $tet = $Wday[1][$m];
                                $tea = $Wday[6][$m];
                            }
                            if($Wday[2][$m]==$Wday[2][$i] and $Wday[1][$m]==$Wday[1][$i]){ $teach = $tea;}
                        }                          
                        echo  "<div class='lte'>".$teach."</div>"; // показать имена преподавателей
                        echo "</div>"; //закрыть тег предмета
                        $pp = $Wday[1][$i];

   


                    }                  
                }
                echo "</div>";
                echo "</div>";
            }
        }
    }
}


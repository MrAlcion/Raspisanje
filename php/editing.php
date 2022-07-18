<?php

    $MyGr[3][]="Группа";
    $MyGr[4][]="Группы";
    $MyGr[5][]="Grupy";

    $MyLt[3][]="Тип занятия";
    $MyLt[4][]="Типы занятий";
    $MyLt[5][]="Teepy";

    $MyLc[3][]="Аудитория";
    $MyLc[4][]="Аудитории";
    $MyLc[5][]="Lokacia";

    $MyLs[3][]="Предмет";
    $MyLs[4][]="Предметы";
    $MyLs[5][]="Predmety";

    $MyTc[3][]="Преподаватель";
    $MyTc[4][]="Преподаватели";
    $MyTc[5][]="Prepodavateli";

    $GrLs[3][]="Группы/Предметы";
    $GrLs[4][]="Предмет";
    $GrLs[5][]="Gr-pr";

    $TLs[3][]="Преподаватели/Предметы";
    $TLs[4][]="Предмет";
    $TLs[5][]="Pepod-pr";
    //---
    $MyPl[0][0]="id";
    $MyPl[0][1]="Номер пары";
    $MyPl[0][2]="Аудитория+";
    $MyPl[0][3]="Тип занятия+";
    $MyPl[0][4]="День недели+";
    $MyPl[0][5]="Предмет+";



function clears($w)
{
//echo "До:".$Mgroup;       //отладка "до"
$noSymb = array ("<", ">", "?", "=", "'", "/", "*", "+", ";", ":", "%", "$", "#", "@", ")", "(", "&", "^", "№", "!", "[", "]","{", "}", ".", ",", "_", '"');
$w = str_replace($noSymb, "", $w);  // очистка запроса от вреда
//echo "После:".$MnSgroup;  //отладка "после"
}
















    if(isset($_POST['groups']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.groups");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyGr[0][] = $row->idGr;
            $MyGr[1][] = $row->GrNum;
        }
        vw($MyGr);
    }
    if(isset($_POST['types']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.lessontypes");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyLt[0][] = $row->idLType;
            $MyLt[1][] = $row->TName;
        }
        vw($MyLt);
    }
    if(isset($_POST['locations']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.locations");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyLc[0][] = $row->idLoc;
            $MyLc[1][] = $row->LocNumber;
        }
        vw($MyLc);
    }
    if(isset($_POST['lessons']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.lessons");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyLs[0][] = $row->idLs;
            $MyLs[1][] = $row->LName;
        }
        vw($MyLs);
    }
    if(isset($_POST['teachers']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.teachers");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyTc[0][] = $row->idT;
            $MyTc[1][] = $row->TFullName;
        }
        vw($MyTc);
    }
    if(isset($_POST['plane']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.planelessons");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyPl[1][] = $row->idPL;
            $MyPl[2][] = $row->LNumber;
            $MyPl[3][] = $row->Locations_idLoc;
            $MyPl[4][] = $row->LessonTypes_idLType;
            $MyPl[5][] = $row->WeekDays_idDay;
            $MyPl[6][] = $row->Lessons_idLs;
        }
        vw1($MyPl);
    }



    //Двойные таблицы-----------------------------------
    if(isset($_POST['gr-les']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.groups_has_planelessons");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            $GrLs[0][] = $row->Groups_idGr;
            $GrLs[1][] = $row->PlaneLessons_idPL;
        }
        echo "<form method='POST' class='Changes'>";
        echo "<div class='table-".$GrLs[5][0]."'>";
        echo "<div class='head0'>".$GrLs[3][0]."</div>";
        echo "<div class='tt'><div class='m1'>Группа</div><div class='m2'>".$GrLs[4][0]."</div>";
        for($j=0;$j<count($GrLs[1]);$j++)
        {
            echo "<div class='n1'>".$GrLs[0][$j]."</div><div class='n2'>".$GrLs[1][$j]."</div>";
        }
        echo "<div class='n2'><input type='text' class='k83' name='m-id-".$GrLs[5][0]."'></div><div class='n2'><input type='text' class='k8' name='m-pr-".$GrLs[5][0]."'></div>";
        echo "<div class='n1'><input type='submit' value='+' name='add-".$GrLs[5][0]."' class='k7'></div>";
        echo "</div>";


        echo "<div class='tt3'><div class='n001'><input type='submit' value='Delete by' name='del-".$GrLs[5][0]."' class='k000'></div>   <div class='n002'>Группа: <input type='text' class='k008' name='del-idpr-".$GrLs[5][0]."'></div>     <div class='n003'>Предмет: <input type='text' class='k008' name='del-id--nomer".$GrLs[5][0]."'></div>      </div>";

        echo "</div></form>";
    }

    if(isset($_POST['tea-les']))
    {
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("SELECT * FROM plane.teachers_has_planelessons");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            $TLs[0][] = $row->Teachers_idT;
            $TLs[1][] = $row->PlaneLessons_idPL;
        }
        echo "<form method='POST' class='Changes'>";
        echo "<div class='table-".$TLs[5][0]."'>";
        echo "<div class='head0'>".$TLs[3][0]."</div>";
        echo "<div class='tt'><div class='m1'>Преподаватель</div><div class='m2'>".$TLs[4][0]."</div>";
        for($j=0;$j<count($TLs[1]);$j++)
        {
            echo "<div class='n1'>".$TLs[0][$j]."</div><div class='n2'>".$TLs[1][$j]."</div>";
        }
        echo "<div class='n2'><input type='text' class='k83' name='m".$TLs[5][0]."'></div><div class='n2'><input type='text' class='k8' name='m".$TLs[5][0]."'></div>";
        echo "<div class='n1'><input type='submit' value='+' name='".$TLs[5][0]."' class='k7'></div>";
        echo "</div>";

        echo "<div class='tt3'><div class='n001'><input type='submit' value='Delete by id' name='del-".$TLs[5][0]."' class='k000'></div>   <div class='n002'>Преподаватель: <input type='text' class='k008' name='del-idpr-".$TLs[5][0]."'></div>     <div class='n003'>Предмет: <input type='text' class='k008' name='del-id--nomer".$TLs[5][0]."'></div>      </div>";


        echo "</div></form>";
    }
    /*Двойные таблицы----------------------------------------------------------------*/



































function vw($q)
{
    echo "<form method='POST' class='Changes'>";


    echo "<div class='table'>";
    echo "<div class='head0'>".$q[4][0]."</div>";

    echo "<div class='tt'>        <div class='m1'>id</div><div class='m2'>".$q[3][0]."</div>";
    for($j=0;$j<count($q[1]);$j++)
    {
        echo "<div class='n1'>".$q[0][$j]."</div><div class='n2'>".$q[1][$j]."</div>";
    }
    echo "<div class='n1'>     <input type='submit' value='add' name='".$q[5][0]."' class='k7'></div><div class='n2'><input type='text' class='k8' name='m".$q[5][0]."'></div>";
    echo "<div class='n1'>     <input type='submit' value='del by id' name='del".$q[5][0]."' class='k7'></div><div class='n2'><input type='text' class='k8' name='m-del".$q[5][0]."'></div>";
    
    echo "</div></div></form>";

}


function vw1($q)
{
    echo "<form method='POST' class='Changes'>";

    echo "<div class='table-rsp'>";


    echo "<div class='head0'>Расписание</div>";


    echo "<div class='tt1'>";


    //--*-*-*-*-*
    for($j=0;$j<6;$j++) {echo "<div class='m-".$j."'>".$q[0][$j]."</div>";} 
    for($j=0;$j<count($q[1]);$j++)
    {
        for($i=1;$i<7;$i++) {echo "<div class='n-".$i."'>".$q[$i][$j]."</div>";} 
    }
    echo "<div class='n-1'><input type='submit' value='+' name='raspisanije' class='k7'></div><div class='n-2'><input type='text' class='k81' name='nomer".$q[5][0]."'></div><div class='n-3'><input type='text' class='k81' name='audtitor".$q[5][0]."'></div><div class='n-4'><input type='text' class='k81' name='tipo".$q[5][0]."'></div><div class='n-5'><input type='text' class='k81' name='dayday".$q[5][0]."'></div><div class='n-6'><input type='text' class='k81' name='predmet".$q[5][0]."'></div>";
    //--*-*-*-*-*
    echo "</div>";

    echo "<div class='tt2'><div class='n01'><input type='submit' value='Delete by id' name='del-raspisanije' class='k00'></div>   <div class='n02'><input type='text' class='k08' name='del-id--nomer".$q[5][0]."'></div></div>";

    echo "</div></form>";
}















//Группы
if(isset($_POST['Grupy']))
    {
        $Mz = "nnn-1-error";
        if(isset($_POST['mGrupy']))
        {
            
       //     $Mz = $_POST['mGrupy'];
       //     clears($Mz);
       //     $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);



        //    $stmt = $db->prepare("INSERT INTO `plane`.`groupes` (`GrNum`) VALUES :Mz");
        //    $stmt->execute(['Mz'=>$Mz]);

        /*    $sth = $db->prepare('INSERT INTO `plane`.`groupes` (`GrNum`) VALUES ?');
            $sth->execute(array($Mz));*/
         //   echo $Mz;
            //$Mz = "('".$Mz."')";



           /* $sth = $db->prepare('INSERT INTO `plane`.`groupes` (`GrNum`) VALUES :colour');
            $sth->bindValue(':colour', "%{$Mz}%");
            $sth->execute();*/

           /* $sth = $db->prepare("INSERT INTO `plane`.`groupes` (`GrNum`) VALUES :colour");
            $sth->execute(array('colour' => $Mz));

*/
         //   echo $Mz;
          //  $db->execute("INSERT INTO `plane`.`groupes` (`GrNum`) VALUES ('{$Mz}')");







          //  $name = 'Новая категория';
          /*
$query = "INSERT INTO `plane`.`groupes` (`GrNum`) VALUES (:name)";
$params = [':name' => $Mz];
$stmt = $pdo->prepare($query);
$stmt->execute($params);
*/

        }
        
        //cho $Mz;
       // $Mz = '"'."INSERT INTO `plane`.`groupes` (`GrNum`) VALUES (`$Mz`)".'"';
        //echo $Mz;

        


       /* $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
        $zapros = $db->query("INSERT INTO `plane`.`groupes` (`GrNum`) VALUES (`$Mz`)");*/

        

        $zapros = $db->query("SELECT * FROM plane.groupes");
        while ($row = $zapros->fetch(PDO::FETCH_LAZY))
        {
            // echo $row->GrNum."---- ".$row->idGr.'<br>';
            $MyGr[0][] = $row->idGr;
            $MyGr[1][] = $row->GrNum;
        }
        vw($MyGr);
    }





















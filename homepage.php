<html>
<head>
    <link rel="icon" href="images/cv1.png" type="image/gif">
    <title>CVH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Style.css">
   
    <style type="text/css">
       @media print
       {
            .table thead tr td, .table tbody tr th, .table tbody tr td
            {
                border-width: 1px !important;
                border-style: solid !important;
                border-color: #000 !important;
            }
        }
    </style> 
</head>

<div class="container-fluid">
<?php
session_start();
include 'body.php';
include 'config.php';

if (isset($_SESSION['LoggedIn']) == false) 
{	
	echo "<script type='text/javascript'>window.top.location='index';</script>"; exit;
}
?>

    <form method = 'post' name='HomePage'> 
    <?php
    $mUserName = $_SESSION['UserName'];
  
    echo "<H4 id='head4'><b><i>Welcome to - ". $mUserName ."</i></b><div style='text-align:right;'><a href='newstudent'>New Student</a></div></H4>";
    echo "<div class='table-responsive'>";
        echo "<table class='table' id='optionstable' style='background-color:whitesmoke;'>";

            echo '<td align = "center">Branch &nbsp; <SELECT name="Branch" style = "width:100px;">
                                                        <option value = "" >-- Select --</option>
                                                        <option value = "CV" >CV</option>
                                                        <option value = "CS" >CS</option>
                                                    </SELECT>';

            echo "<td>Admin No  <input type = 'text' name='fadminno' type='text' placeholder='Admin No.' maxlength='8' style='width:80px;'>";
            echo "<td>Challan No  <input type = 'text' name='cno' type='text' placeholder='Challan No.' maxlength='8' style='width:80px;'>";
            echo "<td>Student Name <input type = 'text' name='sname' type='text' placeholder='Student Name' autofocus maxlength='8' style='width:200px;'>";
        echo "<td><button name='search' id='search'>&nbsp;Search&nbsp;</button>";
        echo "</table>";
    echo "</div>";
    echo "</form>";    
   
    if (isset($_POST['search']))
    {
        $_StudentName = $_POST['sname'];
    
        $sql = "SELECT name as 'Student Name'
                    , Class, Address
                    from Student ";
     
        if ($_StudentName <> "")
        {
            $sql = $sql . " where Name LIKE '%$_StudentName%'  ";
       
            echo "<H4> Students Name Search By - ". $_StudentName ." - </H4>";
        }
        else 
        {
            echo "<H4>All Students</H4>";
        }
        //echo $sql;
        $cnt = 1;
        if ($result=mysqli_query($db, $sql))
        {
            $rowcount=mysqli_num_rows($result);
            if($rowcount!=0)
            {
                echo "<div class='table-responsive'>";
                echo "<TABLE border = 1 class = 'table table-bordered table-hover' id = 'TableToExcel' style='background-color: white;'>";
                echo "<tr><th style='text-align:center; vertical-align:middle;'>S.No.";
                while ($fieldinfo = mysqli_fetch_field($result))
				{	
                    echo "<th style='text-align:center; vertical-align:middle;''>$fieldinfo->name"; 	
                }
               
                    while($row = mysqli_fetch_row($result)) 
                    {
                        echo "<tr><td align = 'center' style='vertical-align:middle;'>" . $cnt;
                      
                        foreach($row as $_column) 
                        {
                            echo "<td align = 'left' style='vertical-align:middle;'>$_column</td>";
                        }
                       
                        echo "</tr>";
                        $cnt++;
                    }
                
                mysqli_free_result($result);
                echo "</table>";
                echo "</div>";
            }
        }
        $db->close();
?>
        <!-- <button name = "Export2Excel" id="Export2Excel" style = 'width:150px;' onclick="ExportToExcel()">Export To Excel</button> -->
        <button name="top" id="btnTop" title="Top of the Page">Top</button>
        <button name="btnprint" id="btnprint"  onclick="print_page()">Print </button><BR><BR>
 
<?php
}
?>

    <script type="text/javascript">
        function print_page() 
        {
        
            var ButtonControlExl = document.getElementById("btnExport2Excel");
            var ButtonControlPrn = document.getElementById("btnprint");
            var ButtonControlReportsHeader = document.getElementById("ReportsHeader").style.display = "block";
            var ButtonControlOptionsTable = document.getElementById("optionstable").style.display = "none";
            var ButtonControlHead4 = document.getElementById("head4").style.display = "none";
            
        
            ButtonControlExl.style.visibility = "hidden";
            ButtonControlPrn.style.visibility = "hidden";
            
            window.print();
            location.reload();
            //window.top.location='homepage';
        }
    </script>
    
<?php include 'pagefooter.php';?>
</body>
</div>
</html>
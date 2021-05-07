<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/fh-3.1.8/kt-2.6.1/r-2.2.7/datatables.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/fh-3.1.8/kt-2.6.1/r-2.2.7/datatables.min.js"></script>

</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>


        <div class="table-responsive">
            <table id="users_data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>IdUser</td>
                        <td>Name</td>
                        <td>Surname</td>
                        <td>Email</td>
                        <td>Newsletter</td>
                        <td>Category</td>
                        <td>Operations</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $dbh->getInstance()->prepare("SELECT `IdUser`, `Name`, `Surname`, `Email`,  `Newsletter`, categories.Category FROM `users` INNER join categories on categories.IdCategory=users.Category WHERE 1 ORDER by users.IdUser");
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        echo '  
                               <tr>  
                                    <td>' . $row["IdUser"] . '</td>  
                                    <td>' . $row["Name"] . '</td>  
                                    <td>' . $row["Surname"] . '</td>  
                                    <td>' . $row["Email"] . '</td>  
                                    <td>' . $row["Newsletter"] . '</td>
                                    <td>' . $row["Category"] . '</td>
                                    <td>' . $row["Category"] . '</td>
                                      
                               </tr>  
                               ';
                    }
                    ?>
                </tbody>
            </table>
        </div>









    </div>
    <?php require_once("footer.php"); ?>


</body>

</html>
<script> 
$(document).ready(function() {

$('#users_data').DataTable({
    paging: true,
    lengthChange: true,
    colReorder: true,
    responsive: true,
    keys: true,
    fixedHeader: true,
    dom: 'lf<"floatright"B>rtip',
    buttons: [
        'csv','copy', 'excel', 'pdf', 'print'
    ] 
});
});
</script>
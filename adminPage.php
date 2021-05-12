<!DOCTYPE html>
<html lang="en">>

<head>
    <?php
    require_once("header.php");
    if(!isset($_SESSION['Category'])||$_SESSION['Category']!='Administrator'){
        header("Location: index.php");
    }
    if(isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin'])==true){
        $_SESSION['modifyByAdmin']=false;
    }
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

        <header class="text-center logo">
            <h1 style="font-size: 65px">All Users</h1>
        </header>
        <div class="table-responsive navbar-font">
            <table id="users_data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td class="logo">IdUser</td>
                        <td class="logo">Name</td>
                        <td class="logo">Surname</td>
                        <td class="logo">Email</td>
                        <td class="logo">Newsletter</td>
                        <td class="logo">Category</td>
                        <td class="logo">Operations</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $dbh->getInstance()->prepare("SELECT `IdUser`, `Name`, `Surname`, `Email`,  `Newsletter`, categories.Category FROM `users` INNER join categories on categories.IdCategory=users.Category WHERE 1 ORDER by users.IdUser");
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                       $id= htmlentities($row['IdUser']);
                       $name=htmlentities($row['Name']);
                       $surname=htmlentities($row['Surname']);
                       $email=htmlentities($row['Email']);
                       $newsletter=htmlentities($row['Newsletter']);
                       $category=htmlentities($row['Category']);
                        echo '  
                               <tr>  
                                    <td class="navbar-font">' . $id. '</td>  
                                    <td class="navbar-font">' . $name . '</td>  
                                    <td class="navbar-font">' . $surname . '</td>  
                                    <td class="navbar-font">' . $email . '</td>  
                                    <td class="navbar-font">' .  (($newsletter == 1) ? 'Subscribed' : 'Not Subscribed')  . '</td>
                                    <td class="navbar-font">' . $category . '</td>
                                    <td class="navbar-font">
                                    <form action="userPage.php" method="POST">
                                    <input type="hidden" name="IdUserToModify" value="'.$id.'">
                                    <button type="submit" class="btn btn-link" name="modifyByAdmin"><i class="fas fa-cog  fa-lg trashBin"></i></button>
                                    </form>
                                    <form action="deliteAccount.php" method="POST"><input type="hidden" name="idToDelite" value="'.$id.'"><button type="submit" name="adminSubmit"  class="btn btn-link"><i class="fas fa-trash-alt fa-lg trashBin"></i></button></form>
                                    </td>
                                      
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
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns:  ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ]

        });
    });
</script>
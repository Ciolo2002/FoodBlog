<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    ?>

    <script src="adminPage.js"></script>
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.jss"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js"></script> -->
<!-- https://codepen.io/AurelieT/pen/JGxMgo -->
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>


    <style rel="stylesheet" href="adminPage.css"></style>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">

    

</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>
       
        <div id="toolbar">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>

        <table id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th data-field="Name" data-filter-control="input" data-sortable="true">Nane</th>
                    <th data-field="Surname" data-filter-control="input" data-sortable="true">Surname</th>
                    <th data-field="Email" data-filter-control="input" data-sortable="true">Email</th>
                    <th data-field="Newsletter" data-filter-control="select" data-sortable="true">Newsletter</th>
                    <!--  <th data-field="select" data-sortable="true">Note</th>  -->
                    <th data-field="Category" data-filter-control="select" data-sortable="true">Category</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bs-checkbox "><input data-index="0" name="btSelectItem" type="checkbox"></td>
                    <td>Valérie</td>
                    <td>01/09/2015</td>
                    <td>Français</td>
                    <td>12/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="1" name="btSelectItem" type="checkbox"></td>
                    <td>Eric</td>
                    <td>05/09/2015</td>
                    <td>Philosophie</td>
                    <td>8/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="2" name="btSelectItem" type="checkbox"></td>
                    <td>Valentin</td>
                    <td>05/09/2015</td>
                    <td>Philosophie</td>
                    <td>4/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="3" name="btSelectItem" type="checkbox"></td>
                    <td>Valérie</td>
                    <td>05/09/2015</td>
                    <td>Philosophie</td>
                    <td>10/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="4" name="btSelectItem" type="checkbox"></td>
                    <td>Eric</td>
                    <td>01/09/2015</td>
                    <td>Français</td>
                    <td>14/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="5" name="btSelectItem" type="checkbox"></td>
                    <td>Valérie</td>
                    <td>07/09/2015</td>
                    <td>Mathématiques</td>
                    <td>19/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="6" name="btSelectItem" type="checkbox"></td>
                    <td>Valentin</td>
                    <td>01/09/2015</td>
                    <td>Français</td>
                    <td>11/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="7" name="btSelectItem" type="checkbox"></td>
                    <td>Eric</td>
                    <td>01/10/2015</td>
                    <td>Philosophie</td>
                    <td>8/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="8" name="btSelectItem" type="checkbox"></td>
                    <td>Valentin</td>
                    <td>07/09/2015</td>
                    <td>Mathématiques</td>
                    <td>14/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="9" name="btSelectItem" type="checkbox"></td>
                    <td>Valérie</td>
                    <td>01/10/2015</td>
                    <td>Philosophie</td>
                    <td>12/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="10" name="btSelectItem" type="checkbox"></td>
                    <td>Eric</td>
                    <td>07/09/2015</td>
                    <td>Mathématiques</td>
                    <td>14/20</td>
                </tr>
                <tr>
                    <td class="bs-checkbox "><input data-index="11" name="btSelectItem" type="checkbox"></td>
                    <td>Valentin</td>
                    <td>01/10/2015</td>
                    <td>Philosophie</td>
                    <td>10/20</td>
                </tr>
            </tbody>
        </table>




    </div>






    <?php require_once("footer.php"); ?>




</body>

</html>
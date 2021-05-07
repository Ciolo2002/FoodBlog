<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    $stmt = $dbh->getInstance()->prepare("SELECT `IdUser`, `Name`, `Surname`, `Email`,  `Newsletter`, categories.Category FROM `users` INNER join categories on categories.IdCategory=users.Category WHERE 1 ORDER by users.IdUser");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $users[] = array(
            "iduser" => $row["IdUser"],
            "name" => $row["Name"],
            "surname" => $row["Surname"],
            "email" => $row["Email"],
            "newsletter" => $row["Newsletter"],
            "category" => $row["Category"],
        );
    }

    $file = "json/users.json";
    if (file_put_contents(
        $file,
        json_encode($users)
    ))
        echo ("");
    else
        echo ("Failed");
    ?>

    <script src="adminPage.js"></script>
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

    <style rel="stylesheet" href="adminPage.css"></style>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <style>
        .select,
        #locale {
            width: 100%;
        }

        .operate {
            margin-right: 10px;
        }
    </style>



</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>





        <div class="select">
            <select class="form-control" id="locale">
                <option value="af-ZA">af-ZA</option>
                <option value="ar-SA">ar-SA</option>
                <option value="ca-ES">ca-ES</option>
                <option value="cs-CZ">cs-CZ</option>
                <option value="da-DK">da-DK</option>
                <option value="de-DE">de-DE</option>
                <option value="el-GR">el-GR</option>
                <option value="en-US" selected>en-US</option>
                <option value="es-AR">es-AR</option>
                <option value="es-CL">es-CL</option>
                <option value="es-CR">es-CR</option>
                <option value="es-ES">es-ES</option>
                <option value="es-MX">es-MX</option>
                <option value="es-NI">es-NI</option>
                <option value="es-SP">es-SP</option>
                <option value="et-EE">et-EE</option>
                <option value="eu-EU">eu-EU</option>
                <option value="fa-IR">fa-IR</option>
                <option value="fi-FI">fi-FI</option>
                <option value="fr-BE">fr-BE</option>
                <option value="fr-FR">fr-FR</option>
                <option value="he-IL">he-IL</option>
                <option value="hr-HR">hr-HR</option>
                <option value="hu-HU">hu-HU</option>
                <option value="id-ID">id-ID</option>
                <option value="it-IT">it-IT</option>
                <option value="ja-JP">ja-JP</option>
                <option value="ka-GE">ka-GE</option>
                <option value="ko-KR">ko-KR</option>
                <option value="ms-MY">ms-MY</option>
                <option value="nb-NO">nb-NO</option>
                <option value="nl-NL">nl-NL</option>
                <option value="pl-PL">pl-PL</option>
                <option value="pt-BR">pt-BR</option>
                <option value="pt-PT">pt-PT</option>
                <option value="ro-RO">ro-RO</option>
                <option value="ru-RU">ru-RU</option>
                <option value="sk-SK">sk-SK</option>
                <option value="sv-SE">sv-SE</option>
                <option value="th-TH">th-TH</option>
                <option value="tr-TR">tr-TR</option>
                <option value="uk-UA">uk-UA</option>
                <option value="ur-PK">ur-PK</option>
                <option value="uz-Latn-UZ">uz-Latn-UZ</option>
                <option value="vi-VN">vi-VN</option>
                <option value="zh-CN">zh-CN</option>
                <option value="zh-TW">zh-TW</option>
            </select>
        </div>

        <div id="toolbar">
            <button id="remove" class="btn btn-danger" disabled>
                <i class="fa fa-trash"></i> Delete
            </button>
        </div>
        <table id="table" data-search="true" , data-show-refresh="true" data-show-toggle="true" data-show-fullscreen="true" data-show-columns="true" data-show-columns-toggle-all="true" data-detail-view="true" data-show-export="true" data-click-to-select="true" data-detail-formatter="detailFormatter" data-show-pagination-switch="true" data-pagination="true" data-id-field="IdUser" data-page-list="[10, 25, 50, 100, all]" data-show-footer="true" data-side-pagination="server" data-url="json\users.json" data-response-handler="responseHandler">
            <!--   <tbody>
                <tr>
                    <th data-field="iduser"></th>
                    <th data-field="name"></th>
                    <th data-field="surname"></th>
                    <th data-field="email"></th>
                    <th data-field="newsletter"></th>
                    <th data-field="category"></th>
                </tr>
            </tbody> -->
        </table>


        <script>
            var $table = $('#table')
            var $remove = $('#remove')

            /* $(function() {
                 $('#table').bootstrapTable({
                     method: 'get',
                     
                     url: 'json/users.json',
                     height: 450,
                     cache: false,
                     stripped: true,
                     pagination: true,
                     pageSize: 10,
                     pageList: [10, 25, 50, 100, 200],
                     minimumCountColums: 2,
                     clickToSelect: true,
                     columns: [
                         {
                             field: 'state', //checobox per fare tutto
                             checkbox: true,
                             rowspan: 2,
                             align: 'center',
                             valign: 'middle'
                         }, {
                             title: 'User ID',
                             field: 'iduser',
                             rowspan: 2,
                             align: 'center',
                             valign: 'middle',
                             sortable: true,

                         }, {
                             title: 'User Detail',
                             colspan: 6,
                             align: 'center'
                         },
                         {
                                 field: 'name',
                                 title: 'User Name',
                                 sortable: true,

                                 align: 'center'
                             }, {
                                 field: 'surname',
                                 title: 'User Surname',
                                 sortable: true,
                                 align: 'center',

                             },
                             {
                                 field: 'email',
                                 title: 'User Email',
                                 sortable: true,
                                 align: 'center',

                             },
                             {
                                 field: 'newsletter',
                                 title: 'User Newsletter',

                                 align: 'center',
                                 valign: 'middle'
                             },
                             {
                                 field: 'category',
                                 title: 'User Category',
                                 sortable: true,
                                 align: 'center',

                             }, {
                                 field: 'operate',
                                 title: 'User Operate',
                                 align: 'center',
                                 clickToSelect: false,
                                 events: window.operateEvents,

                             }
                         ]
                     
                 })
             }) */

            function getIdSelections() {
                return $.map($table.bootstrapTable('getSelections'), function(row) {
                    return row.id
                })
            }

            function responseHandler(res) {
                $.each(res.rows, function(i, row) {
                    row.state = $.inArray(row.id, selections) !== -1
                })
                return res
            }

            function detailFormatter(index, row) {
                var html = []
                $.each(row, function(key, value) {
                    html.push('<p><b>' + key + ':</b> ' + value + '</p>')
                })
                return html.join('')
            }

            function operateFormatter(value, row, index) {
                return [
                    '<a class="operate" href="javascript:void(0)" title="Operate">',
                    '<i class="fas fa-cog"></i>',
                    '</a>  ',
                    '<a class="remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-trash"></i>',
                    '</a>'
                ].join('')
            }

            window.operateEvents = {
                'click .operate': function(e, value, row, index) {
                    alert('You click operate action, row: ' + JSON.stringify(row))
                },
                'click .remove': function(e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    })
                }
            }

            function totalTextFormatter(data) {
                return 'Total'
            }

            function totalNameFormatter(data) {
                return data.length
            }

            function totalPriceFormatter(data) {
                var field = this.field
                return '$' + data.map(function(row) {
                    return +row[field].substring(1)
                }).reduce(function(sum, i) {
                    return sum + i
                }, 0)
            }

            function initTable() {
                $table.bootstrapTable('destroy').bootstrapTable({
                    height: 550,
                    locale: $('#locale').val(),
                    columns: [
                        [{
                            field: 'state', //checobox per fare tutto
                            checkbox: true,
                            rowspan: 2,
                            align: 'center',
                            valign: 'middle'
                        }, {
                            title: 'User ID',
                            field: 'iduser',
                            rowspan: 2,
                            align: 'center',
                            valign: 'middle',
                            sortable: true,

                        }, {
                            title: 'User Detail',
                            colspan: 6,
                            align: 'center'
                        }],
                        [{
                                field: 'name',
                                title: 'User Name',
                                sortable: true,

                                align: 'center'
                            }, {
                                field: 'surname',
                                title: 'User Surname',
                                sortable: true,
                                align: 'center',

                            },
                            {
                                field: 'email',
                                title: 'User Email',
                                sortable: true,
                                align: 'center',

                            },
                            {
                                field: 'newsletter',
                                title: 'User Newsletter',

                                align: 'center',
                                valign: 'middle'
                            },
                            {
                                field: 'category',
                                title: 'User Category',
                                sortable: true,
                                align: 'center',

                            }, {
                                field: 'operate',
                                title: 'User Operate',
                                align: 'center',
                                clickToSelect: false,
                                events: window.operateEvents,

                            }
                        ]
                    ]
                })
                $table.on('check.bs.table uncheck.bs.table ' +
                    'check-all.bs.table uncheck-all.bs.table',
                    function() {
                        $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

                        // save your data, here just save the current page
                        selections = getIdSelections()
                        // push or splice the selections if you want to save all data selections
                    })
                $table.on('all.bs.table', function(e, name, args) {
                    console.log(name, args)
                })
                $remove.click(function() {
                    var ids = getIdSelections()
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: ids
                    })
                    $remove.prop('disabled', true)
                })
            }

            $(function() {
                initTable()

                $('#locale').change(initTable)
            })
        </script>
    </div>






    <?php require_once("footer.php"); ?>




</body>

</html>
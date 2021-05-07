var $table = $('#table')
var $remove = $('#remove')



function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.id
    })
}

function responseHandler(res) {
    $.each(res.rows, function (i, row) {
        row.state = $.inArray(row.id, selections) !== -1
    })
    return res
}

function detailFormatter(index, row) {
    var html = []
    $.each(row, function (key, value) {
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
    'click .operate': function (e, value, row, index) {
        alert('You click operate action, row: ' + JSON.stringify(row))
    },
    'click .remove': function (e, value, row, index) {
        $table.bootstrapTable('remove', {
            field: 'id',
            values: [row.id]
        })
    }
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
        function () {
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

            // save your data, here just save the current page
            selections = getIdSelections()
            // push or splice the selections if you want to save all data selections
        })
    $table.on('all.bs.table', function (e, name, args) {
        console.log(name, args)
    })
    $remove.click(function () {
        var ids = getIdSelections()
        $table.bootstrapTable('remove', {
            field: 'id',
            values: ids
        })
        $remove.prop('disabled', true)
    })
}

$(function () {
    initTable()

    $('#locale').change(initTable)
})

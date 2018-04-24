
// export EXCEL, PDF, PNG, JSON
$('#export .excel').click(function () {
    $table.tableExport({type:'excel',
                mso: {fileFormat:'xlsx',
                        worksheetName: ['Table 1','Table 2', 'Table 3']}});
});

function DoCellData(cell, row, col, data) {}
function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}

$('#export .pdf').click(function () {
    $table.tableExport({fileName: 'test.pdf',
        type: 'pdf',
        jspdf: {format: 'bestfit',
                margins: {left:20, right:10, top:20, bottom:20},
                autotable: {styles: {overflow: 'linebreak'},
                            tableWidth: 'wrap',
                            tableExport: {onBeforeAutotable: DoBeforeAutotable, onCellData: DoCellData}
                }
        }
    });
});

$('#export .png').click(function () {
    $table.tableExport({type:'png'});
});

$('#export .json').click(function () {
    $table.tableExport({type:'json'});
});


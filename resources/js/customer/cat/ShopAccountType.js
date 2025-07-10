$(document).ready(function()
{
    
    var table = $('#dt_ShopAccountType').DataTable({            
        processing: true,
        "bFilter": true,
        "sDom": 'frBtlip',  
        "ordering": false,
        "language": {
            search: ' ',
            sLengthMenu: '_MENU_',
            searchPlaceholder: window.appTranslates.Search,
            sLengthMenu: window.appTranslates.Mostrar + '_MENU_ '+ window.appTranslates.Row_Per_page,
            entries: {
                _: window.appTranslates.Entries,
                1: window.appTranslates.Entries
            },
            info: window.appTranslates.Mostrando + " _START_ " + window.appTranslates.to +" _END_ "+window.appTranslates.of+" _TOTAL_ "+window.appTranslates.Entries,
            infoEmpty: window.appTranslates.No_Records,
            zeroRecords: window.appTranslates.No_Records,
            paginate: {
                next: ' <i class=" fa fa-angle-right"></i>',
                previous: '<i class="fa fa-angle-left"></i> '
            },
            },
            ajax: window.appRoutes.Customer_Cat_Shopaccounttype_Index,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Listado_Roles',
                    className: 'btnExcelHidden',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Listado_Roles',
                    className: 'btnPdfHidden',
                    exportOptions: {
                        columns: ':visible'
                    },
                    orientation: 'portrait', // o 'landscape'
                    pageSize: 'letter'
                }
            ],
            columns: [                        
                    {
                        data: 'clave', 
                        name: 'clave',                                                                    
                    },      
                    {
                        data: 'descr', 
                        name: 'descr',                      
                    },             
                    {
                        data: 'estatus', 
                        name: 'estatus',
                        render: function (data, type) {                            
                            return type === 'display' && data == 1 ?
                            '<span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>'+window.appTranslates.Estatus_Activo+ '</span>':
                            '<span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>'+window.appTranslates.Estatus_Inactivo+ '</span>';
                        },                        
                    },           
                    {
                        data: 'action', name: 'action', 
                        orderable: false, searchable: false,
                        
                    },
                ],            
        initComplete: (settings, json)=>{
            $('.dataTables_filter').appendTo('#tableSearch');
            $('.dataTables_filter').appendTo('.search-input');

        },	
    });
    
    
	$('#btnExportExcel').on('click', function () {
        table.button('.btnExcelHidden').trigger();
    });  
    $('#btnExportPDF').on('click', function () {        
        table.button('.btnPdfHidden').trigger();
    });
    $(document).on("click",".Refresh",function(evento){
        table.ajax.reload(null, false); // Actualizar la tabla sin reiniciar la paginación
    });   
    table.on('preXhr.dt', function () {
        $('#DataTableLoading').show();
        $('#DataTableRefresh').hide();
    });

    // Ocultar loader después de que llega la respuesta
    table.on('xhr.dt', function () {
        $('#DataTableLoading').hide();
        $('#DataTableRefresh').show();
    });
    
            
});       


document.addEventListener('DOMContentLoaded', function () {
    // Selección por columna (acción)
    document.querySelectorAll('.select-column').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const action = this.dataset.action;
            document.querySelectorAll('.checkbox-' + action).forEach(cb => {
                cb.checked = this.checked;
            });
        });
    });

    // Selección por fila (módulo)
    document.querySelectorAll('.select-row').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const module = this.dataset.module;
            document.querySelectorAll('.checkbox-' + module).forEach(cb => {
                cb.checked = this.checked;
            });
        });
    });
});
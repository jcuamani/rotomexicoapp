$(document).ready(function()
{
    
    var table = $('.datatable').DataTable({            
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
            ajax: window.appRoutes.Admin_Users_Index,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Listado_Usuarios',
                    className: 'btnExcelHidden',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Listado_Usuarios',
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
                        data: 'name', 
                        name: 'name',                                                                    
                    },      
                    {
                        data: 'email', 
                        name: 'email',                      
                    },    
                    {
                        data: 'status', 
                        name: 'status',
                        render: function (data, type) {                            
                            return type === 'display' && data == 1 ?
                            '<span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>'+window.appTranslates.Estatus_Activo+ '</span>':
                            '<span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>'+window.appTranslates.Estatus_Inactivo+ '</span>';
                        },                        
                    },    
                    {
                        data: 'last_login_at', 
                        name: 'last_login_at',
                        
                        render: function ( data, type ) {
                            
                            if (!data) {
                                return '<span class="text-muted">-</span>';
                            }
                                if(type === 'display' && data != null )
                                {
                                    return moment(data).format('DD/MM/YYYY HH:mm');                                

                                }  else {
                                    return data;
                                }   
                            }                                                 
                        
                    }, 
                    {
                        data: 'roles', 
                        name: 'roles',
                        render: function (data, type, row) {
                            // si es string, convertir a array
                            if (typeof data === 'string') {
                                data = data.split(',');
                            }

                            // si no es array válido
                            if (!Array.isArray(data) || data.length === 0) {
                                return '<span class="text-muted">-</span>';
                            }

                            return data.map(role => `<span class="badge bg-info">${role.name}</span>`).join(' ');
                        }
                        
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


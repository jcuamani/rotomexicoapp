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
            ajax: window.appRoutes.Admin_Rol_Index,
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
                        data: 'name', 
                        name: 'name',                                                                    
                    },      
                    {
                        data: 'guard_name', 
                        name: 'guard_name',                      
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
    $(document).on("click",".ButonAdd",function(evento){
        event.preventDefault(); // Evitar el envío del formulario
        NewEditWindow(0);
    });
    
    $(document).on("click",".ButonEdit",function(evento){
        event.preventDefault(); // Evitar el envío del formulario
        var valor = $(this).attr('data-init-reg');
        NewEditWindow(valor);
    });
            
});       
function NewEditWindow(reg) {
    $('#form_add_modal').remove();
    var url = window.appRoutes.Admin_Rol_Modal_Add;
    url = url.replace(':reg', reg);
    fetch(url)
    .then(response => response.text())
    .then(html => {
        
        $('body').append(html);
        $('#form_add_modal').modal('handleUpdate',{backdrop: 'static', keyboard: false})
        $('#form_add_modal').modal('show');
        
        $(".close_modal").click(function(){
            $("#form_add_modal").modal("hide");
            montoAplicar0 = 0;
            
        });

        $(".guardar_modal").click(function(){

            
            $("#form_add_rol").submit();
                                
            
        });
        
    })
}

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
var url;

$(function() {
    function initDataTables(){
        /* Set the defaults for DataTables initialisation */
        $.extend( true, $.fn.dataTable.defaults, {
            "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            }
        } );


        /* Default class modification */
        $.extend( $.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
        } );


        /* API method to get paging information */
        $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
        {
            return {
                "iStart":         oSettings._iDisplayStart,
                "iEnd":           oSettings.fnDisplayEnd(),
                "iLength":        oSettings._iDisplayLength,
                "iTotal":         oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage":          oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
                "iTotalPages":    oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
            };
        };


        /* Bootstrap style pagination control */
        $.extend( $.fn.dataTableExt.oPagination, {
            "bootstrap": {
                "fnInit": function( oSettings, nPaging, fnDraw ) {
                    var oLang = oSettings.oLanguage.oPaginate;
                    var fnClickHandler = function ( e ) {
                        e.preventDefault();
                        if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                            fnDraw( oSettings );
                        }
                    };

                    $(nPaging).append(
                            '<ul class="pagination no-margin">'+
                            '<li class="prev disabled page-item"><a class="page-link" href="#">'+oLang.sPrevious+'</a></li>'+
                            '<li class="next disabled page-item"><a class="page-link" href="#">'+oLang.sNext+'</a></li>'+
                            '</ul>'
                    );
                    var els = $('a', nPaging);
                    $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
                    $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
                },

                "fnUpdate": function ( oSettings, fnDraw ) {
                    var iListLength = 5;
                    var oPaging = oSettings.oInstance.fnPagingInfo();
                    var an = oSettings.aanFeatures.p;
                    var i, ien, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

                    if ( oPaging.iTotalPages < iListLength) {
                        iStart = 1;
                        iEnd = oPaging.iTotalPages;
                    }
                    else if ( oPaging.iPage <= iHalf ) {
                        iStart = 1;
                        iEnd = iListLength;
                    } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                        iStart = oPaging.iTotalPages - iListLength + 1;
                        iEnd = oPaging.iTotalPages;
                    } else {
                        iStart = oPaging.iPage - iHalf + 1;
                        iEnd = iStart + iListLength - 1;
                    }

                    for ( i=0, ien=an.length ; i<ien ; i++ ) {
                        // Remove the middle elements
                        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                        // Add the new list items and their event handlers
                        for ( j=iStart ; j<=iEnd ; j++ ) {
                            sClass = (j==oPaging.iPage+1) ? 'class="page-item active"' : 'class="page-item"';
                            $('<li '+sClass+'><a class="page-link" href="#">'+j+'</a></li>')
                                .insertBefore( $('li:last', an[i])[0] )
                                .bind('click', function (e) {
                                    e.preventDefault();
                                    oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                                    fnDraw( oSettings );
                                } );
                        }

                        // Add / remove disabled classes from the static elements
                        if ( oPaging.iPage === 0 ) {
                            $('li:first', an[i]).addClass('disabled');
                        } else {
                            $('li:first', an[i]).removeClass('disabled');
                        }

                        if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                            $('li:last', an[i]).addClass('disabled');
                        } else {
                            $('li:last', an[i]).removeClass('disabled');
                        }
                    }
                }
            }
        } );

        var unsortableColumns = [];
        $('#data-table').find('thead th').each(function(){
            if ($(this).hasClass( 'no-sort')){
                unsortableColumns.push({"bSortable": false});
            } else {
                unsortableColumns.push(null);
            }
        });

        $("#data-table").dataTable({
            "sDom": "<'row'<'col-lg-6 hidden-sm-down'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sInfo": "Showing <strong>_START_ to _END_</strong> of _TOTAL_ entries"
            },
            "oClasses": {
              "sFilter": "float-right",
              "sFilterInput": "form-control input-rounded ml-sm"
            },
            "aoColumns": unsortableColumns,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": base_url+"admin/auth/users_json",
                "type": "GET"
            },
            "responsive": {
                "details": {
                    "display": $.fn.dataTable.Responsive.display.modal(),
                    "renderer": $.fn.dataTable.Responsive.renderer.tableAll( {
                        "tableClass": 'table'
                    } )
                }
            },
            "order": [[1, 'asc']],
            "columnDefs": [{ 
                "targets": [0,4],
                "orderable": false
            }]
        });

        $(".dataTables_length select").selectpicker({
            width: 'auto'
        });
    }


    function crud_submit() {
        var form = $('form#form_crud');
        form.submit(function(e) {
            e.preventDefault();
            // console.log('submit data form crud '+ is_new_record) ;
            if(url !== undefined){
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function(rs) {
                        if (rs.success == false) {
                            Messenger().post({
                                message: rs.msg,
                                type: 'error',
                                showCloseButton: true
                            });
                        } else {
                            Messenger().post({
                                message: rs.msg,
                                type: 'success',
                                showCloseButton: true
                            });
                            reload_table();
                            close_crud();
                        }
                    }, 
                    error: function() {
                        Messenger().post({
                            message: 'Ops! Something error!',
                            type: 'error',
                            showCloseButton: true
                        });
                    } 
                }); 
            }
        })
    }

    function pageLoad() {
        initDataTables();
        crud_submit();
    }

    pageLoad();
})

function create() {
    url = base_url+'admin/auth/store'; 
    $('#modal_crud_label').text('Tambah User Baru');
    $('#modal_crud').modal('show');
}

function edit(id) {
    url = base_url+'admin/auth/update';
    $('#modal_crud_label').text('Ubah Data User');
    $('#modal_crud').modal('show');
    $('#password').removeAttr('required');
    $('#password_confirm').removeAttr('required');

    $.getJSON(base_url+'admin/auth/user_edit_json', { id:id }, function(rs) {
        $('#first_name').val(rs.data.first_name);        
        $('#last_name').val(rs.data.last_name);        
        $('#email').val(rs.data.email).attr('disabled', 'disabled');        
        $('#phone').val(rs.data.phone);        
        $('#company').val(rs.data.company);        
        $('form#form_crud').append('<input type="hidden" name="id" id="id" value="'+rs.data.id+'">');
        $('<small>* Biarkan kosong jika tidak diubah</small>').insertAfter('#password');        
    });
}

function destroy(id) {
    var choice = confirm("Anda yakin menghapus data ini?");
    if (choice) {
        $.getJSON(base_url+'admin/auth/destroy', { id:id }, function(rs) { reload_table() });
    }else {
      return false;
    }
}

function close_crud() {
    url = undefined;
    $('#modal_crud').modal('hide');
    $('form#form_crud').trigger('reset');
    $('#email').removeAttr('disabled');
    $('#password').attr('required', 'required');
    $('#password_confirm').attr('required', 'required');   
    $('#id').remove();     
    $( "small" ).remove( ":contains('* Biarkan kosong jika tidak diubah')" );
    return false;
}

function reload_table() {
    $('#data-table').DataTable().ajax.reload(null, false);
}
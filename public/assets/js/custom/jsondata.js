$(document).ready(function () {
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target);
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        var parentId = $(this).parent().parent().parent().attr('id');
        if( parentId == 'upload'){
            var flag = 1;
            var tableListLength = $('#table_list').find(":selected").val();
            var jsonUploadfile = $('#json_file').prop('files').length;
            if( jsonUploadfile == '' ){
                flag = 0;
                addErrorMessage('json_file','Please Upload JSON file.')
            } else {
                if( $('#json_file').prop('files')[0]['type'] != 'application/json' ){
                    flag = 0;
                    addErrorMessage('json_file','Please Upload only JSON file format.');
                } else {
                    flag = 1;
                    addErrorMessage('json_file','');
                }
            } 
            
            if( ( tableListLength == 0 ) ){
                flag = 0;
                addErrorMessage('table_list','Please select Any one Option.');
            }
             
            if( flag == 1 ){
               
                var data = new FormData();
                var form_data = $('#json_add_data_form').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });

                var file_data = $('input[name="json_file"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("json_file[]", file_data[i]);
                }
                data.append('_token',CSRF_TOKEN);
                data.append('key', 'value');
                $.ajax({
                    url: URL+"/get-json-data",
                    method: "post",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: data,
                    cache: false,
                    success: function (response) {
                        console.log(1)
                        $('#db_fields_mapping').empty().append(response);

                        setTimeout(function(){
                            $('#db_fields_mapping .col-md-12').each(function(){
                                if( $(this).find('.col-md-4 .form-control').hasClass('json-datetime') ){
                                    var dateId = $(this).find('.col-md-4 .json-datetime').attr('id');
                                    $('#'+dateId).daterangepicker({
                                        autoUpdateInput: false,
                                        timePicker : true,
                                        singleDatePicker:true,
                                        timePicker24Hour : true,
                                        timePickerIncrement : 1,
                                        timePickerSeconds : true,
                                        locale: {
                                            format: 'MM-DD-YYYY HH:mm:ss',
                                        },
                                    }, (from_date) => {
                                        $('#'+dateId).val(from_date.format('MM-DD-YYYY HH:mm:ss'));
                                    });
                                }
                                if( $(this).find('.col-md-4 .form-control').hasClass('json-year')){
                                    var dateId = $(this).find('.col-md-4 .json-year').attr('id');
                                    $('#'+dateId).datepicker({
                                        format: "yyyy",
                                        viewMode: "years",
                                        minViewMode: "years"
                                    });
                                }
                            });
                            var active = $('.wizard .nav-tabs li.active');
                            active.next().removeClass('disabled');
                            nextTab(active);
                        }, 1000);
                        return true;
                    },
                    error: function (response) {
                        console.log(response)
                        return false;
                    }
                });
            } else {
                return false;
            }
        } else if( parentId == 'fieldmapping') {
            $('#db_fields_mapping .col-md-12').each(function(){
                if( $(this).find('.col-md-4 .form-control').attr('attr-key') == 'bigint' ){
                    var fieldInput = $(this).find('.mapping select[name="select_db_field[]"]');
                    var fieldVal = fieldInput.val();
                    if( fieldVal == '' ){
                        var inputId = fieldInput.attr('id');
                        fieldInput.parent().find('label').empty();
                        fieldInput.parent().append('<label class="error invalid-feedback" for="'+inputId+'">This Field is Required.</label>');
                    }
                }
            });
            return false;
        } else {
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
        }

    });
    $(".prev-step").click(function (e) {
        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


$('.nav-tabs').on('click', 'li', function() {
    $('.nav-tabs li.active').removeClass('active');
    $(this).addClass('active');
});

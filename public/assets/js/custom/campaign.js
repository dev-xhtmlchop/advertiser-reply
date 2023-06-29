$(document).ready(function(){
    /* Campaign page Start  */

    $('#campaign_table').DataTable({
        pageLength: 10,
        rowReorder: true,
        columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: false, targets: '_all' }
        ]
    });
    $('#campaign_table input[name="deal_number"]').click(function(){
        var editCampaignDealId = $(this).val();
        var editCampaignId = $(this).attr('autoid');
        $('#edit_campaign_id').attr('dealid',editCampaignDealId).attr('autoincrementid',editCampaignId).removeAttr("disabled");
    })
    $('.campaign-view-sec #edit_campaign_id').click(function(){
        var dealId = $(this).attr('dealid');
        var autoIncrementId = $(this).attr('autoincrementid');
        window.location.href = URL+'/campaign/edit/'+dealId;
    });

    /* Campaign page End  */

    /* Edit Campaign page Start */
    function checkedCheckbox( fieldName, fieldValue ){
        if( fieldValue == 1 ){
            $(fieldName).prop('checked',true);
        }else{
            $(fieldName).prop('checked',false);
        }
    }

    function dataAppend( fieldName, fieldValue ){
        $(fieldName).empty().append(fieldValue);
    }

    function dataValue( fieldName, fieldValue ){
        $(fieldName).val(fieldValue);
    }

    function getCampaignDetail(){
        var url = URL+'/get-campaign-detail';
        var currentUrl = window.location.href;
        var splitArray = currentUrl.split('/');
        var thirdLastVal = splitArray[splitArray.length - 3];
        var secondLastVal = splitArray[splitArray.length - 2];
        var firstLastVal = splitArray[splitArray.length - 1];
        if( thirdLastVal == 'campaign' && secondLastVal == 'edit' ){
            $.ajax({
                url: url,
                type: 'POST',
                data: {_token: CSRF_TOKEN, campaignId: firstLastVal },
                success: function(response){
                    console.log( response )
                    if( response.status == 1 ){
                        var campaignArrayData = response.data.campaign_data;
                        console.log( campaignArrayData )
                        /* Step 1 General */
                        dataValue('input[name="campaign_number"]', campaignArrayData.campaign_id );
                        dataValue('input[name="campaign_name"]', campaignArrayData.name );
                        dataValue('input[name="brand_name"]', campaignArrayData.brand_name );
                        dataValue('input[name="media_line_name"]', campaignArrayData.media_name );
                        dataValue('input[name="dollar_rate"]', campaignArrayData.rate );
                        dataValue('input[name="agency_name"]', campaignArrayData.agency_name );
                        dataValue('input[name="demo_name"]', campaignArrayData.demo );
                        dataValue('input[name="ae_name"]', campaignArrayData.ae );
                        dataValue('input[name="outlet_name"]', campaignArrayData.outlets_name );
                        dataValue('input[name="market_place"]', campaignArrayData.market_place );
                        dataValue('input[name="realistic"]', campaignArrayData.realistic );
                        dataValue('input[name="agency_commision"]', campaignArrayData.agency_commission );
                        dataValue('input[name="revenue_risk"]', campaignArrayData.revenue );

                        /* Step 1 End */

                        /* Step 2 Demographic */
                        $('#edit_campaign select#demographic_name').prop("disabled", true);
                        $('#edit_campaign select#demographic_name option').each(function(){
                            var value = $(this).val();
                            if( campaignArrayData.demographic_id == value ){
                                $(this).prop('selected', true);
                            }else{
                                $(this).prop('selected', false);
                            }
                        })
                        /* Step 2 End */

                        /* Step 3 Flighting */
                        var campaignFlightStartDate = moment(campaignArrayData.flight_start_date).format('MM/DD/YYYY');
                        var campaignFlightEndDate = moment(campaignArrayData.flight_end_date).format('MM/DD/YYYY');

                        /* Flight Time Day & Flight fields */

                        dataValue('input[name="campaign_flight_start_date"]', campaignFlightStartDate );
                        dataValue('input[name="campaign_flight_end_date"]', campaignFlightEndDate );
                        dataValue('input[name="campaign_day_parts"]', campaignArrayData.time_day_part );

                        /* Flight Table Section */
                        checkedCheckbox('#edit_flight #sunday', campaignArrayData.sunday);
                        checkedCheckbox('#edit_flight #monday', campaignArrayData.monday);
                        checkedCheckbox('#edit_flight #tuesday', campaignArrayData.tuesday);
                        checkedCheckbox('#edit_flight #wednesday', campaignArrayData.wednesday);
                        checkedCheckbox('#edit_flight #thursday', campaignArrayData.thursday);
                        checkedCheckbox('#edit_flight #friday', campaignArrayData.friday);
                        checkedCheckbox('#edit_flight #saturday', campaignArrayData.saturday);

                        dataValue('#edit_flight #sunday_split', campaignArrayData.sunday_split );
                        dataValue('#edit_flight #monday_split', campaignArrayData.monday_split );
                        dataValue('#edit_flight #tuesday_split', campaignArrayData.tuesday_split );
                        dataValue('#edit_flight #wednesday_split', campaignArrayData.wednesday_split );
                        dataValue('#edit_flight #thursday_split', campaignArrayData.thursday_split );
                        dataValue('#edit_flight #friday_split', campaignArrayData.friday_split );
                        dataValue('#edit_flight #saturday_split', campaignArrayData.saturday_split );

                        /* Step 3 End */
                        
                        /* Step 4 Summary */
                        
                        
                        dataAppend('#summary .demo_name', campaignArrayData.demo);
                        dataAppend('#summary .ae_name', campaignArrayData.ae);
                        dataAppend('#summary .outlet_name', campaignArrayData.outlets_name);
                        dataAppend('#summary .new-campaign-id', campaignArrayData.campaign_id);
                        dataAppend('#summary .change_by', campaignArrayData.change_by);
                        dataAppend('#summary .campaign_number, #new_campaign_table .new-campaign-id, #old_campaign_table .old-campaign-id', campaignArrayData.campaign_id );
                        dataAppend('#summary .campaign_name, #new_campaign_table .new-campaign-name, #old_campaign_table .old-campaign-name', campaignArrayData.name);
                        dataAppend('#new_campaign_table .new-campaign-deal-name, #old_campaign_table .old-campaign-deal-name', campaignArrayData.deal_payloads_name);
                        dataAppend('#new_campaign_table .new-campaign_day-time, #old_campaign_table .old-campaign_day-time', campaignArrayData.day_time );
                        dataAppend('#summary .brand_name, #new_campaign_table .new-campaign-brand, #old_campaign_table .old-campaign-brand', campaignArrayData.brand_name);
                        dataAppend('#new_campaign_table .new-campaign-start-flight-date, #old_campaign_table .old-campaign-start-flight-date, .old-campaign-table .flight-stat-date-text', campaignArrayData.flight_start_date);
                        dataAppend('#new_campaign_table .new-campaign-end-flight-date, #old_campaign_table .old-campaign-end-flight-date, .old-campaign-table .flight-end-date-text', campaignArrayData.flight_end_date);
                        dataAppend('#summary .media_line_name, #new_campaign_table .new-campaign-media-line, #old_campaign_table .old-campaign-media-line', campaignArrayData.media_name);
                        dataAppend('#new_campaign_table .new-campaign-inv-type, #old_campaign_table .old-campaign-inv-type', campaignArrayData.inventory_type );
                        dataAppend('#new_campaign_table .new-campaign-inv-type, #old_campaign_table .old-campaign-inv-type', campaignArrayData.inventory_type );
                        dataAppend('#new_campaign_table .new-campaign-inv-length, #old_campaign_table .old-campaign-inv-length', campaignArrayData.inventory_length );
                        dataAppend('#new_campaign_table .new-campaign-rate, #old_campaign_table .old-campaign-rate', campaignArrayData.rate );
                        dataAppend('#new_campaign_table .new-campaign-do-rate, #old_campaign_table .old-campaign-do-rate', campaignArrayData.rc_rate );
                        dataAppend('#new_campaign_table .new-campaign-per-rate, #old_campaign_table .old-campaign-per-rate', campaignArrayData.rc_rate_percentage );
                        dataAppend('#new_campaign_table .new-campaign-total-avail, #old_campaign_table .old-campaign-total-avail', campaignArrayData.total_avil );
                        dataAppend('#new_campaign_table .new-campaign-total-unit, #old_campaign_table .old-campaign-total-unit', campaignArrayData.total_unit );                        
                    }
                }
            });
        }
    }

    getCampaignDetail();

    /* All Tab add Active Class */

    $('.campaign-edit .tab-btn').click(function(e){
        e.preventDefault();
        var tabClass = $(this).attr('attr-active'); 
        $('ul.nav-tabs li a').each(function(){
            console.log( $(this).attr('class'));
            $(this).removeClass('active').attr('aria-selected', false);
        });
        $('#'+tabClass).addClass('active').attr('aria-selected', true);;

        $('#content .tab-pane').each(function(){
            $(this).removeClass('show').removeClass('active');
        });
        $('.'+tabClass+'-tab').addClass('show').addClass('active');
        getCampaignDetail();
    });

    /* Flight & Ad Length Section Start */ 
    $('input[name="flight_start_date"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'MM/DD/YYYY',
        },
        singleDatePicker: true
    }, (from_date) => {
        $('input[name="flight_start_date"]').val(from_date.format('MM/DD/YYYY'));
    });

    $('input[name="flight_end_date"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'MM/DD/YYYY',
        },
        singleDatePicker: true
    }, (from_date) => {
        $('input[name="flight_end_date"]').val(from_date.format('MM/DD/YYYY'));
    });
    $('input[name="ad_length"]').daterangepicker({
        timePicker : true,
        singleDatePicker:true,
        timePicker24Hour : true,
        timePickerIncrement : 1,
        timePickerSeconds : true,
        locale : {
            format : 'HH:mm:ss'
        },
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    /** Flight Change Event  */
    $('#flight_start_date').on('apply.daterangepicker', function(){
        var startDate = $(this).val();
        $('#summary .new-flight-stat-date-text').empty().text(startDate);
        $('#new_campaign_table td.new-campaign-start-flight-date').empty().text(startDate);
    });

    $('#flight_end_date').on('apply.daterangepicker', function(){
        var endDate = $(this).val();
        $('#summary .new-flight-end-date-text').empty().text(endDate)
        $('#new_campaign_table td.new-campaign-end-flight-date').empty().text(endDate);
    });

    /* Flight Section End */



    $('input[name="sunday_split"], input[name="monday_split"], input[name="tuesday_split"], input[name="wednesday_split"], input[name="thursday_split"], input[name="friday_split"], input[name="saturday_split"]').keypress(function (e) {    
        console.log( $(this).val() );
        var currentVal = $(this).val();
        if( currentVal >= 100 ){
            var changeValue = currentVal.substring(0,currentVal.length - 1);
            $(this).val(changeValue);
            return false;
        }
    });
    /*$('input[name="sunday_split"], input[name="monday_split"], input[name="tuesday_split"], input[name="wednesday_split"], input[name="thursday_split"], input[name="friday_split"], input[name="saturday_split"]').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9-%]/g)) {
            return false;
        } 
    }); 
    $('input[name="sunday_split"], input[name="monday_split"], input[name="tuesday_split"], input[name="wednesday_split"], input[name="thursday_split"], input[name="friday_split"], input[name="saturday_split"]').on('input', function(e) {
        $(this).val(function(i, v) {
         return v.replace('%','') + '%';  
        });
    });*/

    

    /* Edit Campaign page End  */
   
});
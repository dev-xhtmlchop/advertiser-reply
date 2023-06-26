$(document).ready(function(){
    
    $('#campaign_table').DataTable({
        "pageLength": 10,
        "ordering": false
    });
    $('input[name="flight_start_date"], input[name="flight_end_date"]').daterangepicker({
        locale: {
            format: 'MM/DD/YYYY',
      },
      singleDatePicker: true
    });
    $('input[name="sunday_split"]').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9-%]/g)) {
            return false;
        } 
    }); 
    $("input[name='sunday_split']").on('input', function(e) {
        $(this).val(function(i, v) {
         return v.replace('%','') + '%';  
        });
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
    $('#campaign_table input[name="deal_number"]').click(function(){
        var editCampaignDealId = $(this).val();
        var editCampaignId = $(this).attr('autoid');
        $('#edit_campaign').attr('dealid',editCampaignDealId).attr('autoincrementid',editCampaignId).removeAttr("disabled");
    })
    $('.campaign-list #edit_campaign').click(function(){
        var dealId = $(this).attr('dealid');
        var autoIncrementId = $(this).attr('autoincrementid');
        window.location.href = URL+'/campaign/edit/'+dealId;
    });
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
                    $('input[name="campaign_number"]').val(campaignArrayData.campaign_id);
                    $('input[name="campaign_name"]').val(campaignArrayData.name);
                    $('input[name="brand_name"]').val(campaignArrayData.brand_name);
                    $('input[name="media_line_name"]').val(campaignArrayData.media_name);
                    $('input[name="dollar_rate"]').val(campaignArrayData.rate);
                    $('input[name="agency_name"]').val(campaignArrayData.agency_name);
                    $('input[name="demo_name"]').val(campaignArrayData.demo);
                    $('input[name="ae_name"]').val(campaignArrayData.ae);
                    $('input[name="outlet_name"]').val(campaignArrayData.outlets_name);
                    $('input[name="market_place"]').val(campaignArrayData.market_place);
                    $('input[name="realistic"]').val(campaignArrayData.realistic);
                    $('input[name="agency_commision"]').val(campaignArrayData.agency_commission);
                    $('input[name="revenue_risk"]').val(campaignArrayData.revenue);

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
                    
                    /* Step 3 Flighting */
                    var campaignFlightStartDate = moment(campaignArrayData.flight_start_date).format('MM/DD/YYYY');
                    $('input[name="campaign_flight_start_date"]').val(campaignFlightStartDate);
                    var campaignFlightEndDate = moment(campaignArrayData.flight_end_date).format('MM/DD/YYYY');
                    $('input[name="campaign_flight_end_date"]').val(campaignFlightEndDate);
                    $('input[name="campaign_day_parts"]').val(campaignArrayData.day_parts_name);

                    /* Step 4 Summary */
                    $('#summary .campaign_number').empty().append(campaignArrayData.campaign_id);
                    $('#summary .campaign_name').empty().append(campaignArrayData.name);
                    $('#summary .brand_name').empty().append(campaignArrayData.brand_name);
                    $('#summary .media_line_name').empty().append(campaignArrayData.media_name);
                    $('#summary .demo_name').empty().append(campaignArrayData.demo);
                    $('#summary .ae_name').empty().append(campaignArrayData.ae);
                    $('#summary .outlet_name').empty().append(campaignArrayData.outlets_name);
                    
                }
            }
        });
    }
});
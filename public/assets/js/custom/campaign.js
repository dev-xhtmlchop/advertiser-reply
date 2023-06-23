$(document).ready(function(){
    $('#campaign_table').DataTable({
        "pageLength": 2,
        "ordering": false
    });
    $('input[name="deal_number"]').click(function(){
        var editCampaignDealId = $(this).val();
        var editCampaignId = $(this).attr('autoid');
        $('#edit_campaign').attr('dealid',editCampaignDealId).attr('autoincrementid',editCampaignId).removeAttr("disabled");
    })
    $('#edit_campaign').click(function(){
        var dealId = $(this).attr('dealid');
        var autoIncrementId = $(this).attr('autoincrementid');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var URL = $("meta[name='web-url']").attr('content');
        var url = URL+'/get-edit-campaign';
        $.ajax({
            url: url,
            type: 'POST',
            data: {_token: CSRF_TOKEN, id: dealId, autoId:autoIncrementId },
            success: function(response){
                console.log( response )
            }
        });
    });
});
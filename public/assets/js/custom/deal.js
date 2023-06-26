$(document).ready(function(){
    getDealViewData();
    $("#deal_status").change(function(){
        var dealStatus = $(this).val();
        getDealViewData( dealStatus );
    });
    $('#deals_table').DataTable({
        "pageLength": 10,
        "ordering": false
    });
});
function getDealViewData( dealStatus = null){
    var url = URL+'/post-deal-status';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN, data: dealStatus},
        success: function(response){
            if( response ){
                $('#deal_dollars').empty().append('$'+Number(nullNumber(response.rate)).toLocaleString('en'));
                $('#deal_cpm').empty().append('$'+nullNumber(response.cpm));
                $('#deal_deal_unit').empty().append(Number(nullNumber(response.deal_unit)).toLocaleString('en'));
                $('#deal_grp').empty().append(nullNumber(response.grp));
                $('#deal_impressions').empty().append(Number(nullNumber(response.impressions)).toLocaleString('en'));
                return true;
            }else{
                return fasle;
            }
        }
    });
}
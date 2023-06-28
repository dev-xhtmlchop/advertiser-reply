$(document).ready(function(){
    getDealViewData();
    $("#deal_status").change(function(){
        var dealStatus = $(this).val();
        getDealViewData( dealStatus );
    });
    $('#deals_table').DataTable({
        pageLength: 10,
        rowReorder: true,
        columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: false, targets: '_all' }
        ]
    });
});
function getDealViewData( dealStatus = null){
    var url = URL+'/post-deal-status';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN, data: dealStatus},
        success: function(response){
            $('#deals_table').DataTable().destroy();
            $('#deal_view_body').empty().append(response.deal_table_html);
            $('#deals_table').DataTable().draw();
            if( response.deal_view_data ){
                var dealViewData = response.deal_view_data;
                $('#deal_dollars').empty().append('$'+Number(nullNumber(dealViewData.rate)).toLocaleString('en'));
                $('#deal_cpm').empty().append('$'+nullNumber(dealViewData.cpm));
                $('#deal_deal_unit').empty().append(Number(nullNumber(dealViewData.deal_unit)).toLocaleString('en'));
                $('#deal_grp').empty().append(nullNumber(dealViewData.grp));
                $('#deal_impressions').empty().append(Number(nullNumber(dealViewData.impressions)).toLocaleString('en'));
                return true;
            }else{
                return fasle;
            }
        }
    });
}
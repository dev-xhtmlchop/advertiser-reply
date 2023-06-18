$(document).ready(function(){
    getDealDashboardData( null );
    getAdvertiserDashboardData( null)
    $("input[name='daterange']").daterangepicker({
        autoUpdateInput: false,
        }, (from_date, to_date) => {
            $("input[name='daterange']").val(from_date.format('MM-DD-YYYY') + ' - ' + to_date.format('MM-DD-YYYY'));
            $("#start_daterange").val(from_date.format('YYYY-MM-DD'));
            $("#end_daterange").val(to_date.format('YYYY-MM-DD'));
    });

    $("input[name='advertiser_daterange']").daterangepicker({
        autoUpdateInput: false,
        }, (from_date, to_date) => {
            $("input[name='advertiser_daterange']").val(from_date.format('MM-DD-YYYY') + ' - ' + to_date.format('MM-DD-YYYY'));
            $("#advertiser_start_daterange").val(from_date.format('YYYY-MM-DD'));
            $("#advertiser_end_daterange").val(to_date.format('YYYY-MM-DD'));
    });
    
    // Deal No Change
    $("#deal_no, #campaign, #demographics, #outlet, #agency, #location, #brand").change(function(){
        var dealNo = $(this).val();
        //
        var selectOptionObject = {};
        $("form#dashboard_deal select").each(function(){
            var selectOptionsValue = $(this).find(":selected").val();
            var selectOptionsId = $(this).attr('id');
            selectOptionObject[selectOptionsId] = selectOptionsValue;
        });
        var dateRangeVal = $("#daterange").val();
        selectOptionObject['daterange'] = dateRangeVal;
        selectOptionObject['start_daterange'] = $("#start_daterange").val();
        selectOptionObject['end_daterange'] = $("#end_daterange").val();
        console.log(selectOptionObject)
        getDealDashboardData( selectOptionObject );
    });
    
    $('#daterange').on('apply.daterangepicker', function(ev, picker){ 
        var selectOptionObject = {};
        $("form#dashboard_deal select").each(function(){
            var selectOptionsValue = $(this).find(":selected").val();
            var selectOptionsId = $(this).attr('id');
            selectOptionObject[selectOptionsId] = selectOptionsValue;
        });
        var dateRangeVal = $("#daterange").val();
        selectOptionObject['daterange'] = $(this).val();
        selectOptionObject['start_daterange'] = $("#start_daterange").val();
        selectOptionObject['end_daterange'] = $("#end_daterange").val();
        console.log(selectOptionObject)
        getDealDashboardData( selectOptionObject );
    });

    $('#advertiser_daterange').on('apply.daterangepicker', function(ev, picker){
        var advertiserStartDate = $("#advertiser_start_daterange").val();
        var advertiserEndDate = $("#advertiser_end_daterange").val();
        var selectOptionObject = {};
        selectOptionObject['start_date'] = advertiserStartDate;
        selectOptionObject['end_date'] = advertiserEndDate;
        getAdvertiserDashboardData( selectOptionObject );
    });
});

function getDealDashboardData( selectOptionObject = null){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var URL = $("meta[name='web-url']").attr('content');
    var url = URL+'/deal-dashboard';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN, data: selectOptionObject},
        success: function(response){
            if( response ){
                $('#deal_dollars').val('$'+Number(nullNumber(response.rate)).toLocaleString('en'));
                $('#deal_cpm').val('$'+nullNumber(response.cpm));
                $('#deal_deal_unit').val(Number(nullNumber(response.deal_unit)).toLocaleString('en'));
                $('#deal_grp').val(nullNumber(response.grp));
                $('#deal_impressions').val(Number(nullNumber(response.impressions)).toLocaleString('en'));
                return true;
            }else{
                return fasle;
            }
        }
    });
}

function getAdvertiserDashboardData( selectOptionObject = null){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var URL = $("meta[name='web-url']").attr('content');
    var url = URL+'/advertiser-dashboard';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN, data: selectOptionObject},
        success: function(response){
            console.log(response)
            $("#advertiser_inflight").val(response.inflight+" Inflight");
            $("#advertiser_proposal").val(response.proposal+" Proposal");
            $("#advertiser_ended").val(response.ended+" Ended");
            $("#advertiser_approved").val(response.approved+" Approved");
            $("#advertiser_order").val(response.ordered+" Ordered");
            $("#advertiser_planning").val(response.planning+" Planning");
            $("#advertiser_expired").val(response.expired+" Expired");
        }
    });
}
$(document).ready(function(){
    getDealDashboardData( null );
    getAdvertiserDashboardData( null );
    checkForgerPasswordChange();
    $("input[name='daterange']").daterangepicker({
        autoUpdateInput: false,
        }, (from_date, to_date) => {
            $("input[name='daterange']").val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
            $("#start_daterange").val(from_date.format('YYYY-MM-DD'));
            $("#end_daterange").val(to_date.format('YYYY-MM-DD'));
    });

    $("input[name='advertiser_daterange']").daterangepicker({
        autoUpdateInput: false,
        }, (from_date, to_date) => {
            $("input[name='advertiser_daterange']").val(from_date.format('MM/DD/YYYY') + ' - ' + to_date.format('MM/DD/YYYY'));
            $("#advertiser_start_daterange").val(from_date.format('YYYY-MM-DD'));
            $("#advertiser_end_daterange").val(to_date.format('YYYY-MM-DD'));
    });
    
    // Deal No Change
    $("#deal_no, #campaign, #demographics, #outlet, #agency, #location, #brand").change(function(){
        var dealNo = $(this).val();
        //
        var selectOptionObject = {};
        $("#dashboard_deal select").each(function(){
            var selectOptionsValue = $(this).find(":selected").val();
            var selectOptionsId = $(this).attr('id');
            selectOptionObject[selectOptionsId] = selectOptionsValue;
        });
        var dateRangeVal = $("#daterange").val();
        selectOptionObject['daterange'] = dateRangeVal;
        selectOptionObject['start_daterange'] = $("#start_daterange").val();
        selectOptionObject['end_daterange'] = $("#end_daterange").val();
        console.log(selectOptionObject)
        //getFilterInterconnectData( selectOptionObject );
        getDealDashboardData( selectOptionObject );
    });
    
    $('#daterange').on('apply.daterangepicker', function(ev, picker){ 
        var selectOptionObject = {};
        $("#dashboard_deal select").each(function(){
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
    $('#deal_reset').click(function(){
        getDealDashboardData();
        $('#daterange').val('').datepicker('setDate', null);
    });
    $('#advertiser_reset').click(function(){
        getAdvertiserDashboardData();
        $('#advertiser_daterange').val('').datepicker('setDate', null);
    });

   // $("#myModal").modal('show');

});

function checkForgerPasswordChange(){
    var url = URL+'/check-changepassword';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN},
        success: function(response){
            if( response ){
                $("#changepasswrod").modal('hide');
            }else{
                $("#changepasswrod").modal('show');
            }
            return true;
        }
    });
}

function getDealDashboardData( selectOptionObject = null){
    var url = URL+'/deal-dashboard';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN, data: selectOptionObject},
        success: function(response){
            if( response.dropdown !== '' ){
                $('#deal_no').empty().append(uniqueArray(response.dropdown.deal));
                $('#campaign').empty().append(uniqueArray(response.dropdown.campaign));
                $('#demographics').empty().append(uniqueArray(response.dropdown.demographic));
                $('#outlet').empty().append(uniqueArray(response.dropdown.outlet));
                $('#agency').empty().append(uniqueArray(response.dropdown.agency));
                $('#location').empty().append(uniqueArray(response.dropdown.location));
                $('#brand').empty().append(uniqueArray(response.dropdown.brand));
            }
            if( response.result ){
                var dealData = response.result;
                $('#deal_dollars').empty().append('$'+Number(nullNumber(dealData.rate)).toLocaleString('en'));
                $('#deal_cpm').empty().append('$'+nullNumber(dealData.cpm));
                $('#deal_deal_unit').empty().append(Number(nullNumber(dealData.deal_unit)).toLocaleString('en'));
                $('#deal_grp').empty().append(nullNumber(dealData.grp));
                $('#deal_impressions').empty().append(Number(nullNumber(dealData.impressions)).toLocaleString('en'));
                return true;
            }else{
                return false;
            }
        }
    });
}

function getAdvertiserDashboardData( selectOptionObject = null){
    var url = URL+'/advertiser-dashboard';
    $.ajax({
        url: url,
        type: 'POST',
        data: {_token: CSRF_TOKEN, data: selectOptionObject},
        success: function(response){
            console.log(response)
            $("#advertiser_inflight").empty().text(response.inflight+" Inflight");
            $("#advertiser_proposal").empty().text(response.proposal+" Proposal");
            $("#advertiser_ended").empty().text(response.ended+" Ended");
            $("#advertiser_approved").empty().text(response.approved+" Approved");
            $("#advertiser_order").empty().text(response.ordered+" Ordered");
            $("#advertiser_planning").empty().text(response.planning+" Planning");
            $("#advertiser_expired").empty().text(response.expired+" Expired");
        }
    });
}
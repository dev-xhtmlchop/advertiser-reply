<?php

namespace App\Http\Controllers\JsonInsertData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\DealPayload;

class JsonInsertDataController extends Controller
{
    public function index(){
        $removeArray = Helper::jsonDataTableList();
        $tableNameList = [];
        if( count( $removeArray ) > 0  ){
            foreach($removeArray as $removeArrayKey => $removeArrayVal){
                $tableNameList[] = $removeArrayKey;
            }
        }

        $data = array( 
            'title' => 'JsonInsertData',
            'tableList' => $tableNameList,
        );
        return view( 'pages.jsoninsertdata.index', $data );
    }

    public function getJSONData( Request $request ){
        $tableName = $request['table_list'];
        $tempFilePath= $request->file('json_file')[0]->getPathName();
        $data = file_get_contents($tempFilePath);
        $jsonFileFields = (array) json_decode($data);
        
        $removeArray = Helper::jsonDataTableList();
        $tableFieldsList = $removeArray[$tableName];
        $jsonHTML = '';
        if( count( $jsonFileFields ) > 0 ){
            $fieldId = 1;
            $jsonHTML .= '<div class="col-md-12">';
                $jsonHTML .='<div class="row">';
                    $jsonHTML .='<div class="col-md-4 form-group">';
                        $jsonHTML .='<span><strong>Field Name</strong></span>';
                    $jsonHTML .='</div>';  
                    $jsonHTML .='<div class="col-md-4 form-group">';
                        $jsonHTML .='<span><strong>Field Value</strong></span>';
                    $jsonHTML .='</div>';
                    $jsonHTML .='<div class="col-md-4 form-group">';
                        $jsonHTML .='<span><strong>Mapping</strong></span>';
                    $jsonHTML .='</div>';
                $jsonHTML .='</div>';
            $jsonHTML .='</div>';
            foreach( $jsonFileFields as $jsonFileFieldsKey => $jsonFileFieldsVal ){
                if( array_key_exists($jsonFileFieldsKey, $tableFieldsList) ) {
                    $jsonInput = Helper::getInput($tableFieldsList[$jsonFileFieldsKey], $fieldId, $jsonFileFieldsVal, 'field-exists');
                } else {
                    $jsonInput = Helper::getInput('string', $fieldId, $jsonFileFieldsVal, 'field-not-exists');
                }
                
                $jsonFieldNameRemoveUndersocde = Helper::removeUnderscore($jsonFileFieldsKey);
                $jsonHTML .= '<div class="col-md-12">';
                    $jsonHTML .='<div class="row">';
                        $jsonHTML .='<div class="col-md-4 form-group">';
                            $jsonHTML .='<span><strong>'.$jsonFieldNameRemoveUndersocde.'</strong></span>';
                        $jsonHTML .='</div>';  
                        $jsonHTML .='<div class="col-md-4 form-group">';
                            $jsonHTML .= $jsonInput;
                        $jsonHTML .='</div>';
                        $jsonHTML .='<div class="col-md-4 form-group mapping">';
                            $jsonHTML .='<select name="select_db_field[]" id="select_db_field_'.$fieldId.'" class="au-input au-input--full valid" aria-invalid="false">';
                                $jsonHTML .='<option value="">Table Fields Option</option>';
                                foreach($tableFieldsList as $tableFieldsListKey => $tableFieldsListVal ){
                                    $jsonHTML .='<option value="'.Helper::addUnderscore($tableFieldsListKey).'" attr-key="'.$tableFieldsListVal.'">'.Helper::removeUnderscore($tableFieldsListKey).'</option>';
                                }
                            $jsonHTML .= '</select>';
                        $jsonHTML .='</div>';
                    $jsonHTML .='</div>';
                $jsonHTML .='</div>';
                $fieldId++;
            }
        }
        return json_encode($jsonHTML);
    }

    public function jsonMappingData( Request $request ){
        if( count( $request['data'] ) > 0 ){
            $tableFields = [];
            $data = '';
            foreach( $request['data'] as $mappingKey => $mappingValue ){
                $mappingKey = $mappingKey - 1;
                if( ( $mappingValue['name'] == 'select_db_field[]') && ( $mappingValue['value'] != '' ) ){
                    $tableFields[$mappingValue['value']] =   $request['data'][$mappingKey]['value'];
                }
            }
            $tableName = $request['data'][0]['value'];
            if( $tableName == 'deal' ){
                $checkCount = DealPayload::where('name',$tableFields['deal_payload_name'])->count();
                if( $checkCount != 0 ){
                    $data = array( 'status' => 0 , 'message' => 'Deal Name already Exists.');
                }
            } else {
                $validFrom = date('m-d-Y hh:mm:ss', strtotime($tableFields['valid_from']));
                $validTo = date('m-d-Y hh:mm:ss', strtotime($tableFields['valid_to']));
                $flightStartDate = date('m-d-Y hh:mm:ss', strtotime($tableFields['flight_start_date']));
                $flightEndDate = date('m-d-Y hh:mm:ss', strtotime($tableFields['flight_end_date']));
                if( $validFrom >= $validTo ){ 
                    $data = array( 'status' => 0 , 'message' => 'Please check Valid To & From Date.');
                } else if( $flightStartDate >= $flightEndDate ){ 
                    $data = array( 'status' => 0 , 'message' => 'Please check Flight End & Start Date.');
                }
            }

            if( $data != '' ){
                return response()->json($data);  
            } else {
                $tableHTML = '';
                foreach( $tableFields as $tableFieldsKey => $tableFieldsVal ){
                    $tableFieldName = Helper::removeUnderscore($tableFieldsKey);
                    $tableHTML .='<tr class="tr-shadow">';
                        $tableHTML .='<th class="new-campaign-id">'.$tableFieldName.'</th>';
                        $tableHTML .='<td class="new-campaign-name">'.$tableFieldsVal.'</td>';
                    $tableHTML .='</tr>';
                }
                return response()->json($tableHTML);  
            }
        }
    }
}

<?php

namespace App\Http\Controllers\JsonInsertData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;


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

    public function getJSONData(  Request $request,  ){
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
                $jsonInput = Helper::getInput($tableFieldsList[$jsonFileFieldsKey], $fieldId, $jsonFileFieldsVal);
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
}

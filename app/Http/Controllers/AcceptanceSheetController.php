<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AcceptanceSheet;
use App\User;

class AcceptanceSheetController extends Controller
{
	public function edit($aToken) //編集画面の表示
	{
        $myProject = AcceptanceSheet::getDataByToken($aToken);
        if($myProject['filled_at']){
            return view('acceptance/sheet_show', ['target' => '','myProject'=>$myProject]);
        }else{
            return view('acceptance/sheet_edit', ['target' => 'sheet', 'myProject'=>$myProject]);
        }
	}
    public function update(Request $aRequest, $aToken) //編集処理
    {
        $tmpId = AcceptanceSheet::getIdByToken($aToken);
        $myRecord = AcceptanceSheet::findOrFail($tmpId);
        $tmpFlag = true;
        $myError = array(
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'accept_at' => '',
        );
        if( $myRecord->first_name != '' && $myRecord->first_name != $aRequest->first_name ){
            $tmpFlag = false;
            $myError['first_name'] = $aRequest->first_name;
        }
        if( $myRecord->last_name != '' && $myRecord->last_name != $aRequest->last_name ){
            $tmpFlag = false;
            $myError['last_name'] = $aRequest->last_name;
        }
        if( $myRecord->email != '' && $myRecord->email != $aRequest->email ){
            $tmpFlag = false;
            $myError['email'] = $aRequest->email;
        }
        if( $myRecord->accept_at !='' && strtotime($myRecord->accept_at) != strtotime($aRequest->accept_at) ){
            $tmpFlag = false;
            $myError['accept_at'] = $aRequest->accept_at;
        }
        if($tmpFlag == true){
            $tmpFilledAt = date("Y-m-d");
            $myRecord->first_name = $aRequest->first_name;
            $myRecord->last_name = $aRequest->last_name;
            $myRecord->email = $aRequest->email;
            $myRecord->accept_at = $aRequest->accept_at;
            $myRecord->filled_at = $tmpFilledAt;
            $myRecord->save();

            $pdfFileName = 'acceptance_' . preg_replace('/-/m','',$tmpFilledAt) . '_' . $aToken . '.pdf';
            //echo $pdfFileName;echo "<br>";
            $myProject = AcceptanceSheet::getDataByToken($aToken);
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('acceptance/print', ['target' => 'result', 'myProject'=>$myProject]);
            $pdf->setPaper('A4', 'portrait');
            $pdf->save(public_path('pdf/') . $pdfFileName);
            //print_r($myRecord);
            return view('acceptance/sheet_show', ['target' => 'success', 'myProject'=>$myProject]);
        }else{
            $myProject = AcceptanceSheet::getDataByToken($aToken);
            $myInput = array();
            $myInput['first_name'] = $aRequest->first_name;
            $myInput['last_name'] = $aRequest->last_name;
            $myInput['email'] = $aRequest->email;
            $myInput['accept_at'] = $aRequest->accept_at;
            return view('acceptance/sheet_edit', ['target' => 'error', 'myProject'=>$myProject, 'myError'=>$myError, 'myInput'=>$myInput]);
        }

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;

class AcceptanceSheet extends Model
{
    protected $table = 'acceptances';
    protected static $board_key = '';
    protected static $board_token = '';

    protected static function getDataByToken($anUrlToken)
	{
		$tmpRecord = self::where('url_token', '=', $anUrlToken)->get()->toArray();
		if($tmpRecord){
            $tmpCreateUserId = $tmpRecord[0]['created_by'];
            $tmpUser = User::find($tmpCreateUserId);

            self::$board_key = $tmpUser->board_api_key;
            self::$board_token = $tmpUser->board_api_token;
            //return $tmpUser;

			$tmpProjectId = $tmpRecord[0]['project_id'];
            $myProject = self::getDataByProjectId($tmpProjectId);
			$myProject['url_token'] = $anUrlToken;
			$myProject['first_name'] = $tmpRecord[0]['first_name'];
			$myProject['last_name'] = $tmpRecord[0]['last_name'];
			$myProject['email'] = $tmpRecord[0]['email'];
			$myProject['accept_at'] = $tmpRecord[0]['accept_at'];
			$myProject['created_by'] = $tmpRecord[0]['created_by'];
			$myProject['filled_at'] = $tmpRecord[0]['filled_at'];
			return $myProject;
		}
	}
    public static function getApiDataCurl($anUrl)
    {

        $myKey = self::$board_key;
        $myToken = self::$board_token;

        $option = [
            CURLOPT_RETURNTRANSFER => true, //文字列として返す
            CURLOPT_TIMEOUT        => 30, // タイムアウト時間
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer " . $myToken,
                "x-api-key: " . $myKey,
            )
        ];
        $ch = curl_init($anUrl);
        curl_setopt_array($ch, $option);
        $json    = curl_exec($ch);
        $info    = curl_getinfo($ch);
        $errorNo = curl_errno($ch);
        if($errorNo !== CURLE_OK){
            return [];
        }
        if($info['http_code'] !== 200){
            return [];
        }
        $jsonArray = json_decode($json, true);
        return $jsonArray;
    }
    protected function getIdByToken($aToken)
    {
        $tmpId = null;
        $tmpRecord = self::where('url_token', '=', $aToken)->get()->toArray();
        if($tmpRecord) $tmpId = $tmpRecord[0]['id'];

        return $tmpId;
    }



	protected function getData($anId=null)
	{
		if($anId){
			$tmpRecord = parent::findOrFail($anId);
			$myProject = self::getDataByProjectId( $tmpRecord->project_id );
			$myProject['id'] = $tmpRecord->id;
			$myProject['last_name'] = $tmpRecord->last_name;
			$myProject['first_name'] = $tmpRecord->first_name;
			$myProject['last_name'] = $tmpRecord->last_name;
			$myProject['email'] = $tmpRecord->email;
			$myProject['accept_at'] = $tmpRecord->accept_at;

			$myProject['period_at'] = $tmpRecord->period_at;
			$myProject['url_token'] = $tmpRecord->url_token;

			$myProject['created_at'] = $tmpRecord->created_at->timestamp;
			$myProject['updated_at'] = $tmpRecord->updated_at->timestamp;

			return $myProject;


			//return parent::findOrFail($anId);
		}else{
			//echo self::API_TOKEN;
			$myData = array();
			$tmpUrl = 'https://api.the-board.jp/v1/projects?response_group=medium&order_status_in[]=5,4&per_page=100&created_at_gteq=' . date("Y-m-d%20H:i:s",strtotime("-6 month"));
			$tmpTheDate = strtotime("-1 month");

			$tmpBoardProjects = self::getApiDataCurl( $tmpUrl );
			//print_r( $tmpBoardProjects );
			$tmpDbProjects = parent::all()->toArray();
			//print_r( compact($tmpDbProjects) );
			//print_r( $tmpDbProjects );

			foreach($tmpBoardProjects as $aBoardProject){
				$tmpDeliveryDate = $aBoardProject['delivery_date'];

				if( strtotime($tmpDeliveryDate) < $tmpTheDate ) continue;

				$tmpProjectData = array(
					'id' =>           '',
					'project_id' =>   $aBoardProject['id'],
					'client_name' =>  $aBoardProject['client']['name'],
					'project_name' => $aBoardProject['name'],
					'url_token' =>        '',
					'period_at' =>    '',
					'status' =>       0
				);
				foreach($tmpDbProjects as $aDbProject){
					if($aBoardProject['id'] == $aDbProject['project_id']){
						$tmpProjectData['id'] = $aDbProject['id'];
						$tmpProjectData['token'] = $aDbProject['token'];
						$tmpProjectData['period_at'] = $aDbProject['period_at'];
						//if($aDbProject['status'] == 1) $tmpProjectData['status'] = 1;
						$tmpProjectData['status'] = $aDbProject['status'];
						break 1;
					}
				}

				if( !array_key_exists( $tmpDeliveryDate, $myData ) ) $myData[$tmpDeliveryDate] = array();

				$myData[$tmpDeliveryDate][] = $tmpProjectData;
			}
			ksort($myData);
			//print_r($myData);

			return $myData;
		}
	}

    public static function getDataByProjectId($aProjectId)
    {
        $tmpUrl1 = 'https://api.the-board.jp/v1/projects/' . $aProjectId . '?response_group=all';
        $tmpProject = self::getApiDataCurl($tmpUrl1);

        if( !$tmpProject ) return array();

        $tmpUrl2 = 'https://api.the-board.jp/v1/clients/' . $tmpProject['client']['id'];
        $tmpClient = self::getApiDataCurl($tmpUrl2);

        $myData = array(
            'project_id' =>        $tmpProject['id'],
            'project_no' =>        $tmpProject['project_no'],
            'project_name' =>      $tmpProject['name'],
            'invoice_dates' =>     $tmpProject['invoice_dates'][0],
            'payment_term_name' => $tmpProject['payment_term_name'],
            'total' =>             $tmpProject['total'],
            'tax' =>               $tmpProject['tax'],
            'client_name' =>       $tmpClient['name'],
            'client_zip' =>        $tmpClient['zip'],
            'client_pref' =>       $tmpClient['pref'],
            'client_address1' =>   $tmpClient['address1'],
            'client_address2' =>   $tmpClient['address2'],
            'client_tel' =>        $tmpClient['tel'],

            'delivery_details' =>        $tmpProject['deliveries'][0]['details'],
            'delivery_message' =>        $tmpProject['deliveries'][0]['message']

        );

        return $myData;
    }

}

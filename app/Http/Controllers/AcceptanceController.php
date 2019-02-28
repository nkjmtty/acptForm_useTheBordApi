<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Acceptance;
//use App\User;

class AcceptanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index() //一覧画面の表示
    {
        $myProjects = Acceptance::all();
        //print_r($projects);
        return view('acceptance/index', compact('myProjects'));
    }

    public function show($anId) //詳細画面の表示
    {
        $myProject = Acceptance::find($anId);
        //print_r($myProject);
        return view('acceptance/show', ['target' => 'show', 'myProject'=>$myProject]);
        /*
        $tmpUrl = (empty($_SERVER["HTTPS"]))? 'http://' : 'https://' . $_SERVER['HTTP_HOST'] . '/board/' . $myProject['url_token'];
        $tmpName = $myProject['first_name'];
        $tmpDate = date('n月j日', $myProject['period_at']);
        $tmpMail = $myProject['email'];
        $myProject['mail_query'] = self::getMailQuery($tmpUrl,$tmpName,$tmpDate,$tmpMail);
        return view('acceptance/show', ['target' => 'stored', 'myProject'=>$myProject]);
        */
    }
    public function create() //登録画面の表示
    {
        /*
        $acceptance = new Acceptance();
        return view('acceptance/create', compact('acceptance'));
        */
        if( isset($_GET['pid']) ){
            $myProject = Acceptance::getDataByProjectId($_GET['pid']);
            return view('acceptance/create', compact('myProject'));
        }else{
            return redirect("acceptance/index");
        }
    }
    public function store(Request $aRequest) //登録処理
    {
        $myRecord = new Acceptance;
        //$myRecord->id = Acceptance::all()->max('id') + 1;
        $myRecord->project_id = $aRequest->project_id;
        $myRecord->url_token = $aRequest->url_token;
        $myRecord->first_name = $aRequest->first_name;
        $myRecord->last_name = $aRequest->last_name;
        $myRecord->email = $aRequest->email;
        if($aRequest->accept_at)
            $myRecord->accept_at = date("Y-m-d", strtotime($aRequest->accept_at));//strtotime($aRequest->accept_at);
        if($aRequest->period_at)
            $myRecord->period_at = date("Y-m-d", strtotime($aRequest->period_at));//strtotime($aRequest->period_at);
        $myRecord->created_by = Auth::id();
        $myRecord->save();

        $myProject = Acceptance::getData($myRecord->id);
        $tmpUrl = url('/acceptance/sheet') .'/'. $myProject['url_token'];
        $tmpName = $myProject['first_name'];
        $tmpDate = ($myProject['period_at'])? date('n月j日', strtotime($myProject['period_at'])): "";
        $tmpMail = $myProject['email'];
        $myProject['mail_query'] = self::getMailQuery($tmpUrl,$tmpName,$tmpDate,$tmpMail);
        return view('acceptance/show', ['target' => 'stored', 'myProject'=>$myProject]);
    }

    public function edit($anId) //編集画面の表示
    {
        $myProject = Acceptance::getData($anId);
        //print_r($myProject);

        return view('acceptance/edit', compact('myProject'));
    }

    public function update(Request $aRequest, $anId) //編集処理
    {
        $myRecord = Acceptance::findOrFail($anId);
        $myRecord->first_name = $aRequest->first_name;
        $myRecord->last_name = $aRequest->last_name;
        $myRecord->email = $aRequest->email;
        $myRecord->created_by = Auth::id();
        $myRecord->accept_at = date("Y-m-d", strtotime($aRequest->accept_at));
        $myRecord->period_at = date("Y-m-d", strtotime($aRequest->period_at));

        $myRecord->save();

        return redirect("/acceptance");
    }

    public function destroy($anId) //削除処理
    {
        $myRecord = Acceptance::findOrFail($anId);
        $myRecord->delete();
        return redirect("/acceptance");
    }
    private function getMailQuery($anUrl,$aName,$aDate,$aMail)
    {
        $tmpMailBody = <<<EOD
★NAME★ 様

お世話になっております。
★COMPANY★の●●です。

下記URLに検収書入力フォームを用意しましたので、
ご確認の上入力をお願いします。

★URL★

入力箇所は3点となります。

１.検収日
２.検収者氏名
３.検収者メールアドレス

検収書のご入力完了をこちらで確認でき次第、請求書の発行と送付となりますので
お手数ですが★PERIOD★中までにご入力お願いいたします。
EOD;
        $tmpMailBody = str_replace('★URL★', $anUrl, $tmpMailBody);
        $tmpMailBody = str_replace('★NAME★', $aName, $tmpMailBody);
        $tmpMailBody = str_replace('★PERIOD★', $aDate, $tmpMailBody);
        $tmpMailBody = str_replace('★COMPANY★', env('COMPANY_NAME'), $tmpMailBody);
        $myMailQuery = 'mailto:' . $aMail . '?' . http_build_query([
            'subject' => '【検収書ご記入のお願い】',
            'body' => $tmpMailBody
        ], null, '&amp;', PHP_QUERY_RFC3986);
        return $myMailQuery;
    }

}

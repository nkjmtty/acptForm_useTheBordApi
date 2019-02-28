@extends('../cmn-frame')

@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col">
@if($target == 'stored')
            <h1 class="ops-title mt-5 mb-4">検収フォームの発行完了</h1>
            <p>
                入力おつかれさまでした。下記内容にて検収フォームを発行しました。
            </p>
@else
            <h1 class="ops-title mt-5 mb-4">検収書の確認</h1>
            <p>
                検収フォームが入力され、PDFが作成されました。
            </p>
@endif
        </div>
    </div>
@if($target == 'stored')
    <div class="row mt-5" style="display:none">
        <div class="col">
            <h2 class="ops-title mb-3 h3">検収フォームの設定</h2>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col col-12 col-lg-4 mt-5 mt-lg-0">
            <h3 class="ops-title mb-3 h4">お客さま入力の指定</h3>
        </div>
        <div class="col col-12 col-lg-8">
            <div class="row">
                <div class="col col-4 col-md-2 border-bottom">
                    <h4 class="font-weight-bold h5">苗字</h4>
                </div>
                <div class="col col-8 col-md-4 border-bottom">
    @if($myProject['first_name'] != '')
                    {{ $myProject['first_name'] }}
    @else
                    <span class="small text-muted">（未指定）</span>
    @endif
                </div>
                <div class="col col-4 col-md-2 border-bottom">
                    <h4 class="font-weight-bold h5">名前</h4>
                </div>
                <div class="col col-8 col-md-4 border-bottom">
    @if($myProject['last_name'] != '')
                    {{ $myProject['last_name'] }}
    @else
                    <span class="small text-muted">（未指定）</span>
    @endif
                </div>
            </div>
            <div class="row">
                <div class="col col-4 col-xl-3 mt-2 border-bottom">
                    <h4 class="font-weight-bold h5">Emailアドレス</h4>
                </div>
                <div class="col col-8 col-xl-4 mt-2 border-bottom">
    @if($myProject['email'] != '')
                    {{ $myProject['email'] }}
    @else
                    <span class="small text-muted">（未指定）</span>
    @endif
                </div>
                <div class="col col-4 col-xl-2 mt-2 border-bottom">
                    <h4 class="font-weight-bold h5">検収日</h4>
                </div>
                <div class="col col-8 col-xl-3 mt-2 border-bottom">
    @if($myProject['accept_at'])
                    {{ date('Y年n月j日', strtotime($myProject['accept_at'])) }}
    @else
                    <span class="small text-muted">（未指定）</span>
    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col col-12 col-lg-4 mt-5 mt-lg-0">
            <h3 class="ops-title mb-3 h4">管理用の項目</h3>
        </div>
        <div class="col col-12 col-lg-8">
            <div class="row border-bottom">
                <div class="col col-4">
                    <h4 class="font-weight-bold h5">入力の期限</h4>
                </div>
                <div class="col col-8">
                    {{ date('Y年n月j日', strtotime($myProject['period_at'])) }}
                </div>
            </div>
            <div class="row mt-3">
                <div class="col col-12">
                    <h4 class="font-weight-bold h5">検収フォームURL</h4>
                </div>
                <div class="col col-12 border-bottom">
                    {{ url('/acceptance/sheet') }}/{{ $myProject['url_token'] }}
                </div>
            </div>
            <!--div class="row mt-3">
                <div class="col col-12">
                    <h4 class="font-weight-bold h5">検収書URL</h4>
                </div>
                <div class="col col-12 border-bottom">
                    {{ url('/acceptance/pdf') }}/{{ $myProject['url_token'] }}.pdf
                </div>
            </div-->
        </div>
    </div>
@else
    <div class="row mt-5">
        <div class="col">
            <h2 class="ops-title mb-3 h3">お客さま入力内容</h2>
        </div>
    </div>
    <div class="row mt-2">
    <div class="col col-4 mt-2 border-bottom">
            <h4 class="font-weight-bold h5">入力日</h4>
        </div>
        <div class="col col-8 mt-2 border-bottom">
            {{ date('Y年n月j日', strtotime($myProject['filled_at'])) }}
        </div>
        <div class="col col-4 mt-2 border-bottom">
            <h4 class="font-weight-bold h5">苗字</h4>
        </div>
        <div class="col col-8 mt-2 border-bottom">
            {{ $myProject['first_name'] }}
        </div>
        <div class="col col-4 mt-2 border-bottom">
            <h4 class="font-weight-bold h5">名前</h4>
        </div>
        <div class="col col-8 mt-2 border-bottom">
            {{ $myProject['last_name'] }}
        </div>
        <div class="col col-4 mt-2 border-bottom">
            <h4 class="font-weight-bold h5">Emailアドレス</h4>
        </div>
        <div class="col col-8 mt-2 border-bottom">
            {{ $myProject['email'] }}
        </div>
        <div class="col col-4 mt-2 border-bottom">
            <h4 class="font-weight-bold h5">検収日</h4>
        </div>
        <div class="col col-8 mt-2 border-bottom">
            {{ date('Y年n月j日', strtotime($myProject['accept_at'])) }}
        </div>
    </div>
	<div class="row mt-3">
		<div class="col">
			<object data="{{ url('/pdf') }}/acceptance_{{ preg_replace('/-/m','',$myProject['filled_at']) }}_{{ $myProject['url_token'] }}.pdf" type="application/pdf" style="width:100%;min-height:50vw;height:66vh"></object>
		</div>
	</div>
@endif
    <div class="row mt-5 mb-5">
        <div class="col text-center">
            <a href="{{ url('/acceptance') }}" role="button" class="btn btn-lg btn-secondary">一覧へ戻る</a>
            <a href="https://the-board.jp/documents/{{ $myProject['project_id'] }}/edit" target="_blank" role="button" class="btn btn-lg btn-info">boardを開く</a>
    @if($target == 'stored')
            <a href="{{ url('/acceptance') }}/{{ $myProject['id'] }}/edit" role="button" class="btn btn-lg btn-warning">編集する</a>
            <a href="{!! $myProject['mail_query'] !!}" role="button" class="btn btn-lg btn-primary">メーラを立ち上げる</a>
    @else
            <a href="{{ url('/pdf') }}/acceptance_{{ preg_replace('/-/m','',$myProject['filled_at']) }}_{{ $myProject['url_token'] }}.pdf" download class="btn btn-primary btn-lg">PDFダウンロード</a>
            <button type="submit" class="btn btn-lg btn-danger" form="delate">削除する</button>
            <form action="{{ url('/acceptance') }}/{{ $myProject['id'] }}" method="post" id="delate">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
    @endif
        </div>
    </div>
</div>
@endsection

@extends('../cmn-frame')

@section('css')
	<link rel="stylesheet" type="text/css" href="//yui-s.yahooapis.com/3.18.1/build/cssreset-context/cssreset-context-min.css">
@endsection
@section('content')
<div class="container ops-main">
	<div class="row">
		<div class="col">
			<h1 class="ops-title mt-5 mb-4">検収フォームの発行</h1>
			<p>
				検収フォームを発行します。<br>
				内容確認後、必要事項を入力し、「発行する」ボタンを押下してください。<br>
			</p>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col col-12 col-lg-4">
			<h2 class="ops-title mb-3 h3">検収書イメージ</h2>
		</div>
		<div class="col col-12 col-lg-8">
@include('acceptance/pdf', ['target' => 'store'])
		</div>
	</div>
	<div class="row align-items-md-end justify-content-center mt-5">
		<div class="col col-10 col-md-7">
			<p>上記内容に変更が必要であれば、Boardにて請求書を調整の後、この画面をリロードしてください。変更内容が反映されます。内容に問題無くフォームを発行する場合は、引き続き下記を入力ください。<br></p>
		</div>
		<div class="col col-10 col-md-3">
			<div class="text-center">
				<a href="https://the-board.jp/documents/{{ $myProject['project_id'] }}/edit" target="_blank" role="button" class="btn btn-info">boardを開く</a>
			</div>
		</div>
	</div>
	<form action="{{ url('/acceptance') }}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="project_id" value="{{ $myProject['project_id'] }}">
		<div class="row mt-5">
			<div class="col">
				<h2 class="ops-title mb-3 h3">検収フォームの設定</h2>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col col-12 col-lg-4">
				<h3 class="ops-title mb-3 h4">お客さま入力の指定</h3>
				<p><strong>入力の正解を指定する場合のみ設定</strong>してください。入力時に正誤チェックを行います。</p>
			</div>
			<div class="col col-12 col-lg-8">
				<div class="form-row">
					<div class="col col-12 col-sm-6">
						<label for="first_name" class="font-weight-bold">苗字</label>
						<input type="text" name="first_name" placeholder="山田" class="form-control" id="first_name">
					</div>
					<div class="col col-12 col-sm-6 mt-2 mt-sm-0">
						<label for="last_name" class="font-weight-bold">名前</label>
						<input type="text" name="last_name" placeholder="太郎" class="form-control" id="last_name">
					</div>
					<div class="col col-12 col-sm-7 col-md-8 mt-2">
						<label for="email" class="font-weight-bold">Emailアドレス</label>
						<input type="email" name="email" placeholder="name@example.com" class="form-control" id="email">
					</div>
					<div class="col col-12 col-sm-5 col-md-4 mt-2">
						<label for="accept_at" class="font-weight-bold">検収日</label>
						<input type="date" name="accept_at" max="{{ date('Y-m-d', strtotime('2 month')) }}" class="form-control" id="accept_at">
						<p class="small text-muted">納品日の都合上、検収日を指定する場合など</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col col-12 col-lg-4 mt-5 mt-lg-0">
				<h3 class="ops-title mb-3 h4">管理用の項目</h3>
				<p>管理画面用の設定です。検収フォームへ表示されることはありません。</p>
			</div>
			<div class="col col-12 col-lg-8">
				<div class="form-row">
					<div class="col col-12 col-md-6">
						<label for="period_at" class="font-weight-bold">入力の期限<span class="badge badge-danger ml-1">入力必須</span></label>
						<input type="date" name="period_at" min="{{ date('Y-m-d', strtotime('today')) }}" max="{{ date('Y-m-d', strtotime('1 month')) }}" required class="form-control" id="period_at">
						<p class="small">管理画面のリマインド用です。期限になってもフォーム自体は失効しません。</p>
					</div>
					<div class="col col-12 col-md-6 mt-2 mt-md-0">
						<label for="url_token" class="font-weight-bold">ID<span class="badge badge-secondary ml-1">自動生成</span></label>
						<input type="text" name="url_token" value="{{ uniqid() }}" readonly class="form-control" id="url_token" aria-describedby="top">
						<p class="small">入力フォームURLと入力後に生成されるPDFのURLに使われます。</p>
					</div>
				</div>

			</div>
		</div>
		<div class="row mt-5 mb-5">
			<div class="col text-center">
				<a href="{{ url('/acceptance') }}" role="button" class="btn btn-lg btn-secondary">一覧へ戻る</a>
				<input type="submit" value="発行する" class="btn btn-lg btn-primary"/>
			</div>
		</div>
	</form>
</div>
@endsection

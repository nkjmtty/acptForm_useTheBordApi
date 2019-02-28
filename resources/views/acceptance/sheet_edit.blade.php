@extends('../cmn-frame')

@section('css')
	<link rel="stylesheet" type="text/css" href="//yui-s.yahooapis.com/3.18.1/build/cssreset-context/cssreset-context-min.css">
@endsection
@section('content')
<div class="container ops-main">
	<div class="row">
		<div class="col-md-12">
			<h1 class="ops-title">検収フォーム</h1>
@if($target == 'error')
			<p class="text-info">入力内容に問題があるようです。お手数ですがご確認ください。</p>
@else
			<p>納品の確認のため、検収処理頂けますよう宜しくお願いします。</p>
@endif
		</div>
	</div>
	<div class="row">
		<div class="col">
@include('acceptance/pdf', ['target' => 'sheet'])
		</div>
	</div>
	<form action="{{ url('/acceptance/sheet') }}/{{ $myProject['url_token'] }}" method="post">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row justify-content-md-center mt-5">
			<div class="col col-md-4">
				<h2 class="">ご署名欄</h2>
				<p>上記の内容をご確認いただき、問題なければフォーム入力のうえ、「入力の確認」ボタンを押下ください。</p>
			</div>
			<div class="col col-md-7 border">
				<p class="h4 mt-3">{{ env('COMPANY_NAME') }} 殿</p>
				<p class="mt-4">上記に関し、検収致しました。</p>
				<div class="form-row mt-2">
					<div class="form-group col-md-12">
						<h3 class="h5">{{ $myProject['client_name'] }}</h3>
						<p class="mb-0">
							〒{{ $myProject['client_zip'] }}<br>
							{{ $myProject['client_pref'] }} {{ $myProject['client_address1'] }} @if($myProject['client_address2']){{ $myProject['client_address2'] }}@endif<br>
							TEL：{{ $myProject['client_tel'] }}<br>
						</p>
					</div>
					<div class="form-group col-md-6 js-key">
						<label for="first_name" class="font-weight-bold">苗字</label>
@if($target == 'error')
	@if($myError['first_name'] != '')
						<input type="text" name="first_name" value="{{ $myError['first_name'] }}" required placeholder="山田" class="form-control is-invalid" id="first_name">
	@else
						<input type="text" name="first_name" value="{{ $myInput['first_name'] }}" required placeholder="山田" class="form-control" id="first_name">
	@endif
@else
						<input type="text" name="first_name" required placeholder="山田" class="form-control" id="first_name">
@endif
					</div>
					<div class="form-group col-md-6 js-key">
						<label for="last_name" class="font-weight-bold">名前</label>
@if($target == 'error')
	@if($myError['last_name'] != '')
						<input type="text" name="last_name" value="{{ $myError['last_name'] }}" required placeholder="太郎" class="form-control is-invalid" id="last_name">
	@else
						<input type="text" name="last_name" value="{{ $myInput['last_name'] }}" required placeholder="太郎" class="form-control" id="last_name">
	@endif
@else
						<input type="text" name="last_name" required placeholder="太郎" class="form-control" id="last_name">
@endif
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-8 js-key">
						<label for="email" class="font-weight-bold">Emailアドレス</label>
@if($target == 'error')
	@if($myError['email'] != '')
						<input type="email" name="email" value="{{ $myError['email'] }}" required placeholder="name@example.com" class="form-control is-invalid" id="email">
	@else
						<input type="email" name="email" value="{{ $myInput['email'] }}" required placeholder="name@example.com" class="form-control" id="email">
	@endif
@else
						<input type="email" name="email" required placeholder="name@example.com" class="form-control" id="email">
@endif

					</div>
					<div class="form-group col-md-12 js-pen" style="display:none">
						<label class="font-weight-bold">サイン</label>
						<div>
							<canvas width="300" height="150" class="border" id="canvas"></canvas>
							<div>
								<button type="button" class="btn btn-secondary btn-sm" onclick="clearCanvas()">クリア</button>
								<button type="button" class="btn btn-secondary btn-sm" onclick="prevCanvas()">1つ戻る</button>
								<button type="button" class="btn btn-secondary btn-sm" onclick="nextCanvas()">1つ進む</button>
							</div>
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="accept_at" class="font-weight-bold">検収日</label>
@if($target == 'error')
	@if($myError['accept_at'])
						<input type="date" name="accept_at" required value="{{ $myError['accept_at'] }}" min="{{ date('Y-m-d', strtotime('-2 month')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}" class="form-control is-invalid" id="accept_at">
	@else
						<input type="date" name="accept_at" required value="" min="{{ date('Y-m-d', strtotime('-2 month')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}" class="form-control" id="accept_at">
	@endif
@else
	@if($myProject['accept_at'])
						<input type="date" name="accept_at" required value="{{ $myProject['accept_at'] }}" min="{{ date('Y-m-d', strtotime('-2 month')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}" class="form-control" id="accept_at">
	@else
						<input type="date" name="accept_at" required value="{{ date('Y-m-d', strtotime("today")) }}" min="{{ date('Y-m-d', strtotime('-2 month')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}" class="form-control" id="accept_at">
	@endif
@endif
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-md-center mt-4 mb-5">
			<div class="col col-md-12 text-center">
				<button type="button" class="btn btn-lg btn-dark" id="clear">クリア</button>
				<input type="reset" value="リセット" class="btn btn-lg btn-secondary"/>
				<input type="submit" value="入力の確認" class="btn  btn-lg btn-primary"/>
			</div>
		</div>
	</form>
</div>
@endsection
@section('js')
<script>
(function(){
	$('#clear').click(function(){
		$('input[type="text"],input[type="email"],input[type="date"]').val('');
	});
})();
</script>
@endsection

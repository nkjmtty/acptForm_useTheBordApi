@extends('../cmn-frame')

@section('css')
	<link rel="stylesheet" type="text/css" href="//yui-s.yahooapis.com/3.18.1/build/cssreset-context/cssreset-context-min.css">
@endsection
@section('content')
<div class="container ops-main">
	<div class="row">
		<div class="col-md-12">
			<h1 class="ops-title">検収フォーム</h1>
@if($target == 'success')
			<p>ご入力ありがとうございます。送信を完了しました</p>
@else
			<p>{{ $myProject['filled_at'] }}に、ご入力完了いただいております。</p>
@endif
		</div>
	</div>
	<div class="row">
		<div class="col">
			<object data="{{ url('/pdf') }}/acceptance_{{ preg_replace('/-/m','',$myProject['filled_at']) }}_{{ $myProject['url_token'] }}.pdf" type="application/pdf" style="width:100%;min-height:50vw;height:66vh"></object>
		</div>
	</div>
	<div class="row justify-content-md-center mt-4 mb-5">
		<div class="col col-md-12 text-center">
			<a href="{{ url('/pdf') }}/acceptance_{{ preg_replace('/-/m','',$myProject['filled_at']) }}_{{ $myProject['url_token'] }}.pdf" download="検収書_{{ $myProject['project_name'] }}.pdf" class="btn btn-secondary btn-lg">PDFダウンロード</a>
		</div>
	</div>
</div>
@endsection

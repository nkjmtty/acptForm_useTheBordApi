@extends('../cmn-frame')

@section('css')
	<link rel="stylesheet" type="text/css" href="//yui-s.yahooapis.com/3.18.1/build/cssreset-context/cssreset-context-min.css">
@endsection
@section('content')
<div class="container ops-main">
	<div class="row">
		<div class="col-md-12">
			<h1 class="ops-title">検収フォームの確認・調整</h1>
@if($myProject['updated_at'] > $myProject['created_at'])
			<p>フォームは<span class="text-info">{{ date('Y年n月j日', $myProject['updated_at']) }}</span>に、再発行済です。</p>
@else
			<p><span class="text-info">{{ date('Y年n月j日', $myProject['created_at']) }}</span>に、発行済です。</p>
@endif
			<div class="input-group mb-3">
				<input type="text" readonly value="{{ url('/acceptance/sheet') }}/{{ $myProject['url_token'] }}" class="form-control" aria-describedby="copy">
				<div class="input-group-append"><button class="btn btn-outline-secondary" type="button" id="copy">コピー</button></div>
			</div>
		</div>
	</div>
	<div class="row mt-5 mb-5">
		<div class="col text-center">
			<a href="{{ url('/acceptance') }}" role="button" class="btn btn-secondary">一覧へ戻る</a>
			<button type="submit" class="btn btn-danger" form="delate">削除する</button>
		</div>
	</div>
	<div class="row">
		<div class="col">
@include('acceptance/pdf', ['target' => 'update'])
		</div>
	</div>
	<div class="row mt-5 mb-3">
		<div class="col text-center">
			<p>
				上記内容に変更が必要であれば、Boardの請求書を更新ください。こちらに反映されます。<br>
				内容に問題なく、検収フォームを再発行する場合、下記の設定情報を適宜調整し再発行ボタンを押してください。<br>
@if(0)<!--
				<span class="text-danger">再発行すると、修正前の検収フォームは使用できなくなります。</span><br>
-->@endif
			</p>
		</div>
	</div>
@include('acceptance/form', ['target' => 'update'])

</div>
@endsection
@section('js')
<script>
(function(){
	$('#copy').click(function(){
		$('input[aria-describedby="copy"]').select();
		document.execCommand("copy");
		alert('クリップボードにコピーしました。');
	});
})();
</script>
@endsection

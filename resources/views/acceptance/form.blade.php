@if($target == 'store')
	<form action="{{ url('/acceptance') }}" method="post">
@elseif($target == 'update')
	<form action="{{ url('/acceptance') }}/{{ $myProject['id'] }}" method="post">
		<input type="hidden" name="_method" value="PUT">
@endif
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row justify-content-md-center mt-4 mb-4">
			<div class="col text-center">
				<h3>検収フォームの設定</h3>
@if($target == 'update')
				<p>
					こちらの検収フォームは、
    @if($myProject['updated_at'] > $myProject['created_at'])
					<span class="text-info">{{ date('Y年n月j日', $myProject['updated_at']) }}</span>に、再発行済です。
    @else
					<span class="text-info">{{ date('Y年n月j日', $myProject['created_at']) }}</span>に、発行済です。
    @endif
				</p>
@endif
			</div>
		</div>
		<div class="row justify-content-md-center mb-3">
			<div class="col col-md-10">
				<h4 class="mb-2">お客さま入力のフォームチェック</h4>
				<p class="">設定すると、お客さまフォーム入力時に、設定と同一か入力チェックを行います。</p>
			</div>
		</div>
		<div class="form-row justify-content-md-center">
			<div class="form-group col-md-2">
				<label for="first_name" class="font-weight-bold">苗字</label>
@if($target == 'store')
				<input type="text" name="first_name" placeholder="山田" class="form-control" id="first_name">
@elseif($target == 'update')
				<input type="text" name="first_name" value="{{ $myProject['first_name'] }}" class="form-control" id="first_name">
@endif
			</div>
			<div class="form-group col-md-2">
				<label for="last_name" class="font-weight-bold">名前</label>
@if($target == 'store')
				<input type="text" name="last_name" placeholder="太郎" class="form-control" id="last_name">
@elseif($target == 'update')
				<input type="text" name="last_name" value="{{ $myProject['last_name'] }}" class="form-control" id="last_name">
@endif
			</div>
			<div class="form-group col-md-3">
				<label for="email" class="font-weight-bold">Emailアドレス</label>
@if($target == 'store')
				<input type="email" name="email" placeholder="name@example.com" class="form-control" id="email">
@elseif($target == 'update')
				<input type="email" name="email" value="{{ $myProject['email'] }}" class="form-control" id="email">
@endif
			</div>
			<div class="form-group col-md-3">
				<label for="accept_at" class="font-weight-bold">検収日</label>
@if($target == 'store')
				<input type="date" name="accept_at" min="{{ date('Y-m-d', strtotime('-2 month')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}" class="form-control" id="accept_at">
@elseif($target == 'update')
				<input type="date" name="accept_at" min="{{ date('Y-m-d', strtotime('-2 month')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}"@if($myProject['accept_at']) value="{{ $myProject['period_at'] }}"@endif class="form-control" id="accept_at">
@endif
			</div>
		</div>
		<div class="row justify-content-md-center mt-4">
			<div class="col col-md-10">
				<h4 class="mb-2">管理用の設定</h4>
			</div>
		</div>
		<div class="form-row justify-content-md-center">
			<div class="form-group col-md-3">
				<label for="period_at" class="font-weight-bold">フォーム入力の期限</label>
@if($target == 'store')
				<input type="date" name="period_at" value="{{ date('Y-m-d', strtotime('7 day')) }}" min="{{ date('Y-m-d', strtotime('1 day')) }}" max="{{ date('Y-m-d', strtotime('2 month')) }}" required class="form-control" id="period_at">
@elseif($target == 'update')
	@if($myProject['period_at'] >= time())
				<input type="date" name="period_at" value="{{ $myProject['period_at'] }}" min="{{ date('Y-m-d', strtotime('1 day')) }}" max="{{ date('Y-m-d', strtotime('1 month')) }}" required class="form-control" id="period_at">
	@else
				<input type="date" name="period_at" value="{{ $myProject['period_at'] }}" min="{{ date('Y-m-d', strtotime('1 day')) }}" max="{{ date('Y-m-d', strtotime('1 month')) }}" required class="form-control text-danger" id="period_at">
	@endif
@endif
			</div>
			<div class="form-group col-md-7">
				<label for="url_token" class="font-weight-bold">フォームURL</label>
				<div class="input-group" class="font-weight-bold">
					<div class="input-group-prepend"><span class="input-group-text" id="top">{{ url('/acceptance') }}/sheet/</span></div>
@if($target == 'store')
					<input type="text" name="url_token" value="{{ uniqid() }}" readonly class="form-control" id="token" aria-describedby="top">
@elseif($target == 'update')
					<input type="text" name="url_token" value="{{ $myProject['url_token'] }}" readonly class="form-control" id="token" aria-describedby="top">
@endif
@if(0):<!--
					<div class="input-group-append">
						<button type="button" class="btn btn-outline-secondary" id="regenerate">再生成</button>
					</div>
				</div>
-->@endif
			</div>
@if(0):<!--
			<div class="form-group col-md-3">
				<label for="token" class="font-weight-bold">トークン</label>
@if($target == 'store')
				<input type="text" name="token" readonly value="{{ uniqid() }}" class="form-control" id="token">
@elseif($target == 'update')
				<input type="text" name="token" readonly value="{{ $myProject['token'] }}" class="form-control" id="token">
@endif
-->@endif
			</div>
		</div>

		<div class="row mt-5 mb-5">
			<div class="col text-center">
				<a href="{{ url('/acceptance') }}" role="button" class="btn btn-secondary">一覧へ戻る</a>
				<input type="hidden" name="project_id" value="{{ $myProject['project_id'] }}">
@if($target == 'store')
				<input type="submit" value="発行する" class="btn btn-primary"/>
@elseif($target == 'update')
				<input type="submit" value="再発行する" class="btn btn-primary"/>
				<button type="submit" class="btn btn-danger" form="delate">削除する</button>
@endif
			</div>
		</div>
	</form>
@if($target == 'update')
	<form action="{{ url('/acceptance') }}/{{ $myProject['id'] }}" method="post" id="delate">
		<input type="hidden" name="_method" value="DELETE">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
@endif
@if(0):<!--
@section('js')
<script>
(function(){
	$('#regenerate').click(function(){
		console.log( (new Date().getTime()).toString(16) );
	});
})();
</script>
@endsection
-->@endif

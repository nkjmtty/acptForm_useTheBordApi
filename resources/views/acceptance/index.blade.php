@extends('../cmn-frame')

@section('content')
<div class="container ops-main">
	<div class="row">
		<div class="col-md-12">
			<h1 class="ops-title">一覧</h1>
			<p>過去6ヶ月以内に新規案件作成し、ステータスが受注済（受注確定済）の案件で、請求日が過去1ヶ月以内の日付のものを表示します。</p>
		</div>
	</div>
@foreach($myProjects as $aDay => $aProjects)
	<section class="row">
		<div class="col-md-12">
			<h2>{{ $aDay }}</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col" class="text-center text-nowrap">クライアント</th>
						<th scope="col" class="text-center text-nowrap">案件</th>
						<th scope="col" class="text-center text-nowrap" style="width:100px">ステータス</th>
						<th scope="col" class="text-center text-nowrap" style="width:80px">操作</th>
					</tr>
				</thead>
				<tbody>
@foreach($aProjects as $aProject)
					<tr>
						<td style="width:30%">{{ $aProject['client_name'] }}</td>
						<td>{{ $aProject['project_name'] }}</td>
@if($aProject['url_token'] == '')
						<td class="text-center align-middle text-nowrap">未発行</td>
@elseif(!$aProject['filled_at'])
    @if(strtotime($aProject['period_at']) < strtotime(date("Y-m-d")) )
						<td class="text-center align-middle text-nowrap text-danger">期限切</td>
    @else
						<td class="text-center align-middle text-nowrap text-info">発行済</td>
    @endif
@else
						<td class="text-center align-middle text-nowrap text-success">発行済</td>
@endif
						<td class="text-center align-middle text-nowrap">
@if($aProject['url_token'] == '')
							<a href="{{ url('/acceptance') }}/create?pid={{ $aProject['project_id'] }}" role="button" class="btn btn-primary btn-sm">発行</a>
@elseif(!$aProject['filled_at'])
							<a href="{{ url('/acceptance') }}/{{ $aProject['id'] }}/edit" role="button" class="btn btn-info btn-sm">編集</a>
@else
							<!-- a href="{{ url('/pdf') }}/acceptance_{{ preg_replace('/-/m','',$aProject['filled_at']) }}_{{ $aProject['url_token'] }}.pdf" target="_blank" role="button" class="btn btn-success btn-sm">表示</a -->
							<a href="{{ url('/acceptance') }}/{{ $aProject['id'] }}" role="button" class="btn btn-success btn-sm">表示</a>
@endif
						</td>
					</tr>
@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endforeach
</div>
@endsection

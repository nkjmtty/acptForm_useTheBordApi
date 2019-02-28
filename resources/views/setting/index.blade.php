@extends('../cmn-frame')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="ops-title">user一覧</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <table class="table text-center">
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">name</th>
                    <th class="text-center">email</th>
                    <th class="text-center">admin_level</th>
                    <th colspan="2" class="text-center">操作</th>
                </tr>
@foreach($settings as $setting)
                <tr>
                    <td>{{ $setting->id }}</td>
                    <td>{{ $setting->name }}</td>
                    <td>{{ $setting->email }}</td>
                    <td>{{ $setting->admin_level }}</td>
                    <td class="text-center align-middle text-nowrap">
                        <a href="{{ url('/setting') }}/{{ $setting->id }}/edit" role="button" class="btn btn-info btn-sm">編集</a>
                    </td>
                    <td class="text-center align-middle text-nowrap">
    @if($setting->admin_level == 9)
                        <button class="btn btn-sm btn-danger" disabled>削除</button>
    @else
                        <form action="{{ url('/setting') }}/{{ $setting->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-danger">削除</button>
                        </form>
    @endif
                    </td>
                </tr>
@endforeach
            </table>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col text-center">
            <a href="{{ url('/home') }}" role="button" class="btn btn-lg btn-secondary">戻る</a>
            <a href="{{ url('/setting') }}/create" role="button" class="btn btn-lg btn-primary">新規作成</a>
        </div>
    </div>
</div>
@endsection

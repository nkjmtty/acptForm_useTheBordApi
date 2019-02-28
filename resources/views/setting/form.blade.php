@if($target == 'update')
    <form action="{{ url('/setting') }}/{{ $setting->id }}" method="post">
@else
    <form action="{{ url('/setting') }}" method="post">
@endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-11 offset-md-1">
                <table class="table">
                    <tr>
                        <th>name</th>
                        <td><input type="text" class="form-control" name="name" value="{{ $setting->name }}" required></td>
                    </tr>
                    <tr>
                        <th>email</th>
@if(Auth::user()->admin_level >= 5 || $target == 'store')
                        <td><input type="email" class="form-control" name="email" value="{{ $setting->email }}" required></td>
@else
                        <td>{{ $setting->email }}</td>
@endif
                    </tr>
@if($target == 'store')
                    <tr>
                        <th>password</th>
                        <td><input type="password" class="form-control" name="password" value="{{ $setting->password }}" required></td>
                    </tr>
@endif
@if(Auth::user()->admin_level >= 5 && $target == 'update')
                    <tr>
                        <th>email_verified_at</th>
                        <td>{{ $setting->email_verified_at }}</td>
                    </tr>
@endif
@if(Auth::user()->admin_level >= 5)
                    <tr>
                        <th>admin_level</th>
                        <td><input type="number" min="0" max="{{ Auth::user()->admin_level }}" class="form-control" name="admin_level" value="{{ $setting->admin_level }}" required></td>
                    </tr>
@endif

                </table>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-md-11 offset-md-1">
                <table class="table">
@if($target == 'update')
                    <tr>
                        <th>board_api_key</th>
                        <td><input type="text" class="form-control" name="board_api_key" value="{{ $setting->board_api_key }}"></td>
                    </tr>
                    <tr>
                        <th>board_api_token</th>
                        <td><input type="text" class="form-control" name="board_api_token" value="{{ $setting->board_api_token }}"></td>
                    </tr>
@endif
@if(Auth::user()->admin_level >= 5 && $target == 'update')
                    <tr>
                        <th>board_verified_at</th>
                        <td>{{ $setting->board_verified_at }}</td>
                    </tr>
@endif
                </table>
            </div>
        </div>
@if(Auth::user()->admin_level == 9 && $target == 'update')
        <div class="row mt-3 mb-3">
            <div class="col-md-11 offset-md-1">
                <table class="table">
                    <tr>
                        <th>created_at</th>
                        <td>{{ $setting->created_at }}</td>
                    </tr>
                    <tr>
                        <th>updated_at</th>
                        <td>{{ $setting->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
@endif
@include('setting/message')
        <div class="row mt-5 mb-5">
            <div class="col text-center">
@if(Auth::user()->admin_level >= 5 || $target == 'store')
                <a href="{{ url('/setting') }}" role="button" class="btn btn-lg btn-secondary">戻る</a>
@else
                <a href="{{ url('/home') }}" role="button" class="btn btn-lg btn-secondary">戻る</a>
@endif
@if($target == 'update')
                <input type="hidden" name="_method" value="PUT">
                <input type="submit" value="更新" class="btn btn-lg btn-primary"/>
@else
                <input type="hidden" name="_method" value="POST">
                <input type="submit" value="作成" class="btn btn-lg btn-primary"/>
@endif
@if(Auth::user()->admin_level >= 5)
                <button type="submit" class="btn btn-lg btn-danger" form="delate">削除</button>
@endif
            </div>
        </div>
    </form>
@if(Auth::user()->admin_level >= 5)
    <form action="{{ url('/setting') }}/{{ $setting->id }}" method="post" id="delate">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@endif

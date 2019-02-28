@extends('../cmn-frame')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="ops-title">setting</h2>
        </div>
    </div>
@include('setting/form', ['target' => 'update'])
</div>
@endsection

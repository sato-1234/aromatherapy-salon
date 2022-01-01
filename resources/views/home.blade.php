@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br />
                    <a style="margin-top:10px; display:inline-block;" href="{{ route('admin.top') }}">管理画面に移動する</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $ad->title }}
                        <a class="btn btn-sm btn-default pull-right" href="{{ route('list_ads') }}">Return</a>
                    </div>

                    <div class="panel-body">
                        {{ $ad->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
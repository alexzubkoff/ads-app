@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ads
                        @can('create-ad')
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_ad') }}">New</a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($ads as $ad)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3><a href="{{ route('edit_ad', ['id' => $ad->id]) }}">{{ $ad->title }}</a></h3>
                                            <p>{{ str_limit($ad->description, 50) }}</p>
                                            @can('update-ad', $ad)
                                                <p>
                                                    <a href="{{ route('edit_ad', ['id' => $ad->id]) }}" class="btn btn-sm btn-default" role="button">Edit</a>
                                                </p>
                                            @endcan
                                            @can('delete-ad', $ad)
                                                <p>
                                                    <a href="{{ route('delete_ad', ['id' => $ad->id]) }}" class="btn btn-sm btn-default" role="button">Delete</a>
                                                </p>
                                           @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
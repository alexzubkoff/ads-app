@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Drafts <a class="btn btn-sm btn-default pull-right" href="{{ route('list_ads') }}">Return</a>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($ads as $ad)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3><a href="{{ route('show_ad', ['id' => $ad->id]) }}">{{ $ad->title }}</a></h3>
                                            <p>{{ str_limit($ad->description, 50) }}</p>
                                            <p>
                                                @can('publish-ad')
                                                    <a href="{{ route('publish_ad', ['id' => $ad->id]) }}" class="btn btn-sm btn-default" role="button">Publish</a>
                                                @endcan
                                                <a href="{{ route('edit_ad', ['id' => $ad->id]) }}" class="btn btn-default" role="button">Edit</a>
                                            </p>
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
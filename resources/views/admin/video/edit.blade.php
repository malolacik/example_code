@extends('admin.main_template')
@section('title', 'Edit video')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.index') }}">Administracja</a></li>
                    <li><a href="{{ route('admin.videos.index') }}">Lista video</a></li>
                    <li class="active">Edytuj video - {{ $video->title }}</li>
                </ol>
            </div>
            <div class="clearfix"></div>

            @include('admin.include_main_partials.partials.error')

            <div class="container">
                {!! Form::model($video, ['method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['admin.videos.edit', $video->id], 'enctype' => 'multipart/form-data']) !!}

                @include('admin.video.form', ['form' => 'edit'])
                {!! Form::close() !!}



                {{--{!! Form::open(['route' => ['admin.video.destroy', $video->id], 'method' => 'delete', 'class' => 'form-horizontal']) !!}--}}
                {{--<div class="form-group" style="margin-bottom: 50px;">--}}
                    {{--<div class="col-sm-offset-2 col-sm-10">--}}
                        {{--<button type="submit" class="pull-right btn btn-danger">Usuń video</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            </div>
        </div>
    </div>
@stop
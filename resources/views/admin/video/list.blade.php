@extends('admin.main_template')
@section('title', 'Videos')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.index') }}">Administracja</a></li>
                    <li class="active">Lista video</li>
                </ol>
            </div>
            <div class="clearfix"></div>
            @include('admin.include_main_partials.partials.success')


            <div class="col-xs-12">
                <a class="btn btn-success pull-right mt10" href="{{ route('admin.videos.upload.show') }}">Dodaj video</a>
            </div>
            <div class="clearfix"></div>


            <div class="col-sm-6">
                <div class="input-group mt10">
                    {{ $videos->links() }}
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="panel panel-default mt15">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="50">ID</th>
                        <th class="text-center" width="100">Status</th>
                        <th class="text-center" width="100">ID Ustream</th>
                        <th>Nazwa</th>
                        <th class="text-center" width="150">Cena</th>
                        <th class="text-right" width="100">Wyświetleń</th>
                        <th class="text-center" width="100">Zakupów</th>
                        <th class="text-center" width="150">Data</th>
                        <th class="text-center" width="100">EDYCJA</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($videos as $video)
                        <tr>
                            <td class="text-center">{{ $video->id }}</td>
                            <td class="text-center">
                                @if(is_null($video->public_date))
                                    <span class="label label-danger">niepublik.</span>
                                @else
                                    <span class="label label-success">publik.</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $video->ustream_id }}</td>
                            <td>
                                <a href="{{ route('admin.videos.edit', $video->id) }}">{{ $video->title }}</a>
                            </td>
                            <td class="text-center">
                                @if($video->price == 0)
                                    <span class="label label-primary">FREE</span>
                                @else
                                    ${{ number_format($video->price, 2, '.', '') }}
                                @endif
                            </td>

                            <td class="text-center">{{ $video->views }}</td>
                            <td class="text-center">{{ $video->buy }}</td>
                            <td class="text-center">{{ $video->created_at }}</td>

                            <td class="text-center"><a class="label label-warning" href="{{ route('admin.videos.edit', $video->id) }}">EDYCJA</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                <div class="col-sm-6">
                    <div class="input-group mt10">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
























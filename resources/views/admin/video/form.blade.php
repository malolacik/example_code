@if($form == 'create')
    Video..
@elseif($form == 'edit')
    @if(!is_null($video->ustream_id))
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-6">
                <iframe src="https://www.ustream.tv/embed/recorded/{{ $video->ustream_id }}?html5ui" style="border: 0 none transparent;" webkitallowfullscreen="" allowfullscreen="" frameborder="no"
                        width="480"
                        height="270"></iframe>
            </div>
            <div class="clearfix"></div>
        </div>
    @else
        {{ $video->iframe_code }}
    @endif

@endif


<div class="form-group">
    {!! Form::label('title', 'Tytuł', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Zloty Tur 2017', 'required']) !!}
    </div>
    <div class="clearfix"></div>
</div>


<div class="form-group">
    {!! Form::label('ustream_id', 'ID Ustream', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('ustream_id', null, ['class' => 'form-control', 'placeholder' => '78487547']) !!}
        <p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>
    </div>
    <div class="clearfix"></div>
</div>


<div class="form-group">
    {!! Form::label('iframe_code', 'Kod Iframe', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('iframe_code', null, ['class' => 'form-control', 'placeholder' => '<iframe>...</iframe>', 'rows' => 4]) !!}
        <p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>
    </div>
    <div class="clearfix"></div>
</div>


<div class="form-group">
    {!! Form::label('description', 'Opis', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'rows' => 8]) !!}
        <p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>
        <p><span class="glyphicon glyphicon-info-sign"></span> Jeżeli nie ma ID Ustream to zczytywany jest Iframa Code</p>
    </div>
    <div class="clearfix"></div>
</div>


@if($form == 'create' || ($form == 'edit' && is_null($video->image)))
    <div class="form-group">
        {!! Form::label('image', 'Obrazek', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::file('image', ['class' => 'form-control', 'value' => 1]) !!}
            <p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>
        </div>
        <div class="clearfix"></div>
    </div>
@elseif($form == 'edit')

    <div class="form-group">
        {!! Form::label('image', 'Obrazek', ['class' => 'col-sm-2 control-label']) !!}
        <div id="video_thumb_container" class="col-sm-6">
            <img class="video_thumb" src="{{ $video->imageUrl() }}" alt=""/>
            <p class="mt5">
                <span id="del_video_thumb" class="btn btn-danger">USUŃ</span>
            </p>
            <input type="hidden" name="image_isset" value="1"/>
        </div>
        <div class="clearfix"></div>
    </div>
@endif

@if($form == 'create' || ($form == 'edit' && is_null($video->open_graph_image)))
    <div class="form-group">
        {!! Form::label('open_graph_image', 'Open Graph', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::file('open_graph_image', ['class' => 'form-control']) !!}
            <p><span class="glyphicon glyphicon-info-sign"></span> Nie jest wymagane</p>
        </div>
        <div class="clearfix"></div>
    </div>
@elseif($form == 'edit')
    <div class="form-group">
        {!! Form::label('open_graph_image', 'Open Graph', ['class' => 'col-sm-2 control-label']) !!}
        <div id="event_og_image" class="col-sm-6">
            <img class="video_thumb" src="{{ $video->openGraphImageUrl() }}" alt=""/>
            <p class="mt5">
                <span id="del_event_og" class="btn btn-danger">USUŃ</span>
            </p>
            <input type="hidden" name="og_image_isset" value="1"/>
        </div>
        <div class="clearfix"></div>
    </div>
@endif



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kategorie</label>
    <div class="col-sm-6">
        @if(old('categories'))
            {!! Form::select('categories[]', $categories, old('categories'), ['class' => 'js-example-basic-multiple w200', 'multiple', 'id' => 'id_label_multiple']) !!}
        @else
            @if($form == 'create')
                {!! Form::select('categories[]', $categories, null, ['class' => 'js-example-basic-multiple w200', 'multiple', 'id' => 'id_label_multiple']) !!}
            @elseif($form == 'edit')
                {!! Form::select('categories[]', $categories, $video->getCategories, ['class' => 'js-example-basic-multiple w200', 'multiple', 'id' => 'id_label_multiple']) !!}
            @endif
        @endif
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tagi</label>
    <div class="col-sm-6">
        <div class="form-control">
            @if(count($tags = $video->getTags))
                @foreach($tags as $tag)
                    <span class="label label-primary">{{ $tag->title }}</span>
                @endforeach
            @else
                Brak..
            @endif
        </div>
        <a class="label label-success" href="{{ route('admin.tags.video', $video->id) }}">Edytuj tagi</a>
    </div>
</div>


<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Cena</label>
    <div class="col-sm-6">


        @if(old('price'))
            @if(old('price') == 0)
                @php $status = 0; @endphp;
            @else
                @php $status = 1; @endphp;
            @endif
        @else
            @if($form == 'create')
                @php $status = 0; @endphp;
            @elseif($form == 'edit')
                @if($video->price == 0)
                    @php $status = 0; @endphp;
                @else
                    @php $status = 1; @endphp;
                @endif
            @endif
        @endif

        @if($status == 1)
            <span data-price="0" class="btn btn-default">FREE</span>
            <span data-price="0.99" class="btn btn-primary">0.99</span>

            <input type="hidden" name="price" value="0.99"/>
        @else
            <span data-price="0" class="btn btn-primary">FREE</span>
            <span data-price="0.99" class="btn btn-default">0.99</span>

            <input type="hidden" name="price" value="0"/>
        @endif

    </div>
    <div class="clearfix"></div>
</div>


<div class="form-group">
    <label for="date_from" class="col-sm-2 control-label">Publikacja</label>
    <div class="col-sm-6">
        <div class="input-group">
            <div class="input-group-addon">
                <input data-check-click id="code_date_from" type="checkbox"/>
            </div>
            {!! Form::text('public_date', null, ['id' => 'public_date', 'data-check-checkbox', 'class' => 'form-control', 'placeholder' => date('Y-m-d H:i')]) !!}

        </div>
    </div>
    <div class="clearfix"></div>
</div>


@if($form == 'create')
    <div class="form-group" style="margin-bottom: 100px;">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Dodaj video</button>
        </div>
    </div>

@elseif($form == 'edit')
    <div class="form-group" style="margin-bottom: 100px;">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Edytuj video</button>
        </div>
    </div>
@endif








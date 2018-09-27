@if(session('smallModal'))
    <div class="modal__container">
        <div class="modal__container--content">
            <span class="glyphicon glyphicon-remove close_modal_btn"></span>
            <p>
                {{ session('smallModal') }}
            </p>
        </div>
    </div>
@endif

@if(session('smallModalTag'))
    <div class="modal__container">
        <div class="modal__container--content">
            <span class="glyphicon glyphicon-remove close_modal_btn"></span>
            <p>
                {!! session('smallModalTag') !!}
            </p>
        </div>
    </div>
@endif


@if(session('smallModalLogin'))
    <div class="modal__container">
        <div class="modal__container--content">
            <span class="glyphicon glyphicon-remove close_modal_btn"></span>
            @foreach($errors->all() as $error)
                <p> {{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

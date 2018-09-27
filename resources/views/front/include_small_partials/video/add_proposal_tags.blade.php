@foreach($video->getProposalTagsObject(Auth::user()->id) as $tag)
    <span class="proposal_tag">{{ $tag->tag }} <i data-tag-remove="{{ $tag->id }}" class="fa fa-times-circle pointer" aria-hidden="true"></i></span>
@endforeach

<span class="add_tags"><i class="fa fa-plus" aria-hidden="true"></i></span>
<div class="add-tag__container">
    <input id="tag_proposal" data-toggle="tooltip" data-placement="top" data-trigger="manual" title="" class="input__basic input__tag" placeholder="{{ trans('proposal.tag') }}" type="text" value=""/>
    <span id="add_tags_proposal" class="button__basic add-btn__tag"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('proposal.add') }} </span>
    <i class="fa fa-close close-tags" aria-hidden="true"></i>
</div>













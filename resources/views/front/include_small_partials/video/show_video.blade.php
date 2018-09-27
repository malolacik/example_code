<div class="container__videos--content">
    @if(!is_null($video->filename))
        @if(!is_null($video->upload_video_id))
            <iframe src="https://my_site.com/embed/vod.php?v={{ $video->upload_video_id }}/{{ $video->upload_video_id }}.smil&t={{ $video->title }}" scrolling="no" allowfullscreen
                    webkitallowfullscreen frameborder="0"
                    style="border: 0 none transparent;"></iframe>
        @else
            <iframe src="https://my_site.com/embed/vod.php?v={{ $video->filename }}&t={{ $video->title }}" scrolling="no" allowfullscreen webkitallowfullscreen frameborder="0"
                    style="border: 0 none transparent;"></iframe>
        @endif
    @else
        @if(is_null($video->ustream_id))
            {!! $video->iframe_code !!}
        @else
            <iframe src="https://www.ustream.tv/embed/recorded/{{ $video->ustream_id }}?html5ui" scrolling="no" allowfullscreen webkitallowfullscreen frameborder="0"
                    style="border: 0 none transparent;"></iframe>
        @endif
    @endif
</div>



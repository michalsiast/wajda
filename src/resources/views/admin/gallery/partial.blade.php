<input type="hidden" name="gallery_id" value="{{$item->gallery_id}}">


<div id="gallery"></div>

@push('scripts.body.bottom')
    <script src="{{asset('js/components/Gallery.js')}}"></script>
@endpush


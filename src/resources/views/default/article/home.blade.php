<div class="service-inner-details">
    <div class="row g-4">
        @foreach($items as $item)
            <div class="col-md-6 col-lg-6">
                <div class="service-info-item text-center">
                    <div class="icon">
                        <img style="width: 80px;" src="{{ renderImage($item->galleryCover(), 80, 80, 'cover') }}"
                             alt="service-details-icon-1">
                    </div>
                    <h4 class="title">{{$item->title}}</h4>
                    {!! $item->text !!}
                </div>
            </div>
        @endforeach
    </div>
</div>

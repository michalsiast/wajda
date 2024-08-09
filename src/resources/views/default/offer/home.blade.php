@foreach($items as $item)
    <div class="col-sm-6 mx-auto mx-lg-0 col-lg-12 service-item-one-column">
        <div class="service-item-one">
            <div class="row">
                <div class="col-sm-12 col-lg-3 col-xl-3 align-self-center">
                    <div class="image">
                        <a href="{{route('offer.show.'.$item->id)}}" class="d-block w-100">
                            <img src="{{ renderImage($item->galleryCover(), 300, 160, 'cover') }}" style="height: 150px; object-fit: cover" alt="service-1"
                                 class="img-fluid w-100">
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 col-xl-3 align-self-center">
                    <div class="service-title ms-lg-4">
                        <h4 class="title">
                            <a href="{{route('offer.show.'.$item->id)}}">{{$item->title}}</a>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 col-xl-3 align-self-center">
                    <div class="description">
                        {!! $item->lead !!}
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 col-xl-2 ms-auto align-self-center">
                    <div class="read-more text-lg-end">
                        <a href="{{route('offer.show.'.$item->id)}}" style="display: flex;align-items: center;" class="common-btn uppercase border-btn">Zobacz ofertę
                            <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

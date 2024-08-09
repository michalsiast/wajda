@foreach($items as $item)
    <div class="working-process-item d-flex justify-content-between align-items-center">
        <div class="info d-flex align-items-center">
            <div class="image">
                <img style="width: 60px" src="{{ renderImage($item->galleryCover(), 60, 60, 'cover') }}" alt="icon-1">
            </div>
            <div class="title">
                <h4>{{$item->title}}</h4>
            </div>
        </div>
        <div class="number">
            <h3>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</h3>
        </div>
    </div>
@endforeach

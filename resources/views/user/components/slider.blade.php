<div class="section" id="slider-wp">
    <div class="section-detail">
        @foreach ($sliders as $item)
            <div class="item" style="width:878px;height:400px;">
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->image_name }}" >
            </div>
        @endforeach
    </div>
</div>

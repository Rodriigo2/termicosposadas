<div class="mdslider">
    <ul class="navigation">
        <li><a href="#" onclick="return false;" id="md_slider_nav_prew"></a><i class="fa-solid fa-chevron-left"></i></li>
        <li><a href="#" onclick="return false;" id="md_slider_nav_next"></a><i class="fa-solid fa-chevron-right"></i></li>
    </ul>
    @foreach ($sliders as $slider)
    <div class="md-slider-item">
        <div class="row">
            <div class="col-md-7">
                <div class="content">
                    <div class="cinside">{!! html_entity_decode($slider->content) !!}</div>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{url('/uploads/'.$slider->file_path.'/'.$slider->file_name)}}" class="img-fluid">
            </div>
        </div>
    </div>
    @endforeach
</div>
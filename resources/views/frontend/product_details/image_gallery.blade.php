
<div class="sticky-top z-3 row gutters-10">
    @php
        $photos = [];
    @endphp
    @if ($detailedProduct->photos != null)
        @php
            $photos = explode(',', $detailedProduct->photos);
        @endphp
    @endif
    <!-- Gallery Images -->
    <div class="col-12">
        <div class="aiz-carousel product-gallery arrow-inactive-transparent arrow-lg-none"
            data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true' data-arrows="true" data-autoplay="true" data-nav="true">
            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                    
                        <div class="carousel-box img-zoom rounded-0"  >
                            <img class="img-fluid h-auto lazyload mx-auto "
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($stock->image) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                     </a>
                    @endif
                @endforeach
            @endif

            @foreach ($photos as $key => $photo)
            <a href="{{ uploaded_asset($photo) }}" class="popup-link"> 
                <div class="carousel-box img-zoom rounded-0 "  >
                    <img class="img-fluid h-auto lazyload mx-auto"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($photo) }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            </a>
            @endforeach

        </div>
    </div>
    <!-- Thumbnail Images -->
    <div class="col-12 mt-3 d-none d-lg-block">
        <div class="aiz-carousel product-gallery-thumb" data-items='7' data-nav-for='.product-gallery'
            data-focus-select='true' data-arrows='true' data-vertical='false' data-auto-height="true" data-autoplay="true" data-nav="true">

            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                    <a href="{{ uploaded_asset($stock->image) }}" class="popup-link"> 
                        <div class="carousel-box c-pointer rounded-0" data-variation="{{ $stock->variant }}">
                            <img class="lazyload mw-100 size-60px mx-auto border p-1"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($stock->image) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                    </a>
                    @endif
                @endforeach
            @endif

            @foreach ($photos as $key => $photo)
                <div class="carousel-box c-pointer rounded-0" >
                    <img class="lazyload mw-100 size-60px mx-auto border p-1"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($photo) }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endforeach

        </div>
    </div>


</div>
<script src='https://mark-rolich.github.io/Magnifier.js/Event.js'></script>
<script src='https://mark-rolich.github.io/Magnifier.js/Magnifier.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js'></script>
<script>
    $( '[data-fancybox]' ).fancybox({
    infobar: true,
    toolbar: true,
    buttons: [
      'fullScreen',
      'thumbs',
      'zoom',
      'close'
  ],
  btnTpl: {
    zoom : '<button class="fancybox-button fancybox-zoom"><div class="zoom"><span class="zoom-inner"></span></div></button>'
  },
  onInit : function( instance ) {
      instance.$refs.toolbar.find('.fancybox-zoom').on('click', function() {
  
        var evt = new Event(), m = new Magnifier(evt);

        m.attach({
            thumb: '.fancybox-image',
            large: instance.current.src,
            mode: 'inside',
            zoom: 3,
            zoomable: true
        });    
    });
  }
});
</script>
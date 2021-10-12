<section id="{{ $section['id'] }}" class="imageblock switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    
    <?php
    if(isset($section['extras']['item_id'])){
                        
        if(!isset($section['extras']['item_limit'])){
            $section['extras']['item_limit'] = null;
        }

        $items = TheRealJanJanssens\Pakka\Models\Item::getItems($section['extras']['item_id'],1,'desc',$section['extras']['item_limit']);
        ?>
            <div class="imageblock__content col-lg-6 col-md-4 pos-right">
                <div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
                    @foreach($items as $item)
                        <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
                            <img alt="background" {{ parseImage($item, $item['images'][0], 2500) }}>
                        </div>
                    @endforeach 
                </div>
                
                @if (isset($section['extras']['divider_shape_side']))
                    <?php 
                        $orientation = isset($section['extras']['divider_shape_side']) ? "divider-side" : "";
                        $shape = isset($section['extras']['divider_shape_side']) ? $section['extras']['divider_shape_side'] : "";
                        $classes = isset($section['classes']['.divider-side']) ? $section['classes']['.divider-side'] : "";
                        $classes = "$orientation $classes";
                        echo view('pakka::partials.dividers.'.$shape, ['classes' => $classes]);
                    ?>
                @endif

            </div>

            <div class="container pos-vertical-center">
                <div class="row--e {{ parseSecAttr('.row--e', $section['classes']) }}">
                    <div class="col-lg-5 col-md-7 slider-meta">
                    @foreach ($items as $item)
                        <div data-id="{{ $loop->index }}" class="{!! $loop->index == 0 ? "d-block" : "d-none" !!}">
                            @if(isset($section['extras']['item_title']))
                                <h1>{{ parseContent($item, $section['extras']['item_title']) }}</h1>
                            @endif
                            
                            @if(isset($section['extras']['item_text'])) 
                                <p class="lead">{{ parseContent($item, $section['extras']['item_text']) }}</p>
                            @endif

                            @if(isset($section['extras']['item_button']))
                                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{!! isset($section['extras']['item_link']) ? $item[$section['extras']['item_link']] : $item['slug'] !!}">
                                    <span class="btn__text">
                                        {{ parseContent($item, $section['extras']['item_button']) }}
                                    </span> 
                                </a>
                            @endif
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        <?php
    }else{
        ?>
        <div class="imageblock__content col-lg-6 col-md-4 pos-right">
            @if(!empty($section['HEROIG04001_BIMG']['images']) && count($section['HEROIG04001_BIMG']['images']) > 1)
                <div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
                    @foreach($section['HEROIG04001_BIMG']['images'] as $image)
                        <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
                            <img alt="background" {{ parseImage($section['HEROIG04001_BIMG'], $image, 2500) }}>
                        </div>
                    @endforeach 
                </div>
            @else
                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
                    <img alt="background" {{ parseImage($section['HEROIG04001_BIMG'], $section['HEROIG04001_BIMG']['images'][0], 2500) }}> 
                </div>
            @endif
    
            @if (isset($section['extras']['divider_shape_side']))
                <?php 
                    $orientation = isset($section['extras']['divider_shape_side']) ? "divider-side" : "";
                    $shape = isset($section['extras']['divider_shape_side']) ? $section['extras']['divider_shape_side'] : "";
                    $classes = isset($section['classes']['.divider-side']) ? $section['classes']['.divider-side'] : "";
                    $classes = "$orientation $classes";
                    echo view('pakka::partials.dividers.'.$shape, ['classes' => $classes]);
                ?>
            @endif
    
        </div>
    
        <div class="container pos-vertical-center">
            <div class="row--e {{ parseSecAttr('.row--e', $section['classes']) }}">
                <div class="col-lg-5 col-md-7">
                    <h1>{{ parseContent($section['HEROIG04001_H'],'title') }}</h1>
                    <p class="lead">{{ parseContent($section['HEROIG04001_H'],'text') }}</p>
                    
                    @if(checkContent($section['HEROIG04001_H'], 'link'))
                        <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['HEROIG04001_H']['link'] }}">
                            <span class="btn__text">
                                {{ parseContent($section['HEROIG04001_H'],'button') }}
                            </span> 
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    
    
{!! constructDividers($section) !!}
</section>
<section class="p-0 bg--transparant {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <?php
        if(isset($page['item']) && isset($page['item']['images'])){
            $item = $page['item'];

            ?>
            <div class="slider" {{ parseSecAttr('.slider', $section['attributes']) }}>
                @foreach($item['images'] as $img)
                    <div class="img mx-4 {{ parseSecAttr('.img', $section['classes']) }}">
                        <img alt="Image" class="b-lazy" {{ parseImage($item, $img, 2500, true) }}>
                    </div>
                @endforeach
            </div>
            <?php
        }else{
            if(!empty($section['CVR2_BIMG']['images']) && count($section['CVR2_BIMG']['images']) > 1){
                ?>
                <div class="slider" {{ parseSecAttr('.slider', $section['attributes']) }}>
                    @foreach($section['CVR2_BIMG']['images'] as $image)
                        <div class="img mx-4 {{ parseSecAttr('.img', $section['classes']) }}">
                            <img alt="Image" class="b-lazy" {{ parseImage($section['CVR2_BIMG'], $image, 2500, true) }}>
                        </div>
                    @endforeach
                </div>
                <?php
            }else{
                ?>
                <img {{ parseImage($section['CVR2_BIMG'], $section['CVR2_BIMG']['images'][0], 2500) }}>
                <?php
            }

        }
    ?>
{!! constructDividers($section) !!}
</section>

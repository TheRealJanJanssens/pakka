<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="masonry">
            <div class="row row-masonry {{ parseSecAttr('.row-masonry', $section['classes']) }}">
                <?php 
                    if(isset($section['extras']['item_page'])){
                        $page = $section['extras']['item_page'];
                        
                        if(!session()->has('website.'.app()->getLocale().'.'.$page)){
                            $itemPage = TheRealJanJanssens\Pakka\Models\Translation::getTranslation($page);
                            session()->put('website.'.app()->getLocale().'.'.$page, $itemPage);
                        }else{
                            $itemPage = session()->get('website.'.app()->getLocale().'.'.$page);
                        }   
                    }else{
                        $itemPage = null;
                    }
                    
                    if(isset($section['extras']['item_id'])){
                        
                        if(!isset($section['extras']['item_limit'])){
                            $section['extras']['item_limit'] = null;
                        }

                        $items = TheRealJanJanssens\Pakka\Models\Item::getItems($section['extras']['item_id'],1,'desc',$section['extras']['item_limit']);

                        foreach($items as $item){	
                            ?>

                            <div class="masonry__item item {{ parseSecAttr('.item', $section['classes']) }}">                                
                                {!! bladeCompile(html_entity_decode($section['IFRMST01004_C1']['iframe']), $item->attributes) !!}
                            </div>
                            
                            <?php
                        }
                    }else{
                        ?>
                        <div class="masonry__item item {{ parseSecAttr('.item', $section['classes']) }}">
                            <h2>{{ parseContent($section['IFRMST01004_C1'],'title') }}</h2>
                            
                            {!! html_entity_decode($section['IFRMST01004_C1']['iframe']) !!}
                        </div>
                        
                        <div class="masonry__item item {{ parseSecAttr('.item', $section['classes']) }}">
                            <h2>{{ parseContent($section['IFRMST01004_C2'],'title') }}</h2>
                            
                            {!! html_entity_decode($section['IFRMST01004_C2']['iframe']) !!}
                        </div>

                        <div class="masonry__item item {{ parseSecAttr('.item', $section['classes']) }}">
                            <h2>{{ parseContent($section['IFRMST01004_C3'],'title') }}</h2>
                            
                            {!! html_entity_decode($section['IFRMST01004_C3']['iframe']) !!}
                        </div>

                        <div class="masonry__item item {{ parseSecAttr('.item', $section['classes']) }}">
                            <h2>{{ parseContent($section['IFRMST01004_C4'],'title') }}</h2>
                            
                            {!! html_entity_decode($section['IFRMST01004_C4']['iframe']) !!}
                        </div>
                    
                        <?php
                    }
                ?>
            </div>
        </div>    
    </div>
{!! constructDividers($section) !!}
</section>
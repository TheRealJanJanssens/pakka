<section class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 adaptable__text">

                <?php
                    if(isset($section['extras']['item_title']) && isset($page['item'])){
                        ?>
                            <h2>{{ parseContent($page['item'],$section['extras']['item_title']) }}</h2>
                        <?php
                    }else{
                        ?>
                            <h2>{{ parseContent($section['ACORST01001_C1'],'title') }}</h2>
                        <?php
                    }
                ?>
                
                <?php
                    if(isset($section['extras']['item_text']) && isset($page['item'])){
                        ?>
                            <p class="lead">{{ parseContent($page['item'],$section['extras']['item_text']) }}<p>
                        <?php
                    }else{
                        ?>
                            <p class="lead">{{ parseContent($section['ACORST01001_C1'],'text') }}<p>
                        <?php
                    }
                ?>

                <ul class="accordion {{ parseSecAttr('.accordion', $section['classes']) }}">
                    @if(checkContent($section['ACORST01001_C1'], 'text'))
                        <li class="active">
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST01001_C1'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST01001_C1'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST01001_C2'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST01001_C2'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST01001_C2'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST01001_C3'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST01001_C3'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST01001_C3'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST01001_C4'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST01001_C4'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST01001_C4'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST01001_C5'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST01001_C5'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST01001_C5'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST01001_C6'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST01001_C6'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST01001_C6'],'text') }}</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>
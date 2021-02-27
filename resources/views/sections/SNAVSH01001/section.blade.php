<section id="{{ $section['id'] }}" class="cta cta-4 border--bottom {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
		        <?php
                    $collections = App\Collection::getCollections(1);
                ?>

                @foreach($collections as $collection)
                   <a href="{!! url('/'.$settings['role_product_list'].'/'.$collection['id'].'/'.$collection['slug']) !!}" alt="{{ stripslashes($collection['name']) }}" class="m-2"><b>{{ stripslashes($collection['name']) }}</b></a>
                    
                @endforeach                
		    </div>
	    </div>
	</div>
{!! constructDividers($section) !!}
</section>
<div class="se-section-list-inner">
	<div class="se-section-list-top"></div>
	<div class="se-section-list-bottom">
		<div class="se-section-list-sidebar">
			@foreach($tags as $tag)
				<div class="tag" data-search="{!! str_replace(' ', '-',$tag) !!}">{{ ucfirst($tag) }}</div>
			@endforeach
		</div>
		<div class="se-section-list-main scroll">
			@foreach($sections as $section)
				<div class="section-thumbnail active" data-id="{{ $section['id'] }}" data-name="{{ $section['name'] }}" data-tags="{!! str_replace(',', ' ', str_replace(' ', '-',$section['tags'])) !!}">
					<img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="/public/vendor/images/sections/{{ $section['section'] }}.png" alt="{{ $section['name'] }}" title="{{ $section['name'] }}">
				</div>
			@endforeach
		</div>
	</div>
</div>
<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <h2>{!! trans('pakka::privacy-policy.heading') !!}</h2>
        <p class="lead mb-5">{!! trans('pakka::privacy-policy.intro', ['company_name' => $settings['company_name']]) !!}<p>
	    
	    <h3>{!! trans('pakka::privacy-policy.usage_info_title') !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.usage_info_text', ['company_name' => $settings['company_name']]) !!}</p>
	    
	    <h3>{!! trans('pakka::privacy-policy.cookies_title', ['company_name' => $settings['company_name']]) !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.cookies_text', ['company_name' => $settings['company_name']]) !!}</p>    
		
		<h3>{!! trans('pakka::privacy-policy.cookies_we_use_title', ['company_name' => $settings['company_name']]) !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.cookies_we_use_text', ['company_name' => $settings['company_name']]) !!}</p>
		
		<h3>{!! trans('pakka::privacy-policy.cookies_we_use_table', ['company_name' => $settings['company_name']]) !!}</h3>
		<table class="tg">
		  <tr>
		    <th class="bg--secondary">{!! trans('pakka::privacy-policy.name') !!}</th>
		    <th class="bg--secondary">{!! trans('pakka::privacy-policy.sort') !!}</th>
		    <th class="bg--secondary">{!! trans('pakka::privacy-policy.description') !!}</th>
		  </tr>
		  <tr>
		    <td>XSRF-TOKEN</td>
		    <td>{!! trans('pakka::privacy-policy.necessary_cookie') !!}</td>
		    <td>{!! trans('pakka::privacy-policy.xsrf') !!}</td>
		  </tr>
		  
		  <tr>
		    <td>cookie_consent</td>
		    <td>{!! trans('pakka::privacy-policy.necessary_cookie') !!}</td>
		    <td>{!! trans('pakka::privacy-policy.cookie_consent') !!}</td>
		  </tr>
		  
		  <tr>
		    <td>laravel_session</td>
		    <td>{!! trans('pakka::privacy-policy.session_cookie') !!}</td>
		    <td>{!! trans('pakka::privacy-policy.laravel_session') !!}</td>
		  </tr>
		  
		  @if(isset($settings['track_gtm']))
			  <tr>
				  <td>_ga, _gat, _gat_gaMain, __utma, __utmb, __utmc, __utmt, __utmz, __uzma, __uzmb, __uzmc, __uzmd</td>
				  <td>{!! trans('pakka::privacy-policy.tracking_cookie') !!}</td>
				  <td>{!! trans('pakka::privacy-policy.gtm') !!}</td>
			  </tr>
		  @endif
		  
		  @if(isset($settings['track_fbpxl']))
			   <tr>
				  <td>Facebook Pixel</td>
				  <td>{!! trans('pakka::privacy-policy.marketing_cookie') !!}</td>
				  <td>{!! trans('pakka::privacy-policy.gtm') !!}</td>
			  </tr>
		  @endif
		</table>
		
		<h3>{!! trans('pakka::privacy-policy.goals_title', ['company_name' => $settings['company_name']]) !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.goals_text', ['company_name' => $settings['company_name']]) !!}</p>
	    
	    <h3>{!! trans('pakka::privacy-policy.third_party_title', ['company_name' => $settings['company_name']]) !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.third_party_text', ['company_name' => $settings['company_name']]) !!}</p>
	    
	    <h3>{!! trans('pakka::privacy-policy.changes_title', ['company_name' => $settings['company_name']]) !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.changes_text', ['company_name' => $settings['company_name']]) !!}</p>
	    
	    <h3>{!! trans('pakka::privacy-policy.control_title', ['company_name' => $settings['company_name']]) !!}</h3>
	    <p>{!! trans('pakka::privacy-policy.control_text', ['company_name' => $settings['company_name']]) !!}</p>
		
		<h5 class="mb-0">{{ $settings['company_name'] }}</h5>
		<p>{{ $settings['company_address'] }}<br>
			{{ $settings['company_zip'] }} {{ $settings['company_city'] }}<br>
			{{ $settings['company_country'] }}<br><br>
			Tel: {{ $settings['company_phone'] }}<br>
			Email: {{ $settings['company_email'] }}</p>
		
    </div>
{!! constructDividers($section) !!}
</section>
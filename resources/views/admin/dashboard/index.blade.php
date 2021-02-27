@extends('pakka::admin.default')

@section('content')

    <div class="row pos-r"> <!-- masonry -->
	    
<!-- 	    <div class="masonry-sizer col-md-6"></div> -->
	    
	    <div class="w-100"> <!-- masonry-header masonry-item -->
		    <div class="row">
			    <div class='dashboard-header col-md-12'>
				    <div class="dashboard-text">
					    <h1>Welkom terug {{ auth()->user()->name }}</h1>
					    <p>Er waren <span>{{ $analytics['monthVisits'] }} bezoekers</span> in de voorbije <span>30 dagen</span></p>
					    
					    <div class="row gap-20">
						    <div class='col-md-3'>
						    	<a href="/" class="link"><i class="ti-angle-right"></i>Ga naar de live editor</a>
								<a href="/admin/content" class="link"><i class="ti-angle-right"></i>Beheer je pagina's</a>
						    </div>
						    
						    <div class='col-md-3'>
							    <a href="#" class="link"><i class="ti-angle-right"></i>Plaats een nieuw project</a>
								<a href="/admin/menu" class="link"><i class="ti-angle-right"></i>Beheer je menu's</a>
						    </div>
					    </div>
				    </div>
				    
				    <div class='dashboard-background'>
					    
					    <?php
						    if(isset($settings['app_dashboard_cover'])){
							    $dashboardCover = config('image.app.public').$settings['app_dashboard_cover'];
						    }else{
							    $dashboardCover = config('placeholders.dashboard_cover');
						    }
					    ?>
					    
					    <img src="{{ $dashboardCover }}" alt="">
				    </div>
			    </div>
		    </div>
	    </div>
        
        <div class="w-100"> <!-- masonry-item -->
            <div class="row overflow-visible gap-20">
	            
                <!-- #Unique Visitors Weekly ==================== -->
                <div class='col-md-3'>
                    <div class="dashboard-card box-shadow layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <p class="lh-1"><i class="margin-icon ti-tag"></i>Bezoekers deze week</p>
                        </div>
                        <div class="masonry-result layer w-100">
                            <h5>{{ $analytics['weekVisits'] }}</h5>
                        </div>
                    </div>
                </div>

                <!-- #Unique Visitors Monthly ==================== -->
                <div class='col-md-3'>
                    <div class="dashboard-card box-shadow layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <p class="lh-1"><i class="margin-icon ti-user"></i>Bezoekers deze maand</p>
                        </div>
                        <div class="masonry-result layer w-100">
                            <h5>{{ $analytics['monthVisits'] }}</h5>
                        </div>
                    </div>
                </div>
                
                <!-- #AVRG Session Duration ==================== -->
                <div class='col-md-3'>
                    <div class="dashboard-card box-shadow layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <p class="lh-1"><i class="margin-icon status-icon status-icon-green"></i>Gemiddelde surftijd</p>
                        </div>
                        <div class="masonry-result layer w-100">
                            <h5>{{ $analytics['avgSessionDuration'] }}</h5>
                        </div>
                    </div>
                </div>

                <!-- #BounceRate ==================== -->
                <div class='col-md-3'>
                    <div class="dashboard-card box-shadow layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <p class="lh-1">
	                            <i class="margin-icon status-icon status-icon-red"></i>
	                            Bounce percentage
	                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Precentage van bezoekers die na één pagina de website verlaten."><i class="ti-info-alt"></i></span>
                            </p>
                            
                        </div>
                        <div class="masonry-result layer w-100">
                            <h5>{{ $analytics['bounceRate'] }}%</h5>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="col-md-6"> <!-- masonry-header masonry-item -->
            <!-- #Monthly Stats ==================== -->
<!--
            <div class="bd bgc-white">
                <div class="layers">
                    <div class="layer w-100 pX-20 pT-20">
                        <h6 class="lh-1">Monthly Stats</h6>
                    </div>
                    <div class="layer w-100 p-20">
                        <canvas id="line-chart" height="220"></canvas>
                    </div>
                    <div class="layer bdT p-20 w-100">
                        <div class="peers ai-c jc-c gapX-20">
                            <div class="peer">
                                <span class="fsz-def fw-600 mR-10 c-grey-800">10% <i class="fa fa-level-up c-green-500"></i></span>
                                <small class="c-grey-500 fw-600">APPL</small>
                            </div>
                            <div class="peer fw-600">
                                <span class="fsz-def fw-600 mR-10 c-grey-800">2% <i class="fa fa-level-down c-red-500"></i></span>
                                <small class="c-grey-500 fw-600">Average</small>
                            </div>
                            <div class="peer fw-600">
                                <span class="fsz-def fw-600 mR-10 c-grey-800">15% <i class="fa fa-level-up c-green-500"></i></span>
                                <small class="c-grey-500 fw-600">Sales</small>
                            </div>
                            <div class="peer fw-600">
                                <span class="fsz-def fw-600 mR-10 c-grey-800">8% <i class="fa fa-level-down c-red-500"></i></span>
                                <small class="c-grey-500 fw-600">Profit</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
-->
        </div>
        
    </div>

@endsection
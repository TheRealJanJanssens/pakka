@extends('pakka::layouts.component')

@section('content')

	<?php
		$i=0;
		
		$startMain = true;
		$startFooter = true;
		
		//Only place the placeholders if user is authenticated
		if(Auth::check()){
			
			$placeholderHeader = true;
			$placeholderMain = true;
			$placeholderFooter = true;

			if(isset($page['sections'])){
				$sectionCount = count($page['sections']);
				//there are section present check which types
				$iP = 0;
				$iF = 0;
				foreach($page['sections'] as $section){
					switch (true) {
					    case $section['type'] == 1:
							$placeholderHeader = false;
					        break;
					    case $section['type'] == 2:
							$placeholderMain = false;
					        break;
					    case $section['type'] == 3:
					    	$iF = $iP;
							$placeholderFooter = false;
					        break;
					}
					
					if($iP + 1 == $sectionCount && $placeholderHeader == true){
						//detects no header present
						$insert = array(
							"type" => 1,
							"section" => "_NAV"
						);
						
						array_unshift($page['sections'],$insert);
						
						//safety so no duplicate placeholder are generated
						$placeholderHeader = false;
					}
					
					if($iP + 1 == $sectionCount && $placeholderMain == true){
						//detects no main present
						$insert = array(
							"type" => 2,
							"section" => "_MAIN"
						);
						
						//makes sure the array is inserted on the right spot
						if($iF == 0){
							$iF = $iP + 1;
						}
						
						array_splice($page['sections'], $iF, 0, array($insert));
	
						//safety so no duplicate placeholder are generated
						$placeholderMain = false;
					}
					
					if($iP + 1 == $sectionCount && $placeholderFooter == true){
						//detects no footer present
						$insert = array(
							"type" => 3,
							"section" => "_FOOTER"
						);
						
						array_push($page['sections'],$insert);
						
						//safety so no duplicate placeholder are generated
						$placeholderFooter = false;
					}
					
					$iP++;
				}
	
			}else{
				$page['sections'] = array(
					0 => array(
						"type" => 1,
						"section" => "_NAV"
					),
					1 => array(
						"type" => 2,
						"section" => "_MAIN"
					),
					2 => array(
						"type" => 3,
						"section" => "_FOOTER"
					),	
				);
			}	
		}

		$sectionCount = count($page['sections']);
		foreach($page['sections'] as $section){
			$i++;
			
			switch (true) {
			    case $i == 1:
			        //Begin Header
			        echo "<header>";
			        break;
			    case $section['type'] == 2 && $startMain == true:
			        //End header / begin main
			        echo "</header><main>";
			        $startMain = false;
			        break;
			    case $section['type'] == 3 && $startFooter == true:
			        //End main / begin footer
			        echo "</main><footer class='space--0'>";
			        $startFooter = false;
			        break;
			}
			
			//Other way to do this?
			$view = getSectionView($section['section']);
			?>
				@include($view)
			<?php
			
			if($i == $sectionCount){
				//Last Section / end footer
				echo "</footer>";
			}
		}
	?>
	
@endsection

<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 mB-40 bd">

			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'name', 'Naam', [], null, $langItem["language_code"]) !!}
			@endforeach

			{!! Form::myInput('number', 'position', 'Position', [], null, null) !!}

			{!! Form::mySelect('template', 'Template', $templates, null, ['class' => 'form-control select2']) !!}

			@if(checkAccess("permission_template_managment") && !empty($jsonTemplates) && !Route::is('admin.content.editpage'))
				<div class="form-group">
					<label for="json" class="col-form-label">Layout Template</label>

					<select id="json" class="form-control select2 json select2-hidden-accessible" data-placeholder="Selecteer een template" name="json" aria-hidden="true">
						<option></option>

						@if($jsonTemplates)
							@foreach($jsonTemplates as $key => $item)
								<option value="{{ $key }}">{{ $item }}</option>
							@endforeach
						@endif
					</select>
				</div>
			@endif

            @if(checkAccess("permission_template_managment") && Route::is('admin.content.editpage'))
                {!! Form::myTextArea('json', 'Insert content', ["class" => "form-control"], null) !!}
			@endif

		</div>

	</div>

	<div class="col-sm-4">
		<div class="bgc-white p-20 mB-40 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'slug', 'Slug', ["class" => "form-control slug-input"], null, $langItem["language_code"]) !!}
			@endforeach

			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'meta_title', 'Meta Title', ["class" => "form-control"], null, $langItem["language_code"]) !!}
			@endforeach

			@foreach ($lang as $langItem)
				{!! Form::myTextArea('meta_description', 'Meta Description', ["class" => "form-control"], null, $langItem["language_code"]) !!}
			@endforeach

			@foreach ($lang as $langItem)
				{!! Form::myTextArea('meta_keywords', 'Meta Keywords', ["class" => "form-control"], null, $langItem["language_code"]) !!}
			@endforeach

			<div class="list-group list-group-status">
				@if (isset($page['status']))
					@switch($page['status'])
				    	@case(1)
							@php( $onlineClass = "active" )
							@php( $offlineClass = "" )
				        @break

				        @case(0)
							@php( $onlineClass = "" )
							@php( $offlineClass = "active" )
				        @break
				    @endswitch
				@else
				    @php( $onlineClass = "active" )
					@php( $offlineClass = "" )
				@endif

				<a href="#" class="list-group-item list-group-item-action list-group-head {{ $onlineClass }}" data-status="1">{{ trans('pakka::app.online') }}</a>
				<a href="#" class="list-group-item list-group-item-action {{ $offlineClass }}" data-status="0">{{ trans('pakka::app.offline') }}</a>
			</div>
			{!! Form::myInput('hidden', 'status', '', ["class" => "status-input"]) !!}

		</div>

		{{ constructTransSelect() }}

		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.add_button') }}</button>
	</div>

</div>

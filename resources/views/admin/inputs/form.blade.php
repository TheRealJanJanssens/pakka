<div class="row">
	<div class="col-sm-8">
		<div class="bgc-white mB-40 p-20 bd">

			<div class="row">
				<div class="col-sm-4">
					@foreach ($lang as $langItem)
						{!! Form::myInput('text', 'label', 'Label', [], null, $langItem["language_code"]) !!}
					@endforeach

					{!! Form::myInput('hidden', 'input_id', '', [], null) !!}

					@if(!isset($input))
						@php ($defaultPos = "1")
					@else
						@php ($defaultPos = null)
					@endif

					{!! Form::myInput('hidden', 'position', '', [], $defaultPos)  !!}
				</div>

				<div class="col-sm-4">
					{!! Form::myInput('text', 'name', 'Naam', [], null) !!}
				</div>

				<div class="col-sm-4">
					{!! Form::mySelect('type', 'Type', config('pakka.type'), null, ['class' => 'form-control select2 select-custom-input']) !!}
				</div>

				<div class="col-sm-12 input-options hidden"><!-- hidden -->
					<table class="table table-bordered table-sort" cellspacing="0" width="100%">
						<thead>
			                <tr>
			                    <th class="col-md-10 align-middle">{{ trans('pakka::app.option') }}</th>
			                    <th class="col-md-2">
				                    <ul class="list-inline">
				                    	<li class="list-inline-item"><a href="#" class="btn btn-primary btn-sm add-input-option"><i class="ti-plus"></i></a></li>
				                    </ul>
				                </th>
			                </tr>
			            </thead>

			            <tbody>
				            @if (isset($lang[0]))
				            	@php ($probeName = $lang[0]["language_code"].':option')
				            @else
				            	@php ($probeName = 'undefined')
				            @endif



				            @if (isset($input[$probeName]))

				            	@php ($probeCount = count($input[$probeName]))

				            	@for ($i = 0; $i < $probeCount; $i++)

			            			@if ($i == 0)
						            	@php ($id = 'clone-input-option')
						            @else
						            	@php ($id = '')
						            @endif

									<tr id="{{ $id }}" class="input-option">
				                        <td>
					                        <i class="handle ti-line-double"></i>

					                        @php ($optionIds = '')

					                        @foreach ($lang as $langItem)

					                        	@php ($name = $langItem["language_code"].':option')

												{!! Form::myInput('text', 'option[]', '', [], $input[$name][$i]['value'], $langItem["language_code"]) !!}

												<input type="hidden" name="id[]" value="{{ $input[$name][$i]['id'] }}">
												<input type="hidden" name="option_id[]" value="{{ $input[$name][$i]['option_id'] }}">
												<input type="hidden" name="option_position[]" value="{{ $input[$name][$i]['position'] }}">

												@php ($optionIds .= $input[$name][$i]['option_id'].',')

											@endforeach
				                        </td>
				                        <td>
				                            <ul class="list-inline">
				                                <li class="list-inline-item">
				                                    <a href="#" class="btn btn-danger btn-sm remove-input-option" data-id="{{ $input[$name][$i]['option_id'] }}"><i class="ti-trash"></i></a>
				                                </li>
				                            </ul>
				                        </td>
				                    </tr>

				            	@endfor

							@else
								<tr id="clone-input-option" class="input-option">
			                        <td>
				                        <i class="handle ti-line-double"></i>

				                        @foreach ($lang as $langItem)
											{!! Form::myInput('text', 'option[]', '', [], null, $langItem["language_code"]) !!}
											<input type="hidden" name="option_id[]" value="">
											<input type="hidden" name="option_position[]" value="1">
										@endforeach

			                        </td>
			                        <td>
			                            <ul class="list-inline">
			                                <li class="list-inline-item">
			                                    <a href="#" class="btn btn-danger btn-sm remove-input-option"><i class="ti-trash"></i></a>
			                                </li>
			                            </ul>
			                        </td>
			                    </tr>
							@endif


			            </tbody>

<!--
			            <tr class="input-option">
		                        <td>
			                        <i class="handle ti-line-double"></i>

			                        <div class="form-group" data-lang="nl">
							            <input type="text" class="form-control" name="nl:name" value="">
							        </div>

							        <div class="form-group" data-lang="en">
							            <input type="text" class="form-control" name="en:name" value="">
							        </div>
		                        </td>
		                        <td>
		                            <ul class="list-inline">
		                                <li class="list-inline-item">
		                                    {!! Form::open([
		                                        'class'=>'delete',
		                                        'url'  => route(config('pakka.prefix.admin'). '.menu.destroymenuitem', 1),
		                                        'method' => 'DELETE',
		                                        ])
		                                    !!}

		                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>

		                                    {!! Form::close() !!}
		                                </li>
		                            </ul>
		                        </td>
		                    </tr>
-->

					</table>
<!-- 					{!! Form::myTextArea('options', 'Options', ['placeholder' => 'Option 1,Option 2,...']) !!} -->
				</div>
			</div>

		</div>

	</div>

	<div class="col-sm-4">
		<div class="bgc-white p-20 mB-40 bd">
			{!! Form::mySelect('input_width', 'Width', config('pakka.input_width'), (isset($input['input_width'])) ? $input['input_width'] : null, ['class' => 'form-control select2 select-custom-input', 'data-search' => '-1']) !!}
			{!! Form::mySwitch('required', 'Required', (isset($input['required']) && $input['required'] == "1") ? true : false); !!}
		</div>

		{{ constructTransSelect() }}

		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.edit_button') }}</button>
	</div>
</div>

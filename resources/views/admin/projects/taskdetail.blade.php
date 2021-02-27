<div id="task-detail-inner" data-id="{{ $task['id'] }}">
	<i class="task-detail-close fa fa-times"></i>
	<div class="row">
		<div class="col-md-8">
			<div class="task-row">
				<i class="fa fa-tasks"></i>
				<div class="task-row-content">
					<h2 contenteditable="true" data-name="name">{{ $task['name'] }}</h2>
					<span>Toegevoegd door {{ $task['created_by'] }}</span>
				</div>
			</div>
			
			<div class="task-row">
				<i class="fa fa-pencil-square-o"></i>
				<div class="task-row-content">
					<h3>Omschrijving</h3>
					
					@if($task['description'])
						<span contenteditable="true" data-name="description">{!! nl2br($task['description']) !!}</span>
					@else	
						<span contenteditable="true" data-name="description">Hier kan je een beschrijving toevoegen!</span>
					@endif
				</div>
			</div>
			
			<div class="task-row">
				<i class="fa fa-send-o"></i>
				<div class="task-row-content">
					<h3>Activiteit</h3>
				</div>
			</div>
			
			<div id="task-activity">
				<div id="task-activity-input">
					<span class="placeholder-avatar">
	                    @if(auth()->user()->avatar)
	                    	<img class="w-2r bdrs-50p" src="{{ auth()->user()->avatar }}" alt="">
	                    @else
	                    	<i class="ti-user"></i>
	                    @endif
                    </span>
                    
					<input type="text" placeholder="Schrijf een opmerking...">
					
					<a href="#" class="btn btn-primary"><i class="fa fa-send-o"></i></a>
				</div>
				
				<div id="task-activity-messages">
					
					<div class="message-clone">
						<div class="message-avatar">
							<span class="placeholder-avatar">
								@if(auth()->user()->avatar)
			                    	<img class="w-2r bdrs-50p" src="{{ auth()->user()->avatar }}" alt="">
			                    @else
			                    	<i class="ti-user"></i>
			                    @endif
							</span>
						</div>
						<div class="message-content">
							<p><b>{username}</b><span>{text}</span></p>
							<i>Nu</i>
						</div>
					</div>
					@if($task['comments'])
						@foreach($task['comments'] as $comment)
							<div class="message">
								<div class="message-avatar">
									<span class="placeholder-avatar">
										@if($comment['avatar'])
					                    	<img class="w-2r bdrs-50p" src="/public/storage/avatar/{{ $comment['avatar'] }}" alt="">
					                    @else
					                    	<i class="ti-user"></i>
					                    @endif
									</span>
								</div>
								<div class="message-content">
									<p><b>{{ $comment['user_name'] }}</b><span>{{ $comment['text'] }}</span></p>
									<i>{{ date("j M Y H:i", strtotime($comment['created_at'])) }}</i>
								</div>
							</div>
						@endforeach
					@else	
						<div class="message-placeholder">
							Er zijn geen berichten
						</div>
					@endif
					
				</div>
				
			</div>
			
		</div>
		
		<div class="task-column col-md-4">
			<div class="task-row">
				<h4>Geavanceerd</h4>
				<input type="text" placeholder="Deadline: 18/1/2020">
			</div>
			<div class="task-row">
				<h4>Acties</h4>
				<a href="#" id="task-edit-btn" class="btn btn-light"><i class="fa fa-floppy-o"></i>Taak opslaan</a>
				<a href="#" class="btn btn-danger"><i class="fa fa-trash"></i>Taak verwijderen</a>
			</div>
			<div class="task-row">
				<h4>Details</h4>
				@if($task['finished_at'])
					<p>Toegevoegd op {{ date("j M Y H:i", strtotime($task['created_at'])) }}</p>
				@endif
				
				@if($task['finished_at'])
					<p>Laatst aangepast op {{ date("j M Y H:i", strtotime($task['updated_at'])) }}</p>
				@endif
				
				@if($task['finished_at'])
					<p>Afgewerkt op {{ date("j M Y H:i", strtotime($task['finished_at'])) }}</p>
				@endif
			</div>
		</div>
	</div>
</div>
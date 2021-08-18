@php
	$categories = [
		"Suggestion or request",
		"Problem with a form",
		"Broken link",
		"Error mesage",
		"Problem selecting an option",
		"A description isn't clear",
		"Can't find something",
		"Image(s) don't look right",
		"Something else (please explain)",
	];

	$malleyCateogries = [
		"Pricing wrong",
		"Image or rendering issue",
		"Missing content",
		"Access problem",
		"Problem with option rules",
	];

	$categoryList = ( $malley ) ? array_merge( $malleyCateogries, $categories ) : $categories
@endphp

@extends('bugreport::template')

@section('content')

	<div class="panel-body">

		<p>Thank you for helping us make Blueprint as good a tool as possible. Use this form to let us know about any issue you have, big or small. Please provide as much
			information as you possibly can, especially if the issue you run into is preventing you from doing something.</p>

		<p>Please be as specific as possible and provide whatever detail that you can. We will contact you if we require any further information to resolve the issue.</p>
		@includeIf('bugreport::errors')

		<form method="POST"
		      enctype="multipart/form-data"
		      action="https://blueprint.malleyindustries.com/bugs">
			{{ csrf_field() }}
			<input type="hidden" name="email" value="{{ Auth::user()->email }}">

			<h2>Details</h2>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="title">Category</label>

						<select class="form-control"
						        id='title'
						        name="title">
							@foreach ( $categoryList as $cat )
								<option
										@if( old('title') === $cat )
										selected
										@endif
										value="{{ $cat }}">{{ $cat }}</option>
							@endforeach
						</select>

					</div>
				</div>
				<div class="form-group">
					<label for="category">Urgency?</label>

					<select class="form-control"
					        id='category'
					        name="urgency">

						@foreach ( \App\Models\BugReport::$blueprintUrgencies as $key => $value )
							<option
									@if( old('urgency') === $key || $key === 4)
									selected
									@endif
									value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>

				</div>	<div class="col-md-6">

				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="user_notes">User Notes (Be as specific as possible!)</label>
						<textarea
								class="form-control"
								cols="50"
								rows="6"
								id="user_notes"
								name="user_notes">{{ old('description') }}</textarea>
					</div>
				</div>
			</div>
			<br>
			<h2>Supporting Files and Photos</h2>
			<div class="row">
				<div class="col-md-12">
					<input
							max="4096"
							name="upload[]"
							multiple
							type="file"
							class="form-control" >
				</div>
			</div>
			<br> <br>

			<h2>Technical Stuff</h2>
			<p>This form grabs some technical information to help us better address your issue.
				Some bugs are specific to browser or even individual Blueprints or Options.
				No action is required on your part, but you can
                <span style="color:#002752;" id="showhidden">click here to see what is being sent.</span></p>
			<div id="hidden" style="display: none;">

			<div class="row">
				<div class="col-md-1">
					<div class="form-group">
						<label for="user_id">User ID</label>
						<input class="form-control"
                               id="user_id"
                               name="user_id"
                               readonly
                               type="text"
                               value="{{ old('user_id') ?? Auth::user()->id  }}"/>
					</div>
				</div>


				<div class="col-md-2">
					<div class="form-group">
						<label for="related_table">Rel Table</label>
						<input type="text"
						       readonly
						       class="form-control"
						       name="related_table"
						       id="related_table"
						       value="{{ old('related_table') ?? session('bugreport_related_table') ?? ""  }}"/>
					</div>
				</div>


				<div class="col-md-2">
					<div class="form-group">
						<label for="related_id">Rel ID</label>
						<input type="text"
						       readonly
						       id="related_id"
						       class="form-control"
						       name="related_id"
						       value="{{ old('related_id') ?? session('bugreport_related_id') ?? ""  }}"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="browser">Browser</label>
						<input type="text"
						       id="browser"
						       class="form-control" name="browser"
						       value="{{ old('browser')  }}"/>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<label for="full_version">Version</label>
						<input type="text"
						       id="full_version"
						       class="form-control" name="full_version"
						       value="{{ old('full_version')  }}"/>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<label for="major_version">Maj Ver</label>
						<input type="text"
						       id="major_version"
						       class="form-control" name="major_version"
						       value="{{ old('major_version')  }}"/>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="app_name">App Name</label>
						<input type="text"
						       id="app_name"
						       class="form-control" name="app_name"
						       value="{{ old('app_name')  }}"/>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="user_agent">User Agent</label>
						<input type="text"
						       id="user_agent"
						       class="form-control" name="user_agent"
						       value="{{ old('user_agent')  }}"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="os">OS</label>
						<input type="text"
						       id="os"
						       class="form-control" name="os"
						       value="{{ old('os')  }}"/>
					</div>
				</div>
			</div>




			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="url">URL</label>
						<input type="text"
						       class="form-control" name="url"
						       id="url"
						       value="{{ old('url') ?? url()->previous() }}"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="program">Tool</label>
						<input type="text"
						       id="program"
						       class="form-control" name="program"
						       value="{{ old('program') ?? $tool ?? "OptionMaker" }}"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="status">Status</label>
						<input type="text"
						       readonly
						       id="status"
						       class="form-control" name="status"
						       value="{{ old('status') ?? "Open" }}"/>
					</div>
				</div>
			</div>
			</div>


			<div class="row">
				<div class="col-md-12">
					<input type="submit"
					       class="btn btn-lg btn-success"
					       value="Submit" />
				</div>
			</div>
		</form>

	</div>

@endsection

@section('scripts')
	<script>

		document.getElementById('showhidden').addEventListener('click', function(){
			document.getElementById('hidden').style.display = 'block';
		});

		var nVer = navigator.appVersion;
		var nAgt = navigator.userAgent;
		var browserName  = navigator.appName;
		var fullVersion  = ''+parseFloat(navigator.appVersion);
		var majorVersion = parseInt(navigator.appVersion,10);
		var nameOffset,verOffset,ix;

		// In Opera, the true version is after "Opera" or after "Version"
		if ((verOffset=nAgt.indexOf("Opera"))  !==-1) {
			browserName = "Opera";
			fullVersion = nAgt.substring(verOffset+6);
			if ((verOffset=nAgt.indexOf("Version"))!==-1)
				fullVersion = nAgt.substring(verOffset+8);
		}
// In MSIE, the true version is after "MSIE" in userAgent
		else if ((verOffset=nAgt.indexOf("MSIE"))!==-1) {
			browserName = "Microsoft Internet Explorer";
			fullVersion = nAgt.substring(verOffset+5);
		}
// In Chrome, the true version is after "Chrome"
		else if ((verOffset=nAgt.indexOf("Chrome"))!==-1) {
			browserName = "Chrome";
			fullVersion = nAgt.substring(verOffset+7);
		}
// In Safari, the true version is after "Safari" or after "Version"
		else if ((verOffset=nAgt.indexOf("Safari"))!==-1) {
			browserName = "Safari";
			fullVersion = nAgt.substring(verOffset+7);
			if ((verOffset=nAgt.indexOf("Version"))!==-1)
				fullVersion = nAgt.substring(verOffset+8);
		}
// In Firefox, the true version is after "Firefox"
		else if ((verOffset=nAgt.indexOf("Firefox"))!==-1) {
			browserName = "Firefox";
			fullVersion = nAgt.substring(verOffset+8);
		}
// In most other browsers, "name/version" is at the end of userAgent
		else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
			(verOffset=nAgt.lastIndexOf('/')) )
		{
			browserName = nAgt.substring(nameOffset,verOffset);
			fullVersion = nAgt.substring(verOffset+1);
			if (browserName.toLowerCase()===browserName.toUpperCase()) {
				browserName = navigator.appName;
			}
		}
		// trim the fullVersion string at semicolon/space if present
		if ((ix=fullVersion.indexOf(";"))!==-1)
			fullVersion=fullVersion.substring(0,ix);
		if ((ix=fullVersion.indexOf(" "))!==-1)
			fullVersion=fullVersion.substring(0,ix);

		majorVersion = parseInt(''+fullVersion,10);
		if (isNaN(majorVersion)) {
			fullVersion  = ''+parseFloat(navigator.appVersion);
			majorVersion = parseInt(navigator.appVersion,10);
		}

		document.getElementById('browser').value = browserName;
		document.getElementById('full_version').value = fullVersion;
		document.getElementById('major_version').value = majorVersion;
		document.getElementById('app_name').value = navigator.appName;
		document.getElementById('user_agent').value = navigator.userAgent;


		var OSName="Unknown OS";
		if (navigator.appVersion.indexOf("Win")!==-1) OSName="Windows";
		if (navigator.appVersion.indexOf("Mac")!==-1) OSName="MacOS";
		if (navigator.appVersion.indexOf("X11")!==-1) OSName="UNIX";
		if (navigator.appVersion.indexOf("Linux")!==-1) OSName="Linux";
		document.getElementById('os').value = OSName;

	</script>
@endsection

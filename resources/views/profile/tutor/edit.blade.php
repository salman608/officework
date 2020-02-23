@extends('layouts.backend')
@section('content')

<div class="uk-grid-small" uk-grid>
    <div class="uk-width-expand@m">
		<div class="uk-card uk-card-body uk-card-small">
		    <div class="uk-card-header uk-card-primary">
		        <div class="uk-grid-small uk-flex-middle header_profile" uk-grid>
		            <div class="uk-width-auto uk-position-relative">
		                <img class="uk-border-circle uk-box-shadow-medium" width="100" height="100" src="{{ (!empty($profile->photo)) ? asset('storage/upload/'.$profile->photo.'') : asset('storage/upload/default-profile.png') }}">
		                <a class="uk-border-circle uk-badge uk-position-absolute" href="{{ route('tutor.profile.upload_profile_photo') }}"><span uk-icon="upload"></span></a>
		            </div>
		            <div class="uk-width-expand">
		                <h5 class="uk-card-title uk-margin-remove-bottom uk-text-bold">{{ auth()->user()->name }}</h5>
		                <p class="uk-margin-remove-top uk-text-bold uk-text-emphasis">Profile Completed: {{ $percentage }}%</p>
		            </div>
		        </div>
		    </div>
		    <hr class="uk-divider-icon">
	    	<ul class="uk-child-width-expand edit_tutor_profile_tab" uk-tab  data-uk-tab="{connect:'#ProfileTab'}">
			    <li class="uk-active"><a class="uk-text-capitalize" href="#">Tuition Related Information</a></li>
			    <li><a class="uk-text-capitalize" href="#">Educational Information</a></li>
			    <li><a class="uk-text-capitalize" href="#">Personal Information</a></li>
			</ul>
			<div id="ProfileTab" class="uk-switcher uk-margin tutor_profile_edit">
				<form id="tuitionRelatedInformationForm" action="javaScript:;">
					@csrf
					<div class="uk-margin">
						<p class="uk-text-primary uk-text-bold">Please select categories that match your qualifications.</p>
						<label class="uk-form-label" for="categories_id">Select Category <span class="uk-text-meta">(You can not add more than five categories, so select categories based on your skills)</span> <span class="uk-text-danger">(Requied *)</span></label>
			            {{ Form::select('categories_id[]', (!empty($categories)) ? $categories : [], $profile_categories, ['id' => 'categories_id', 'class' => 'uk-select uk-form-large', 'multiple' => 'multiple']) }}
		                <p class="uk-margin-remove-top uk-text-danger error categories_id">
		                    @error('categories_id') {{ $message }} @enderror
		                </p>
			        </div>

			        <div class="uk-margin">
			        	<label class="uk-form-label" for="courses_id">Class / Course <span class="uk-text-meta">(e.g. Class 1, Standard 1)</span> <span class="uk-text-danger">(Requied *)</span></label>
			        	{{ Form::select('courses_id[]', (!empty($selected_courses)) ? $selected_courses : [], $profile_courses, ['id' => 'courses_id', 'class' => 'uk-select uk-form-large', 'multiple' => 'multiple']) }}
		                <p class="uk-margin-remove-top uk-text-danger error courses_id">
		                    @error('courses_id') {{ $message }} @enderror
		                </p>
			        </div>

					<div class="uk-margin">
						<p class="uk-text-primary uk-text-bold">Please select subject(s)</p>
						<label class="uk-form-label" for="subjects_id">Subjects <span class="uk-text-danger">(Requied *)</span></label>
			            {{ Form::select('subjects_id[]', (!empty($selected_subject)) ? $selected_subject : [], $profile_subjects, ['id' => 'subjects_id', 'class' => 'uk-select uk-form-large', 'multiple' => 'multiple']) }}
		                <p class="uk-margin-remove-top uk-text-danger error subjects_id">
		                    @error('subjects_id') {{ $message }} @enderror
		                </p>
			        </div>

					<p class="uk-text-primary uk-text-bold">Location info</p>
					<div class="uk-grid-small" uk-grid>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="city_id">City <span class="uk-text-danger">(Requied *)</span></label>
				            {{ Form::select('city_id', (!empty($cities)) ? $cities : [], $profile->city_id, ['placeholder' => 'Select City', 'id' => 'city_id', 'class' => 'uk-select uk-form-large']) }}
				            <p class="uk-margin-remove-top uk-text-danger error city_id">
			                    @error('city_id') {{ $message }} @enderror
			                </p>
					    </div>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="locations_id">Your location <span class="uk-text-danger">(Requied *)</span></label>
				            {{ Form::select('locations_id', (!empty($selected_locations)) ? $selected_locations : [], $profile->locations_id, ['placeholder' => 'Select Location', 'id' => 'locations_id', 'class' => 'uk-select uk-form-large']) }}
				            <p class="uk-margin-remove-top uk-text-danger error locations_id">
			                    @error('locations_id') {{ $message }} @enderror
			                </p>
					    </div>
				    </div>

			        <div class="uk-margin">
						<p class="uk-text-primary uk-text-bold">Your preferred locations <span class="uk-text-danger">(Requied *)</span></p>
			        	<label class="uk-form-label" for="preferred_locations_id"><span class="uk-text-meta">Select up to 10 locations that not too far from your home/university/workplace.</span></label>
			            {{ Form::select('preferred_locations_id[]', (!empty($locations)) ? $locations : [], $preferred_locations_id, ['id' => 'preferred_locations_id', 'class' => 'uk-select uk-form-large', 'multiple' => 'multiple']) }}
			            <p class="uk-margin-remove-top uk-text-danger error preferred_locations_id">
		                    @error('preferred_locations_id') {{ $message }} @enderror
		                </p>
			        </div>

					<p class="uk-text-primary uk-text-bold">Where do you want to provide your service? <span class="uk-text-danger">(Requied *)</span></p>
					<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
			            <label class="uk-text-emphasis">{{ Form::checkbox('provide_service[]', 'Student Home', (in_array('Student Home', (!empty($provide_service)) ? $provide_service : [])) ? true : false, ['class' => 'uk-checkbox']) }} Student Home</label>
			            <label class="uk-text-emphasis">{{ Form::checkbox('provide_service[]', 'My Home', (in_array('My Home', (!empty($provide_service)) ? $provide_service : [])) ? true : false, ['class' => 'uk-checkbox']) }} My Home</label>

			            <label class="uk-text-emphasis">{{ Form::checkbox('provide_service[]', 'Online', (in_array('Online', (!empty($provide_service)) ? $provide_service : [])) ? true : false, ['class' => 'uk-checkbox']) }} Online</label>
			        </div>
		            <p class="uk-margin-remove-top uk-text-danger error provide_service">
	                    @error('provide_service') {{ $message }} @enderror
	                </p>

					<p class="uk-text-primary uk-text-bold">Experience Info</p>
					<label class="uk-form-label" for="experience"><span class="uk-text-meta">Do you have any tutoring experience?</span> <span class="uk-text-danger">(Requied *)</span></label>
					<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
			            <label class="uk-text-emphasis">{{ Form::radio('experience', 'Yes', ($profile->have_experience == 'Yes') ? true : false, ['class' => 'uk-radio']) }} Yes</label>
			            <label class="uk-text-emphasis">{{ Form::radio('experience', 'No', ($profile->have_experience == 'No') ? true : false, ['class' => 'uk-radio']) }} No</label>
			        </div>
		            <p class="uk-margin-remove-top uk-text-danger error experience">
	                    @error('experience') {{ $message }} @enderror
	                </p>

	                <div class="uk-margin total_experience" style="display: {{ ($profile->have_experience == 'No') ? 'none' : 'block' }};">
	                    <label class="uk-form-label uk-text-bold" for="total_experience">What is your total tutoring experience?</label>
	                    {{ Form::text('total_experience', $profile->experience, ['class' => 'uk-input uk-form-large', 'placeholder' => 'Example: 5 years']) }}
	                    <p class="uk-margin-remove-top uk-text-danger error total_experience">
	                        @error('total_experience') {{ $message }} @enderror
	                    </p>
	                </div>

					<p class="uk-text-primary uk-text-bold">Availability / Salary</p>
			        <div class="uk-margin">
		            	<label class="uk-form-label uk-text-bold" for="availability">Tell us about your availability <span class="uk-text-danger">(Requied *)</span></label>

		            	{{ Form::select('availability[]', ['Saturday' => 'Saturday', 'Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday'], $availability, ['id' => 'availability', 'class' => 'uk-select uk-form-large', 'multiple' => 'multiple']) }}
			            <p class="uk-margin-remove-top uk-text-danger error availability">
			                @error('availability') {{ $message }} @enderror
			            </p>
			        </div>

			        <div class="uk-grid-small" uk-grid>
			            <div class="uk-width-1-2@s">
			                <div class="uk-margin">
			                    <div class="uk-inline uk-width-1-1 bootstrap-timepicker">
			                        <label class="uk-form-label uk-text-bold" for="from_time">From time <span class="uk-text-danger">(Requied *)</span></label>
			                        {{ Form::text('from_time', $profile->from_time, ['class' => 'uk-input uk-form-large timepicker', 'placeholder' => 'From time']) }}
			                    </div>
			                    <p class="uk-margin-remove-top uk-text-danger error from_time">
			                        @error('from_time') {{ $message }} @enderror
			                    </p>
			                </div>
			            </div>
			            <div class="uk-width-1-2@s">
			                <div class="uk-margin">
			                    <div class="uk-inline uk-width-1-1 bootstrap-timepicker">
			                        <label class="uk-form-label uk-text-bold" for="to_time">To time <span class="uk-text-danger">(Requied *)</span></label>
			                        {{ Form::text('to_time', $profile->to_time, ['class' => 'uk-input uk-form-large timepicker', 'placeholder' => 'To time']) }}
			                    </div>
			                    <p class="uk-margin-remove-top uk-text-danger error to_time">
			                        @error('to_time') {{ $message }} @enderror
			                    </p>
			                </div>
			            </div>
			        </div>
			        <div class="uk-margin">
		            	<label class="uk-form-label uk-text-bold" for="salary">Expected salary <span class="uk-text-danger">(Requied *)</span></label>
		            	{{ Form::text('salary', $profile->salary, ['class' => 'uk-input uk-form-large', 'placeholder' => 'Expected salary']) }}
			            <p class="uk-margin-remove-top uk-text-danger error salary">
			                @error('salary') {{ $message }} @enderror
			            </p>
			        </div>
			        <div class="uk-margin">
		            	<label class="uk-form-label uk-text-bold" for="tutoring_style">Preferred tutoring style <span class="uk-text-danger">(Requied *)</span></label>
		                {{ Form::select('tutoring_style[]', ['One to one' => 'One to one', 'One to many' => 'One to many', 'Online tutoring' => 'Online tutoring'], $tutoring_style, ['id' => 'tutoring_style', 'class' => 'uk-select uk-form-large', 'multiple' => 'multiple']) }}
			            <p class="uk-margin-remove-top uk-text-danger error tutoring_style">
			                @error('tutoring_style') {{ $message }} @enderror
			            </p>
			        </div>
			        <div class="uk-margin uk-text-center uk-align-right@m">
			        	<button type="submit" class="uk-button uk-button-primary">Save & Continue</button>
			        </div>
				</form>
				<form id="educationInformationForm" action="javaScript:;">
					@csrf
					<p class="uk-text-primary uk-text-bold">Education Information</p>
					<div class="uk-margin">
						<label class="uk-form-label" for="level_of_education">Add Masters, Honors, HSC/A Level, SSC/O Level <span class="uk-text-danger">(Required)*</span></label>
						{{ Form::select('level_of_education', ['Secondary' => 'Secondary', 'Higher Secondary' => 'Higher Secondary', 'Diploma' => 'Diploma', 'Bachelor/Honors' => 'Bachelor/Honors', 'Masters' => 'Masters', 'Doctoral' => 'Doctoral'], null, ['id' => 'level_of_education', 'class' => 'uk-select uk-form-large', 'placeholder' => 'Select education level']) }}
		                <p class="uk-margin-remove-top uk-text-danger error level_of_education">
		                    @error('level_of_education') {{ $message }} @enderror
		                </p>
			        </div>
				    <div class="uk-margin">
				    	<label class="uk-form-label" for="degree_title">Exam Name <small>e.g BBA, MBA, BSC, MSC, Bcom</small></label>
			            {{ Form::text('degree_title', null, ['id' => 'degree_title', 'class' => 'uk-input uk-form-large', 'placeholder' => 'e.g BBA, MBA, BSC, MSC, Bcom']) }}
			            <p class="uk-margin-remove-top uk-text-danger error degree_title">
			                @error('degree_title') {{ $message }} @enderror
			            </p>
				    </div>
				    <div class="uk-margin">
				    	<label class="uk-form-label" for="group_name">Subject <span class="uk-text-danger">(Requied *)</span></label>
				    	{{ Form::text('group_name', null, ['id' => 'group_name', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Subject']) }}
			            <p class="uk-margin-remove-top uk-text-danger error group_name">
			                @error('group_name') {{ $message }} @enderror
			            </p>
				    </div>

			        <div class="uk-margin">
			        	<label class="uk-form-label" for="institute_name">Institute Name ( University/Collage ) <span class="uk-text-danger">(Requied *)</span></label>
			        	{{ Form::text('institute_name', null, ['id' => 'institute_name', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Institute Name ( University/Collage )']) }}
			            <p class="uk-margin-remove-top uk-text-danger error institute_name">
			                @error('institute_name') {{ $message }} @enderror
			            </p>
			        </div>
			        <div class="uk-margin">
				    	<label class="uk-form-label" for="curriculum">Curriculum <span class="uk-text-danger">(Requied *)</span></label>
		            	{{ Form::select('curriculum', ['Bangla version' => 'Bangla version', 'English version' => 'English version', 'Cambridge' => 'Cambridge', 'Ed-excel' => 'Ed-excel', 'IB' => 'IB'], null, ['id' => 'curriculum', 'class' => 'uk-select uk-form-large', 'placeholder' => 'Select curriculum']) }}
			            <p class="uk-margin-remove-top uk-text-danger error curriculum">
			                @error('curriculum') {{ $message }} @enderror
			            </p>
			        </div>

					<div class="uk-grid-small" uk-grid>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="is_until">I'm currently studying here <span class="uk-text-danger">(Requied *)</span></label>
			            	{{ Form::select('is_until', ['1st Year' => '1st Year', '2nd Year' => '2nd Year', '3rd Year' => '3rd Year', 'Final Year' => 'Final Year', 'Completed' => 'Completed'], null, ['id' => 'is_until', 'class' => 'uk-select uk-form-large', 'placeholder' => 'Select Current Year']) }}
				            <p class="uk-margin-remove-top uk-text-danger error is_until">
				                @error('is_until') {{ $message }} @enderror
				            </p>
					    </div>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="result">GPA / CGPA<span class="uk-text-meta"></span></label>
			            	{{ Form::text('result', null, ['id' => 'result', 'class' => 'uk-input uk-form-large', 'placeholder' => 'GPA / CGPA']) }}
				            <p class="uk-margin-remove-top uk-text-danger error result">
				                @error('result') {{ $message }} @enderror
				            </p>
					    </div>
				    </div>
					<div class="uk-grid-small" uk-grid>
					    <div class="uk-width-1-3@s">
					    	<label class="uk-form-label" for="year_of_passing">Year of passing<span class="uk-text-meta"></span></label>
			            	{{ Form::text('year_of_passing', null, ['id' => 'year_of_passing', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Year of passing']) }}
				            <p class="uk-margin-remove-top uk-text-danger error year_of_passing">
				                @error('year_of_passing') {{ $message }} @enderror
				            </p>
					    </div>
					    <div class="uk-width-1-3@s">
					    	<label class="uk-form-label" for="from_date">From<span class="uk-text-meta"></span></label>
			            	{{ Form::text('from_date', null, ['id' => 'from_date', 'class' => 'uk-input uk-form-large datepick', 'placeholder' => 'From']) }}
				            <p class="uk-margin-remove-top uk-text-danger error from_date">
				                @error('from_date') {{ $message }} @enderror
				            </p>
					    </div>
					    <div class="uk-width-1-3@s">
					    	<label class="uk-form-label" for="until_date">Until Date<span class="uk-text-meta"></span></label>
			            	{{ Form::text('until_date', null, ['id' => 'until_date', 'class' => 'uk-input uk-form-large datepick', 'placeholder' => 'Until Date']) }}
				            <p class="uk-margin-remove-top uk-text-danger error until_date">
				                @error('until_date') {{ $message }} @enderror
				            </p>
					    </div>
				    </div>
			        <div class="uk-margin uk-align-right">
			        	<button type="submit" class="uk-button uk-button-secondary">Save</button>
			        </div>
				</form>
				<form id="personalInformationForm" action="javaScript:;">
					@csrf
					<p class="uk-text-primary uk-text-bold">Personal Information</p>
					<p class="uk-form-label">Gender <span class="uk-text-danger">(Requied *)</span></p>
					<div class="uk-form-horizontal">
						<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
				            <label class="uk-text-emphasis">{{ Form::radio('gender', 'Male', ($profile->gender == 'Male') ? true : false, ['class' => 'uk-radio']) }} Male</label>
				            <label class="uk-text-emphasis">{{ Form::radio('gender', 'Female', ($profile->gender == 'Female') ? true : false, ['class' => 'uk-radio']) }} Female</label>
				        </div>
			            <p class="uk-margin-remove-top uk-text-danger error gender">
		                    @error('gender') {{ $message }} @enderror
		                </p>
					</div>
					
			        <div class="uk-margin">
			        	<label class="uk-form-label" for="identity"><span class="uk-text-meta">NID / Passport No / Birth Certificate No</span> <span class="uk-text-danger">(Requied *)</span></label>
			        	{{ Form::text('identity', $profile->identity, ['id' => 'identity', 'class' => 'uk-input uk-form-large', 'placeholder' => 'NID / Passport No / Birth Certificate Noer']) }}
			            <p class="uk-margin-remove-top uk-text-danger error identity">
			                @error('identity') {{ $message }} @enderror
			            </p>
			        </div>

					<p class="uk-text-primary uk-text-bold">Socials Links</p>
					<div class="uk-margin">
				    	<label class="uk-form-label" for="facebook_link">Facebok Profile Link/Name</label>
			            {{ Form::text('facebook_link', $profile->facebook_link, ['id' => 'facebook_link', 'class' => 'uk-input uk-form-large', 'placeholder' => 'ex: https://www.facebook.com/your_profile_name']) }}
			            <p class="uk-margin-remove-top uk-text-danger error facebook_link">
			                @error('facebook_link') {{ $message }} @enderror
			            </p>
					</div>

			        <div class="uk-margin">
			        	<label class="uk-form-label" for="form-stacked-text"><span class="uk-text-meta">Parmanent Address</span></label>
			        	<textarea id="address" class="uk-textarea" name="address" rows="5" placeholder="{{ __('Parmanent Address') }}">{{ $profile->address }}</textarea>
			        	<p class="uk-margin-remove-top uk-text-danger error address">
			                @error('address') {{ $message }} @enderror
			            </p>
			        </div>

					<p class="uk-text-primary uk-text-bold">Parents Information</p>
					<div class="uk-grid-small" uk-grid>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="father_name">Father's name <span class="uk-text-danger">(Requied *)</span></label>
				            {{ Form::text('father_name', $profile->father_name, ['id' => 'father_name', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Father\'s name']) }}
				            <p class="uk-margin-remove-top uk-text-danger error father_name">
				                @error('father_name') {{ $message }} @enderror
				            </p>
					    </div>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="father_mobile_no">Father's phone no <span class="uk-text-danger">(Requied *)</span></label>
					    	{{ Form::text('father_mobile_no', $profile->father_mobile_no, ['id' => 'father_mobile_no', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Father\'s phone no']) }}
				            <p class="uk-margin-remove-top uk-text-danger error father_mobile_no">
				                @error('father_mobile_no') {{ $message }} @enderror
				            </p>
					    </div>
				    </div>
					<div class="uk-grid-small" uk-grid>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="mother_name">Mother's name <span class="uk-text-danger">(Requied *)</span></label>
				            {{ Form::text('mother_name', $profile->mother_name, ['id' => 'mother_name', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Mother\'s name']) }}
				            <p class="uk-margin-remove-top uk-text-danger error mother_name">
				                @error('mother_name') {{ $message }} @enderror
				            </p>
					    </div>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="mother_mobile_no">Mother's phone no <span class="uk-text-danger">(Requied *)</span></label>
					    	{{ Form::text('mother_mobile_no', $profile->mother_mobile_no, ['id' => 'mother_mobile_no', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Mother\'s phone no']) }}
				            <p class="uk-margin-remove-top uk-text-danger error mother_mobile_no">
				                @error('mother_mobile_no') {{ $message }} @enderror
				            </p>
					    </div>
				    </div>

					<p class="uk-text-primary uk-text-bold">Emergency Contact Info</p>

					<div class="uk-grid-small" uk-grid>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="emergency_name">Emergency's name <span class="uk-text-danger">(Requied *)</span></label>
				            {{ Form::text('emergency_name', $profile->emergency_name, ['id' => 'emergency_name', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Emergency\'s name']) }}
				            <p class="uk-margin-remove-top uk-text-danger error emergency_name">
				                @error('emergency_name') {{ $message }} @enderror
				            </p>
					    </div>
					    <div class="uk-width-1-2@s">
					    	<label class="uk-form-label" for="emergency_mobile_no">Emergency's phone no <span class="uk-text-danger">(Requied *)</span></label>
					    	{{ Form::text('emergency_mobile_no', $profile->emergency_mobile_no, ['id' => 'emergency_mobile_no', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Emergency\'s phone no']) }}
				            <p class="uk-margin-remove-top uk-text-danger error emergency_mobile_no">
				                @error('emergency_mobile_no') {{ $message }} @enderror
				            </p>
					    </div>
				    </div>
			        <div class="uk-margin">
				    	<label class="uk-form-label" for="emergency_relation">Relation <span class="uk-text-danger">(Requied *)</span></label>
				    	{{ Form::text('emergency_relation', $profile->emergency_relation, ['id' => 'emergency_relation', 'class' => 'uk-input uk-form-large', 'placeholder' => 'Relation']) }}
			            <p class="uk-margin-remove-top uk-text-danger error emergency_relation">
			                @error('emergency_relation') {{ $message }} @enderror
			            </p>
			        </div>
			        <div class="uk-margin">
			        	<label class="uk-form-label" for="form-stacked-text"><span class="uk-text-meta">Present's Address</span></label>
			        	<textarea id="emergency_address" class="uk-textarea" name="emergency_address" rows="5" placeholder="{{ __('Present\'s Address') }}">{{ $profile->emergency_address }}</textarea>
			            <p class="uk-margin-remove-top uk-text-danger error emergency_address">
			                @error('emergency_address') {{ $message }} @enderror
			            </p>
			        </div>
			        <div class="uk-margin uk-align-right">
			        	<button type="submit" class="uk-button uk-button-primary">Save & Finish</button>
			        </div>
				</form>
			</div>
		</div>
    </div>
    <div class="uk-width-1-3@m">
    	<div class="make_profile_strong uk-card uk-card-body uk-card-small">
		    <div class="uk-card-header uk-card-primary uk-text-center uk-text-large">Make Your Profile Strong</div>
		    <div class="uk-card-body uk-card-default">
			    <a href="{{ route('tutor.profile.upload_credentials') }}" class="uk-button uk-width-1-1 uk-margin-small-bottom" style="background-color: #1e87f0; color: #fff">Upload Your Documents</a>
				<button class="uk-button uk-button-danger uk-width-1-1 uk-margin-small-bottom" uk-toggle="target: #modal-example">Photo Upload Instruction</button>
		    </div>
		</div>
    </div>
</div>
<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">How to upload a perfect profile picture</h2>
        <p>You have excellent educational background and good experience of tutoring, but you’re having a hard time to find new tuitions. Sound familiar? If so, consider the first impression your profile makes with prospective client.</p>
        <p>Your profile is how you present yourself to the world. And if a picture is worth a thousand words, what does your profile picture say about you? Does it say you’re friendly, professional, and easy to get along with?</p>
        <p>Client look at profile photos to get a sense of who you are…and if they don’t see a photo that conveys friendliness and professionalism, you may get overlooked. To help you attract client and stand out from the crowd, keep these guidelines in mind when you’re snapping your pics.</p>
        <p><strong>1) Find your best light</strong></p>
        <p>Shady areas outdoors, without direct sunlight, are a great lighting choice. Inside, avoid overhead light, which creates harsh shadows, and instead look for natural light.</p>
        <p><strong>2) Simplify the background</strong></p>
        <p>Look for a background that is clear and uncluttered. A solid, not-too-bright wall or simple outdoor background works well.</p>
        <p><strong>3) Focus on your face</strong></p>
        <p>Face the camera straight on or with your shoulders at a slight angle. Crop so that you only include your head and the top of your shoulders.</p>
        <p><strong>4) Smile! (You’ll land more jobs)</strong></p>
        <p>Clients find smiling tutors more warm, friendly, and trustworthy. Not used to smiling for the camera? Try pretending that you are greeting your best friend.</p>

        <h4 class="uk-text-center uk-text-bold uk-margin-small-top">Do & Don't Examples (Male)</h4>
        <img src="{{ asset('assets/images/male_example.jpg') }}" alt="">
        <h4 class="uk-text-center uk-text-bold uk-margin-small-top">Do & Don't Examples (Female)</h4>
        <img src="{{ asset('assets/images/female_example.jpg') }}" alt="">

        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        </p>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#categories_id').select2({
		maximumSelectionLength: 5,
		placeholder: "Select categories",
	});
	$('#courses_id').select2({
		placeholder: "Select class / course(s)"
	});
	$('#subjects_id').select2({
		placeholder: "Your preferred subjects(s)"
	});
	$('#availability').select2({
		placeholder: "Days of week"
	});
	$('#preferred_locations_id').select2({
		maximumSelectionLength: 10,
		placeholder: "Select your preferred locations"
	});
	$('#tutoring_style').select2({
		placeholder: "Tutoring Style"
	});

	/*$('#is_until').change(function(){
        var is_until = $(this).val();
		$('#until_date').val("");
        $('#until_date').attr('disabled', 'disabled');
		$('#year_of_passing').val("");
        $('#year_of_passing').attr('disabled', 'disabled');
        if (is_until == 'Completed') {
	        $('#until_date').removeAttr('disabled', 'disabled');
	        $('#year_of_passing').removeAttr('disabled', 'disabled');
        }
	});*/

	$('input[name="experience"]').click(function(){
		$('#total_experience').val("");
		if ($(this).val() == 'Yes')
		{
			$('.total_experience').show();
		}
		else
		{
			$('.total_experience').hide();
		}
	})

	$("#categories_id").change(function(){
        var categories_id = $(this).val();
        $('#courses_id').select2({
			placeholder: "Select class / course(s)"
		}).empty().trigger('change');
        $('#subjects_id').select2({
			placeholder: "Your preferred subjects(s)"
		}).empty().trigger('change');
        if (categories_id != "") {
			axios.get('{{ route("get_cources_with_group") }}/'+categories_id)
	        .then(function (response) {
	            console.log(response);
	            $('#courses_id').select2({
					data: response.data,
					placeholder: "Select class / course(s)"
				});
	        })
	        .catch(function (error) {
	            console.log(error);
	        });
    	}
	});

	$("#courses_id").change(function(){
        var courses_id = $(this).val();
        $('#subjects_id').select2({
			placeholder: "Your preferred subjects(s)"
		}).empty().trigger('change');
        if (courses_id != "") {
			axios.get('{{ route("get_subjects_with_group") }}/'+courses_id)
	        .then(function (response) {
	            console.log(response);
	            $('#subjects_id').select2({
					data: response.data,
					placeholder: "Your preferred subjects(s)"
				});
	        })
	        .catch(function (error) {
	            console.log(error);
	        });
    	}
	});

    $("#city_id").change(function(){
        var city_id = $(this).val();
        var initsellocation = '<option selected="selected" value="">Select Location</option>';
        $("#locations_id").html(initsellocation);
        
        if (city_id != "") {
            axios.get('{{ route("get_locations") }}/'+city_id)
            .then(function (response) {
                var opt = [];
                opt.push(initsellocation);
                $.each(response.data, function (key, value) {
                    opt.push('<option value="' + key + '">' + value + '</option>');
                });
                $("#locations_id").html(opt);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    });

    $("#tuitionRelatedInformationForm").submit(function() {
        axios.post('{{ route("tutor.profile.update.tuition") }}', $(this).serialize())
        .then(function (response) {
            console.log(response);
            $(".error.uk-text-danger").html("&nbsp;");
            toastr.success(response.data.success);
        })
        .catch(function (error) {
            console.log(error.response);
            $(".error.uk-text-danger").html("&nbsp;");
            $.each(error.response.data.errors, function(index, value){
                $(".error." + index + "").html(value[0]);
            });
            if (error.response.data.errors != null) {
            	toastr.error(error.response.data.message);
            }
            if (error.response.data.error != null) {
            	toastr.error(error.response.data.error);
            }
        });
    });

    $("#educationInformationForm").submit(function() {
        axios.post('{{ route("tutor.profile.update.education") }}', $(this).serialize())
        .then(function (response) {
            console.log(response);
            $(".error.uk-text-danger").html("&nbsp;");
            toastr.success(response.data.success);
            $('#educationInformationForm')[0].reset();
        })
        .catch(function (error) {
            console.log(error.response);
            $(".error.uk-text-danger").html("&nbsp;");
            $.each(error.response.data.errors, function(index, value){
                $(".error." + index + "").html(value[0]);
            });
            if (error.response.data.errors != null) {
            	toastr.error(error.response.data.message);
            }
            if (error.response.data.error != null) {
            	toastr.error(error.response.data.error);
            }
        });
    });

    $("#personalInformationForm").submit(function() {
        axios.post('{{ route("tutor.profile.update.personal") }}', $(this).serialize())
        .then(function (response) {
            console.log(response);
            $(".error.uk-text-danger").html("&nbsp;");
            toastr.success(response.data.success);
        })
        .catch(function (error) {
            console.log(error.response);
            $(".error.uk-text-danger").html("&nbsp;");
            $.each(error.response.data.errors, function(index, value){
                $(".error." + index + "").html(value[0]);
            });
            if (error.response.data.errors != null) {
            	toastr.error(error.response.data.message);
            }
            if (error.response.data.error != null) {
            	toastr.error(error.response.data.error);
            }
        });
    })
})
</script>
@endsection
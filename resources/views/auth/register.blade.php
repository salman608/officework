@extends('layouts.frontend')
@section('content')
<div class="blocks">
    <h5 class="title">{{ __('Hire A Tutor') }}</h5>
    <div class="content">
        <form id="registerForm" action="javaScript:;">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city_id">Select City <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('city_id', $cities, old('city_id'), ['placeholder' => 'Select City', 'id' => 'city_id', 'class' => 'form-control '.($errors->has('city_id') ? 'is-invalid':'').'']) }}
                    <p id="city_id_help" class="form-text text-muted error_city_id">@error('city_id') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="locations_id">Select Location <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('locations_id', [], old('locations_id'), ['placeholder' => 'Select Location', 'id' => 'locations_id', 'class' => 'form-control '.($errors->has('locations_id') ? 'is-invalid':'').'']) }}
                    <p id="locations_id_help" class="form-text text-muted error_locations_id">@error('locations_id') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="categories_id">Select Category <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('categories_id', $categories, old('categories_id'), ['placeholder' => 'Select Category', 'id' => 'categories_id', 'class' => 'form-control '.($errors->has('categories_id') ? 'is-invalid':'').'']) }}
                    <p id="categories_id_help" class="form-text text-muted error_categories_id">@error('categories_id') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="courses_id">Select Class/Course <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('courses_id', [], old('courses_id'), ['placeholder' => 'Select Class/Course', 'id' => 'courses_id', 'class' => 'form-control '.($errors->has('courses_id') ? 'is-invalid':'').'']) }}
                    <p id="courses_id_help" class="form-text text-muted error_courses_id">@error('courses_id') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="student_gender">Select Student Gender <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('student_gender', ['male' => 'Male', 'female' => 'Female'], old('student_gender'), ['placeholder' => 'Select Student Gender', 'id' => 'student_gender', 'class' => 'form-control '.($errors->has('student_gender') ? 'is-invalid':'').'']) }}
                    <p id="student_gender_help" class="form-text text-muted error_student_gender">@error('student_gender') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="institute_name">Institute Name <span class="text-danger">(Requied *)</span></label>
                    <input id="institute_name" class="form-control @error('institute_name') is-invalid @enderror" type="text" name="institute_name" placeholder="{{ __('Institute Name') }}" value="{{ old('institute_name') }}">
                    <p id="institute_name_help" class="form-text text-muted error_institute_name">@error('institute_name') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Your Name ( Guardian ) <span class="text-danger">(Requied *)</span></label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="{{ __('Your Name') }}" value="{{ old('name') }}">
                    <p id="name_help" class="form-text text-muted error_name">@error('name') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Parents Phone Number <span class="text-danger">(Requied *)</span></label>
                    <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="number" name="phone" placeholder="{{ __('Parents Phone Number') }}" value="{{ old('phone') }}">
                    <p id="phone_help" class="form-text text-muted error_phone">@error('phone') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-group">
                <label for="subjects_id">Select Subjects <span class="text-danger">(Requied *)</span></label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkall">
                    <label class="custom-control-label" for="checkall">Check All</label>
                </div>
                <span id="subjects_id"></span>
                <p id="subjects_id_help" class="form-text text-muted error_subjects_id">@error('subjects_id') {{ $message }} @enderror</p>
            </div>
            <div class="form-group" id="curriculums" style="display: none;">
                <label for="curriculum">Select Curriculum <span class="text-danger">(Requied *)</span></label>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="curriculum" id="Cambridge" checked value="Cambridge">
                        <label class="custom-control-label" for="Cambridge">Cambridge</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="curriculum" id="Ed-excel" value="Ed-excel">
                        <label class="custom-control-label" for="Ed-excel">Ed-excel</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="curriculum" id="IB" value="IB">
                        <label class="custom-control-label" for="IB">IB</label>
                    </div>
                </div>
                <p id="curriculum_help" class="form-text text-muted error_curriculum">@error('curriculum') {{ $message }} @enderror</p>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="peferred_gender">Tutor gender reference <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('peferred_gender', ['any' => 'Any', 'male' => 'Male', 'female' => 'Female'], old('peferred_gender'), ['placeholder' => 'Select Tutor gender reference', 'id' => 'peferred_gender', 'class' => 'form-control '.($errors->has('peferred_gender') ? 'is-invalid':'').'']) }}
                    <p id="peferred_gender_help" class="form-text text-muted error_peferred_gender">@error('peferred_gender') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="weekly">Days in a week <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('weekly', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7], old('weekly'), ['placeholder' => 'Select Days in a week', 'id' => 'weekly', 'class' => 'form-control '.($errors->has('weekly') ? 'is-invalid':'').'']) }}
                    <p id="weekly_help" class="form-text text-muted error_weekly">@error('weekly') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="salary">Salary <span class="text-danger">(Requied *)</span></label>
                    <input id="salary" class="form-control @error('salary') is-invalid @enderror" type="number" name="salary" placeholder="{{ __('Salary') }}" value="{{ old('salary') }}">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="salary_negotiate" name="salary_negotiate">
                        <label class="custom-control-label" for="salary_negotiate">Check if you want to negotiate salary</label>
                    </div>
                    <p id="salary_help" class="form-text text-muted error_salary">@error('salary') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="hire_date">When Are You Looking To Hire <span class="text-danger">(Requied *)</span></label>
                    <input id="hire_date" class="form-control datepick @error('hire_date') is-invalid @enderror" type="text" name="hire_date" placeholder="{{ __('When Are You Looking To Hire') }}" value="{{ old('hire_date') }}">
                    <p id="hire_date_help" class="form-text text-muted error_hire_date">@error('hire_date') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-group">
                <div class="uk-inline uk-width-1-1">
                    <label for="address">Address <span class="text-danger">(Requied *)</span></label>
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="5" placeholder="{{ __('Address') }}">{{ old('address') }}</textarea>
                </div>
                <p id="address_help" class="form-text text-muted error_address">@error('address') {{ $message }} @enderror</p>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="no_of_students">No. of student <span class="text-danger">(Requied *)</span></label>
                    {{ Form::select('no_of_students', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10], old('no_of_students'), ['placeholder' => 'Select No. of student', 'id' => 'no_of_students', 'class' => 'form-control '.($errors->has('no_of_students') ? 'is-invalid':'').'']) }}
                    <p id="no_of_students_help" class="form-text text-muted error_no_of_students">@error('no_of_students') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6 bootstrap-timepicker">
                    <label for="tutoring_time">Tutoring Time <span class="text-danger">(Requied *)</span></label>
                    <input id="tutoring_time" class="form-control timepicker @error('tutoring_time') is-invalid @enderror" type="text" name="tutoring_time" placeholder="{{ __('Tutoring Time') }}" value="{{ old('tutoring_time') }}">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="tutoring_time_negotiate" name="tutoring_time_negotiate">
                        <label class="custom-control-label" for="tutoring_time_negotiate">Check if you want to negotiate Tutoring Time</label>
                    </div>
                    <p id="tutoring_time_help" class="form-text text-muted error_tutoring_time">@error('tutoring_time') {{ $message }} @enderror</p>
                </div>
            </div>
            <div class="form-group">
                <label for="requirements">Requirements</label>
                <textarea id="requirements" class="form-control @error('requirements') is-invalid @enderror" name="requirements" rows="5" placeholder="{{ __('Please tell us a bit more about your  requirement to help us match better') }}">{{ old('requirements') }}</textarea>
                <p id="requirements_help" class="form-text text-muted error_requirements">@error('requirements') {{ $message }} @enderror</p>
            </div>
            <div class="form-group">
                <label for="hear_about_us">How Did You Hear About Us?</label>
                {{ Form::select('hear_about_us', ['From Friends & Family' => 'From Friends & Family', 'From Facebook' => 'From Facebook', 'From Google' => 'From Google', 'From Shop' => 'From Shop', 'Others' => 'Others'], old('hear_about_us'), ['placeholder' => 'Select How Did You Hear About Us?', 'id' => 'hear_about_us', 'class' => 'form-control '.($errors->has('hear_about_us') ? 'is-invalid':'').'']) }}
                <p id="hear_about_us_help" class="form-text text-muted error_hear_about_us">@error('hear_about_us') {{ $message }} @enderror</p>
            </div>
            <div class="form-group">
                <label for="form-stacked-text">Email Address <span class="text-danger">(Requied *)</span></label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email"" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}">
                <p id="email_help" class="form-text text-muted error_email">@error('email') {{ $message }} @enderror</p>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="form-stacked-text">Password <span class="text-danger">(Requied *)</span></label>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="{{ __('Password') }}">
                    <p class="text-danger">Your password must be 8 characters long</p>
                    <p id="password_help" class="form-text text-muted error_password">@error('password') {{ $message }} @enderror</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="password-confirm">Retype Password <span class="text-danger">(Requied *)</span></label>
                    <input id="password-confirm" class="form-control" type="password" name="password_confirmation" placeholder="{{ __('Retype Password') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Sign Up') }}</button>
            <p class="mt-2">By Signing up, you agree to our <a href="{{ route('conditions') }}">Terms of Use and Privacy Policy</a></p>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#salary_negotiate').click( function(){
        var is_checked = $(this).prop('checked');
        $('#salary').removeAttr('disabled', 'disabled');
        if (is_checked) {
            $('#salary').attr('disabled', 'disabled');
            $('#salary').val('');
        }
    });

    $('#tutoring_time_negotiate').click( function(){
        var is_checked = $(this).prop('checked');
        $('#tutoring_time').removeAttr('disabled', 'disabled');
        if (is_checked) {
            $('#tutoring_time').attr('disabled', 'disabled');
            $('#tutoring_time').val('');
        }
    });

    $("#checkall").on('click',function(){
        if(this.checked){
            $('.select_subject_checkbox').prop('checked',true);
        }
        else
        {
            $('.select_subject_checkbox').prop('checked',false);
        }
    });
    $('.select_subject_checkbox').on('click',function(){
        if($('.select_subject_checkbox:checked').length == $('.select_subject_checkbox').length){
            $('#checkall').prop('checked',true);
        }else{
            $('#checkall').prop('checked',false);
        }
    });

    $("#registerForm").submit(function() {
        axios.post('{{ route("register") }}', $(this).serialize())
        .then(function (response) {
            console.log(response);
            $(".form-text.text-muted").html("&nbsp;");
            toastr.success(response.data.success);
            window.location.href = '{{ route("login") }}';
        })
        .catch(function (error) {
            console.log(error.response);
            $(".form-text.text-muted").html("&nbsp;");
            $.each(error.response.data.errors, function(index, value){
                $(".error_" + index + "").html(value[0]);
            });
            if (error.response.data.errors != null) {
            toastr.error(error.response.data.message);
            }
            if (error.response.data.error != null) {
            toastr.error(error.response.data.error);
            }
        });
    })
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

    $('input[name="curriculum"]').attr('disabled', 'disabled');
    $("#categories_id").change(function(){
        var categories_id = $(this).val();
        var initselcourse = '<option selected="selected" value="">Select Class/Course</option>';
        var initselsubject = '';
        $("#courses_id").html(initselcourse);
        $("#subjects_id").html(initselsubject);
        
        if (categories_id != "") {
            axios.get('{{ route("get_cources") }}/'+categories_id)
            .then(function (response) {
                var opt = [];
                opt.push(initselcourse);
                $.each(response.data, function (key, value) {
                    opt.push('<option value="' + key + '">' + value + '</option>');
                });
                $("#courses_id").html(opt);
            })
            .catch(function (error) {
                console.log(error);
            });

            if ($("#categories_id option:selected").text() == 'English Medium') {
                $('#curriculums').show();
                $('input[name="curriculum"]').removeAttr('disabled', 'disabled');
            }
            else
            {
                $('#curriculums').hide();
                $('input[name="curriculum"]').attr('disabled', 'disabled');
            }
        }
    });

    $("#courses_id").change(function(){
        var courses_id = $(this).val();
        var initselsubject = '';
        $("#subjects_id").html(initselsubject);
        
        if (courses_id != "") {
            axios.get('{{ route("get_subjects") }}/'+courses_id)
            .then(function (response) {
                var opt = [];
                opt.push(initselsubject);
                $.each(response.data, function (key, value) {
                    opt.push('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input select_subject_checkbox" name="subjects_id[]" id="id_' + key + '" value="' + key + '"><label class="custom-control-label" for="id_' + key + '">' + value + '</label></div>');
                });
                $("#subjects_id").html(opt);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    });
})
</script>
@endsection

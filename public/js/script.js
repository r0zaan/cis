$(document).ready(function(){


    $(function(){

        $(document).on('click', '.ajax-modal-box', function(){
            if($(this).hasClass('big')){
                $('.modal-dialog').css('width','800px').css('max-width','800px');
            }
            url = $(this).attr('data-url');
            title = $(this).attr('data-title');
            if (title === "Add Voter" || title === "Edit Voter") {
                $('.modal .modal-dialog').addClass('modal-lg');
            }
            $('.ajax-form-model').modal();
            $('.modal .modal-title').html(title);
            $('.ajax-form-model .panel-body').load(url,function () {
                $('.select2').not('.manual').select2();
            });
            $('.ajax-load-image').addClass('hidden');
        });
        $('.ajax-form-model').on('hidden.bs.modal', function () {
            $(".ajax-form-model .panel-body").html('');
            var prep_content = $('.prep').html();
            $(".ajax-form-model .panel-body").html(prep_content);

        });

    });


    $(function(){

        $(document).on('submit', '.ajax-form-post', function(e){
            e.preventDefault();

            var url = $(this).attr('action');
            var form = $(this);
            var formData = false;
            if (window.FormData) {
                formData = new FormData(form[0]);
            }

            $( '.error-message' ).each(function( ) {
                $(this).html('');
            });

            $.ajax({
                url : url,
                data : formData ? formData : form.serialize(),
                cache : false,
                contentType : false,
                processData : false,
                type        : 'POST',
                success : function(response){
                    console.log(response);
                    // SUCCESS
                    if (response.status === "success") {
                        $('.loadTable').load(location.href + ' .loadTable .tableData');
                        $('.ajax-form-model').modal('toggle');

                        // set message
                        $('.ajax-message-div').html(response.message);
                        $('.response-flash').show().delay(3000).hide(0);
                    }
                    // UNABLE
                    if (response.status =='unable') {
                        $('.ajax-form-model').modal('toggle');

                        // set message
                        $('.ajax-message-div').html(response.message);
                        $('.response-flash-unable').show().delay(3000).hide(0);

                    }
                    if (response.status === "fail") {
                        for (var key in response.errors) {
                            //console.log(response);
                            var error_message = response.errors[key];

                            var error_form_field = form.find("[name=" + key + "]");
                            error_form_field.addClass('errors');
                            error_form_field.parent().find('.error-message').addClass('text-danger').html(error_message);
                        }
                    }
                }
            });
        });
    });

    $(function(){

        $(document).on('change', '.ajax-input', function(){
            var url = $(this).attr('data-url');
            var type = $(this).attr('data-type');
            var id = $(this).children("option:selected").val();

            $.get(url,{data : id, type : type},function(response){
                console.log(response);
                if (type == "district") {
                    $('.filterDistrict').html(response);
                }

                if (type == "area") {
                    $('.filterConstituencyArea').html(response);
                }

                if (type == "municipality") {
                    $('.filterMunicipality').html(response);
                }
                if (type == "ward") {
                    $('.filterWard').html(response);
                }

                if (type == "poll") {
                    $('.filterLocation').html(response);
                }
            });
        });
    });


    $(function(){

        $(document).on('click','.click-ajax',function (e) {
            e.preventDefault();
            $('.imgLoaderDiv').css('display','block');
            // console.log($('.prep').html());
            $('.change').html($('.prep').html());
            var url = $(this).attr('data-url');
            $( '.error-message' ).each(function( ) {
                $(this).html('');
            });

            $.ajax({
                url : url,
                contentType : false,
                processData : false,
                type        : 'GET',
                success : function(response){
                    console.log(response);
                    // SUCCESS
                    $('.imgLoaderDiv').css('display','none');
                    $('.change').html(response);
                }
            });
        });
    });





    $(function(){
        $(document).on('submit', 'form.delete-data-ajax', function (e) {
            var current_form = $(this);
            sweetAlert({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false
                },
                function () {

                    var request_data = {};

                    request_data['_token'] = current_form.find('input[name=_token]').val();

                    $.ajax({
                        type: current_form.attr('method'),
                        url: current_form.attr('action'),
                        data: request_data,
                        success: function (response) {
                            console.log(response);
                            if (response.status === "success") {
                                $('.loadTable').load(location.href + ' .loadTable .tableData');

                                // set message
                                $('.ajax-message-div').html(response.message);
                                $('.response-flash').show().delay(3000).hide(0);
                            }
                            // UNABLE
                            if (response.status =='unable') {

                                // set message
                                $('.ajax-message-div').html(response.message);
                                $('.response-flash-unable').show().delay(3000).hide(0);

                            }
                        }
                    });

                    swal("Deleted!", "Deleted Successfully!", "success");
                });

            return false;
        });
    });





});
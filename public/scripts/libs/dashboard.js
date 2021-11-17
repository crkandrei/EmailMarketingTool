
let Dashboard = function () {

    var CSRF = $('meta[name="csrf-token"]').attr('content');

    let handleClickSendMassMessage = function (){

       $('#send_mass_email').on('click', function () {
           $.ajax({
               url: "/dashboard/send-email",
               method: "POST",
               data: {
                   group_id : $('#form_group_id').val(),
                   template_id : $('#form_template_id').val(),
                   _token : CSRF
               },
               success: function() {
                   toastr.success('Mass email sent with success!')
               }
           });
       });

        $('#schedule_mass_email').on('click', function () {
            $.ajax({
                url: "/dashboard/schedule-email",
                method: "POST",
                data: {
                    group_id : $('#form_group_id').val(),
                    template_id : $('#form_template_id').val(),
                    date : $('#form_date').val(),
                    _token : CSRF
                },
                success: function() {
                    toastr.success('Schedule set with success!');
                }
            });
        })
   }


    return {
        init: function () {
            handleClickSendMassMessage();
        }
    }
}();

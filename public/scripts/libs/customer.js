
let Customer = function () {

    let tableCustomer;

    let handleDatatable = function () {

        tableCustomer = $('#table_customer').DataTable({
            processing: true,
            serverSide: true,
            ajax: "customer",
            method: "GET",
            columns: [
                {width:"10%", title:'#', data:'DT_RowIndex', name:'DT_RowIndex'},
                {width:"10%", title:'First Name', data:'first_name', name:'first_name'},
                {width:"10%", title:'Last Name', data:'last_name', name:'last_name'},
                {width:"10%", title:'Gender', data:'gender', name:'gender'},
                {width:"20%", title:'Email', data:'email', name:'email'},
                {width:"20%", title:'Birth Day', data:'birthday', name:'birthday'},
                {width:"20%", title:'Actions', data:'action', name:'action', orderable: false}
            ]
        });

    }

    ////////////////////////////////////////////////////////////////////ADD FORM //////////////////////////////////////////////////////////////////////////////////////////////////////
    let handleAddReset = function () {

        $('#form_add_first_name').val('');
        $('#form_add_last_name').val('');
        $('#form_add_email').val('');
        $('#form_add_gender').val('');
        $('#form_add_birthday').val('');

    }

    let handleAddSuccess = function (responseText) {

        $.unblockUI();
        // Response processing
        if (responseText===null || responseText.hasOwnProperty('Value')===false || responseText.hasOwnProperty('Message')===false)
        {
            // Message
            toastr.error("The action couldn't be completed !");
            return;
        }

        let responseValue = 1*responseText.Value,
            responseMessage = responseText.Message;

        if (responseValue===200) // Succes
        {
            // Close Modal
            $('#modal_add').modal('hide');
            // Reset form
            handleAddReset();
            // Message
            toastr.success(responseMessage);

            // Refresh tabel
            tableCustomer.draw(false);

        }
        else // Erorr
        {
            toastr.error(responseMessage);
        }
    }

    let handleAddError = function () {

        // Message
        toastr.error("The action couldn't be completed ");
        $.unblockUI();

    }

    var formAddOptions = {
        success: handleAddSuccess,
        error: handleAddError,
        url:      "customer",
        type:     'POST',
        dataType: 'json'
    }

    ////////////////////////////////////////////////////////////////////EDIT FORM //////////////////////////////////////////////////////////////////////////////////////////////////////
    let handleEditReset = function () {

        $('#form_edit_first_name').val('');
        $('#form_edit_last_name').val('');
        $('#form_edit_gender').val('');
        $('#form_edit_birthday').val('');

    }

    let handleEditSuccess = function (responseText) {
        $.unblockUI();
        // Response Processing
        if (responseText===null || responseText.hasOwnProperty('Value')===false || responseText.hasOwnProperty('Message')===false)
        {
            // Message
            toastr.error('The action couldn\'t be completed !');
            return;
        }

        let responseValue = 1*responseText.Value,
            responseMessage = responseText.Message;

        // Actions for every response/
        if (responseValue===200) // Success
        {
            // Close modal
            $('#modal_edit').modal('hide');
            // Reset form
            handleEditReset();
            // Message
            toastr.success(responseMessage);

            // Refresh tabel
            tableCustomer.draw(false);

        }
        else // Eroare la
        {
            toastr.error(responseMessage);
        }
    }

    let handleEditError = function () {

        $.unblockUI();
        // Message
        toastr.error('The action couldn\'t be completed !');

    }

    let formEditOptions = {
        success: handleEditSuccess,
        error: handleEditError,
        url:      "customer/"+1*$('#form_edit_id').val(),
        type:     'PUT',
        dataType: 'json'
    }
    ////////////////////////////////////////////////////////////////////Delete FORM //////////////////////////////////////////////////////////////////////////////////////////////////////


    let handleDeleteSuccess = function (responseText) {

        $.unblockUI();

        // Resonse Processing
        if (responseText===null || responseText.hasOwnProperty('Value')===false || responseText.hasOwnProperty('Message')===false)
        {
            // Message
            toastr.error('The action couldn\'t be completed !');
            return;
        }

        let responseValue = 1*responseText.Value,
            responseMessage = responseText.Message;
        // Actions for every response
        if (responseValue===200) // Success
        {
            // Close Modal
            $('#modal_delete').modal('hide');
            // Reset form
            handleEditReset();
            // Message
            toastr.success(responseMessage);

            // Refresh tabel
            tableCustomer.draw(false);

        }
        else // Eroare la
        {
            toastr.error(responseMessage);
        }
    }

    let handleDeleteError = function () {

        // Message
        toastr.error("The action couldn't be completed ");
        $.unblockUI();

    }

    let formDeleteOptions = {
        success: handleDeleteSuccess,
        error: handleDeleteError,
        url:      "customer/"+1*$('#form_delete_id').val(),
        type:     'DELETE',
        dataType: 'json'
    }

    let handleClickModal = function () {

        $(document).on('click', '.edit', function () {

            handleEditReset();
            let nTr = $(this).closest("tr").get(0),
                data = tableCustomer.row(nTr).data();
            $('#form_edit_id').val(1*data.id);
            $('#form_edit_first_name').val(data.first_name);
            $('#form_edit_last_name').val(data.last_name);
            $('#form_edit_email').val(data.email);
            $('#form_edit_gender').val(data.gender);
            $('#form_edit_birthday').val(data.birthday);

            // Show modal
            $('#modal_edit').modal({show: true, modalOverflow: true});
        });

        $(document).on('click', '.delete', function () {

            let nTr = $(this).closest("tr").get(0),
                 data = tableCustomer.row(nTr).data();
            $('#form_delete_id').val(1*data.id);

            // Afisare modala
            $('#modal_delete').modal({show: true, modalOverflow: true});
        });

    }


    let handleAjaxRequest = function () {

        $('#form_add_submit').on('click', function () {
            $('#form_add').ajaxSubmit(formAddOptions);
            $.blockUI({ message: 'Asteapta..' });

        })

        $('#form_edit_submit').on('click', function () {

            $('#form_edit').ajaxSubmit(formEditOptions);
            $.blockUI({ message: 'Asteapta..' });

        })

        $('#form_delete_submit').on('click', function () {

            $('#form_delete').ajaxSubmit(formDeleteOptions);
            $.blockUI({ message: 'Asteapta..' });

        })

    }


    return {
        init: function () {
            handleDatatable();
            handleClickModal();
            handleAjaxRequest();
        }
    }
}();


let Group = function () {

    let tableGroup, tableCustomerToGroup, selectedGroup = 0;

    let handleDatatable = function () {

        tableGroup = $('#table_group').DataTable({
            processing: true,
            serverSide: true,
            ajax: "group",
            method: "GET",
            columns: [
                {width:"10%", title:'#', data:'DT_RowIndex', name:'DT_RowIndex'},
                {width:"60%", title:'Group Name', data:'name', name:'name'},
                {width:"30%", title:'Actions', data:'action', name:'action', orderable: false}
            ]
        });

        tableCustomerToGroup = $('#table_customer_to_group').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "customer-to-group",
                data: function (data) {
                    data.group_id = selectedGroup;
                },
                type: "GET"
            },
            columns: [
                {width:"10%", title:'#', data:'DT_RowIndex', name:'DT_RowIndex'},
                {width:"30%", title:'Customer', data:'customer_name', name:'customer_name'},
                {width:"30%", title:'Customer', data:'customer.email', name:'customer.email'},
                {width:"30%", title:'Actiuni', data:'action', name:'action', orderable: false}
            ]
        });

    }

    ////////////////////////////////////////////////////////////////////ADD CUSTOMER FORM //////////////////////////////////////////////////////////////////////////////////////////////////////
    let handleAddCustomerToGroupReset = function () {
        $('#form_add_name').val('');
    }

    let handleAddCustomerToGroupSuccess = function (responseText) {

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
            $('#modal_customer').modal('hide');
            // Reset form
            handleAddCustomerToGroupReset();
            // Message
            toastr.success(responseMessage);

            // Refresh tabel
            tableCustomerToGroup.draw(false);

        }
        else // Erorr
        {
            toastr.error(responseMessage);
        }
    }

    let handleAddCustomerToGroupError = function () {

        // Message
        toastr.error("The action couldn't be completed ");
        $.unblockUI();

    }

    let formAddCustomerToGroupOptions = {
        success: handleAddCustomerToGroupSuccess,
        error: handleAddCustomerToGroupError,
        url:      "customer-to-group",
        type:     'POST',
        dataType: 'json'
    }

    ////////////////////////////////////////////////////////////////////ADD FORM //////////////////////////////////////////////////////////////////////////////////////////////////////
    let handleAddReset = function () {
        $('#form_add_name').val('');
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
            tableGroup.draw(false);

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

    let formAddOptions = {
        success: handleAddSuccess,
        error: handleAddError,
        url:      "group",
        type:     'POST',
        dataType: 'json'
    }

    ////////////////////////////////////////////////////////////////////EDIT FORM //////////////////////////////////////////////////////////////////////////////////////////////////////
    let handleEditReset = function () {
        $('#form_edit_name').val('');
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
            tableGroup.draw(false);

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
        url:      "group/"+1*$('#form_edit_id').val(),
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
            tableGroup.draw(false);

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
        url:      "group/"+1*$('#form_delete_id').val(),
        type:     'DELETE',
        dataType: 'json'
    }

    ////////////////////////////////////////////////////////////////////Delete CUSTOMER FORM //////////////////////////////////////////////////////////////////////////////////////////////////////


    let handleDeleteCustomerToGroupSuccess = function (responseText) {

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
            $('#modal_customer_delete').modal('hide');
            // Reset form
            handleEditReset();
            // Message
            toastr.success(responseMessage);

            // Refresh tabel
            tableCustomerToGroup.draw(false);

        }
        else // Eroare la
        {
            toastr.error(responseMessage);
        }
    }

    let handleDeleteCustomerToGroupError = function () {
        // Message
        toastr.error("The action couldn't be completed ");
        $.unblockUI();
    }

    let formDeleteCustomerToGroupOptions = {
        success: handleDeleteCustomerToGroupSuccess,
        error: handleDeleteCustomerToGroupError,
        url:      "customer-to-group/"+1*$('#form_customer_delete_id').val(),
        type:     'DELETE',
        dataType: 'json'
    }

    let handleClickModal = function () {

        $(document).on('click', '.edit', function () {

            handleEditReset();
            let nTr = $(this).closest("tr").get(0),
                data = tableGroup.row(nTr).data();
            $('#form_edit_id').val(1*data.id);
            $('#form_edit_name').val(data.name);

            // Show modal
            $('#modal_edit').modal({show: true, modalOverflow: true});
        });

        $(document).on('click', '.delete', function () {
            let nTr = $(this).closest("tr").get(0),
                 data = tableGroup.row(nTr).data();
            $('#form_delete_id').val(1*data.id);

            // Show Modal
            $('#modal_delete').modal({show: true, modalOverflow: true});
        });

        $(document).on('click', '.customers-to-group', function () {
            let nTr = $(this).closest("tr").get(0),
                data = tableGroup.row(nTr).data();

            $('#form_add_group_id').val(data.id);
            selectedGroup = data.id;
            tableCustomerToGroup.ajax.reload();

            // Show Modal
            $('#modal_add_customer_to_group').modal({show: true, modalOverflow: true});
        });

        $(document).on('click', '.delete-customers-to-group', function () {
            let nTr = $(this).closest("tr").get(0),
                data = tableCustomerToGroup.row(nTr).data();

            $('#form_customer_delete_id').val(data.id);

            // Show Modal
            $('#modal_customer_delete').modal({show: true, modalOverflow: true});
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

        $('#form_customers_add_submit').on('click', function () {

            $('#form_customer_add').ajaxSubmit(formAddCustomerToGroupOptions);
            $.blockUI({ message: 'Asteapta..' });

        })

        $('#form_customer_delete_submit').on('click', function () {

            $('#form_customer_delete').ajaxSubmit(formDeleteCustomerToGroupOptions);
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

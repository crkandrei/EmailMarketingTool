let Template = function () {

    let tableTemplates, selectedTextArea = "form_add_message";

    let handleDatatable = function () {
        tableTemplates= $('#table_templates').DataTable({
            processing: true,
            serverSide: true,
            ajax: "template",
            method: "GET",
            columns: [
                {width:"5%", title:'#', data:'DT_RowIndex', name:'DT_RowIndex'},
                {width:"15%", title:'Name', data:'name', name:'name'},
                {width:"30%", title:'Subject', data:'subject', name:'subject'},
                {width:"40%", title:'Text', data:'message', name:'message'},
                {width:"10%", title:'Actions', data:'action', name:'action', orderable: false}
            ]
        });
    }

    ////////////////////////////////////////////////////////////////////ADD FORM //////////////////////////////////////////////////////////////////////////////////////////////////////
    let handleAddReset = function () {

        $('#form_add_subject').val('');
        $('#form_add_message').val('');
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
            tableTemplates.draw(false);

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
        url:      "template",
        type:     'POST',
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
            tableTemplates.draw(false);

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

    var formDeleteOptions = {
        success: handleDeleteSuccess,
        error: handleDeleteError,
        url:      "template/"+1*$('#form_delete_id').val(),
        type:     'DELETE',
        dataType: 'json'
    }

    let handleClickModal = function () {

        $(document).on('click', '.delete', function () {

            let nTr = $(this).closest("tr").get(0),
                 data = tableTemplates.row(nTr).data();

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

        $('#form_delete_submit').on('click', function () {

            $('#form_delete').ajaxSubmit(formDeleteOptions);
            $.blockUI({ message: 'Asteapta..' });

        })

    }

    //https://stackoverflow.com/questions/1064089/inserting-a-text-where-cursor-is-using-javascript-jquery
    let handleInsertToClick = function (areaId,text) {
        text = "#!#"+text+'#!#';
        var txtarea = document.getElementById(areaId);
        if (!txtarea) {
            return;
        }

        var scrollPos = txtarea.scrollTop;
        var strPos = 0;
        var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
            "ff" : (document.selection ? "ie" : false));
        if (br == "ie") {
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart('character', -txtarea.value.length);
            strPos = range.text.length;
        } else if (br == "ff") {
            strPos = txtarea.selectionStart;
        }

        var front = (txtarea.value).substring(0, strPos);
        var back = (txtarea.value).substring(strPos, txtarea.value.length);
        txtarea.value = front + text + back;
        strPos = strPos + text.length;
        if (br == "ie") {
            txtarea.focus();
            var ieRange = document.selection.createRange();
            ieRange.moveStart('character', -txtarea.value.length);
            ieRange.moveStart('character', strPos);
            ieRange.moveEnd('character', 0);
            ieRange.select();
        } else if (br == "ff") {
            txtarea.selectionStart = strPos;
            txtarea.selectionEnd = strPos;
            txtarea.focus();
        }

        txtarea.scrollTop = scrollPos;
    }

    let handleAddPlaceholder = function(){

        $('#form_add_subject').on('click', function(){
            selectedTextArea = "form_add_subject";
        })
        $('#form_add_message').on('click', function(){
            selectedTextArea = "form_add_message";
        })

        $('#form_add_button').on('click', function(){
            handleInsertToClick(selectedTextArea, $('#form_add_placeholder').val())
        })
    }


    return {
        init: function () {
            handleDatatable();
            handleClickModal();
            handleAjaxRequest();
            handleAddPlaceholder();
        }
    }
}();

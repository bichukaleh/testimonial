require(["jquery", "mage/calendar"],
    function ($, modal) {
        $(".field").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "1970:2050",
            buttonText: "Select Date",
            dateFormat: "dd-mm-yy",
            onSelect: function (date, instance) {
                updateRecord(instance, $(this).data('id'), $(this).data('url'));
            }
        });

        updateRecord = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            new Ajax.Request(url, {
                method: 'post',
                parameters: {
                    agent: $("#agent" + fieldId).val(),
                    status: $("#status" + fieldId).val(),
                    agent_comment: $("#agent_comment" + fieldId).val(),
                    datelimit: $("#datelimit" + fieldId).val(),
                    payment: $("#payment" + fieldId).val(),
                    special_request: $("#special_request" + fieldId).val()
                },
                onSuccess: function (transport) {
                    if (transport.status == 200) {
                        var html = '<div id="messages"><div class="messages"><div class="message message-success success"><div data-ui-id="messages-message-success">Record has been updated successfully.</div></div></div></div>';
                        $("#container").prepend(html);
                        setTimeout(function () {
                            $('#messages').hide();
                        }, 5000);
                    } else {
                        var html = '<div id="messages"><div class="messages"><div class="message message-error error"><div data-ui-id="messages-message-success">Something went wrong.</div></div></div></div>';
                        $("#container").prepend(html);
                        setTimeout(function () {
                            $('#messages').hide();
                        }, 5000);
                    }
                }
            });
        }
        UpdateFile = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            var formData = new FormData($('#data')[0]);
            formData.append('form_key', window.FORM_KEY);
            var formKey = "<?php echo Mage::getSingleton('core/session')->getFormKey(); ?>";
            console.log(formData);
            console.log(file);
            console.log(formKey);
            new Ajax.Request(url, {
                method: 'post',
                data: formData,
                parameters: {
                    traveldocumentfile: formData, form_key: window.FORM_KEY
                },
                onSuccess: function (transport) {
                    if (transport.status == 200) {
                        var html = '<div id="messages"><div class="messages"><div class="message message-success success"><div data-ui-id="messages-message-success">Record has been updated successfully.</div></div></div></div>';
                        $("#container").prepend(html);
                        setTimeout(function () {
                            $('#messages').hide();
                        }, 5000);
                    } else {
                        var html = '<div id="messages"><div class="messages"><div class="message message-error error"><div data-ui-id="messages-message-success">Something went wrong.</div></div></div></div>';
                        $("#container").prepend(html);
                        setTimeout(function () {
                            $('#messages').hide();
                        }, 5000);
                    }
                }
            });
        }
        $(document).on('click', "#travelDocument1btnSubmit", function (event) {
            //stop submit the form, we will post it manually.
            event.preventDefault();
            // Get form
            var id = $(this).data('id');
            var formName='fileUploadForm'+id;
            var form = $('#' + formName)[0];
            // Create an FormData object
            var data = new FormData(form);
            data.append('form_key', window.FORM_KEY);
            data.append('document', '1');
            // disabled the submit button
            $("#travelDocument1btnSubmit").prop("disabled", true);
            var url = $(this).data('url');

            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + id;
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: url,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var response = data.content;
                    $("#fileUploadForm1Div" + id).html(response);
                    $("#travelDocument1btnSubmit").prop("disabled", false);
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#travelDocument1btnSubmit").prop("disabled", false);
                }
            });
        });
        $(document).on('click', "#travelDocument2btnSubmit", function (event) {
            //stop submit the form, we will post it manually.
            event.preventDefault();
            // Get form
            var id = $(this).data('id');
            var formName='fileUploadForm2'+id;
            var form = $('#' + formName)[0];
            // Create an FormData object
            var data = new FormData(form);
            data.append('form_key', window.FORM_KEY);
            data.append('document', '2');
            // disabled the submit button
            $("#travelDocument2btnSubmit").prop("disabled", true);
            var url = $(this).data('url');

            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + id;
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: url,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var response = data.content;
                    $("#fileUploadForm2Div" + id).html(response);
                    $("#travelDocument2btnSubmit").prop("disabled", false);
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#travelDocument2btnSubmit").prop("disabled", false);
                }
            });
        });
        $(document).on('click', "#removeDocument", function (event) {
            event.preventDefault();
            // disabled the remove button
            $("#removeDocument").prop("disabled", true);
            var id = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    form_key: window.FORM_KEY
                },
                success: function (data) {
                    var response = data.content;
                    $("#fileUploadForm2Div" + id).replaceWith(response);
                    $("#removeDocument").prop("disabled", false);
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#removeDocument").prop("disabled", false);
                }
            });
        });
    });
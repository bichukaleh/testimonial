require(["jquery", 'Magento_Ui/js/modal/modal', "mage/calendar"],
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
                    is_approved: $("#is_approved" + fieldId).val(),
                    created_at: $("#created_at" + fieldId).val(),
                    name: $("#name" + fieldId).val()
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
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'popup modal title',
            buttons: [{
                text: $.mage.__('Continue'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        var popup = modal(options, $('#popup-modal'));
        $(document).on('click','.updateButton',function(){
            var name=$(this).data('ref');
            var text="Value: "+$("#"+name).attr('value')+" Id: "+$(this).data('id');
            $('.text').html(text);
            $("#popup-modal").modal("openModal");
        });

    });
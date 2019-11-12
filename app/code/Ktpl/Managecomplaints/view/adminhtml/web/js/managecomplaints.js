require(["jquery"],
    function ($) {
        updateRecord = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            new Ajax.Request(url, {
                method: 'post',
                parameters: {
                    comment: $("#comment" + fieldId).val(),
                },
                onSuccess: function (transport) {
                    var response= JSON.parse(transport.responseText);
                    var comment= response['messages']['comment'];
                    if (transport.status == 200) {
                        $("#comment"+fieldId).val(comment);
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
        updateSolvedRecord = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            var comment="• Solved status Updated to "+$("#solved" + fieldId).val();
            new Ajax.Request(url, {
                method: 'post',
                parameters: {
                    solved: $("#solved" + fieldId).val(),
                    comment:comment
                },
                onSuccess: function (data) {
                    var response= JSON.parse(data.responseText);
                    var comment= response['messages']['comment'];
                    if (data.status == 200) {
                        $("#comment"+fieldId).val(comment);
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
        updateSolutionRecord = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            var comment="• Solution Updated to "+$("#solution" + fieldId).val();
            new Ajax.Request(url, {
                method: 'post',
                parameters: {
                    solution: $("#solution" + fieldId).val(),
                    comment:comment
                },
                onSuccess: function (data) {
                    var response= JSON.parse(data.responseText);
                    var comment= response['messages']['comment'];
                    if (data.status == 200) {
                        $("#comment"+fieldId).val(comment);
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
        updateResponsibleRecord = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            var comment="• Responsible person Updated to  "+$("#responsible" + fieldId).val();
            new Ajax.Request(url, {
                method: 'post',
                parameters: {
                    responsible: $("#responsible" + fieldId).val(),
                    comment:comment
                },
                onSuccess: function (data) {
                    var response= JSON.parse(data.responseText);
                    var comment= response['messages']['comment'];
                    if (data.status == 200) {
                        $("#comment"+fieldId).val(comment);
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
        updateReasonRecord = function (button, fieldId, url) {
            url = url + (url.match(new RegExp('\\?')) ? '&isAjax=true' : '?isAjax=true') + '&id=' + fieldId;
            var comment="• Reason Updated to "+$("#reason" + fieldId).val();
            new Ajax.Request(url, {
                method: 'post',
                parameters: {
                    reason: $("#reason" + fieldId).val(),
                    comment:comment
                },
                onSuccess: function (data) {
                    var response= JSON.parse(data.responseText);
                    var comment= response['messages']['comment'];
                    if (data.status == 200) {
                        $("#comment"+fieldId).val(comment);
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
    });
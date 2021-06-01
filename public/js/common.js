function showProgress() {
    var progress_bar = jQuery('#progress');
    if (progress_bar.length == 1) {
        progress_bar.show();
    }
}

function hideProgress() {
    var progress_bar = jQuery('#progress');
    if (progress_bar.length == 1) {
        progress_bar.hide();
    }
}

axios.interceptors.request.use(function (options) {
    showProgress();
    return options;
}, function (error) {
    hideProgress();
});

function izanagi(_action, _method, _data, _params, _callback) {

    var protocol = window.location.protocol;
    var hostname = window.location.hostname;

    var options = {
        baseURL: protocol + "//" + hostname + "/", url: _action, method: _method
    };

    if (typeof _data === 'object') {

        if (_data instanceof FormData) {
            options.headers = {};
            options.headers['Content-Type'] = 'multipart/form-data';
            options.data = _data;
        } else {
            options.data = qs.stringify(_data);
        }
    }

    if (typeof _params === 'object') {
        options.params = _params;
    }

    axios(options)
        .then(function (response) {
            setTimeout(function () {
                hideProgress();
            }, 500);
            if (typeof _callback == 'function') {
                _callback(response);
            }
        })
        .catch(function (error) {
            setTimeout(function () {
                hideProgress();
            }, 500);
            swalAlert('Thất bại', 'error');

        });
}

function swalConfirm(message) {
    return swal.mixin({
        title: 'Azumino',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes, continue!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    });
}

function swalAlert(message, type) {
    swal.fire({
        icon: type,
        title: 'Azumino',
        html: message,
    });
}

function swal_alert(message, type) {
    const swalAlertWithBootstrapButtons = swal.mixin({
        title: 'Azumino',
        text: message,
        icon: type,
    });
    return swalAlertWithBootstrapButtons;
}

function changePassword() {
    const formData = $('#form-change-password').serializeArray()
        .reduce(function (a, x) {
            a[x.name] = x.value;
            return a;
        }, {});
    izanagi('change-password', 'post', formData, null, changePasswordCallback);
}

function changePasswordCallback(res) {
    if (res.data.success === true) {
        window.location.href = "/login";
    } else {
        if (_.has(res.data.message, 'current_password')) {
            jQuery("#current_password-validator").text(res.data.message.current_password);
        } else {
            jQuery("#current_password-validator").text('');
        }

        if (_.has(res.data.message, 'new_password')) {
            jQuery("#new_password-validator").text(res.data.message.new_password);
        } else {
            jQuery("#new_password-validator").text('');
        }

        if (_.has(res.data.message, 'new_confirm_password')) {
            jQuery("#new_confirm_password-validator").text(res.data.message.new_confirm_password);
        } else {
            jQuery("#new_confirm_password-validator").text('');
        }

    }
}

function checkAll($this) {
    const table = $this.closest('table');
    $('tbody td input:checkbox', table).prop('checked', $this.checked);
}

function isCheckAll($this) {
    const table = $this.closest('table');
    const checkAll = $('thead th input:checkbox', table);
    if (!$this.checked) {
        checkAll.prop('checked', false);
        return;
    }

    const $checkedBoxs = $('tbody td input:checkbox:checked', table);
    const $checkBoxs = $('tbody td input:checkbox', table);
    if ($checkedBoxs.length === $checkBoxs.length) {
        checkAll.prop('checked', true);
        return;
    }
    checkAll.prop('checked', false);

}

function resetForm() {
    $('.select2 ').val('').trigger('change');
    $('.select2-not-search ').val('').trigger('change');
}

function getMessageErrors(message) {
    let $mess = '';
    if (jQuery.isEmptyObject(message)) {
        return $mess;
    }

    jQuery.each(message, function (key, value) {
        $mess += value + "<br/>";
    });

    return $mess;
}

function removeNull(value) {
    if (value === 'undefined' || value === null) {
        return '';
    }

    return value;
}

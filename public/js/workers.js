(function ($) {
    Workers = function () {
        this.search = {};
        this.page = 1;
    };
    jQuery.Workers = new Workers();
    jQuery.extend(Workers.prototype, {
        func_init: function () {
        },
        func_get_search: function () {
            return $('#form-workers').serializeArray()
                .reduce(function (a, x) {
                    a[x.name] = x.value;
                    return a;
                }, {});
        },
        func_search: function () {
            const params = jQuery.Workers.func_get_search();
            params.page = jQuery.Workers.page = 1;
            izanagi('workers/search', 'post', params, null, jQuery.Workers.func_search_callback);
        },
        func_search_callback: function (res) {
            if (res.data.status) {
                jQuery.Workers.func_render_grid_view(res.data.model.data);
                jQuery.Workers.func_render_paginator(res.data.paginator);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_render_grid_view: function (data) {
            var html = '';
            jQuery.each(data, function (idx, product) {
                html += jQuery.Workers.func_render_grid_view_row(product, idx);
            });
            jQuery("table#table-workers").find('tbody').empty();
            jQuery("table#table-workers").find('tbody').html(html);
        },
        func_render_grid_view_row: function (data, idx) {
            var html = '';
            html += '<tr id=' + data.worker_id + '>';
            html += '<td class="text-center">' + data.worker_id + '</td>';
            html += '<td class="text-left">' + data.worker_name + '</td>';
            html += '<td class="text-left">' + data.store_name + '</td>';
            if (data.disabled_flag == 0) {
                html += '<td class="text-center">-</td>';
            } else {
                html += '<td class="text-center text-red">無効</td>';
            }
            html += '<td class="text-center"><button class="btn az-bg-primary" id="' + data.worker_id + '" onclick="jQuery.Workers.func_detail(this)">詳細</button></td>';
            html += '</tr>';

            return html;
        },
        func_paging: function (self) {
            let params = jQuery.Workers.func_get_search();
            params.page = jQuery.Workers.page = jQuery(self).attr('page');
            izanagi('workers/search', 'post', params, null, jQuery.Workers.func_search_callback);
        },
        func_render_paginator: function (paginator_html) {
            jQuery("#paginator").html(paginator_html);
        },
        func_detail: function (self, isNew = false) {
            const footerUpdate = $('#modal-worker-detail .modal-footer-update');
            const footerInsert = $('#modal-worker-detail .modal-footer-insert');
            if (isNew) {
                footerUpdate.hide();
                footerInsert.show();
                const data = {isNew: 1};
                izanagi('workers/detail', 'post', data, null, jQuery.Workers.func_detail_callback);
            } else {
                footerUpdate.show();
                footerInsert.hide();
                const data = {isNew: 0, id: self.id};
                izanagi('workers/detail', 'post', data, null, jQuery.Workers.func_detail_callback);
            }
        },
        func_detail_callback: function (res) {
            if (res.data.status) {
                $('#modal-worker-detail .modal-body').html('');
                $('#modal-worker-detail .modal-body').html(res.data.form);
                $('#modal-worker-detail').modal('show');
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_modal_get_form_detail: function () {
            return $('#modal-worker-detail .modal-body #form-worker-detail').serializeArray()
                .reduce(function (a, x) {
                    a[x.name] = x.value;
                    return a;
                }, {});
        },
        func_modal_delete_confirm: function () {
            const $mess = '本情報はシステムから完全に削除されます。削除してもよろしいですか？';
            const sw_confirm = swalConfirm($mess);
            sw_confirm.fire({}).then((result) => {
                if (result.value) {
                    const params = jQuery.Workers.func_modal_get_form_detail();
                    izanagi('workers/delete', 'post', params, null, jQuery.Workers.func_modal_delete_callback);
                }
            });
        },
        func_modal_delete_callback: function (res) {
            if (res.data.status) {
                const $mess = 'Ngon rồi';
                swal_alert($mess || 'Success', 'success').fire({}).then(result => {
                    $('#modal-worker-detail').modal('hide');
                });
                jQuery.Workers.func_search()
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_modal_update_confirm: function () {
            const $mess = 'Could you update?';
            const sw_confirm = swalConfirm($mess);
            sw_confirm.fire({}).then((result) => {
                if (result.value) {
                    const params = jQuery.Workers.func_modal_get_form_detail();
                    izanagi('workers/update', 'post', params, null, jQuery.Workers.func_modal_update_confirm_callback);
                }
            });
        },
        func_modal_update_confirm_callback: function (res) {
            if (res.data.status) {
                const $mess = 'Ngon rồi';
                swal_alert($mess || 'Success', 'success').fire({}).then(result => {
                    $('#modal-worker-detail').modal('hide');
                });

                const params = jQuery.Workers.func_get_search();
                params.page = jQuery.Workers.page;
                izanagi('workers/search', 'post', params, null, jQuery.Workers.func_search_callback);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_modal_add_new_confirm: function () {
            const $mess = 'Could you create new?';
            const sw_confirm = swalConfirm($mess);
            sw_confirm.fire({}).then((result) => {
                if (result.value) {
                    const params = jQuery.Workers.func_modal_get_form_detail();
                    izanagi('workers/add-new', 'post', params, null, jQuery.Workers.func_modal_add_new_confirm_callback);
                }
            });
        },
        func_modal_add_new_confirm_callback: function (res) {

            if (res.data.status) {
                const $mess = 'Đã tạo';
                swal_alert($mess || 'Success', 'success').fire({}).then(result => {
                    $('#modal-worker-detail').modal('hide');
                });

                const params = jQuery.Workers.func_get_search();
                params.page = jQuery.Workers.page;
                izanagi('workers/search', 'post', params, null, jQuery.Workers.func_search_callback);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
    });
})(jQuery);
jQuery(document).ready(function () {
    jQuery.Workers.func_init();
});

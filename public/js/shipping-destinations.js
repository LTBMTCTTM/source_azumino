(function ($) {
    Shipping = function () {
        this.search = {};
        this.page = 1;
    };
    jQuery.Shipping = new Shipping();
    jQuery.extend(Shipping.prototype, {
        func_init: function () {
        },
        func_get_search: function () {
            return $('#form-shipping-destinations').serializeArray()
                .reduce(function (a, x) {
                    a[x.name] = x.value;
                    return a;
                }, {});
        },
        func_search: function () {
            const params = jQuery.Shipping.func_get_search();
            params.page = jQuery.Shipping.page = 1;
            izanagi('shipping-destinations/search', 'post', params, null, jQuery.Shipping.func_search_callback);
        },
        func_search_callback: function (res) {
            if (res.data.status) {
                jQuery.Shipping.func_render_grid_view(res.data.model.data);
                jQuery.Shipping.func_render_paginator(res.data.paginator);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_render_grid_view: function (data) {
            var html = '';
            jQuery.each(data, function (idx, product) {
                html += jQuery.Shipping.func_render_grid_view_row(product, idx);
            });
            jQuery("table#table-shipping-destinations").find('tbody').empty();
            jQuery("table#table-shipping-destinations").find('tbody').html(html);
        },
        func_render_grid_view_row: function (data, idx) {
            var html = '';
            html += '<tr id=' + removeNull(data.ship_des_id) + '>';
            html += '<td class="text-center">' + removeNull(data.ship_des_id) + '</td>';
            html += '<td class="text-left">' + removeNull(data.ship_des_name) + '</td>';
            html += '<td class="text-left">' + removeNull(data.ship_des_addr) + '</td>';
            html += '<td class="text-center">' + removeNull(data.ship_des_tel) + '</td>';
            if (data.disabled_flag == 0) {
                html += '<td class="text-center">-</td>';
            } else {
                html += '<td class="text-center text-red">無効</td>';
            }
            html += '<td class="text-center"><button class="btn az-bg-primary" id="' + removeNull(data.ship_des_id) + '" onclick="jQuery.Shipping.func_detail(this)">詳細</button></td>';
            html += '</tr>';

            return html;
        },
        func_paging: function (self) {
            const page = jQuery(self).attr('page');
            if (page == jQuery.Shipping.page) {
                return;
            }
            let params = jQuery.Shipping.func_get_search();
            params.page = jQuery.Shipping.page = page;
            izanagi('shipping-destinations/search', 'post', params, null, jQuery.Shipping.func_search_callback);
        },
        func_render_paginator: function (paginator_html) {
            jQuery("#paginator").html(paginator_html);
        },
        func_detail: function (self, isNew = false) {
            const footerUpdate = $('#modal-shipping-detail .modal-footer-update');
            const footerInsert = $('#modal-shipping-detail .modal-footer-insert');
            if (isNew){
                footerUpdate.hide();
                footerInsert.show();
                const data = {isNew: 1};
                izanagi('shipping-destinations/detail', 'post', data, null, jQuery.Shipping.func_detail_callback);
            }else {
                footerUpdate.show();
                footerInsert.hide();
                const data = {isNew: 0, id: self.id};
                izanagi('shipping-destinations/detail', 'post', data, null, jQuery.Shipping.func_detail_callback);
            }
        },
        func_detail_callback: function (res) {
            if (res.data.status) {
                $('#modal-shipping-detail .modal-body').html('');
                $('#modal-shipping-detail .modal-body').html(res.data.form);
                $('#modal-shipping-detail').modal('show');
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_modal_get_form_detail: function () {
            return $('#modal-shipping-detail .modal-body #form-shipping-detail').serializeArray()
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
                    const params = jQuery.Shipping.func_modal_get_form_detail();
                    izanagi('shipping-destinations/delete', 'post', params, null, jQuery.Shipping.func_modal_delete_callback);
                }
            });
        },
        func_modal_delete_callback: function (res) {
            if (res.data.status) {
                const $mess = 'Ngon rồi';
                swal_alert($mess || 'Success', 'success').fire({}).then(result => {
                    $('#modal-shipping-detail').modal('hide');
                });
                jQuery.Shipping.func_search()
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_modal_update_confirm: function () {
            const params = jQuery.Shipping.func_modal_get_form_detail();
            const id_grp = params.ship_des_id.substr(0,2);
            const $mess = id_grp == params.ship_grp_key ? 'Update?' : '出庫先の商品コードは選択グループの開始コードと合っていません。保存しますか？';

            const sw_confirm = swalConfirm($mess);
            sw_confirm.fire({}).then((result) => {
                if (result.value) {
                    izanagi('shipping-destinations/update', 'post', params, null, jQuery.Shipping.func_modal_update_confirm_callback);
                }
            });
        },
        func_modal_update_confirm_callback: function (res) {
            if (res.data.status) {
                const $mess = 'Ngon rồi';
                swal_alert($mess || 'Success', 'success').fire({}).then(result => {
                    $('#modal-shipping-detail').modal('hide');
                });

                const params = jQuery.Shipping.func_get_search();
                params.page = jQuery.Shipping.page;
                izanagi('shipping-destinations/search', 'post', params, null, jQuery.Shipping.func_search_callback);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_modal_add_new_confirm: function (){
            const params = jQuery.Shipping.func_modal_get_form_detail();
            const id_grp = params.ship_des_id.substr(0,2);
            const $mess = id_grp == params.ship_grp_key ? 'Could you create new?' : '出庫先の商品コードは選択グループの開始コードと合っていません。保存しますか？';

            const sw_confirm = swalConfirm($mess);
            sw_confirm.fire({}).then((result) => {
                if (result.value) {
                    const params = jQuery.Shipping.func_modal_get_form_detail();
                    izanagi('shipping-destinations/add-new', 'post', params, null, jQuery.Shipping.func_modal_add_new_confirm_callback);
                }
            });
        },
        func_modal_add_new_confirm_callback: function (res) {

            if (res.data.status) {
                const $mess = 'Đã tạo';
                swal_alert($mess || 'Success', 'success').fire({}).then(result => {
                    $('#modal-shipping-detail').modal('hide');
                });

                const params = jQuery.Shipping.func_get_search();
                params.page = jQuery.Shipping.page;
                izanagi('shipping-destinations/search', 'post', params, null, jQuery.Shipping.func_search_callback);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
    });
})(jQuery);
jQuery(document).ready(function () {
    jQuery.Shipping.func_init();
});

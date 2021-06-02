(function ($) {
    GoodsHis = function () {
        this.search = {};
        this.sort = '';
        this.page = 1;
        this.limit = 10;
    };
    jQuery.GoodsHis = new GoodsHis();
    jQuery.extend(GoodsHis.prototype, {
        func_init: function () {
        },
        func_search: function () {
            var params = {};
            params = jQuery.GoodsHis.func_get_search();
            params.page = jQuery.GoodsHis.page = 1;
            izanagi('goods-history/search', 'post', params, null, jQuery.GoodsHis.func_search_callback);
        },
        func_search_callback: function (res) {
            if (res.data.status) {
                jQuery.GoodsHis.func_render_grid_view(res.data.model.data);
                jQuery.GoodsHis.func_render_paginator(res.data.paginator);

            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_render_grid_view: function (data) {
            var html = '';
            jQuery.each(data, function (idx, product) {
                html += jQuery.GoodsHis.func_render_grid_view_row(product, idx);
            });
            jQuery("table#goods-history-table").find('tbody').empty();
            jQuery("table#goods-history-table").find('tbody').html(html);
        },
        func_render_grid_view_row: function (data, idx) {
            var html = '';
            html += '<tr id=' + removeNull(data.id) + '-' + removeNull(data.index) + '>';
            html += '<td class="text-center">' +
                '    <label class="custom-control custom-checkbox">' +
                '        <input type="checkbox" class="custom-control-input" value="' + removeNull(data.id) + '-' + removeNull(data.index) + '" onchange="isCheckAll(this)">' +
                '        <span class="custom-control-label"></span>' +
                '    </label>' +
                '</td>';
            const create_date = data.create_date == null ? " " : moment(data.create_date).format("YYYY/MM/DD");
            const ship_date = data.ship_date == null ? " " : moment(data.ship_date).format("YYYY/MM/DD");
            html += '<td class="text-center">' + create_date + '</td>';
            html += '<td class="text-center">' + ship_date + '</td>';
            html += '<td class="text-center"> ' + removeNull(data.lot_no) + ' </td>';
            html += '<td class="text-center"> ' + removeNull(data.actual_vote) + ' </td>';
            html += '<td class="text-center"> '+removeNull(data.index)+'/'+(data.palette_plan)+' </td>';
            html += '<td class="text-left">' + removeNull(data.ship_des_name) + '</td>';
            html += '<td class="text-center">' + removeNull(data.car_num) + '</td>';
            const create_hour = data.create_date == null ? " " : moment(data.create_date).format("HH:mm");
            html += '<td class="text-center">'+create_hour+'</td>';
            html += '<td class="text-left">'+removeNull(data.worker_name)+'</td>';
            html += '<td class="text-left"> '+removeNull(data.store_name)+' </td>';
            html += '</tr>';

            return html;
        },
        func_paging: function (self) {

            var params = jQuery.GoodsHis.func_get_search();
            params.page = jQuery.GoodsHis.page = jQuery(self).attr('page');

            izanagi('goods-history/search', 'post', params, null, jQuery.GoodsHis.func_search_callback);
        },
        func_render_paginator: function (paginator_html) {
            jQuery("#paginator").html(paginator_html);
        },
        func_get_search: function(){
            return  $('#form-goods-his').serializeArray()
                .reduce(function (a, x) {
                    a[x.name] = x.value;
                    return a;
                }, {});
        },
        func_delete_confirm: function () {
            const $checkedBoxs = $('#goods-history-table tbody td input:checkbox:checked');
            console.log($checkedBoxs);
            if ($checkedBoxs.length > 0){
                const $mess = '選択中の履歴を削除します。よろしいですか？';
                const sw_confirm = swalConfirm($mess);

                let ids = [];
                $checkedBoxs.each(function () {
                    ids.push($(this).val());
                });
                console.log(ids);

                sw_confirm.fire({}).then((result) => {
                    if (result.value) {
                        izanagi('goods-history/delete', 'post', {ids: ids}, null, jQuery.GoodsHis.func_delete_callback);
                    }
                });
            }

        },
        func_delete_callback: function (res) {
            if (res.data.status){
                jQuery.GoodsHis.func_search()
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        },
        func_export: function () {
            const params = jQuery.GoodsHis.func_get_search();
            izanagi('goods-history/export', 'post', params, null, jQuery.GoodsHis.func_export_callback);
        },
        func_export_callback: function (res) {
            if (res.data.status){
                window.location.href = encodeURI("file/download?file_name=" + res.data.file_name + "&file_path=" + res.data.file_path);
            }
            if (!res.data.status) {
                const $mess = getMessageErrors(res.data.message);
                swalAlert($mess || 'Errors', 'error');
            }
        }
    });
})(jQuery);
jQuery(document).ready(function () {
    jQuery.GoodsHis.func_init();
});

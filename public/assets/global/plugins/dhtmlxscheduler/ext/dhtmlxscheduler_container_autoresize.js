/*
@license
dhtmlxScheduler v.4.4.0 Stardard

This software is covered by GPL license. You also can obtain Commercial or Enterprise license to use it in non-GPL project - please contact sales@dhtmlx.com. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
! function() {
    scheduler.config.container_autoresize = !0, scheduler.config.month_day_min_height = 90, scheduler.config.min_grid_size = 25, scheduler.config.min_map_size = 400;
    var e = scheduler._pre_render_events,
        t = !0,
        i = 0,
        a = 0;
    scheduler._pre_render_events = function(r, s) {
        if (!scheduler.config.container_autoresize || !t) return e.apply(this, arguments);
        var n = this.xy.bar_height,
            d = this._colsS.heights,
            l = this._colsS.heights = [0, 0, 0, 0, 0, 0, 0],
            o = this._els.dhx_cal_data[0];
        if (r = this._table_view ? this._pre_render_events_table(r, s) : this._pre_render_events_line(r, s), this._table_view)
            if (s) this._colsS.heights = d;
            else {
                var h = o.firstChild;
                if (h.rows) {
                    for (var _ = 0; _ < h.rows.length; _++) {
                        if (l[_]++, l[_] * n > this._colsS.height - this.xy.month_head_height) {
                            var c = h.rows[_].cells,
                                u = this._colsS.height - this.xy.month_head_height;
                            1 * this.config.max_month_events !== this.config.max_month_events || l[_] <= this.config.max_month_events ? u = l[_] * n : (this.config.max_month_events + 1) * n > this._colsS.height - this.xy.month_head_height && (u = (this.config.max_month_events + 1) * n);
                            for (var g = 0; g < c.length; g++) c[g].childNodes[1].style.height = u + "px";
                            l[_] = (l[_ - 1] || 0) + c[0].offsetHeight
                        }
                        l[_] = (l[_ - 1] || 0) + h.rows[_].cells[0].offsetHeight
                    }
                    l.unshift(0), h.parentNode.offsetHeight < h.parentNode.scrollHeight && !h._h_fix
                } else if (r.length || "visible" != this._els.dhx_multi_day[0].style.visibility || (l[0] = -1), r.length || -1 == l[0]) {
                    var f = (h.parentNode.childNodes, (l[0] + 1) * n + 1);
                    a != f + 1 && (this._obj.style.height = i - a + f - 1 + "px"), f += "px", o.style.top = this._els.dhx_cal_navline[0].offsetHeight + this._els.dhx_cal_header[0].offsetHeight + parseInt(f, 10) + "px", o.style.height = this._obj.offsetHeight - parseInt(o.style.top, 10) - (this.xy.margin_top || 0) + "px";
                    var v = this._els.dhx_multi_day[0];
                    v.style.height = f, v.style.visibility = -1 == l[0] ? "hidden" : "visible", v = this._els.dhx_multi_day[1], v.style.height = f, v.style.visibility = -1 == l[0] ? "hidden" : "visible", v.className = l[0] ? "dhx_multi_day_icon" : "dhx_multi_day_icon_small", this._dy_shift = (l[0] + 1) * n, l[0] = 0
                }
            } return r
    };
    var r = ["dhx_cal_navline", "dhx_cal_header", "dhx_multi_day", "dhx_cal_data"],
        s = function(e) {
            i = 0;
            for (var t = 0; t < r.length; t++) {
                var s = r[t],
                    n = scheduler._els[s] ? scheduler._els[s][0] : null,
                    d = 0;
                switch (s) {
                    case "dhx_cal_navline":
                    case "dhx_cal_header":
                        d = parseInt(n.style.height, 10);
                        break;
                    case "dhx_multi_day":
                        d = n ? n.offsetHeight - 1 : 0, a = d;
                        break;
                    case "dhx_cal_data":
                        var l = scheduler.getState().mode;
                        if (d = n.childNodes[1] && "month" != l ? n.childNodes[1].offsetHeight : Math.max(n.offsetHeight - 1, n.scrollHeight), "month" == l) {
                            if (scheduler.config.month_day_min_height && !e) {
                                var o = n.getElementsByTagName("tr").length;
                                d = o * scheduler.config.month_day_min_height
                            }
                            e && (n.style.height = d + "px")
                        } else if ("year" == l) d = 190 * scheduler.config.year_y;
                        else if ("agenda" == l) {
                            if (d = 0, n.childNodes && n.childNodes.length)
                                for (var h = 0; h < n.childNodes.length; h++) d += n.childNodes[h].offsetHeight;
                            d + 2 < scheduler.config.min_grid_size ? d = scheduler.config.min_grid_size : d += 2
                        } else if ("week_agenda" == l) {
                            for (var _, c, u = scheduler.xy.week_agenda_scale_height + scheduler.config.min_grid_size, g = 0; g < n.childNodes.length; g++) {
                                c = n.childNodes[g];
                                for (var h = 0; h < c.childNodes.length; h++) {
                                    for (var f = 0, v = c.childNodes[h].childNodes[1], m = 0; m < v.childNodes.length; m++) f += v.childNodes[m].offsetHeight;
                                    _ = f + scheduler.xy.week_agenda_scale_height,
                                        _ = 1 != g || 2 != h && 3 != h ? _ : 2 * _, _ > u && (u = _)
                                }
                            }
                            d = 3 * u
                        } else if ("map" == l) {
                            d = 0;
                            for (var p = n.querySelectorAll(".dhx_map_line"), h = 0; h < p.length; h++) d += p[h].offsetHeight;
                            d + 2 < scheduler.config.min_map_size ? d = scheduler.config.min_map_size : d += 2
                        } else if (scheduler._gridView)
                            if (d = 0, n.childNodes[1].childNodes[0].childNodes && n.childNodes[1].childNodes[0].childNodes.length) {
                                for (var p = n.childNodes[1].childNodes[0].childNodes[0].childNodes, h = 0; h < p.length; h++) d += p[h].offsetHeight;
                                d += 2, d < scheduler.config.min_grid_size && (d = scheduler.config.min_grid_size);
                            } else d = scheduler.config.min_grid_size;
                        if (scheduler.matrix && scheduler.matrix[l])
                            if (e) d += 2, n.style.height = d + "px";
                            else {
                                d = 2;
                                for (var x = scheduler.matrix[l], b = x.y_unit, y = 0; y < b.length; y++) d += b[y].children ? x.folder_dy || x.dy : x.dy
                            }("day" == l || "week" == l || scheduler._props && scheduler._props[l]) && (d += 2)
                }
                i += d
            }
            scheduler._obj.style.height = i + "px", e || scheduler.updateView()
        },
        n = function() {
            if (!scheduler.config.container_autoresize || !t) return !0;
            var e = scheduler.getState().mode;
            s(), (scheduler.matrix && scheduler.matrix[e] || "month" == e) && window.setTimeout(function() {
                s(!0)
            }, 1)
        };
    scheduler.attachEvent("onViewChange", n), scheduler.attachEvent("onXLE", n), scheduler.attachEvent("onEventChanged", n), scheduler.attachEvent("onEventCreated", n), scheduler.attachEvent("onEventAdded", n), scheduler.attachEvent("onEventDeleted", n), scheduler.attachEvent("onAfterSchedulerResize", n), scheduler.attachEvent("onClearAll", n), scheduler.attachEvent("onBeforeExpand", function() {
        return t = !1, !0
    }), scheduler.attachEvent("onBeforeCollapse", function() {
        return t = !0, !0
    })
}();
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_container_autoresize.js.map
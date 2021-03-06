/*
@license
dhtmlxScheduler v.4.4.0 Stardard

This software is covered by GPL license. You also can obtain Commercial or Enterprise license to use it in non-GPL project - please contact sales@dhtmlx.com. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
scheduler.config.icons_select = ["icon_details", "icon_delete"], scheduler.config.details_on_create = !0, scheduler.config.show_quick_info = !0, scheduler.xy.menu_width = 0, scheduler.attachEvent("onClick", function(e) {
        return scheduler.showQuickInfo(e), !0
    }),
    function() {
        for (var e = ["onEmptyClick", "onViewChange", "onLightbox", "onBeforeEventDelete", "onBeforeDrag"], t = function() {
                return scheduler._hideQuickInfo(), !0
            }, a = 0; a < e.length; a++) scheduler.attachEvent(e[a], t)
    }(), scheduler.templates.quick_info_title = function(e, t, a) {
        return a.text.substr(0, 50)
    }, scheduler.templates.quick_info_content = function(e, t, a) {
        return a.details || a.text
    }, scheduler.templates.quick_info_date = function(e, t, a) {
        return scheduler.isOneDayEvent(a) ? scheduler.templates.day_date(e, t, a) + " " + scheduler.templates.event_header(e, t, a) : scheduler.templates.week_date(e, t, a)
    }, scheduler.showQuickInfo = function(e) {
        if (e != this._quick_info_box_id && this.config.show_quick_info) {
            this.hideQuickInfo(!0);
            var t = this._get_event_counter_part(e);
            t && (this._quick_info_box = this._init_quick_info(t), this._fill_quick_data(e), this._show_quick_info(t), this.callEvent("onQuickInfo", [e]))
        }
    }, scheduler._hideQuickInfo = function() {
        scheduler.hideQuickInfo()
    }, scheduler.hideQuickInfo = function(e) {
        var t = this._quick_info_box,
            a = this._quick_info_box_id;
        if (this._quick_info_box_id = 0, t && t.parentNode) {
            var r = t.offsetWidth;
            if (scheduler.config.quick_info_detached) return this.callEvent("onAfterQuickInfo", [a]), t.parentNode.removeChild(t);
            "auto" == t.style.right ? t.style.left = -r + "px" : t.style.right = -r + "px", e && t.parentNode.removeChild(t),
                this.callEvent("onAfterQuickInfo", [a])
        }
    }, dhtmlxEvent(window, "keydown", function(e) {
        27 == e.keyCode && scheduler.hideQuickInfo()
    }), scheduler._show_quick_info = function(e) {
        var t = scheduler._quick_info_box;
        scheduler._obj.appendChild(t);
        var a = t.offsetWidth,
            r = t.offsetHeight;
        scheduler.config.quick_info_detached ? (t.style.left = e.left - e.dx * (a - e.width) + "px", t.style.top = e.top - (e.dy ? r : -e.height) + "px") : (t.style.top = this.xy.scale_height + this.xy.nav_height + 20 + "px", 1 == e.dx ? (t.style.right = "auto", t.style.left = -a + "px", setTimeout(function() {
            t.style.left = "-10px"
        }, 1)) : (t.style.left = "auto", t.style.right = -a + "px", setTimeout(function() {
            t.style.right = "-10px"
        }, 1)), t.className = t.className.replace(" dhx_qi_left", "").replace(" dhx_qi_right", "") + " dhx_qi_" + (1 == e.dx ? "left" : "right"))
    }, scheduler.attachEvent("onTemplatesReady", function() {
        if (scheduler.hideQuickInfo(), this._quick_info_box) {
            var e = this._quick_info_box;
            e.parentNode && e.parentNode.removeChild(e), this._quick_info_box = null
        }
    }), scheduler._quick_info_onscroll_handler = function(e) {
        scheduler.hideQuickInfo();
    }, scheduler._init_quick_info = function() {
        if (!this._quick_info_box) {
            var e = scheduler.xy,
                t = this._quick_info_box = document.createElement("div");
            this._waiAria.quickInfoAttr(t), t.className = "dhx_cal_quick_info", scheduler.$testmode && (t.className += " dhx_no_animate");
            var a = this._waiAria.quickInfoHeaderAttrString(),
                r = '<div class="dhx_cal_qi_title" style="height:' + e.quick_info_title + 'px" ' + a + '><div class="dhx_cal_qi_tcontent"></div><div  class="dhx_cal_qi_tdate"></div></div><div class="dhx_cal_qi_content"></div>';
            r += '<div class="dhx_cal_qi_controls" style="height:' + e.quick_info_buttons + 'px">';
            for (var i = scheduler.config.icons_select, n = 0; n < i.length; n++) {
                var a = this._waiAria.quickInfoButtonAttrString(this.locale.labels[i[n]]);
                r += "<div " + a + ' class="dhx_qi_big_icon ' + i[n] + '" title="' + scheduler.locale.labels[i[n]] + "\"><div class='dhx_menu_icon " + i[n] + "'></div><div>" + scheduler.locale.labels[i[n]] + "</div></div>"
            }
            r += "</div>", t.innerHTML = r, dhtmlxEvent(t, "click", function(e) {
                e = e || event, scheduler._qi_button_click(e.target || e.srcElement);
            }), scheduler.config.quick_info_detached && (scheduler._detachDomEvent(scheduler._els.dhx_cal_data[0], "scroll", scheduler._quick_info_onscroll_handler), dhtmlxEvent(scheduler._els.dhx_cal_data[0], "scroll", scheduler._quick_info_onscroll_handler))
        }
        return this._quick_info_box
    }, scheduler._qi_button_click = function(e) {
        var t = scheduler._quick_info_box;
        if (e && e != t) {
            var a = scheduler._getClassName(e);
            if (-1 != a.indexOf("_icon")) {
                var r = scheduler._quick_info_box_id;
                scheduler._click.buttons[a.split(" ")[1].replace("icon_", "")](r);
            } else scheduler._qi_button_click(e.parentNode)
        }
    }, scheduler._get_event_counter_part = function(e) {
        for (var t = scheduler.getRenderedEvent(e), a = 0, r = 0, i = t; i && i != scheduler._obj;) a += i.offsetLeft, r += i.offsetTop - i.scrollTop, i = i.offsetParent;
        if (i) {
            var n = a + t.offsetWidth / 2 > scheduler._x / 2 ? 1 : 0,
                s = r + t.offsetHeight / 2 > scheduler._y / 2 ? 1 : 0;
            return {
                left: a,
                top: r,
                dx: n,
                dy: s,
                width: t.offsetWidth,
                height: t.offsetHeight
            }
        }
        return 0
    }, scheduler._fill_quick_data = function(e) {
        var t = scheduler.getEvent(e),
            a = scheduler._quick_info_box;
        scheduler._quick_info_box_id = e;
        var r = {
                content: scheduler.templates.quick_info_title(t.start_date, t.end_date, t),
                date: scheduler.templates.quick_info_date(t.start_date, t.end_date, t)
            },
            i = a.firstChild.firstChild;
        i.innerHTML = r.content;
        var n = i.nextSibling;
        n.innerHTML = r.date, scheduler._waiAria.quickInfoHeader(a, [r.content, r.date].join(" "));
        var s = a.firstChild.nextSibling;
        s.innerHTML = scheduler.templates.quick_info_content(t.start_date, t.end_date, t)
    };
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_quick_info.js.map
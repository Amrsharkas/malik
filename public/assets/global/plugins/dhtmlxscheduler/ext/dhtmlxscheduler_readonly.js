/*
@license
dhtmlxScheduler v.4.4.0 Stardard

This software is covered by GPL license. You also can obtain Commercial or Enterprise license to use it in non-GPL project - please contact sales@dhtmlx.com. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
scheduler.attachEvent("onTemplatesReady", function() {
    function e(e, t, a, r) {
        for (var i = t.getElementsByTagName(e), n = a.getElementsByTagName(e), s = n.length - 1; s >= 0; s--) {
            var a = n[s];
            if (r) {
                var d = document.createElement("SPAN");
                d.className = "dhx_text_disabled", d.innerHTML = r(i[s]), a.parentNode.insertBefore(d, a), a.parentNode.removeChild(a)
            } else a.disabled = !0, t.checked && (a.checked = !0)
        }
    }
    var t = scheduler.config.lightbox.sections.slice(),
        a = scheduler.config.buttons_left.slice(),
        r = scheduler.config.buttons_right.slice();
    scheduler.attachEvent("onBeforeLightbox", function(e) {
        if (this.config.readonly_form || this.getEvent(e).readonly) {
            this.config.readonly_active = !0;
            for (var i = 0; i < this.config.lightbox.sections.length; i++) this.config.lightbox.sections[i].focus = !1
        } else this.config.readonly_active = !1, scheduler.config.lightbox.sections = t.slice(), scheduler.config.buttons_left = a.slice(), scheduler.config.buttons_right = r.slice();
        var n = this.config.lightbox.sections;
        if (this.config.readonly_active) {
            for (var i = 0; i < n.length; i++)
                if ("recurring" == n[i].type) {
                    this.config.readonly_active && n.splice(i, 1);
                    break
                } for (var s = ["dhx_delete_btn", "dhx_save_btn"], d = [scheduler.config.buttons_left, scheduler.config.buttons_right], i = 0; i < s.length; i++)
                for (var l = s[i], o = 0; o < d.length; o++) {
                    for (var c = d[o], _ = -1, h = 0; h < c.length; h++)
                        if (c[h] == l) {
                            _ = h;
                            break
                        } - 1 != _ && c.splice(_, 1)
                }
        }
        return this.resetLightbox(), !0
    });
    var i = scheduler._fill_lightbox;
    scheduler._fill_lightbox = function() {
        var t = this.getLightbox();
        this.config.readonly_active && (t.style.visibility = "hidden", t.style.display = "block");
        var a = i.apply(this, arguments);
        if (this.config.readonly_active && (t.style.visibility = "", t.style.display = "none"), this.config.readonly_active) {
            var r = this.getLightbox(),
                s = this._lightbox_r = r.cloneNode(!0);
            s.id = scheduler.uid(), e("textarea", r, s, function(e) {
                    return e.value
                }), e("input", r, s, !1), e("select", r, s, function(e) {
                    return e.options.length ? e.options[Math.max(e.selectedIndex || 0, 0)].text : ""
                }), r.parentNode.insertBefore(s, r), n.call(this, s), scheduler._lightbox && scheduler._lightbox.parentNode.removeChild(scheduler._lightbox), this._lightbox = s, scheduler.config.drag_lightbox && (s.firstChild.onmousedown = scheduler._ready_to_dnd),
                this.setLightboxSize(), s.onclick = function(e) {
                    var t = e ? e.target : event.srcElement;
                    if (scheduler._getClassName(t) || (t = t.previousSibling), t && t.className) switch (scheduler._getClassName(t)) {
                        case "dhx_cancel_btn":
                            scheduler.callEvent("onEventCancel", [scheduler._lightbox_id]), scheduler._edit_stop_event(scheduler.getEvent(scheduler._lightbox_id), !1), scheduler.hide_lightbox()
                    }
                }, s.onkeydown = function(e) {
                    var t = e || window.event,
                        a = e.target || e.srcElement,
                        r = a.querySelector("[dhx_button]");
                    switch (r || (r = a.parentNode.querySelector(".dhx_custom_button, .dhx_readonly")),
                        (e || t).keyCode) {
                        case 32:
                            if ((e || t).shiftKey) return;
                            r && r.click && r.click();
                            break;
                        case scheduler.keys.edit_cancel:
                            scheduler.cancel_lightbox()
                    }
                }
        }
        return a
    };
    var n = scheduler.showCover;
    scheduler.showCover = function() {
        this.config.readonly_active || n.apply(this, arguments)
    };
    var s = scheduler.hide_lightbox;
    scheduler.hide_lightbox = function() {
        return this._lightbox_r && (this._lightbox_r.parentNode.removeChild(this._lightbox_r), this._lightbox_r = this._lightbox = null), s.apply(this, arguments)
    }
});
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_readonly.js.map
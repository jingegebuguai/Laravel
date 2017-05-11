//定义modal弹框
!function(e) {
    "use strict";
    var t = function(t, n) {
        this.options = n,
        this.$element = e(t).delegate('[data-dismiss="modal"]', "click.dismiss.modal", e.proxy(this.hide, this)),
        this.options.remote && this.$element.find(".modal-body").load(this.options.remote)
    }
    ;
    t.prototype = {
        constructor: t,
        toggle: function() {
            return this[this.isShown ? "hide" : "show"]()
        },
        show: function() {
            var t = this
              , n = e.Event("show");
            this.$element.trigger(n),
            this.isShown || n.isDefaultPrevented() || (this.isShown = !0,
            this.escape(),
            this.backdrop(function() {
                var n = e.support.transition && t.$element.hasClass("fade");
                t.$element.parent().length || t.$element.appendTo(document.body),
                t.$element.show(),
                n && t.$element[0].offsetWidth,
                t.$element.addClass("in").attr("aria-hidden", !1),
                t.enforceFocus(),
                n ? t.$element.one(e.support.transition.end, function() {
                    t.$element.focus().trigger("shown")
                }) : t.$element.focus().trigger("shown")
            }))
        },
        hide: function(t) {
            t && t.preventDefault();
            t = e.Event("hide"),
            this.$element.trigger(t),
            this.isShown && !t.isDefaultPrevented() && (this.isShown = !1,
            this.escape(),
            e(document).off("focusin.modal"),
            this.$element.removeClass("in").attr("aria-hidden", !0),
            e.support.transition && this.$element.hasClass("fade") ? this.hideWithTransition() : this.hideModal())
        },
        enforceFocus: function() {
            var t = this;
            e(document).on("focusin.modal", function(e) {
                t.$element[0] === e.target || t.$element.has(e.target).length || t.$element.focus()
            })
        },
        escape: function() {
            var e = this;
            this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.modal", function(t) {
                27 == t.which && e.hide()
            }) : this.isShown || this.$element.off("keyup.dismiss.modal")
        },
        hideWithTransition: function() {
            var t = this
              , n = setTimeout(function() {
                t.$element.off(e.support.transition.end),
                t.hideModal()
            }, 500);
            this.$element.one(e.support.transition.end, function() {
                clearTimeout(n),
                t.hideModal()
            })
        },
        hideModal: function() {
            var e = this;
            this.$element.hide(),
            this.backdrop(function() {
                e.removeBackdrop(),
                e.$element.trigger("hidden")
            })
        },
        removeBackdrop: function() {
            this.$backdrop && this.$backdrop.remove(),
            this.$backdrop = null 
        },
        backdrop: function(t) {
            var n = this.$element.hasClass("fade") ? "fade" : "";
            if (this.isShown && this.options.backdrop) {
                var i = e.support.transition && n
                  , r = e(document).height()
                  , o = "100%";
                if (this.$backdrop = e('<div class="modal-backdrop ' + n + '" />').appendTo(document.body),
                this.$backdrop.css({
                    width: o,
                    height: r
                }).click("static" == this.options.backdrop ? e.proxy(this.$element[0].focus, this.$element[0]) : e.proxy(this.hide, this)),
                i && this.$backdrop[0].offsetWidth,
                this.$backdrop.addClass("in"),
                !t)
                    return;
                i ? this.$backdrop.one(e.support.transition.end, t) : t()
            } else
                !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"),
                e.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(e.support.transition.end, t) : t()) : t && t()
        }
    };
    var n = e.fn.modal;
    e.fn.modal = function(n) {
        return this.each(function() {
            var i = e(this)
              , r = i.data("modal")
              , o = e.extend({}, e.fn.modal.defaults, i.data(), "object" == typeof n && n);
            r || i.data("modal", r = new t(this,o)),
            "string" == typeof n ? r[n]() : o.show && r.show()
        })
    }
    ,
    e.fn.modal.defaults = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    },
    e.fn.modal.Constructor = t,
    e.fn.modal.noConflict = function() {
        return e.fn.modal = n,
        this
    }
    ,
    e(document).on("click.modal.data-api", '[data-toggle="modal"]', function(t) {
        var n = e(this)
          , i = n.attr("href")
          , r = e(n.attr("data-target") || i && i.replace(/.*(?=#[^\s]+$)/, ""))
          , o = r.data("modal") ? "toggle" : e.extend({
            remote: !/#/.test(i) && i
        }, r.data(), n.data());
        t.preventDefault(),
        r.modal(o).one("hide", function() {
            n.focus()
        })
    })
}(window.jQuery)
/*!
 * Font Awesome Icon Picker
 * https://farbelous.github.io/fontawesome-iconpicker/
 *
 * @author Javi Aguilar, itsjavi.com
 * @license MIT License
 * @see https://github.com/farbelous/fontawesome-iconpicker/blob/master/LICENSE
 */


(function(e) {
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], e);
    } else {
        e(jQuery);
    }
})(function(j) {
    j.ui = j.ui || {};
    var e = j.ui.version = "1.12.1";
    (function() {
        var r, y = Math.max, x = Math.abs, s = /left|center|right/, i = /top|center|bottom/, f = /[\+\-]\d+(\.[\d]+)?%?/, l = /^\w+/, c = /%$/, a = j.fn.pos;
        function q(e, a, t) {
            return [ parseFloat(e[0]) * (c.test(e[0]) ? a / 100 : 1), parseFloat(e[1]) * (c.test(e[1]) ? t / 100 : 1) ];
        }
        function C(e, a) {
            return parseInt(j.css(e, a), 10) || 0;
        }
        function t(e) {
            var a = e[0];
            if (a.nodeType === 9) {
                return {
                    width: e.width(),
                    height: e.height(),
                    offset: {
                        top: 0,
                        left: 0
                    }
                };
            }
            if (j.isWindow(a)) {
                return {
                    width: e.width(),
                    height: e.height(),
                    offset: {
                        top: e.scrollTop(),
                        left: e.scrollLeft()
                    }
                };
            }
            if (a.preventDefault) {
                return {
                    width: 0,
                    height: 0,
                    offset: {
                        top: a.pageY,
                        left: a.pageX
                    }
                };
            }
            return {
                width: e.outerWidth(),
                height: e.outerHeight(),
                offset: e.offset()
            };
        }
        j.pos = {
            scrollbarWidth: function() {
                if (r !== undefined) {
                    return r;
                }
                var e, a, t = j("<div " + "style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'>" + "<div style='height:100px;width:auto;'></div></div>"), s = t.children()[0];
                j("body").append(t);
                e = s.offsetWidth;
                t.css("overflow", "scroll");
                a = s.offsetWidth;
                if (e === a) {
                    a = t[0].clientWidth;
                }
                t.remove();
                return r = e - a;
            },
            getScrollInfo: function(e) {
                var a = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"), t = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"), s = a === "scroll" || a === "auto" && e.width < e.element[0].scrollWidth, r = t === "scroll" || t === "auto" && e.height < e.element[0].scrollHeight;
                return {
                    width: r ? j.pos.scrollbarWidth() : 0,
                    height: s ? j.pos.scrollbarWidth() : 0
                };
            },
            getWithinInfo: function(e) {
                var a = j(e || window), t = j.isWindow(a[0]), s = !!a[0] && a[0].nodeType === 9, r = !t && !s;
                return {
                    element: a,
                    isWindow: t,
                    isDocument: s,
                    offset: r ? j(e).offset() : {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: a.scrollLeft(),
                    scrollTop: a.scrollTop(),
                    width: a.outerWidth(),
                    height: a.outerHeight()
                };
            }
        };
        j.fn.pos = function(h) {
            if (!h || !h.of) {
                return a.apply(this, arguments);
            }
            h = j.extend({}, h);
            var m, p, d, u, T, e, g = j(h.of), b = j.pos.getWithinInfo(h.within), k = j.pos.getScrollInfo(b), w = (h.collision || "flip").split(" "), v = {};
            e = t(g);
            if (g[0].preventDefault) {
                h.at = "left top";
            }
            p = e.width;
            d = e.height;
            u = e.offset;
            T = j.extend({}, u);
            j.each([ "my", "at" ], function() {
                var e = (h[this] || "").split(" "), a, t;
                if (e.length === 1) {
                    e = s.test(e[0]) ? e.concat([ "center" ]) : i.test(e[0]) ? [ "center" ].concat(e) : [ "center", "center" ];
                }
                e[0] = s.test(e[0]) ? e[0] : "center";
                e[1] = i.test(e[1]) ? e[1] : "center";
                a = f.exec(e[0]);
                t = f.exec(e[1]);
                v[this] = [ a ? a[0] : 0, t ? t[0] : 0 ];
                h[this] = [ l.exec(e[0])[0], l.exec(e[1])[0] ];
            });
            if (w.length === 1) {
                w[1] = w[0];
            }
            if (h.at[0] === "right") {
                T.left += p;
            } else if (h.at[0] === "center") {
                T.left += p / 2;
            }
            if (h.at[1] === "bottom") {
                T.top += d;
            } else if (h.at[1] === "center") {
                T.top += d / 2;
            }
            m = q(v.at, p, d);
            T.left += m[0];
            T.top += m[1];
            return this.each(function() {
                var t, e, f = j(this), l = f.outerWidth(), c = f.outerHeight(), a = C(this, "marginLeft"), s = C(this, "marginTop"), r = l + a + C(this, "marginRight") + k.width, i = c + s + C(this, "marginBottom") + k.height, o = j.extend({}, T), n = q(v.my, f.outerWidth(), f.outerHeight());
                if (h.my[0] === "right") {
                    o.left -= l;
                } else if (h.my[0] === "center") {
                    o.left -= l / 2;
                }
                if (h.my[1] === "bottom") {
                    o.top -= c;
                } else if (h.my[1] === "center") {
                    o.top -= c / 2;
                }
                o.left += n[0];
                o.top += n[1];
                t = {
                    marginLeft: a,
                    marginTop: s
                };
                j.each([ "left", "top" ], function(e, a) {
                    if (j.ui.pos[w[e]]) {
                        j.ui.pos[w[e]][a](o, {
                            targetWidth: p,
                            targetHeight: d,
                            elemWidth: l,
                            elemHeight: c,
                            collisionPosition: t,
                            collisionWidth: r,
                            collisionHeight: i,
                            offset: [ m[0] + n[0], m[1] + n[1] ],
                            my: h.my,
                            at: h.at,
                            within: b,
                            elem: f
                        });
                    }
                });
                if (h.using) {
                    e = function(e) {
                        var a = u.left - o.left, t = a + p - l, s = u.top - o.top, r = s + d - c, i = {
                            target: {
                                element: g,
                                left: u.left,
                                top: u.top,
                                width: p,
                                height: d
                            },
                            element: {
                                element: f,
                                left: o.left,
                                top: o.top,
                                width: l,
                                height: c
                            },
                            horizontal: t < 0 ? "left" : a > 0 ? "right" : "center",
                            vertical: r < 0 ? "top" : s > 0 ? "bottom" : "middle"
                        };
                        if (p < l && x(a + t) < p) {
                            i.horizontal = "center";
                        }
                        if (d < c && x(s + r) < d) {
                            i.vertical = "middle";
                        }
                        if (y(x(a), x(t)) > y(x(s), x(r))) {
                            i.important = "horizontal";
                        } else {
                            i.important = "vertical";
                        }
                        h.using.call(this, e, i);
                    };
                }
                f.offset(j.extend(o, {
                    using: e
                }));
            });
        };
        j.ui.pos = {
            _trigger: function(e, a, t, s) {
                if (a.elem) {
                    a.elem.trigger({
                        type: t,
                        position: e,
                        positionData: a,
                        triggered: s
                    });
                }
            },
            fit: {
                left: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "fitLeft");
                    var t = a.within, s = t.isWindow ? t.scrollLeft : t.offset.left, r = t.width, i = e.left - a.collisionPosition.marginLeft, f = s - i, l = i + a.collisionWidth - r - s, c;
                    if (a.collisionWidth > r) {
                        if (f > 0 && l <= 0) {
                            c = e.left + f + a.collisionWidth - r - s;
                            e.left += f - c;
                        } else if (l > 0 && f <= 0) {
                            e.left = s;
                        } else {
                            if (f > l) {
                                e.left = s + r - a.collisionWidth;
                            } else {
                                e.left = s;
                            }
                        }
                    } else if (f > 0) {
                        e.left += f;
                    } else if (l > 0) {
                        e.left -= l;
                    } else {
                        e.left = y(e.left - i, e.left);
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "fitLeft");
                },
                top: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "fitTop");
                    var t = a.within, s = t.isWindow ? t.scrollTop : t.offset.top, r = a.within.height, i = e.top - a.collisionPosition.marginTop, f = s - i, l = i + a.collisionHeight - r - s, c;
                    if (a.collisionHeight > r) {
                        if (f > 0 && l <= 0) {
                            c = e.top + f + a.collisionHeight - r - s;
                            e.top += f - c;
                        } else if (l > 0 && f <= 0) {
                            e.top = s;
                        } else {
                            if (f > l) {
                                e.top = s + r - a.collisionHeight;
                            } else {
                                e.top = s;
                            }
                        }
                    } else if (f > 0) {
                        e.top += f;
                    } else if (l > 0) {
                        e.top -= l;
                    } else {
                        e.top = y(e.top - i, e.top);
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "fitTop");
                }
            },
            flip: {
                left: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "flipLeft");
                    var t = a.within, s = t.offset.left + t.scrollLeft, r = t.width, i = t.isWindow ? t.scrollLeft : t.offset.left, f = e.left - a.collisionPosition.marginLeft, l = f - i, c = f + a.collisionWidth - r - i, o = a.my[0] === "left" ? -a.elemWidth : a.my[0] === "right" ? a.elemWidth : 0, n = a.at[0] === "left" ? a.targetWidth : a.at[0] === "right" ? -a.targetWidth : 0, h = -2 * a.offset[0], m, p;
                    if (l < 0) {
                        m = e.left + o + n + h + a.collisionWidth - r - s;
                        if (m < 0 || m < x(l)) {
                            e.left += o + n + h;
                        }
                    } else if (c > 0) {
                        p = e.left - a.collisionPosition.marginLeft + o + n + h - i;
                        if (p > 0 || x(p) < c) {
                            e.left += o + n + h;
                        }
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "flipLeft");
                },
                top: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "flipTop");
                    var t = a.within, s = t.offset.top + t.scrollTop, r = t.height, i = t.isWindow ? t.scrollTop : t.offset.top, f = e.top - a.collisionPosition.marginTop, l = f - i, c = f + a.collisionHeight - r - i, o = a.my[1] === "top", n = o ? -a.elemHeight : a.my[1] === "bottom" ? a.elemHeight : 0, h = a.at[1] === "top" ? a.targetHeight : a.at[1] === "bottom" ? -a.targetHeight : 0, m = -2 * a.offset[1], p, d;
                    if (l < 0) {
                        d = e.top + n + h + m + a.collisionHeight - r - s;
                        if (d < 0 || d < x(l)) {
                            e.top += n + h + m;
                        }
                    } else if (c > 0) {
                        p = e.top - a.collisionPosition.marginTop + n + h + m - i;
                        if (p > 0 || x(p) < c) {
                            e.top += n + h + m;
                        }
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "flipTop");
                }
            },
            flipfit: {
                left: function() {
                    j.ui.pos.flip.left.apply(this, arguments);
                    j.ui.pos.fit.left.apply(this, arguments);
                },
                top: function() {
                    j.ui.pos.flip.top.apply(this, arguments);
                    j.ui.pos.fit.top.apply(this, arguments);
                }
            }
        };
        (function() {
            var e, a, t, s, r, i = document.getElementsByTagName("body")[0], f = document.createElement("div");
            e = document.createElement(i ? "div" : "body");
            t = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            };
            if (i) {
                j.extend(t, {
                    position: "absolute",
                    left: "-1000px",
                    top: "-1000px"
                });
            }
            for (r in t) {
                e.style[r] = t[r];
            }
            e.appendChild(f);
            a = i || document.documentElement;
            a.insertBefore(e, a.firstChild);
            f.style.cssText = "position: absolute; left: 10.7432222px;";
            s = j(f).offset().left;
            j.support.offsetFractions = s > 10 && s < 11;
            e.innerHTML = "";
            a.removeChild(e);
        })();
    })();
    var a = j.ui.position;
});

(function(e) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], e);
    } else if (window.jQuery && !window.jQuery.fn.iconpicker) {
        e(window.jQuery);
    }
})(function(c) {
    "use strict";
    var f = {
        isEmpty: function(e) {
            return e === false || e === "" || e === null || e === undefined;
        },
        isEmptyObject: function(e) {
            return this.isEmpty(e) === true || e.length === 0;
        },
        isElement: function(e) {
            return c(e).length > 0;
        },
        isString: function(e) {
            return typeof e === "string" || e instanceof String;
        },
        isArray: function(e) {
            return c.isArray(e);
        },
        inArray: function(e, a) {
            return c.inArray(e, a) !== -1;
        },
        throwError: function(e) {
            throw "Font Awesome Icon Picker Exception: " + e;
        }
    };
    var t = function(e, a) {
        this._id = t._idCounter++;
        this.element = c(e).addClass("iconpicker-element");
        this._trigger("iconpickerCreate", {
            iconpickerValue: this.iconpickerValue
        });
        this.options = c.extend({}, t.defaultOptions, this.element.data(), a);
        this.options.templates = c.extend({}, t.defaultOptions.templates, this.options.templates);
        this.options.originalPlacement = this.options.placement;
        this.container = f.isElement(this.options.container) ? c(this.options.container) : false;
        if (this.container === false) {
            if (this.element.is(".dropdown-toggle")) {
                this.container = c("~ .dropdown-menu:first", this.element);
            } else {
                this.container = this.element.is("input,textarea,button,.btn") ? this.element.parent() : this.element;
            }
        }
        this.container.addClass("iconpicker-container");
        if (this.isDropdownMenu()) {
            this.options.placement = "inline";
        }
        this.input = this.element.is("input,textarea") ? this.element.addClass("iconpicker-input") : false;
        if (this.input === false) {
            this.input = this.container.find(this.options.input);
            if (!this.input.is("input,textarea")) {
                this.input = false;
            }
        }
        this.component = this.isDropdownMenu() ? this.container.parent().find(this.options.component) : this.container.find(this.options.component);
        if (this.component.length === 0) {
            this.component = false;
        } else {
            this.component.find("i").addClass("iconpicker-component");
        }
        this._createPopover();
        this._createIconpicker();
        if (this.getAcceptButton().length === 0) {
            this.options.mustAccept = false;
        }
        if (this.isInputGroup()) {
            this.container.parent().append(this.popover);
        } else {
            this.container.append(this.popover);
        }
        this._bindElementEvents();
        this._bindWindowEvents();
        this.update(this.options.selected);
        if (this.isInline()) {
            this.show();
        }
        this._trigger("iconpickerCreated", {
            iconpickerValue: this.iconpickerValue
        });
    };
    t._idCounter = 0;
    t.defaultOptions = {
        title: false,
        selected: false,
        defaultValue: false,
        placement: "bottom",
        collision: "none",
        animation: true,
        hideOnSelect: false,
        showFooter: false,
        searchInFooter: false,
        mustAccept: false,
        selectedCustomClass: "bg-primary",
        icons: [],
        fullClassFormatter: function(e) {
            return e;
        },
        input: "input,.iconpicker-input",
        inputSearch: false,
        container: false,
        component: ".input-group-addon,.iconpicker-component",
        templates: {
            popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' + '<div class="popover-title"></div><div class="popover-content"></div></div>',
            footer: '<div class="popover-footer"></div>',
            buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' + ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
            search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
            iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
            iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
        }
    };
    t.batch = function(e, a) {
        var t = Array.prototype.slice.call(arguments, 2);
        return c(e).each(function() {
            var e = c(this).data("iconpicker");
            if (!!e) {
                e[a].apply(e, t);
            }
        });
    };
    t.prototype = {
        constructor: t,
        options: {},
        _id: 0,
        _trigger: function(e, a) {
            a = a || {};
            this.element.trigger(c.extend({
                type: e,
                iconpickerInstance: this
            }, a));
        },
        _createPopover: function() {
            this.popover = c(this.options.templates.popover);
            var e = this.popover.find(".popover-title");
            if (!!this.options.title) {
                e.append(c('<div class="popover-title-text">' + this.options.title + "</div>"));
            }
            if (this.hasSeparatedSearchInput() && !this.options.searchInFooter) {
                e.append(this.options.templates.search);
            } else if (!this.options.title) {
                e.remove();
            }
            if (this.options.showFooter && !f.isEmpty(this.options.templates.footer)) {
                var a = c(this.options.templates.footer);
                if (this.hasSeparatedSearchInput() && this.options.searchInFooter) {
                    a.append(c(this.options.templates.search));
                }
                if (!f.isEmpty(this.options.templates.buttons)) {
                    a.append(c(this.options.templates.buttons));
                }
                this.popover.append(a);
            }
            if (this.options.animation === true) {
                this.popover.addClass("fade");
            }
            return this.popover;
        },
        _createIconpicker: function() {
            var t = this;
            this.iconpicker = c(this.options.templates.iconpicker);
            var e = function(e) {
                var a = c(this);
                if (a.is("i")) {
                    a = a.parent();
                }
                t._trigger("iconpickerSelect", {
                    iconpickerItem: a,
                    iconpickerValue: t.iconpickerValue
                });
                if (t.options.mustAccept === false) {
                    t.update(a.data("iconpickerValue"));
                    t._trigger("iconpickerSelected", {
                        iconpickerItem: this,
                        iconpickerValue: t.iconpickerValue
                    });
                } else {
                    t.update(a.data("iconpickerValue"), true);
                }
                if (t.options.hideOnSelect && t.options.mustAccept === false) {
                    t.hide();
                }
            };
            var a = c(this.options.templates.iconpickerItem);
            var s = [];
            for (var r in this.options.icons) {
                if (typeof this.options.icons[r].title === "string") {
                    var i = a.clone();
                    i.find("i").addClass(this.options.fullClassFormatter(this.options.icons[r].title));
                    i.data("iconpickerValue", this.options.icons[r].title).on("click.iconpicker", e);
                    i.attr("title", "." + this.options.icons[r].title);
                    if (this.options.icons[r].searchTerms.length > 0) {
                        var f = "";
                        for (var l = 0; l < this.options.icons[r].searchTerms.length; l++) {
                            f = f + this.options.icons[r].searchTerms[l] + " ";
                        }
                        i.attr("data-search-terms", f);
                    }
                    s.push(i);
                }
            }
            this.iconpicker.find(".iconpicker-items").append(s);
            this.popover.find(".popover-content").append(this.iconpicker);
            return this.iconpicker;
        },
        _isEventInsideIconpicker: function(e) {
            var a = c(e.target);
            if ((!a.hasClass("iconpicker-element") || a.hasClass("iconpicker-element") && !a.is(this.element)) && a.parents(".iconpicker-popover").length === 0) {
                return false;
            }
            return true;
        },
        _bindElementEvents: function() {
            var a = this;
            this.getSearchInput().on("keyup.iconpicker", function() {
                a.filter(c(this).val().toLowerCase());
            });
            this.getAcceptButton().on("click.iconpicker", function() {
                var e = a.iconpicker.find(".iconpicker-selected").get(0);
                a.update(a.iconpickerValue);
                a._trigger("iconpickerSelected", {
                    iconpickerItem: e,
                    iconpickerValue: a.iconpickerValue
                });
                if (!a.isInline()) {
                    a.hide();
                }
            });
            this.getCancelButton().on("click.iconpicker", function() {
                if (!a.isInline()) {
                    a.hide();
                }
            });
            this.element.on("focus.iconpicker", function(e) {
                a.show();
                e.stopPropagation();
            });
            if (this.hasComponent()) {
                this.component.on("click.iconpicker", function() {
                    a.toggle();
                });
            }
            if (this.hasInput()) {
                this.input.on("keyup.iconpicker", function(e) {
                    if (!f.inArray(e.keyCode, [ 38, 40, 37, 39, 16, 17, 18, 9, 8, 91, 93, 20, 46, 186, 190, 46, 78, 188, 44, 86 ])) {
                        a.update();
                    } else {
                        a._updateFormGroupStatus(a.getValid(this.value) !== false);
                    }
                    if (a.options.inputSearch === true) {
                        a.filter(c(this).val().toLowerCase());
                    }
                });
            }
        },
        _bindWindowEvents: function() {
            var e = c(window.document);
            var a = this;
            var t = ".iconpicker.inst" + this._id;
            c(window).on("resize.iconpicker" + t + " orientationchange.iconpicker" + t, function(e) {
                if (a.popover.hasClass("in")) {
                    a.updatePlacement();
                }
            });
            if (!a.isInline()) {
                e.on("mouseup" + t, function(e) {
                    if (!a._isEventInsideIconpicker(e) && !a.isInline()) {
                        a.hide();
                    }
                });
            }
        },
        _unbindElementEvents: function() {
            this.popover.off(".iconpicker");
            this.element.off(".iconpicker");
            if (this.hasInput()) {
                this.input.off(".iconpicker");
            }
            if (this.hasComponent()) {
                this.component.off(".iconpicker");
            }
            if (this.hasContainer()) {
                this.container.off(".iconpicker");
            }
        },
        _unbindWindowEvents: function() {
            c(window).off(".iconpicker.inst" + this._id);
            c(window.document).off(".iconpicker.inst" + this._id);
        },
        updatePlacement: function(e, a) {
            e = e || this.options.placement;
            this.options.placement = e;
            a = a || this.options.collision;
            a = a === true ? "flip" : a;
            var t = {
                at: "right bottom",
                my: "right top",
                of: this.hasInput() && !this.isInputGroup() ? this.input : this.container,
                collision: a === true ? "flip" : a,
                within: window
            };
            this.popover.removeClass("inline topLeftCorner topLeft top topRight topRightCorner " + "rightTop right rightBottom bottomRight bottomRightCorner " + "bottom bottomLeft bottomLeftCorner leftBottom left leftTop");
            if (typeof e === "object") {
                return this.popover.pos(c.extend({}, t, e));
            }
            switch (e) {
              case "inline":
                {
                    t = false;
                }
                break;

              case "topLeftCorner":
                {
                    t.my = "right bottom";
                    t.at = "left top";
                }
                break;

              case "topLeft":
                {
                    t.my = "left bottom";
                    t.at = "left top";
                }
                break;

              case "top":
                {
                    t.my = "center bottom";
                    t.at = "center top";
                }
                break;

              case "topRight":
                {
                    t.my = "right bottom";
                    t.at = "right top";
                }
                break;

              case "topRightCorner":
                {
                    t.my = "left bottom";
                    t.at = "right top";
                }
                break;

              case "rightTop":
                {
                    t.my = "left bottom";
                    t.at = "right center";
                }
                break;

              case "right":
                {
                    t.my = "left center";
                    t.at = "right center";
                }
                break;

              case "rightBottom":
                {
                    t.my = "left top";
                    t.at = "right center";
                }
                break;

              case "bottomRightCorner":
                {
                    t.my = "left top";
                    t.at = "right bottom";
                }
                break;

              case "bottomRight":
                {
                    t.my = "right top";
                    t.at = "right bottom";
                }
                break;

              case "bottom":
                {
                    t.my = "center top";
                    t.at = "center bottom";
                }
                break;

              case "bottomLeft":
                {
                    t.my = "left top";
                    t.at = "left bottom";
                }
                break;

              case "bottomLeftCorner":
                {
                    t.my = "right top";
                    t.at = "left bottom";
                }
                break;

              case "leftBottom":
                {
                    t.my = "right top";
                    t.at = "left center";
                }
                break;

              case "left":
                {
                    t.my = "right center";
                    t.at = "left center";
                }
                break;

              case "leftTop":
                {
                    t.my = "right bottom";
                    t.at = "left center";
                }
                break;

              default:
                {
                    return false;
                }
                break;
            }
            this.popover.css({
                display: this.options.placement === "inline" ? "" : "block"
            });
            if (t !== false) {
                this.popover.pos(t).css("maxWidth", c(window).width() - this.container.offset().left - 5);
            } else {
                this.popover.css({
                    top: "auto",
                    right: "auto",
                    bottom: "auto",
                    left: "auto",
                    maxWidth: "none"
                });
            }
            this.popover.addClass(this.options.placement);
            return true;
        },
        _updateComponents: function() {
            this.iconpicker.find(".iconpicker-item.iconpicker-selected").removeClass("iconpicker-selected " + this.options.selectedCustomClass);
            if (this.iconpickerValue) {
                this.iconpicker.find("." + this.options.fullClassFormatter(this.iconpickerValue).replace(/ /g, ".")).parent().addClass("iconpicker-selected " + this.options.selectedCustomClass);
            }
            if (this.hasComponent()) {
                var e = this.component.find("i");
                if (e.length > 0) {
                    e.attr("class", this.options.fullClassFormatter(this.iconpickerValue));
                } else {
                    this.component.html(this.getHtml());
                }
            }
        },
        _updateFormGroupStatus: function(e) {
            if (this.hasInput()) {
                if (e !== false) {
                    this.input.parents(".form-group:first").removeClass("has-error");
                } else {
                    this.input.parents(".form-group:first").addClass("has-error");
                }
                return true;
            }
            return false;
        },
        getValid: function(e) {
            if (!f.isString(e)) {
                e = "";
            }
            var a = e === "";
            e = c.trim(e);
            var t = false;
            for (var s = 0; s < this.options.icons.length; s++) {
                if (this.options.icons[s].title === e) {
                    t = true;
                    break;
                }
            }
            if (t || a) {
                return e;
            }
            return false;
        },
        setValue: function(e) {
            var a = this.getValid(e);
            if (a !== false) {
                this.iconpickerValue = a;
                this._trigger("iconpickerSetValue", {
                    iconpickerValue: a
                });
                return this.iconpickerValue;
            } else {
                this._trigger("iconpickerInvalid", {
                    iconpickerValue: e
                });
                return false;
            }
        },
        getHtml: function() {
            return '<i class="' + this.options.fullClassFormatter(this.iconpickerValue) + '"></i>';
        },
        setSourceValue: function(e) {
            e = this.setValue(e);
            if (e !== false && e !== "") {
                if (this.hasInput()) {
                    this.input.val(this.iconpickerValue);
                } else {
                    this.element.data("iconpickerValue", this.iconpickerValue);
                }
                this._trigger("iconpickerSetSourceValue", {
                    iconpickerValue: e
                });
            }
            return e;
        },
        getSourceValue: function(e) {
            e = e || this.options.defaultValue;
            var a = e;
            if (this.hasInput()) {
                a = this.input.val();
            } else {
                a = this.element.data("iconpickerValue");
            }
            if (a === undefined || a === "" || a === null || a === false) {
                a = e;
            }
            return a;
        },
        hasInput: function() {
            return this.input !== false;
        },
        isInputSearch: function() {
            return this.hasInput() && this.options.inputSearch === true;
        },
        isInputGroup: function() {
            return this.container.is(".input-group");
        },
        isDropdownMenu: function() {
            return this.container.is(".dropdown-menu");
        },
        hasSeparatedSearchInput: function() {
            return this.options.templates.search !== false && !this.isInputSearch();
        },
        hasComponent: function() {
            return this.component !== false;
        },
        hasContainer: function() {
            return this.container !== false;
        },
        getAcceptButton: function() {
            return this.popover.find(".iconpicker-btn-accept");
        },
        getCancelButton: function() {
            return this.popover.find(".iconpicker-btn-cancel");
        },
        getSearchInput: function() {
            return this.popover.find(".iconpicker-search");
        },
        filter: function(r) {
            if (f.isEmpty(r)) {
                this.iconpicker.find(".iconpicker-item").show();
                return c(false);
            } else {
                var i = [];
                this.iconpicker.find(".iconpicker-item").each(function() {
                    var e = c(this);
                    var a = e.attr("title").toLowerCase();
                    var t = e.attr("data-search-terms") ? e.attr("data-search-terms").toLowerCase() : "";
                    a = a + " " + t;
                    var s = false;
                    try {
                        s = new RegExp("(^|\\W)" + r, "g");
                    } catch (e) {
                        s = false;
                    }
                    if (s !== false && a.match(s)) {
                        i.push(e);
                        e.show();
                    } else {
                        e.hide();
                    }
                });
                return i;
            }
        },
        show: function() {
            if (this.popover.hasClass("in")) {
                return false;
            }
            c.iconpicker.batch(c(".iconpicker-popover.in:not(.inline)").not(this.popover), "hide");
            this._trigger("iconpickerShow", {
                iconpickerValue: this.iconpickerValue
            });
            this.updatePlacement();
            this.popover.addClass("in");
            setTimeout(c.proxy(function() {
                this.popover.css("display", this.isInline() ? "" : "block");
                this._trigger("iconpickerShown", {
                    iconpickerValue: this.iconpickerValue
                });
            }, this), this.options.animation ? 300 : 1);
        },
        hide: function() {
            if (!this.popover.hasClass("in")) {
                return false;
            }
            this._trigger("iconpickerHide", {
                iconpickerValue: this.iconpickerValue
            });
            this.popover.removeClass("in");
            setTimeout(c.proxy(function() {
                this.popover.css("display", "none");
                this.getSearchInput().val("");
                this.filter("");
                this._trigger("iconpickerHidden", {
                    iconpickerValue: this.iconpickerValue
                });
            }, this), this.options.animation ? 300 : 1);
        },
        toggle: function() {
            if (this.popover.is(":visible")) {
                this.hide();
            } else {
                this.show(true);
            }
        },
        update: function(e, a) {
            e = e ? e : this.getSourceValue(this.iconpickerValue);
            this._trigger("iconpickerUpdate", {
                iconpickerValue: this.iconpickerValue
            });
            if (a === true) {
                e = this.setValue(e);
            } else {
                e = this.setSourceValue(e);
                this._updateFormGroupStatus(e !== false);
            }
            if (e !== false) {
                this._updateComponents();
            }
            this._trigger("iconpickerUpdated", {
                iconpickerValue: this.iconpickerValue
            });
            return e;
        },
        destroy: function() {
            this._trigger("iconpickerDestroy", {
                iconpickerValue: this.iconpickerValue
            });
            this.element.removeData("iconpicker").removeData("iconpickerValue").removeClass("iconpicker-element");
            this._unbindElementEvents();
            this._unbindWindowEvents();
            c(this.popover).remove();
            this._trigger("iconpickerDestroyed", {
                iconpickerValue: this.iconpickerValue
            });
        },
        disable: function() {
            if (this.hasInput()) {
                this.input.prop("disabled", true);
                return true;
            }
            return false;
        },
        enable: function() {
            if (this.hasInput()) {
                this.input.prop("disabled", false);
                return true;
            }
            return false;
        },
        isDisabled: function() {
            if (this.hasInput()) {
                return this.input.prop("disabled") === true;
            }
            return false;
        },
        isInline: function() {
            return this.options.placement === "inline" || this.popover.hasClass("inline");
        }
    };
    c.iconpicker = t;
    c.fn.iconpicker = function(a) {
        return this.each(function() {
            var e = c(this);
            if (!e.data("iconpicker")) {
                e.data("iconpicker", new t(this, typeof a === "object" ? a : {}));
            }
        });
    };
    t.defaultOptions = c.extend(t.defaultOptions, {
        icons: [ {
            title: "fab fa-500px",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-accessible-icon",
            searchTerms: [ "accessibility", "handicap", "person", "wheelchair", "wheelchair-alt","accesibilidad", "discapacidad", "persona", "silla de ruedas", "silla de ruedas-alt" ]
        }, {
            title: "fab fa-accusoft",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-acquisitions-incorporated",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fas fa-ad",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-address-book",
            searchTerms: ["mas"]
        }, {
            title: "far fa-address-book",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-address-card",
            searchTerms: ["mas"]
        }, {
            title: "far fa-address-card",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-adjust",
            searchTerms: [ "contrast" ]
        }, {
            title: "fab fa-adn",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-adversal",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-affiliatetheme",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-air-freshener",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-algolia",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-align-center",
            searchTerms: [ "middle", "text" ]
        }, {
            title: "fas fa-align-justify",
            searchTerms: [ "text" ]
        }, {
            title: "fas fa-align-left",
            searchTerms: [ "text" ]
        }, {
            title: "fas fa-align-right",
            searchTerms: [ "text" ]
        }, {
            title: "fab fa-alipay",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-allergies",
            searchTerms: [ "freckles", "hand", "intolerances", "pox", "spots" ]
        }, {
            title: "fab fa-amazon",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-amazon-pay",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ambulance",
            searchTerms: [ "help", "machine", "support", "vehicle","ayuda", "máquina", "soporte", "vehículo" ]
        }, {
            title: "fas fa-american-sign-language-interpreting",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-amilia",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-anchor",
            searchTerms: [ "link" ]
        }, {
            title: "fab fa-android",
            searchTerms: [ "robot" ]
        }, {
            title: "fab fa-angellist",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-angle-double-down",
            searchTerms: [ "arrows" ]
        }, {
            title: "fas fa-angle-double-left",
            searchTerms: [ "arrows", "back", "laquo", "previous", "quote","flechas", "atrás", "laquo", "anterior", "comentar" ]
        }, {
            title: "fas fa-angle-double-right",
            searchTerms: [ "arrows", "forward", "next", "quote", "raquo","flechas", "atrás", "laquo", "anterior", "comentar" ]
        }, {
            title: "fas fa-angle-double-up",
            searchTerms: [ "arrows" ]
        }, {
            title: "fas fa-angle-down",
            searchTerms: [ "arrow",'flechas' ]
        }, {
            title: "fas fa-angle-left",
            searchTerms: [ "arrow", "back", "previous","flecha", "atrás", "anterior" ]
        }, {
            title: "fas fa-angle-right",
            searchTerms: [ "arrow", "forward", "next","flecha", "adelante", "siguiente" ]
        }, {
            title: "fas fa-angle-up",
            searchTerms: [ "arrow","flecha" ]
        }, {
            title: "fas fa-angry",
            searchTerms: [ "disapprove", "emoticon", "face", "mad", "upset","desaprobar", "emoticono", "cara", "enojado", "enojado" ]
        }, {
            title: "far fa-angry",
            searchTerms: [ "disapprove", "emoticon", "face", "mad", "upset","desaprobar", "emoticono", "cara", "enojado", "enojado" ]
        }, {
            title: "fab fa-angrycreative",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-angular",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ankh",
            searchTerms: [ "amulet", "copper", "coptic christianity", "copts", "crux ansata", "egyptian", "venus","amuleto", "cobre", "cristianismo copto", "coptos", "crux ansata", "egipcio", "venus" ]
        }, {
            title: "fab fa-app-store",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-app-store-ios",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-apper",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-apple",
            searchTerms: ["fruit","apple","hearth","fruta","salud","manzana","fall", "food", "fruit", "fuji", "macintosh", "seasonal","fruit","apple","hearth","fruta","salud","manzana"]
        }, {
            title: "fas fa-apple-alt",
            searchTerms: [ "fruit","apple","hearth","fruta","salud","manzana","fall", "food", "fruit", "fuji", "macintosh", "seasonal" ]
        }, {
            title: "fab fa-apple-pay",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-archive",
            searchTerms: [ "box", "package", "storage","caja", "paquete", "almacenamiento" ]
        }, {
            title: "fas fa-archway",
            searchTerms: [ "arc", "monument", "road", "street","arco", "monumento", "camino", "calle" ]
        }, {
            title: "fas fa-arrow-alt-circle-down",
            searchTerms: [ "arrow-circle-o-down", "download","flecha-círculo-o-abajo", "descargar" ]
        }, {
            title: "far fa-arrow-alt-circle-down",
            searchTerms: [ "arrow-circle-o-down", "download","flecha-círculo-o-abajo", "descargar" ]
        }, {
            title: "fas fa-arrow-alt-circle-left",
            searchTerms: [ "arrow-circle-o-left", "back", "previous","flecha-círculo-o-izquierda", "atrás", "anterior" ]
        }, {
            title: "far fa-arrow-alt-circle-left",
            searchTerms: [ "arrow-circle-o-left", "back", "previous","flecha-círculo-o-izquierda", "atrás", "anterior" ]
        }, {
            title: "fas fa-arrow-alt-circle-right",
            searchTerms: [ "arrow-circle-o-right", "forward", "next" ]
        }, {
            title: "far fa-arrow-alt-circle-right",
            searchTerms: [ "arrow-circle-o-right", "forward", "next" ]
        }, {
            title: "fas fa-arrow-alt-circle-up",
            searchTerms: [ "arrow-circle-o-up" ]
        }, {
            title: "far fa-arrow-alt-circle-up",
            searchTerms: [ "arrow-circle-o-up" ]
        }, {
            title: "fas fa-arrow-circle-down",
            searchTerms: [ "download" ]
        }, {
            title: "fas fa-arrow-circle-left",
            searchTerms: [ "back", "previous" ]
        }, {
            title: "fas fa-arrow-circle-right",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "fas fa-arrow-circle-up",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-arrow-down",
            searchTerms: [ "download","descargar" ]
        }, {
            title: "fas fa-arrow-left",
            searchTerms: [ "back", "previous","atrás", "anterior" ]
        }, {
            title: "fas fa-arrow-right",
            searchTerms: [ "forward", "next","adelante", "siguiente" ]
        }, {
            title: "fas fa-arrow-up",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-arrows-alt",
            searchTerms: [ "arrow", "arrows", "bigger", "enlarge", "expand", "fullscreen", "move", "position", "reorder", "resize" ]
        }, {
            title: "fas fa-arrows-alt-h",
            searchTerms: [ "arrows-h", "resize","flechas-h", "redimensionar" ]
        }, {
            title: "fas fa-arrows-alt-v",
            searchTerms: [ "arrows-v", "resize","flechas-v", "redimensionar" ]
        }, {
            title: "fas fa-assistive-listening-systems",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-asterisk",
            searchTerms: [ "details","detalles" ]
        }, {
            title: "fab fa-asymmetrik",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-at",
            searchTerms: [ "e-mail", "email","correo" ]
        }, {
            title: "fas fa-atlas",
            searchTerms: [ "book", "directions", "geography", "map", "wayfinding","libro", "direcciones", "geografía", "mapa", "wayfinding" ]
        }, {
            title: "fas fa-atom",
            searchTerms: [ "atheism", "chemistry", "science","ateismo", "química", "ciencia" ]
        }, {
            title: "fab fa-audible",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-audio-description",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-autoprefixer",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-avianex",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-aviato",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-award",
            searchTerms: [ "honor", "praise", "prize", "recognition", "ribbon" ,"honor", "alabanza", "premio", "reconocimiento", "lazo"]
        }, {
            title: "fab fa-aws",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-backspace",
            searchTerms: [ "command", "delete", "keyboard", "undo","comando", "eliminar", "teclado", "deshacer" ]
        }, {
            title: "fas fa-backward",
            searchTerms: [ "previous", "rewind" ]
        }, {
            title: "fas fa-balance-scale",
            searchTerms: [ "equilibrado", "justicia", "legal", "medida", "peso","balanced", "justice", "legal", "measure", "weight" ]
        }, {
            title: "fas fa-ban",
            searchTerms: [ "abort", "ban", "block", "cancel", "delete", "hide", "prohibit", "remove", "stop", "trash","abortar", "prohibir", "bloquear", "cancelar", "eliminar", "ocultar", "prohibir", "eliminar", "detener", "basura" ]
        }, {
            title: "fas fa-band-aid",
            searchTerms: [ "bandage", "boo boo", "ouch","vendaje", "boo boo", "ouch" ]
        }, {
            title: "fab fa-bandcamp",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-barcode",
            searchTerms: [ "scan" ]
        }, {
            title: "fas fa-bars",
            searchTerms: [ "checklist", "drag", "hamburger", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "todo", "ul" ]
        }, {
            title: "fas fa-baseball-ball",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-basketball-ball",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bath",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-battery-empty",
            searchTerms: [ "power", "status","poder", "estado" ]
        }, {
            title: "fas fa-battery-full",
            searchTerms: [ "power", "status","poder", "estado" ]
        }, {
            title: "fas fa-battery-half",
            searchTerms: [ "power", "status","poder", "estado" ]
        }, {
            title: "fas fa-battery-quarter",
            searchTerms: [ "power", "status","poder", "estado" ]
        }, {
            title: "fas fa-battery-three-quarters",
            searchTerms: [ "power", "status","poder", "estado" ]
        }, {
            title: "fas fa-bed",
            searchTerms: [ "lodging", "sleep", "travel","alojamiento", "dormir", "viajar" ]
        }, {
            title: "fas fa-beer",
            searchTerms: [ "alcohol", "bar", "beverage", "drink", "liquor", "mug", "stein","alcohol", "bar", "bebida", "bebida", "licor", "taza", "stein" ]
        }, {
            title: "fab fa-behance",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-behance-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bell",
            searchTerms: [ "alert", "notification", "reminder","alerta", "notificación", "recordatorio" ]
        }, {
            title: "far fa-bell",
            searchTerms: [ "alert", "notification", "reminder","alerta", "notificación", "recordatorio" ]
        }, {
            title: "fas fa-bell-slash",
            searchTerms: ["mas"]
        }, {
            title: "far fa-bell-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bezier-curve",
            searchTerms: [ "curves", "illustrator", "lines", "path", "vector","curvas", "ilustrador", "líneas", "camino", "vector" ]
        }, {
            title: "fas fa-bible",
            searchTerms: [ "book", "catholicism", "christianity","libro", "catolicismo", "cristianismo" ]
        }, {
            title: "fas fa-bicycle",
            searchTerms: [ "bike", "gears", "transportation", "vehicle","bicicleta", "engranajes", "transporte", "vehículo" ]
        }, {
            title: "fab fa-bimobject",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-binoculars",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-birthday-cake",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-bitbucket",
            searchTerms: [ "bitbucket-square", "git" ]
        }, {
            title: "fab fa-bitcoin",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-bity",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-black-tie",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-blackberry",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-blender",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-blender-phone",
            searchTerms: [ "appliance", "fantasy", "silly","aparato", "fantasía", "tonto" ]
        }, {
            title: "fas fa-blind",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-blogger",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-blogger-b",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-bluetooth",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-bluetooth-b",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bold",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bolt",
            searchTerms: [ "electricity", "lightning", "weather", "zap","electricidad", "relámpago", "clima", "zapato" ]
        }, {
            title: "fas fa-bomb",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bone",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bong",
            searchTerms: [ "aparatus", "cannabis", "marijuana", "pipe", "smoke", "smoking","aparato", "cannabis", "marihuana", "pipa", "humo", "fumar" ]
        }, {
            title: "fas fa-book",
            searchTerms: [ "documentation", "read","documentación", "leer" ]
        }, {
            title: "fas fa-book-dead",
            searchTerms: [ "Dungeons & Dragons", "crossbones", "d&d", "dark arts", "death", "dnd", "documentation", "evil", "fantasy", "halloween", "holiday", "read", "skull", "spell" ]
        }, {
            title: "fas fa-book-open",
            searchTerms: [ "flyer", "notebook", "open book", "pamphlet", "reading","folleto", "cuaderno", "libro abierto", "folleto", "lectura" ]
        }, {
            title: "fas fa-book-reader",
            searchTerms: [ "library","biblioteca" ]
        }, {
            title: "fas fa-bookmark",
            searchTerms: [ "save","salvar" ]
        }, {
            title: "far fa-bookmark",
            searchTerms: [ "save","salvar" ]
        }, {
            title: "fas fa-bowling-ball",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-box",
            searchTerms: [ "package" ,"paquete"]
        }, {
            title: "fas fa-box-open",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-boxes",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-braille",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-brain",
            searchTerms: [ "cerebellum", "gray matter", "intellect", "medulla oblongata", "mind", "noodle", "wit","cerebelo", "materia gris", "intelecto", "médula oblongata", "mente", "fideos", "ingenio" ]
        }, {
            title: "fas fa-briefcase",
            searchTerms: [ "bag", "business", "luggage", "office", "work" ,"bolsa", "negocio", "equipaje", "oficina", "trabajo"]
        }, {
            title: "fas fa-briefcase-medical",
            searchTerms: [ "health briefcase","maletín de salud" ]
        }, {
            title: "fas fa-broadcast-tower",
            searchTerms: [ "airwaves", "radio", "waves","ondas", "radio", "ondas" ]
        }, {
            title: "fas fa-broom",
            searchTerms: [ "clean", "firebolt", "fly", "halloween", "holiday", "nimbus 2000", "quidditch", "sweep", "witch" ]
        }, {
            title: "fas fa-brush",
            searchTerms: [ "bristles", "color", "handle", "painting","cerdas", "color", "asa", "pintura" ]
        }, {
            title: "fab fa-btc",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bug",
            searchTerms: [ "insect", "report","insecto", "informe" ]
        }, {
            title: "fas fa-building",
            searchTerms: [ "apartment", "business", "company", "office", "work","apartamento", "negocio", "empresa", "oficina", "trabajo" ]
        }, {
            title: "far fa-building",
            searchTerms: [ "apartment", "business", "company", "office", "work","apartamento", "negocio", "empresa", "oficina", "trabajo" ]
        }, {
            title: "fas fa-bullhorn",
            searchTerms: [ "announcement", "broadcast", "louder", "megaphone", "share","anuncio", "transmisión", "más alto", "megáfono", "compartir" ]
        }, {
            title: "fas fa-bullseye",
            searchTerms: [ "target","objetivo" ]
        }, {
            title: "fas fa-burn",
            searchTerms: [ "energy","energía" ]
        }, {
            title: "fab fa-buromobelexperte",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-bus",
            searchTerms: [ "machine", "public transportation", "transportation", "vehicle","máquina", "transporte público", "transporte", "vehículo" ]
        }, {
            title: "fas fa-bus-alt",
            searchTerms: [ "machine", "public transportation", "transportation", "vehicle","máquina", "transporte público", "transporte", "vehículo" ]
        }, {
            title: "fas fa-business-time",
            searchTerms: [ "briefcase", "business socks", "clock", "flight of the conchords", "wednesday","maletín", "calcetines de negocios", "reloj", "vuelo de los conchords", "miércoles" ]
        }, {
            title: "fab fa-buysellads",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-calculator",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-calendar",
            searchTerms: [ "calendar-o", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "far fa-calendar",
            searchTerms: [ "calendar-o", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "fas fa-calendar-alt",
            searchTerms: [ "calendar", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "far fa-calendar-alt",
            searchTerms: [ "calendar", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "fas fa-calendar-check",
            searchTerms: [ "accept", "agree", "appointment", "confirm", "correct", "done", "ok", "select", "success", "todo","aceptar", "aceptar", "cita", "confirmar", "corregir", "hacer", "aceptar", "seleccionar", "éxito", "todo" ]
        }, {
            title: "far fa-calendar-check",
            searchTerms: [ "accept", "agree", "appointment", "confirm", "correct", "done", "ok", "select", "success", "todo","aceptar", "aceptar", "cita", "confirmar", "corregir", "hacer", "aceptar", "seleccionar", "éxito", "todo" ]
        }, {
            title: "fas fa-calendar-minus",
            searchTerms: [ "delete", "negative", "remove","eliminar", "negativo", "eliminar" ]
        }, {
            title: "far fa-calendar-minus",
            searchTerms: [ "delete", "negative", "remove","eliminar", "negativo", "eliminar" ]
        }, {
            title: "fas fa-calendar-plus",
            searchTerms: [ "add", "create", "new", "positive","agregar", "crear", "nuevo", "positivo" ]
        }, {
            title: "far fa-calendar-plus",
            searchTerms: [ "add", "create", "new", "positive","agregar", "crear", "nuevo", "positivo" ]
        }, {
            title: "fas fa-calendar-times",
            searchTerms: [ "archive", "delete", "remove", "x","archivo", "eliminar", "eliminar", "x" ]
        }, {
            title: "far fa-calendar-times",
            searchTerms: [ "archive", "delete", "remove", "x","archivo", "eliminar", "eliminar", "x" ]
        }, {
            title: "fas fa-camera",
            searchTerms: [ "photo", "picture", "record","foto", "imagen", "grabar" ]
        }, {
            title: "fas fa-camera-retro",
            searchTerms: [ "photo", "picture", "record","foto", "imagen", "grabar" ]
        }, {
            title: "fas fa-campground",
            searchTerms: [ "camping", "fall", "outdoors", "seasonal", "tent","camping", "otoño", "aire libre", "estacional", "tienda" ]
        }, {
            title: "fas fa-cannabis",
            searchTerms: [ "bud", "chronic", "drugs", "endica", "endo", "ganja", "marijuana", "mary jane", "pot", "reefer", "sativa", "spliff", "weed", "whacky-tabacky","brote", "crónico", "drogas", "indica", "endo", "ganja", "marihuana", "mary jane", "olla", "reefer", "sativa", "spliff", " mala hierba "," alocada " ]
        }, {
            title: "fas fa-capsules",
            searchTerms: [ "drugs", "medicine","drogas", "medicina" ]
        }, {
            title: "fas fa-car",
            searchTerms: [ "machine", "transportation", "vehicle","máquina", "transporte", "vehículo" ]
        }, {
            title: "fas fa-car-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-car-battery",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-car-crash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-car-side",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-caret-down",
            searchTerms: [ "arrow", "dropdown", "menu", "more", "triangle down" ]
        }, {
            title: "fas fa-caret-left",
            searchTerms: [ "arrow", "back", "previous", "triangle left" ]
        }, {
            title: "fas fa-caret-right",
            searchTerms: [ "arrow", "forward", "next", "triangle right" ]
        }, {
            title: "fas fa-caret-square-down",
            searchTerms: [ "caret-square-o-down", "dropdown", "menu", "more" ]
        }, {
            title: "far fa-caret-square-down",
            searchTerms: [ "caret-square-o-down", "dropdown", "menu", "more" ]
        }, {
            title: "fas fa-caret-square-left",
            searchTerms: [ "back", "caret-square-o-left", "previous" ]
        }, {
            title: "far fa-caret-square-left",
            searchTerms: [ "back", "caret-square-o-left", "previous" ]
        }, {
            title: "fas fa-caret-square-right",
            searchTerms: [ "caret-square-o-right", "forward", "next" ]
        }, {
            title: "far fa-caret-square-right",
            searchTerms: [ "caret-square-o-right", "forward", "next" ]
        }, {
            title: "fas fa-caret-square-up",
            searchTerms: [ "caret-square-o-up" ]
        }, {
            title: "far fa-caret-square-up",
            searchTerms: [ "caret-square-o-up" ]
        }, {
            title: "fas fa-caret-up",
            searchTerms: [ "arrow", "triangle up" ]
        }, {
            title: "fas fa-cart-arrow-down",
            searchTerms: [ "shopping" ]
        }, {
            title: "fas fa-cart-plus",
            searchTerms: [ "add", "create", "new", "positive", "shopping" ]
        }, {
            title: "fas fa-cat",
            searchTerms: [ "feline", "halloween", "holiday", "kitten", "kitty", "meow", "pet" ]
        }, {
            title: "fab fa-cc-amazon-pay",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-amex",
            searchTerms: [ "amex" ]
        }, {
            title: "fab fa-cc-apple-pay",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-diners-club",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-discover",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-jcb",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-mastercard",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-paypal",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-stripe",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cc-visa",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-centercode",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-certificate",
            searchTerms: [ "badge", "star" ]
        }, {
            title: "fas fa-chair",
            searchTerms: [ "furniture", "seat" ]
        }, {
            title: "fas fa-chalkboard",
            searchTerms: [ "blackboard", "learning", "school", "teaching", "whiteboard", "writing","pizarra", "aprendizaje", "escuela", "enseñanza", "pizarra", "escritura" ]
        }, {
            title: "fas fa-chalkboard-teacher",
            searchTerms: [ "blackboard", "instructor", "learning", "professor", "school", "whiteboard", "writing","pizarra", "instructor", "aprendizaje", "profesor", "escuela", "pizarra", "escribir" ]
        }, {
            title: "fas fa-charging-station",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chart-area",
            searchTerms: [ "analytics", "area-chart", "graph" ]
        }, {
            title: "fas fa-chart-bar",
            searchTerms: [ "analytics", "bar-chart", "graph" ]
        }, {
            title: "far fa-chart-bar",
            searchTerms: [ "analytics", "bar-chart", "graph" ]
        }, {
            title: "fas fa-chart-line",
            searchTerms: [ "activity", "analytics", "dashboard", "graph", "line-chart" ]
        }, {
            title: "fas fa-chart-pie",
            searchTerms: [ "analytics", "graph", "pie-chart" ]
        }, {
            title: "fas fa-check",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "notice", "notification", "notify", "ok", "select", "success", "tick", "todo", "yes" ]
        }, {
            title: "fas fa-check-circle",
            searchTerms: [ "accept", "agree", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "far fa-check-circle",
            searchTerms: [ "accept", "agree", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "fas fa-check-double",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "notice", "notification", "notify", "ok", "select", "success", "tick", "todo" ]
        }, {
            title: "fas fa-check-square",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "far fa-check-square",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "fas fa-chess",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-bishop",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-board",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-king",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-knight",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-pawn",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-queen",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chess-rook",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chevron-circle-down",
            searchTerms: [ "arrow", "dropdown", "menu", "more" ]
        }, {
            title: "fas fa-chevron-circle-left",
            searchTerms: [ "arrow", "back", "previous" ]
        }, {
            title: "fas fa-chevron-circle-right",
            searchTerms: [ "arrow", "forward", "next" ]
        }, {
            title: "fas fa-chevron-circle-up",
            searchTerms: [ "arrow" ]
        }, {
            title: "fas fa-chevron-down",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-chevron-left",
            searchTerms: [ "back", "bracket", "previous" ]
        }, {
            title: "fas fa-chevron-right",
            searchTerms: [ "bracket", "forward", "next" ]
        }, {
            title: "fas fa-chevron-up",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-child",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-chrome",
            searchTerms: [ "browser" ]
        }, {
            title: "fas fa-church",
            searchTerms: [ "building", "community", "religion" ]
        }, {
            title: "fas fa-circle",
            searchTerms: [ "circle-thin", "dot", "notification" ]
        }, {
            title: "far fa-circle",
            searchTerms: [ "circle-thin", "dot", "notification" ]
        }, {
            title: "fas fa-circle-notch",
            searchTerms: [ "circle-o-notch" ]
        }, {
            title: "fas fa-city",
            searchTerms: [ "buildings", "busy", "skyscrapers", "urban", "windows" ]
        }, {
            title: "fas fa-clipboard",
            searchTerms: [ "paste" ]
        }, {
            title: "far fa-clipboard",
            searchTerms: [ "paste" ]
        }, {
            title: "fas fa-clipboard-check",
            searchTerms: [ "accept", "agree", "confirm", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "fas fa-clipboard-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "intinerary", "ol", "schedule", "todo", "ul" ]
        }, {
            title: "fas fa-clock",
            searchTerms: [ "date", "late", "schedule", "timer", "timestamp", "watch" ]
        }, {
            title: "far fa-clock",
            searchTerms: [ "date", "late", "schedule", "timer", "timestamp", "watch" ]
        }, {
            title: "fas fa-clone",
            searchTerms: [ "copy", "duplicate" ]
        }, {
            title: "far fa-clone",
            searchTerms: [ "copy", "duplicate" ]
        }, {
            title: "fas fa-closed-captioning",
            searchTerms: [ "cc" ]
        }, {
            title: "far fa-closed-captioning",
            searchTerms: [ "cc" ]
        }, {
            title: "fas fa-cloud",
            searchTerms: [ "save" ]
        }, {
            title: "fas fa-cloud-download-alt",
            searchTerms: [ "import" ]
        }, {
            title: "fas fa-cloud-meatball",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cloud-moon",
            searchTerms: [ "crescent", "evening", "halloween", "holiday", "lunar", "night", "sky" ]
        }, {
            title: "fas fa-cloud-moon-rain",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cloud-rain",
            searchTerms: [ "precipitation" ]
        }, {
            title: "fas fa-cloud-showers-heavy",
            searchTerms: [ "precipitation", "rain", "storm" ]
        }, {
            title: "fas fa-cloud-sun",
            searchTerms: [ "day", "daytime", "fall", "outdoors", "seasonal" ]
        }, {
            title: "fas fa-cloud-sun-rain",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cloud-upload-alt",
            searchTerms: [ "cloud-upload" ]
        }, {
            title: "fab fa-cloudscale",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cloudsmith",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-cloudversify",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cocktail",
            searchTerms: [ "alcohol", "beverage", "drink" ]
        }, {
            title: "fas fa-code",
            searchTerms: [ "brackets", "html" ]
        }, {
            title: "fas fa-code-branch",
            searchTerms: [ "branch", "code-fork", "fork", "git", "github", "rebase", "svn", "vcs", "version" ]
        }, {
            title: "fab fa-codepen",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-codiepie",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-coffee",
            searchTerms: [ "beverage", "breakfast", "cafe", "drink", "fall", "morning", "mug", "seasonal", "tea" ]
        }, {
            title: "fas fa-cog",
            searchTerms: [ "settings" ]
        }, {
            title: "fas fa-cogs",
            searchTerms: [ "gears", "settings" ]
        }, {
            title: "fas fa-coins",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-columns",
            searchTerms: [ "dashboard", "panes", "split" ]
        }, {
            title: "fas fa-comment",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "far fa-comment",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "fas fa-comment-alt",
            searchTerms: [ "bubble", "chat", "commenting", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "far fa-comment-alt",
            searchTerms: [ "bubble", "chat", "commenting", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "fas fa-comment-dollar",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-comment-dots",
            searchTerms: ["mas"]
        }, {
            title: "far fa-comment-dots",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-comment-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-comments",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "far fa-comments",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "fas fa-comments-dollar",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-compact-disc",
            searchTerms: [ "bluray", "cd", "disc", "media" ]
        }, {
            title: "fas fa-compass",
            searchTerms: [ "directory", "location", "menu", "safari" ]
        }, {
            title: "far fa-compass",
            searchTerms: [ "directory", "location", "menu", "safari" ]
        }, {
            title: "fas fa-compress",
            searchTerms: [ "collapse", "combine", "contract", "merge", "smaller" ]
        }, {
            title: "fas fa-concierge-bell",
            searchTerms: [ "attention", "hotel", "service", "support" ]
        }, {
            title: "fab fa-connectdevelop",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-contao",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cookie",
            searchTerms: [ "baked good", "chips", "food", "snack", "sweet", "treat" ]
        }, {
            title: "fas fa-cookie-bite",
            searchTerms: [ "baked good", "bitten", "chips", "eating", "food", "snack", "sweet", "treat" ]
        }, {
            title: "fas fa-copy",
            searchTerms: [ "clone", "duplicate", "file", "files-o" ]
        }, {
            title: "far fa-copy",
            searchTerms: [ "clone", "duplicate", "file", "files-o" ]
        }, {
            title: "fas fa-copyright",
            searchTerms: ["mas"]
        }, {
            title: "far fa-copyright",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-couch",
            searchTerms: [ "furniture", "sofa" ]
        }, {
            title: "fab fa-cpanel",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-by",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-nc",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-nc-eu",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-nc-jp",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-nd",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-pd",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-pd-alt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-remix",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-sa",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-sampling",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-sampling-plus",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-share",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-creative-commons-zero",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-credit-card",
            searchTerms: [ "buy", "checkout", "credit-card-alt", "debit", "money", "payment", "purchase" ]
        }, {
            title: "far fa-credit-card",
            searchTerms: [ "buy", "checkout", "credit-card-alt", "debit", "money", "payment", "purchase" ]
        }, {
            title: "fab fa-critical-role",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fas fa-crop",
            searchTerms: [ "design" ]
        }, {
            title: "fas fa-crop-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cross",
            searchTerms: [ "catholicism", "christianity" ]
        }, {
            title: "fas fa-crosshairs",
            searchTerms: [ "gpd", "picker", "position" ]
        }, {
            title: "fas fa-crow",
            searchTerms: [ "bird", "bullfrog", "fauna", "halloween", "holiday", "toad" ]
        }, {
            title: "fas fa-crown",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-css3",
            searchTerms: [ "code" ]
        }, {
            title: "fab fa-css3-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-cube",
            searchTerms: [ "package" ]
        }, {
            title: "fas fa-cubes",
            searchTerms: [ "packages" ]
        }, {
            title: "fas fa-cut",
            searchTerms: [ "scissors" ]
        }, {
            title: "fab fa-cuttlefish",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-d-and-d",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-d-and-d-beyond",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "gaming", "tabletop" ]
        }, {
            title: "fab fa-dashcube",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-database",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-deaf",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-delicious",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-democrat",
            searchTerms: [ "american", "democratic party", "donkey", "election", "left", "left-wing", "liberal", "politics", "usa" ]
        }, {
            title: "fab fa-deploydog",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-deskpro",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-desktop",
            searchTerms: [ "computer", "cpu", "demo", "desktop", "device", "machine", "monitor", "pc", "screen" ]
        }, {
            title: "fab fa-dev",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-deviantart",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dharmachakra",
            searchTerms: [ "buddhism", "buddhist", "wheel of dharma" ]
        }, {
            title: "fas fa-diagnoses",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dice",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-d20",
            searchTerms: [ "Dungeons & Dragons", "chance", "d&d", "dnd", "fantasy", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-d6",
            searchTerms: [ "Dungeons & Dragons", "chance", "d&d", "dnd", "fantasy", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-five",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-four",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-one",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-six",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-three",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-two",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fab fa-digg",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-digital-ocean",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-digital-tachograph",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-directions",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-discord",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-discourse",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-divide",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dizzy",
            searchTerms: [ "dazed", "disapprove", "emoticon", "face" ]
        }, {
            title: "far fa-dizzy",
            searchTerms: [ "dazed", "disapprove", "emoticon", "face" ]
        }, {
            title: "fas fa-dna",
            searchTerms: [ "double helix", "helix" ]
        }, {
            title: "fab fa-dochub",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-docker",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dog",
            searchTerms: [ "canine", "fauna", "mammmal", "pet", "pooch", "puppy", "woof" ]
        }, {
            title: "fas fa-dollar-sign",
            searchTerms: [ "$", "dollar-sign", "money", "price", "usd" ]
        }, {
            title: "fas fa-dolly",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dolly-flatbed",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-donate",
            searchTerms: [ "generosity", "give" ]
        }, {
            title: "fas fa-door-closed",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-door-open",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dot-circle",
            searchTerms: [ "bullseye", "notification", "target" ]
        }, {
            title: "far fa-dot-circle",
            searchTerms: [ "bullseye", "notification", "target" ]
        }, {
            title: "fas fa-dove",
            searchTerms: [ "bird", "fauna", "flying", "peace" ]
        }, {
            title: "fas fa-download",
            searchTerms: [ "import" ]
        }, {
            title: "fab fa-draft2digital",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-drafting-compass",
            searchTerms: [ "mechanical drawing", "plot", "plotting" ]
        }, {
            title: "fas fa-dragon",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy" ]
        }, {
            title: "fas fa-draw-polygon",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-dribbble",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-dribbble-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-dropbox",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-drum",
            searchTerms: [ "instrument", "music", "percussion", "snare", "sound" ]
        }, {
            title: "fas fa-drum-steelpan",
            searchTerms: [ "calypso", "instrument", "music", "percussion", "reggae", "snare", "sound", "steel", "tropical" ]
        }, {
            title: "fas fa-drumstick-bite",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-drupal",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-dumbbell",
            searchTerms: [ "exercise", "gym", "strength", "weight", "weight-lifting","ejercicio", "gimnasio", "fuerza", "peso", "levantamiento de pesas" ]
        }, {
            title: "fas fa-dungeon",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "door", "entrance", "fantasy", "gate" ]
        }, {
            title: "fab fa-dyalog",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-earlybirds",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-ebay",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-edge",
            searchTerms: [ "browser", "ie","navegador", "es decir" ]
        }, {
            title: "fas fa-edit",
            searchTerms: [ "edit", "pen", "pencil", "update", "write","editar", "pluma", "lápiz", "actualizar", "escribir" ]
        }, {
            title: "far fa-edit",
            searchTerms: [ "edit", "pen", "pencil", "update", "write","editar", "pluma", "lápiz", "actualizar", "escribir" ]
        }, {
            title: "fas fa-eject",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-elementor",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ellipsis-h",
            searchTerms: [ "dots", "drag", "kebab", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "ul","puntos", "arrastrar", "kebab", "lista", "menú", "navegación", "navegación", "ol", "reordenar", "configuraciones", "ul" ]
        }, {
            title: "fas fa-ellipsis-v",
            searchTerms: [ "dots", "drag", "kebab", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "ul","puntos", "arrastrar", "kebab", "lista", "menú", "navegación", "navegación", "ol", "reordenar", "configuraciones", "ul" ]
        }, {
            title: "fab fa-ello",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-ember",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-empire",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-envelope",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support","Correo electrónico", "Correo electrónico", "Carta", "Correo electrónico", "Mensaje", "Notificación", "Soporte" ]
        }, {
            title: "far fa-envelope",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support","Correo electrónico", "Correo electrónico", "Carta", "Correo electrónico", "Mensaje", "Notificación", "Soporte" ]
        }, {
            title: "fas fa-envelope-open",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support","Correo electrónico", "Correo electrónico", "Carta", "Correo electrónico", "Mensaje", "Notificación", "Soporte" ]
        }, {
            title: "far fa-envelope-open",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support","Correo electrónico", "Correo electrónico", "Carta", "Correo electrónico", "Mensaje", "Notificación", "Soporte" ]
        }, {
            title: "fas fa-envelope-open-text",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-envelope-square",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support","Correo electrónico", "Correo electrónico", "Carta", "Correo electrónico", "Mensaje", "Notificación", "Soporte" ]
        }, {
            title: "fab fa-envira",
            searchTerms: [ "leaf","hoja" ]
        }, {
            title: "fas fa-equals",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-eraser",
            searchTerms: [ "delete", "remove","eliminar", "eliminar" ]
        }, {
            title: "fab fa-erlang",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-ethereum",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-etsy",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-euro-sign",
            searchTerms: [ "eur","euro" ]
        }, {
            title: "fas fa-exchange-alt",
            searchTerms: [ "arrow", "arrows", "exchange", "reciprocate", "return", "swap", "transfer","flechas", "intercambio", "reciprocidad", "retorno", "intercambio", "transferencia" ]
        }, {
            title: "fas fa-exclamation",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning","alerta", "peligro", "error", "importante", "aviso", "notificación", "notificar", "problema", "advertencia" ]
        }, {
            title: "fas fa-exclamation-circle",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning","alerta", "peligro", "error", "importante", "aviso", "notificación", "notificar", "problema", "advertencia" ]
        }, {
            title: "fas fa-exclamation-triangle",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning","alerta", "peligro", "error", "importante", "aviso", "notificación", "notificar", "problema", "advertencia" ]
        }, {
            title: "fas fa-expand",
            searchTerms: [ "bigger", "enlarge", "resize","más grande", "ampliar", "redimensionar" ]
        }, {
            title: "fas fa-expand-arrows-alt",
            searchTerms: [ "arrows-alt", "bigger", "enlarge", "move", "resize","más grande", "ampliar", "redimensionar" ]
        }, {
            title: "fab fa-expeditedssl",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-external-link-alt",
            searchTerms: [ "external-link", "new", "open" ]
        }, {
            title: "fas fa-external-link-square-alt",
            searchTerms: [ "external-link-square", "new", "open" ]
        }, {
            title: "fas fa-eye",
            searchTerms: [ "optic", "see", "seen", "show", "sight", "views", "visible","óptica", "ver", "visto", "mostrar", "vista", "vistas", "visible" ]
        }, {
            title: "far fa-eye",
            searchTerms: [ "optic", "see", "seen", "show", "sight", "views", "visible","óptica", "ver", "visto", "mostrar", "vista", "vistas", "visible" ]
        }, {
            title: "fas fa-eye-dropper",
            searchTerms: [ "eyedropper","cuentagotas" ]
        }, {
            title: "fas fa-eye-slash",
            searchTerms: [ "blind", "hide", "show", "toggle", "unseen", "views", "visible", "visiblity","ciego", "ocultar", "mostrar", "alternar", "invisible", "vistas", "visible", "visibilidad" ]
        }, {
            title: "far fa-eye-slash",
            searchTerms: [ "blind", "hide", "show", "toggle", "unseen", "views", "visible", "visiblity","ciego", "ocultar", "mostrar", "alternar", "invisible", "vistas", "visible", "visibilidad" ]
        }, {
            title: "fab fa-facebook",
            searchTerms: [ "facebook-official", "social network" ]
        }, {
            title: "fab fa-facebook-f",
            searchTerms: [ "facebook" ]
        }, {
            title: "fab fa-facebook-messenger",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-facebook-square",
            searchTerms: [ "social network" ]
        }, {
            title: "fab fa-fantasy-flight-games",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fas fa-fast-backward",
            searchTerms: [ "beginning", "first", "previous", "rewind", "start","comienzo", "primero", "anterior", "rebobinar", "comenzar"]
        }, {
            title: "fas fa-fast-forward",
            searchTerms: [ "end", "last", "next" ]
        }, {
            title: "fas fa-fax",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-feather",
            searchTerms: [ "bird", "light", "plucked", "quill","pájaro", "luz", "desplumado", "pluma" ]
        }, {
            title: "fas fa-feather-alt",
            searchTerms: [ "bird", "light", "plucked", "quill","pájaro", "luz", "desplumado", "pluma" ]
        }, {
            title: "fas fa-female",
            searchTerms: [ "human", "person", "profile", "user", "woman" ,"humano", "persona", "perfil", "usuario", "mujer"]
        }, {
            title: "fas fa-fighter-jet",
            searchTerms: [ "airplane", "fast", "fly", "goose", "maverick", "plane", "quick", "top gun", "transportation", "travel","avión", "rápido", "volar", "ganso", "inconformista", "avión", "rápido", "arma superior", "transporte", "viaje" ]
        }, {
            title: "fas fa-file",
            searchTerms: [ "document", "new", "page", "pdf", "resume","documento", "nuevo", "página", "pdf", "reanudar" ]
        }, {
            title: "far fa-file",
            searchTerms: [ "document", "new", "page", "pdf", "resume","documento", "nuevo", "página", "pdf", "reanudar" ]
        }, {
            title: "fas fa-file-alt",
            searchTerms: [ "document", "file-text", "invoice", "new", "page", "pdf","documento", "archivo-texto", "factura", "nuevo", "página", "pdf" ]
        }, {
            title: "far fa-file-alt",
            searchTerms: [ "document", "file-text", "invoice", "new", "page", "pdf","documento", "archivo-texto", "factura", "nuevo", "página", "pdf" ]
        }, {
            title: "fas fa-file-archive",
            searchTerms: [ ".zip", "bundle", "compress", "compression", "download", "zip",".zip", "paquete", "comprimir", "compresión", "descargar", "zip" ]
        }, {
            title: "far fa-file-archive",
            searchTerms: [ ".zip", "bundle", "compress", "compression", "download", "zip",".zip", "paquete", "comprimir", "compresión", "descargar", "zip" ]
        }, {
            title: "fas fa-file-audio",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-audio",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-code",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-code",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-contract",
            searchTerms: [ "agreement", "binding", "document", "legal", "signature","acuerdo", "vinculante", "documento", "legal", "firma" ]
        }, {
            title: "fas fa-file-csv",
            searchTerms: [ "spreadsheets","hojas de cálculo" ]
        }, {
            title: "fas fa-file-download",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-excel",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-excel",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-export",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-image",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-image",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-import",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-invoice",
            searchTerms: [ "bill", "document", "receipt","factura", "documento", "recibo"]
        }, {
            title: "fas fa-file-invoice-dollar",
            searchTerms: [ "$", "bill", "document", "dollar-sign", "money", "receipt", "usd","factura", "documento", "signo de dólar", "dinero", "recibo", "usd" ]
        }, {
            title: "fas fa-file-medical",
            searchTerms: ['history','medico']
        }, {
            title: "fas fa-file-medical-alt",
            searchTerms: ['history','medico']
        }, {
            title: "fas fa-file-pdf",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-pdf",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-powerpoint",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-powerpoint",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-prescription",
            searchTerms: [ "drugs", "medical", "medicine", "rx","drogas", "medicina", "medicina", "rx" ]
        }, {
            title: "fas fa-file-signature",
            searchTerms: [ "John Hancock", "contract", "document", "name","John Hancock", "contrato", "documento", "nombre" ]
        }, {
            title: "fas fa-file-upload",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-video",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-video",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-file-word",
            searchTerms: ["mas"]
        }, {
            title: "far fa-file-word",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-fill",
            searchTerms: [ "bucket", "color", "paint", "paint bucket","cubo", "color", "pintura", "cubo de pintura" ]
        }, {
            title: "fas fa-fill-drip",
            searchTerms: [ "bucket", "color", "drop", "paint", "paint bucket", "spill","cubo", "color", "gota", "pintura", "cubo de pintura", "derrame" ]
        }, {
            title: "fas fa-film",
            searchTerms: [ "movie","película" ]
        }, {
            title: "fas fa-filter",
            searchTerms: [ "funnel", "options","embudo", "opciones" ]
        }, {
            title: "fas fa-fingerprint",
            searchTerms: [ "human", "id", "identification", "lock", "smudge", "touch", "unique", "unlock" ]
        }, {
            title: "fas fa-fire",
            searchTerms: [ "caliente", "flame", "heat", "hot", "popular" , "llama", "calor", "caliente", "popular"]
        }, {
            title: "fas fa-fire-extinguisher",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-firefox",
            searchTerms: [ "browser" ]
        }, {
            title: "fas fa-first-aid",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-first-order",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-first-order-alt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-firstdraft",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-fish",
            searchTerms: [ "fauna", "gold", "swimming","fauna", "oro", "natación" ]
        }, {
            title: "fas fa-fist-raised",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "hand", "ki", "monk", "resist", "strength", "unarmed combat","Dragones y Mazmorras", "d & d", "dnd", "fantasía", "mano", "ki", "monje", "resistir", "fuerza", "combate sin armas" ]
        }, {
            title: "fas fa-flag",
            searchTerms: [ "country", "notice", "notification", "notify", "pole", "report", "symbol","país", "aviso", "notificación", "notificar", "polo", "informar", "símbolo" ]
        }, {
            title: "far fa-flag",
            searchTerms: [ "country", "notice", "notification", "notify", "pole", "report", "symbol","país", "aviso", "notificación", "notificar", "polo", "informar", "símbolo" ]
        }, {
            title: "fas fa-flag-checkered",
            searchTerms: [ "notice", "notification", "notify", "pole", "racing", "report", "symbol","aviso", "notificación", "notificar", "polo", "carreras", "informe", "símbolo" ]
        }, {
            title: "fas fa-flag-usa",
            searchTerms: [ "betsy ross", "country", "old glory", "stars", "stripes", "symbol" ]
        }, {
            title: "fas fa-flask",
            searchTerms: [ "beaker", "experimental", "labs", "science","vaso", "experimental", "laboratorios", "ciencia" ]
        }, {
            title: "fab fa-flickr",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-flipboard",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-flushed",
            searchTerms: [ "embarrassed", "emoticon", "face","avergonzado", "emoticon", "cara" ]
        }, {
            title: "far fa-flushed",
            searchTerms: [ "embarrassed", "emoticon", "face","avergonzado", "emoticon", "cara" ]
        }, {
            title: "fab fa-fly",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-folder",
            searchTerms: ["mas"]
        }, {
            title: "far fa-folder",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-folder-minus",
            searchTerms: [ "archive", "delete", "negative", "remove","archivo", "eliminar", "negativo", "eliminar" ]
        }, {
            title: "fas fa-folder-open",
            searchTerms: ["mas"]
        }, {
            title: "far fa-folder-open",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-folder-plus",
            searchTerms: [ "add", "create", "new", "positive","agregar", "crear", "nuevo", "positivo" ]
        }, {
            title: "fas fa-font",
            searchTerms: [ "text" ]
        }, {
            title: "fab fa-font-awesome",
            searchTerms: [ "meanpath" ]
        }, {
            title: "fab fa-font-awesome-alt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-font-awesome-flag",
            searchTerms: ["mas"]
        }, {
            title: "far fa-font-awesome-logo-full",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-font-awesome-logo-full",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-font-awesome-logo-full",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-fonticons",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-fonticons-fi",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-football-ball",
            searchTerms: [ "fall", "pigskin", "seasonal" ]
        }, {
            title: "fab fa-fort-awesome",
            searchTerms: [ "castle" ]
        }, {
            title: "fab fa-fort-awesome-alt",
            searchTerms: [ "castle" ]
        }, {
            title: "fab fa-forumbee",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-forward",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "fab fa-foursquare",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-free-code-camp",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-freebsd",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-frog",
            searchTerms: [ "amphibian", "bullfrog", "fauna", "hop", "kermit", "kiss", "prince", "ribbit", "toad", "wart","anfibios", "rana toro", "fauna", "salto", "kermit", "beso", "príncipe", "ribbit", "sapo", "verruga" ]
        }, {
            title: "fas fa-frown",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "far fa-frown",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "fas fa-frown-open",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "far fa-frown-open",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "fab fa-fulcrum",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-funnel-dollar",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-futbol",
            searchTerms: [ "ball", "football", "soccer","balón", "fútbol", "fútbol" ]
        }, {
            title: "far fa-futbol",
            searchTerms: [ "ball", "football", "soccer","balón", "fútbol", "fútbol" ]
        }, {
            title: "fab fa-galactic-republic",
            searchTerms: [ "politics", "star wars" ]
        }, {
            title: "fab fa-galactic-senate",
            searchTerms: [ "star wars" ]
        }, {
            title: "fas fa-gamepad",
            searchTerms: [ "controller" ]
        }, {
            title: "fas fa-gas-pump",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-gavel",
            searchTerms: [ "hammer", "judge", "lawyer", "opinion" ]
        }, {
            title: "fas fa-gem",
            searchTerms: [ "diamond" ]
        }, {
            title: "far fa-gem",
            searchTerms: [ "diamond" ]
        }, {
            title: "fas fa-genderless",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-get-pocket",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-gg",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-gg-circle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ghost",
            searchTerms: [ "apparition", "blinky", "clyde", "floating", "halloween", "holiday", "inky", "pinky", "spirit" ]
        }, {
            title: "fas fa-gift",
            searchTerms: [ "generosity", "giving", "party", "present", "wrapped" ]
        }, {
            title: "fab fa-git",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-git-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-github",
            searchTerms: [ "octocat" ]
        }, {
            title: "fab fa-github-alt",
            searchTerms: [ "octocat" ]
        }, {
            title: "fab fa-github-square",
            searchTerms: [ "octocat" ]
        }, {
            title: "fab fa-gitkraken",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-gitlab",
            searchTerms: [ "Axosoft" ]
        }, {
            title: "fab fa-gitter",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-glass-martini",
            searchTerms: [ "alcohol", "bar", "beverage", "drink", "glass", "liquor", "martini","alcohol", "bar", "bebida", "bebida", "vaso", "licor", "martini" ]
        }, {
            title: "fas fa-glass-martini-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-glasses",
            searchTerms: [ "foureyes", "hipster", "nerd", "reading", "sight", "spectacles" ]
        }, {
            title: "fab fa-glide",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-glide-g",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-globe",
            searchTerms: [ "all", "coordinates", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world","todo", "coordenadas", "país", "tierra", "global", "gps", "idioma", "localizar", "ubicación", "mapa", "en línea", "lugar", "planeta","traducir","viajar","mundo" ]
        }, {
            title: "fas fa-globe-africa",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world","todo", "país", "tierra", "global", "gps", "idioma", "localizar", "ubicación", "mapa", "en línea", "lugar", "planeta", "traducir","viajar","mundo" ]
        }, {
            title: "fas fa-globe-americas",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world","todo", "país", "tierra", "global", "gps", "idioma", "localizar", "ubicación", "mapa", "en línea", "lugar", "planeta", "traducir","viajar","mundo" ]
        }, {
            title: "fas fa-globe-asia",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world","todo", "país", "tierra", "global", "gps", "idioma", "localizar", "ubicación", "mapa", "en línea", "lugar", "planeta", "traducir","viajar","mundo" ]
        }, {
            title: "fab fa-gofore",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-golf-ball",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-goodreads",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-goodreads-g",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-google",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-google-drive",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-google-play",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-google-plus",
            searchTerms: [ "google-plus-circle", "google-plus-official" ]
        }, {
            title: "fab fa-google-plus-g",
            searchTerms: [ "google-plus", "social network" ]
        }, {
            title: "fab fa-google-plus-square",
            searchTerms: [ "social network",,"red social" ]
        }, {
            title: "fab fa-google-wallet",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-gopuram",
            searchTerms: [ "building", "entrance", "hinduism", "temple", "tower","edificio", "entrada", "hinduismo", "templo", "torre" ]
        }, {
            title: "fas fa-graduation-cap",
            searchTerms: [ "learning", "school", "student","aprender", "escuela", "estudiante"]
        }, {
            title: "fab fa-gratipay",
            searchTerms: [ "favorite", "heart", "like", "love","favorito", "corazón", "me gusta", "amor" ]
        }, {
            title: "fab fa-grav",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-greater-than",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-greater-than-equal",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-grimace",
            searchTerms: [ "cringe", "emoticon", "face" ]
        }, {
            title: "far fa-grimace",
            searchTerms: [ "cringe", "emoticon", "face" ]
        }, {
            title: "fas fa-grin",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-alt",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin-alt",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-beam",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin-beam",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-beam-sweat",
            searchTerms: [ "emoticon", "face", "smile" ]
        }, {
            title: "far fa-grin-beam-sweat",
            searchTerms: [ "emoticon", "face", "smile" ]
        }, {
            title: "fas fa-grin-hearts",
            searchTerms: [ "emoticon", "face", "love", "smile" ]
        }, {
            title: "far fa-grin-hearts",
            searchTerms: [ "emoticon", "face", "love", "smile" ]
        }, {
            title: "fas fa-grin-squint",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin-squint",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-squint-tears",
            searchTerms: [ "emoticon", "face", "happy", "smile" ]
        }, {
            title: "far fa-grin-squint-tears",
            searchTerms: [ "emoticon", "face", "happy", "smile" ]
        }, {
            title: "fas fa-grin-stars",
            searchTerms: [ "emoticon", "face", "star-struck" ]
        }, {
            title: "far fa-grin-stars",
            searchTerms: [ "emoticon", "face", "star-struck" ]
        }, {
            title: "fas fa-grin-tears",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tears",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-tongue",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tongue",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-tongue-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tongue-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-tongue-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tongue-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-wink",
            searchTerms: [ "emoticon", "face", "flirt", "laugh", "smile" ]
        }, {
            title: "far fa-grin-wink",
            searchTerms: [ "emoticon", "face", "flirt", "laugh", "smile" ]
        }, {
            title: "fas fa-grip-horizontal",
            searchTerms: [ "affordance", "drag", "drop", "grab", "handle" ]
        }, {
            title: "fas fa-grip-vertical",
            searchTerms: [ "affordance", "drag", "drop", "grab", "handle" ]
        }, {
            title: "fab fa-gripfire",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-grunt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-gulp",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-h-square",
            searchTerms: [ "hospital", "hotel" ]
        }, {
            title: "fab fa-hacker-news",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-hacker-news-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-hackerrank",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hammer",
            searchTerms: [ "admin", "fix", "repair", "settings", "tool" ]
        }, {
            title: "fas fa-hamsa",
            searchTerms: [ "amulet", "christianity", "islam", "jewish", "judaism", "muslim", "protection" ]
        }, {
            title: "fas fa-hand-holding",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hand-holding-heart",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hand-holding-usd",
            searchTerms: [ "$", "dollar sign", "donation", "giving", "money", "price" ]
        }, {
            title: "fas fa-hand-lizard",
            searchTerms: ["mas"]
        }, {
            title: "far fa-hand-lizard",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hand-paper",
            searchTerms: [ "stop" ]
        }, {
            title: "far fa-hand-paper",
            searchTerms: [ "stop" ]
        }, {
            title: "fas fa-hand-peace",
            searchTerms: ["mas"]
        }, {
            title: "far fa-hand-peace",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hand-point-down",
            searchTerms: [ "finger", "hand-o-down", "point" ]
        }, {
            title: "far fa-hand-point-down",
            searchTerms: [ "finger", "hand-o-down", "point" ]
        }, {
            title: "fas fa-hand-point-left",
            searchTerms: [ "back", "finger", "hand-o-left", "left", "point", "previous" ]
        }, {
            title: "far fa-hand-point-left",
            searchTerms: [ "back", "finger", "hand-o-left", "left", "point", "previous" ]
        }, {
            title: "fas fa-hand-point-right",
            searchTerms: [ "finger", "forward", "hand-o-right", "next", "point", "right" ]
        }, {
            title: "far fa-hand-point-right",
            searchTerms: [ "finger", "forward", "hand-o-right", "next", "point", "right" ]
        }, {
            title: "fas fa-hand-point-up",
            searchTerms: [ "finger", "hand-o-up", "point" ]
        }, {
            title: "far fa-hand-point-up",
            searchTerms: [ "finger", "hand-o-up", "point" ]
        }, {
            title: "fas fa-hand-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "far fa-hand-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "fas fa-hand-rock",
            searchTerms: ["mas"]
        }, {
            title: "far fa-hand-rock",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hand-scissors",
            searchTerms: ["mas"]
        }, {
            title: "far fa-hand-scissors",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hand-spock",
            searchTerms: ["mas"]
        }, {
            title: "far fa-hand-spock",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hands",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hands-helping",
            searchTerms: [ "aid", "assistance", "partnership", "volunteering" ]
        }, {
            title: "fas fa-handshake",
            searchTerms: [ "greeting", "partnership" ]
        }, {
            title: "far fa-handshake",
            searchTerms: [ "greeting", "partnership" ]
        }, {
            title: "fas fa-hanukiah",
            searchTerms: [ "candle", "hanukkah", "jewish", "judaism", "light" ]
        }, {
            title: "fas fa-hashtag",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hat-wizard",
            searchTerms: [ "Dungeons & Dragons", "buckle", "cloth", "clothing", "d&d", "dnd", "fantasy", "halloween", "holiday", "mage", "magic", "pointy", "witch" ]
        }, {
            title: "fas fa-haykal",
            searchTerms: [ "bahai", "bahá'í", "star" ]
        }, {
            title: "fas fa-hdd",
            searchTerms: [ "cpu", "hard drive", "harddrive", "machine", "save", "storage" ]
        }, {
            title: "far fa-hdd",
            searchTerms: [ "cpu", "hard drive", "harddrive", "machine", "save", "storage" ]
        }, {
            title: "fas fa-heading",
            searchTerms: [ "header" ]
        }, {
            title: "fas fa-headphones",
            searchTerms: [ "audio", "listen", "music", "sound", "speaker" ]
        }, {
            title: "fas fa-headphones-alt",
            searchTerms: [ "audio", "listen", "music", "sound", "speaker" ]
        }, {
            title: "fas fa-headset",
            searchTerms: [ "audio", "gamer", "gaming", "listen", "live chat", "microphone", "shot caller", "sound", "support", "telemarketer" ]
        }, {
            title: "fas fa-heart",
            searchTerms: [ "favorite", "like", "love" ]
        }, {
            title: "far fa-heart",
            searchTerms: [ "favorite", "like", "love" ]
        }, {
            title: "fas fa-heartbeat",
            searchTerms: [ "ekg", "lifeline", "vital signs" ]
        }, {
            title: "fas fa-helicopter",
            searchTerms: [ "airwolf", "apache", "chopper", "flight", "fly" ]
        }, {
            title: "fas fa-highlighter",
            searchTerms: [ "edit", "marker", "sharpie", "update", "write" ]
        }, {
            title: "fas fa-hiking",
            searchTerms: [ "activity", "backpack", "fall", "fitness", "outdoors", "seasonal", "walking" ]
        }, {
            title: "fas fa-hippo",
            searchTerms: [ "fauna", "hungry", "mammmal" ]
        }, {
            title: "fab fa-hips",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-hire-a-helper",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-history",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hockey-puck",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-home",
            searchTerms: [ "house", "main" ]
        }, {
            title: "fab fa-hooli",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-hornbill",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-horse",
            searchTerms: [ "equus", "fauna", "mammmal", "neigh" ]
        }, {
            title: "fas fa-hospital",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "far fa-hospital",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "fas fa-hospital-alt",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "fas fa-hospital-symbol",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hot-tub",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hotel",
            searchTerms: [ "building", "lodging" ]
        }, {
            title: "fab fa-hotjar",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hourglass",
            searchTerms: ["mas"]
        }, {
            title: "far fa-hourglass",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hourglass-end",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hourglass-half",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hourglass-start",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-house-damage",
            searchTerms: [ "devastation", "home" ]
        }, {
            title: "fab fa-houzz",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-hryvnia",
            searchTerms: [ "money" ]
        }, {
            title: "fab fa-html5",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-hubspot",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-i-cursor",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-id-badge",
            searchTerms: ["mas"]
        }, {
            title: "far fa-id-badge",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-id-card",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "far fa-id-card",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "fas fa-id-card-alt",
            searchTerms: [ "demographics" ]
        }, {
            title: "fas fa-image",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "far fa-image",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "fas fa-images",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "far fa-images",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "fab fa-imdb",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-inbox",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-indent",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-industry",
            searchTerms: [ "factory", "manufacturing" ]
        }, {
            title: "fas fa-infinity",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-info",
            searchTerms: [ "details", "help", "information", "more" ]
        }, {
            title: "fas fa-info-circle",
            searchTerms: [ "details", "help", "information", "more" ]
        }, {
            title: "fab fa-instagram",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-internet-explorer",
            searchTerms: [ "browser", "ie" ]
        }, {
            title: "fab fa-ioxhost",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-italic",
            searchTerms: [ "italics" ]
        }, {
            title: "fab fa-itunes",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-itunes-note",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-java",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-jedi",
            searchTerms: [ "star wars" ]
        }, {
            title: "fab fa-jedi-order",
            searchTerms: [ "star wars" ]
        }, {
            title: "fab fa-jenkins",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-joget",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-joint",
            searchTerms: [ "blunt", "cannabis", "doobie", "drugs", "marijuana", "roach", "smoke", "smoking", "spliff" ]
        }, {
            title: "fab fa-joomla",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-journal-whills",
            searchTerms: [ "book", "jedi", "star wars", "the force" ]
        }, {
            title: "fab fa-js",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-js-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-jsfiddle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-kaaba",
            searchTerms: [ "building", "cube", "islam", "muslim" ]
        }, {
            title: "fab fa-kaggle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-key",
            searchTerms: [ "password", "unlock" ]
        }, {
            title: "fab fa-keybase",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-keyboard",
            searchTerms: [ "input", "type" ]
        }, {
            title: "far fa-keyboard",
            searchTerms: [ "input", "type" ]
        }, {
            title: "fab fa-keycdn",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-khanda",
            searchTerms: [ "chakkar", "sikh", "sikhism", "sword" ]
        }, {
            title: "fab fa-kickstarter",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-kickstarter-k",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-kiss",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "far fa-kiss",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "fas fa-kiss-beam",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "far fa-kiss-beam",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "fas fa-kiss-wink-heart",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "far fa-kiss-wink-heart",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "fas fa-kiwi-bird",
            searchTerms: [ "bird", "fauna" ]
        }, {
            title: "fab fa-korvue",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-landmark",
            searchTerms: [ "building", "historic", "memoroable", "politics" ]
        }, {
            title: "fas fa-language",
            searchTerms: [ "dialect", "idiom", "localize", "speech", "translate", "vernacular" ]
        }, {
            title: "fas fa-laptop",
            searchTerms: [ "computer", "cpu", "dell", "demo", "device", "dude you're getting", "mac", "macbook", "machine", "pc" ]
        }, {
            title: "fas fa-laptop-code",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-laravel",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-lastfm",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-lastfm-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-laugh",
            searchTerms: [ "LOL", "emoticon", "face", "laugh" ]
        }, {
            title: "far fa-laugh",
            searchTerms: [ "LOL", "emoticon", "face", "laugh" ]
        }, {
            title: "fas fa-laugh-beam",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-laugh-beam",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-laugh-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-laugh-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-laugh-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-laugh-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-layer-group",
            searchTerms: [ "layers" ]
        }, {
            title: "fas fa-leaf",
            searchTerms: [ "eco", "flora", "nature", "plant" ]
        }, {
            title: "fab fa-leanpub",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-lemon",
            searchTerms: [ "food" ]
        }, {
            title: "far fa-lemon",
            searchTerms: [ "food" ]
        }, {
            title: "fab fa-less",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-less-than",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-less-than-equal",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-level-down-alt",
            searchTerms: [ "level-down" ]
        }, {
            title: "fas fa-level-up-alt",
            searchTerms: [ "level-up" ]
        }, {
            title: "fas fa-life-ring",
            searchTerms: [ "support" ]
        }, {
            title: "far fa-life-ring",
            searchTerms: [ "support" ]
        }, {
            title: "fas fa-lightbulb",
            searchTerms: [ "idea", "inspiration" ]
        }, {
            title: "far fa-lightbulb",
            searchTerms: [ "idea", "inspiration" ]
        }, {
            title: "fab fa-line",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-link",
            searchTerms: [ "chain" ]
        }, {
            title: "fab fa-linkedin",
            searchTerms: [ "linkedin-square" ]
        }, {
            title: "fab fa-linkedin-in",
            searchTerms: [ "linkedin" ]
        }, {
            title: "fab fa-linode",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-linux",
            searchTerms: [ "tux" ]
        }, {
            title: "fas fa-lira-sign",
            searchTerms: [ "try", "turkish" ]
        }, {
            title: "fas fa-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-list-alt",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "far fa-list-alt",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-list-ol",
            searchTerms: [ "checklist", "list", "numbers", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-list-ul",
            searchTerms: [ "checklist", "list", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-location-arrow",
            searchTerms: [ "address", "coordinates", "gps", "location", "map", "place", "where" ]
        }, {
            title: "fas fa-lock",
            searchTerms: [ "admin", "protect", "security" ]
        }, {
            title: "fas fa-lock-open",
            searchTerms: [ "admin", "lock", "open", "password", "protect" ]
        }, {
            title: "fas fa-long-arrow-alt-down",
            searchTerms: [ "long-arrow-down" ]
        }, {
            title: "fas fa-long-arrow-alt-left",
            searchTerms: [ "back", "long-arrow-left", "previous" ]
        }, {
            title: "fas fa-long-arrow-alt-right",
            searchTerms: [ "long-arrow-right" ]
        }, {
            title: "fas fa-long-arrow-alt-up",
            searchTerms: [ "long-arrow-up" ]
        }, {
            title: "fas fa-low-vision",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-luggage-cart",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-lyft",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-magento",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-magic",
            searchTerms: [ "autocomplete", "automatic", "mage", "magic", "spell", "witch", "wizard" ]
        }, {
            title: "fas fa-magnet",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mail-bulk",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-mailchimp",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-male",
            searchTerms: [ "human", "man", "person", "profile", "user" ]
        }, {
            title: "fab fa-mandalorian",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-map",
            searchTerms: [ "coordinates", "location", "paper", "place", "travel" ]
        }, {
            title: "far fa-map",
            searchTerms: [ "coordinates", "location", "paper", "place", "travel" ]
        }, {
            title: "fas fa-map-marked",
            searchTerms: [ "address", "coordinates", "destination", "gps", "localize", "location", "map", "paper", "pin", "place", "point of interest", "position", "route", "travel", "where" ]
        }, {
            title: "fas fa-map-marked-alt",
            searchTerms: [ "address", "coordinates", "destination", "gps", "localize", "location", "map", "paper", "pin", "place", "point of interest", "position", "route", "travel", "where" ]
        }, {
            title: "fas fa-map-marker",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "pin", "place", "position", "travel", "where" ]
        }, {
            title: "fas fa-map-marker-alt",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "pin", "place", "position", "travel", "where" ]
        }, {
            title: "fas fa-map-pin",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "marker", "place", "position", "travel", "where" ]
        }, {
            title: "fas fa-map-signs",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-markdown",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-marker",
            searchTerms: [ "edit", "sharpie", "update", "write" ]
        }, {
            title: "fas fa-mars",
            searchTerms: [ "male" ]
        }, {
            title: "fas fa-mars-double",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mars-stroke",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mars-stroke-h",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mars-stroke-v",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mask",
            searchTerms: [ "costume", "disguise", "halloween", "holiday", "secret", "super hero" ]
        }, {
            title: "fab fa-mastodon",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-maxcdn",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-medal",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-medapps",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-medium",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-medium-m",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-medkit",
            searchTerms: [ "first aid", "firstaid", "health", "help", "support" ]
        }, {
            title: "fab fa-medrt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-meetup",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-megaport",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-meh",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "far fa-meh",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "fas fa-meh-blank",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "far fa-meh-blank",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "fas fa-meh-rolling-eyes",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "far fa-meh-rolling-eyes",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "fas fa-memory",
            searchTerms: [ "DIMM", "RAM" ]
        }, {
            title: "fas fa-menorah",
            searchTerms: [ "candle", "hanukkah", "jewish", "judaism", "light" ]
        }, {
            title: "fas fa-mercury",
            searchTerms: [ "transgender" ]
        }, {
            title: "fas fa-meteor",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-microchip",
            searchTerms: [ "cpu", "processor" ]
        }, {
            title: "fas fa-microphone",
            searchTerms: [ "record", "sound", "voice" ]
        }, {
            title: "fas fa-microphone-alt",
            searchTerms: [ "record", "sound", "voice" ]
        }, {
            title: "fas fa-microphone-alt-slash",
            searchTerms: [ "disable", "mute", "record", "sound", "voice" ]
        }, {
            title: "fas fa-microphone-slash",
            searchTerms: [ "disable", "mute", "record", "sound", "voice" ]
        }, {
            title: "fas fa-microscope",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-microsoft",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-minus",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "fas fa-minus-circle",
            searchTerms: [ "delete", "hide", "negative", "remove", "trash" ]
        }, {
            title: "fas fa-minus-square",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "far fa-minus-square",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "fab fa-mix",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-mixcloud",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-mizuni",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mobile",
            searchTerms: [ "apple", "call", "cell phone", "cellphone", "device", "iphone", "number", "screen", "telephone", "text" ]
        }, {
            title: "fas fa-mobile-alt",
            searchTerms: [ "apple", "call", "cell phone", "cellphone", "device", "iphone", "number", "screen", "telephone", "text" ]
        }, {
            title: "fab fa-modx",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-monero",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-money-bill",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "fas fa-money-bill-alt",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "far fa-money-bill-alt",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "fas fa-money-bill-wave",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-money-bill-wave-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-money-check",
            searchTerms: [ "bank check", "cheque" ]
        }, {
            title: "fas fa-money-check-alt",
            searchTerms: [ "bank check", "cheque" ]
        }, {
            title: "fas fa-monument",
            searchTerms: [ "building", "historic", "memoroable" ]
        }, {
            title: "fas fa-moon",
            searchTerms: [ "contrast", "crescent", "darker", "lunar", "night" ]
        }, {
            title: "far fa-moon",
            searchTerms: [ "contrast", "crescent", "darker", "lunar", "night" ]
        }, {
            title: "fas fa-mortar-pestle",
            searchTerms: [ "crush", "culinary", "grind", "medical", "mix", "spices" ]
        }, {
            title: "fas fa-mosque",
            searchTerms: [ "building", "islam", "muslim" ]
        }, {
            title: "fas fa-motorcycle",
            searchTerms: [ "bike", "machine", "transportation", "vehicle" ]
        }, {
            title: "fas fa-mountain",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-mouse-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "fas fa-music",
            searchTerms: [ "note", "sound" ]
        }, {
            title: "fab fa-napster",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-neos",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-network-wired",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-neuter",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-newspaper",
            searchTerms: [ "article", "press" ]
        }, {
            title: "far fa-newspaper",
            searchTerms: [ "article", "press" ]
        }, {
            title: "fab fa-nimblr",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-nintendo-switch",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-node",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-node-js",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-not-equal",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-notes-medical",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-npm",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-ns8",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-nutritionix",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-object-group",
            searchTerms: [ "design" ]
        }, {
            title: "far fa-object-group",
            searchTerms: [ "design" ]
        }, {
            title: "fas fa-object-ungroup",
            searchTerms: [ "design" ]
        }, {
            title: "far fa-object-ungroup",
            searchTerms: [ "design" ]
        }, {
            title: "fab fa-odnoklassniki",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-odnoklassniki-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-oil-can",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-old-republic",
            searchTerms: [ "politics", "star wars" ]
        }, {
            title: "fas fa-om",
            searchTerms: [ "buddhism", "hinduism", "jainism", "mantra" ]
        }, {
            title: "fab fa-opencart",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-openid",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-opera",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-optin-monster",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-osi",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-otter",
            searchTerms: [ "fauna", "mammmal" ]
        }, {
            title: "fas fa-outdent",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-page4",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pagelines",
            searchTerms: [ "eco", "flora", "leaf", "leaves", "nature", "plant", "tree" ]
        }, {
            title: "fas fa-paint-brush",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-paint-roller",
            searchTerms: [ "brush", "painting", "tool" ]
        }, {
            title: "fas fa-palette",
            searchTerms: [ "colors", "painting" ]
        }, {
            title: "fab fa-palfed",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-pallet",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-paper-plane",
            searchTerms: ["mas"]
        }, {
            title: "far fa-paper-plane",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-paperclip",
            searchTerms: [ "attachment" ]
        }, {
            title: "fas fa-parachute-box",
            searchTerms: [ "aid", "assistance", "rescue", "supplies" ]
        }, {
            title: "fas fa-paragraph",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-parking",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-passport",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "fas fa-pastafarianism",
            searchTerms: [ "agnosticism", "atheism", "flying spaghetti monster", "fsm" ]
        }, {
            title: "fas fa-paste",
            searchTerms: [ "clipboard", "copy" ]
        }, {
            title: "fab fa-patreon",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-pause",
            searchTerms: [ "wait" ]
        }, {
            title: "fas fa-pause-circle",
            searchTerms: ["mas"]
        }, {
            title: "far fa-pause-circle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-paw",
            searchTerms: [ "animal", "pet" ]
        }, {
            title: "fab fa-paypal",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-peace",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-pen",
            searchTerms: [ "design", "edit", "update", "write" ]
        }, {
            title: "fas fa-pen-alt",
            searchTerms: [ "design", "edit", "update", "write" ]
        }, {
            title: "fas fa-pen-fancy",
            searchTerms: [ "design", "edit", "fountain pen", "update", "write" ]
        }, {
            title: "fas fa-pen-nib",
            searchTerms: [ "design", "edit", "fountain pen", "update", "write" ]
        }, {
            title: "fas fa-pen-square",
            searchTerms: [ "edit", "pencil-square", "update", "write" ]
        }, {
            title: "fas fa-pencil-alt",
            searchTerms: [ "design", "edit", "pencil", "update", "write" ]
        }, {
            title: "fas fa-pencil-ruler",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-penny-arcade",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "pax", "tabletop" ]
        }, {
            title: "fas fa-people-carry",
            searchTerms: [ "movers" ]
        }, {
            title: "fas fa-percent",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-percentage",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-periscope",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-person-booth",
            searchTerms: [ "changing", "changing room", "election", "human", "person", "vote", "voting" ]
        }, {
            title: "fab fa-phabricator",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-phoenix-framework",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-phoenix-squadron",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-phone",
            searchTerms: [ "call", "earphone", "number", "support", "telephone", "voice" ]
        }, {
            title: "fas fa-phone-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-phone-square",
            searchTerms: [ "call", "number", "support", "telephone", "voice" ]
        }, {
            title: "fas fa-phone-volume",
            searchTerms: [ "telephone", "volume-control-phone" ]
        }, {
            title: "fab fa-php",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pied-piper",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pied-piper-alt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pied-piper-hat",
            searchTerms: [ "clothing" ]
        }, {
            title: "fab fa-pied-piper-pp",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-piggy-bank",
            searchTerms: [ "save", "savings" ]
        }, {
            title: "fas fa-pills",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "fab fa-pinterest",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pinterest-p",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pinterest-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-place-of-worship",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-plane",
            searchTerms: [ "airplane", "destination", "fly", "location", "mode", "travel", "trip" ]
        }, {
            title: "fas fa-plane-arrival",
            searchTerms: [ "airplane", "arriving", "destination", "fly", "land", "landing", "location", "mode", "travel", "trip" ]
        }, {
            title: "fas fa-plane-departure",
            searchTerms: [ "airplane", "departing", "destination", "fly", "location", "mode", "take off", "taking off", "travel", "trip" ]
        }, {
            title: "fas fa-play",
            searchTerms: [ "music", "playing", "sound", "start" ]
        }, {
            title: "fas fa-play-circle",
            searchTerms: [ "playing", "start" ]
        }, {
            title: "far fa-play-circle",
            searchTerms: [ "playing", "start" ]
        }, {
            title: "fab fa-playstation",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-plug",
            searchTerms: [ "connect", "online", "power" ]
        }, {
            title: "fas fa-plus",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "fas fa-plus-circle",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "fas fa-plus-square",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "far fa-plus-square",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "fas fa-podcast",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-poll",
            searchTerms: [ "results", "survey", "vote", "voting" ]
        }, {
            title: "fas fa-poll-h",
            searchTerms: [ "results", "survey", "vote", "voting" ]
        }, {
            title: "fas fa-poo",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-poo-storm",
            searchTerms: [ "mess", "poop", "shit" ]
        }, {
            title: "fas fa-poop",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-portrait",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-pound-sign",
            searchTerms: [ "gbp" ]
        }, {
            title: "fas fa-power-off",
            searchTerms: [ "on", "reboot", "restart" ]
        }, {
            title: "fas fa-pray",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-praying-hands",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-prescription",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-prescription-bottle",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-prescription-bottle-alt",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-print",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-procedures",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-product-hunt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-project-diagram",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-pushed",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-puzzle-piece",
            searchTerms: [ "add-on", "addon", "section" ]
        }, {
            title: "fab fa-python",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-qq",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-qrcode",
            searchTerms: [ "scan" ]
        }, {
            title: "fas fa-question",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "fas fa-question-circle",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "far fa-question-circle",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "fas fa-quidditch",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-quinscape",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-quora",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-quote-left",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-quote-right",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-quran",
            searchTerms: [ "book", "islam", "muslim" ]
        }, {
            title: "fab fa-r-project",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-rainbow",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-random",
            searchTerms: [ "shuffle", "sort" ]
        }, {
            title: "fab fa-ravelry",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-react",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-reacteurope",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-readme",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-rebel",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-receipt",
            searchTerms: [ "check", "invoice", "table" ]
        }, {
            title: "fas fa-recycle",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-red-river",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-reddit",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-reddit-alien",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-reddit-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-redo",
            searchTerms: [ "forward", "refresh", "reload", "repeat" ]
        }, {
            title: "fas fa-redo-alt",
            searchTerms: [ "forward", "refresh", "reload", "repeat" ]
        }, {
            title: "fas fa-registered",
            searchTerms: ["mas"]
        }, {
            title: "far fa-registered",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-renren",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-reply",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-reply-all",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-replyd",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-republican",
            searchTerms: [ "american", "conservative", "election", "elephant", "politics", "republican party", "right", "right-wing", "usa" ]
        }, {
            title: "fab fa-researchgate",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-resolving",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-retweet",
            searchTerms: [ "refresh", "reload", "share", "swap" ]
        }, {
            title: "fab fa-rev",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ribbon",
            searchTerms: [ "badge", "cause", "lapel", "pin" ]
        }, {
            title: "fas fa-ring",
            searchTerms: [ "Dungeons & Dragons", "Gollum", "band", "binding", "d&d", "dnd", "fantasy", "jewelry", "precious" ]
        }, {
            title: "fas fa-road",
            searchTerms: [ "street" ]
        }, {
            title: "fas fa-robot",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-rocket",
            searchTerms: [ "app" ]
        }, {
            title: "fab fa-rocketchat",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-rockrms",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-route",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-rss",
            searchTerms: [ "blog" ]
        }, {
            title: "fas fa-rss-square",
            searchTerms: [ "blog", "feed" ]
        }, {
            title: "fas fa-ruble-sign",
            searchTerms: [ "rub" ]
        }, {
            title: "fas fa-ruler",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ruler-combined",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ruler-horizontal",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-ruler-vertical",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-running",
            searchTerms: [ "jog", "sprint" ]
        }, {
            title: "fas fa-rupee-sign",
            searchTerms: [ "indian", "inr" ]
        }, {
            title: "fas fa-sad-cry",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "far fa-sad-cry",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "fas fa-sad-tear",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "far fa-sad-tear",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "fab fa-safari",
            searchTerms: [ "browser" ]
        }, {
            title: "fab fa-sass",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-save",
            searchTerms: [ "floppy", "floppy-o" ]
        }, {
            title: "far fa-save",
            searchTerms: [ "floppy", "floppy-o" ]
        }, {
            title: "fab fa-schlix",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-school",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-screwdriver",
            searchTerms: [ "admin", "fix", "repair", "settings", "tool" ]
        }, {
            title: "fab fa-scribd",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-scroll",
            searchTerms: [ "Dungeons & Dragons", "announcement", "d&d", "dnd", "fantasy", "paper" ]
        }, {
            title: "fas fa-search",
            searchTerms: [ "bigger", "enlarge", "magnify", "preview", "zoom" ]
        }, {
            title: "fas fa-search-dollar",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-search-location",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-search-minus",
            searchTerms: [ "minify", "negative", "smaller", "zoom", "zoom out" ]
        }, {
            title: "fas fa-search-plus",
            searchTerms: [ "bigger", "enlarge", "magnify", "positive", "zoom", "zoom in" ]
        }, {
            title: "fab fa-searchengin",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-seedling",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-sellcast",
            searchTerms: [ "eercast" ]
        }, {
            title: "fab fa-sellsy",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-server",
            searchTerms: [ "cpu" ]
        }, {
            title: "fab fa-servicestack",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-shapes",
            searchTerms: [ "circle", "square", "triangle" ]
        }, {
            title: "fas fa-share",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-share-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-share-alt-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-share-square",
            searchTerms: [ "send", "social" ]
        }, {
            title: "far fa-share-square",
            searchTerms: [ "send", "social" ]
        }, {
            title: "fas fa-shekel-sign",
            searchTerms: [ "ils" ]
        }, {
            title: "fas fa-shield-alt",
            searchTerms: [ "achievement", "award", "block", "defend", "security", "winner" ]
        }, {
            title: "fas fa-ship",
            searchTerms: [ "boat", "sea" ]
        }, {
            title: "fas fa-shipping-fast",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-shirtsinbulk",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-shoe-prints",
            searchTerms: [ "feet", "footprints", "steps" ]
        }, {
            title: "fas fa-shopping-bag",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-shopping-basket",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-shopping-cart",
            searchTerms: [ "buy", "checkout", "payment", "purchase" ]
        }, {
            title: "fab fa-shopware",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-shower",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-shuttle-van",
            searchTerms: [ "machine", "public-transportation", "transportation", "vehicle" ]
        }, {
            title: "fas fa-sign",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-sign-in-alt",
            searchTerms: [ "arrow", "enter", "join", "log in", "login", "sign in", "sign up", "sign-in", "signin", "signup" ]
        }, {
            title: "fas fa-sign-language",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-sign-out-alt",
            searchTerms: [ "arrow", "exit", "leave", "log out", "logout", "sign-out" ]
        }, {
            title: "fas fa-signal",
            searchTerms: [ "bars", "graph", "online", "status" ]
        }, {
            title: "fas fa-signature",
            searchTerms: [ "John Hancock", "cursive", "name", "writing" ]
        }, {
            title: "fab fa-simplybuilt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-sistrix",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-sitemap",
            searchTerms: [ "directory", "hierarchy", "ia", "information architecture", "organization" ]
        }, {
            title: "fab fa-sith",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-skull",
            searchTerms: [ "bones", "skeleton", "yorick" ]
        }, {
            title: "fas fa-skull-crossbones",
            searchTerms: [ "Dungeons & Dragons", "alert", "bones", "d&d", "danger", "dead", "deadly", "death", "dnd", "fantasy", "halloween", "holiday", "jolly-roger", "pirate", "poison", "skeleton", "warning" ]
        }, {
            title: "fab fa-skyatlas",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-skype",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-slack",
            searchTerms: [ "anchor", "hash", "hashtag" ]
        }, {
            title: "fab fa-slack-hash",
            searchTerms: [ "anchor", "hash", "hashtag" ]
        }, {
            title: "fas fa-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-sliders-h",
            searchTerms: [ "settings", "sliders" ]
        }, {
            title: "fab fa-slideshare",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-smile",
            searchTerms: [ "approve", "emoticon", "face", "happy", "rating", "satisfied" ]
        }, {
            title: "far fa-smile",
            searchTerms: [ "approve", "emoticon", "face", "happy", "rating", "satisfied" ]
        }, {
            title: "fas fa-smile-beam",
            searchTerms: [ "emoticon", "face", "happy", "positive" ]
        }, {
            title: "far fa-smile-beam",
            searchTerms: [ "emoticon", "face", "happy", "positive" ]
        }, {
            title: "fas fa-smile-wink",
            searchTerms: [ "emoticon", "face", "happy" ]
        }, {
            title: "far fa-smile-wink",
            searchTerms: [ "emoticon", "face", "happy" ]
        }, {
            title: "fas fa-smog",
            searchTerms: [ "dragon" ]
        }, {
            title: "fas fa-smoking",
            searchTerms: [ "cigarette", "nicotine", "smoking status" ]
        }, {
            title: "fas fa-smoking-ban",
            searchTerms: [ "no smoking", "non-smoking" ]
        }, {
            title: "fab fa-snapchat",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-snapchat-ghost",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-snapchat-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-snowflake",
            searchTerms: [ "precipitation", "seasonal", "winter" ]
        }, {
            title: "far fa-snowflake",
            searchTerms: [ "precipitation", "seasonal", "winter" ]
        }, {
            title: "fas fa-socks",
            searchTerms: [ "business socks", "business time", "flight of the conchords", "wednesday" ]
        }, {
            title: "fas fa-solar-panel",
            searchTerms: [ "clean", "eco-friendly", "energy", "green", "sun" ]
        }, {
            title: "fas fa-sort",
            searchTerms: [ "order" ]
        }, {
            title: "fas fa-sort-alpha-down",
            searchTerms: [ "sort-alpha-asc" ]
        }, {
            title: "fas fa-sort-alpha-up",
            searchTerms: [ "sort-alpha-desc" ]
        }, {
            title: "fas fa-sort-amount-down",
            searchTerms: [ "sort-amount-asc" ]
        }, {
            title: "fas fa-sort-amount-up",
            searchTerms: [ "sort-amount-desc" ]
        }, {
            title: "fas fa-sort-down",
            searchTerms: [ "arrow", "descending", "sort-desc" ]
        }, {
            title: "fas fa-sort-numeric-down",
            searchTerms: [ "numbers", "sort-numeric-asc" ]
        }, {
            title: "fas fa-sort-numeric-up",
            searchTerms: [ "numbers", "sort-numeric-desc" ]
        }, {
            title: "fas fa-sort-up",
            searchTerms: [ "arrow", "ascending", "sort-asc" ]
        }, {
            title: "fab fa-soundcloud",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-spa",
            searchTerms: [ "flora", "mindfullness", "plant", "wellness" ]
        }, {
            title: "fas fa-space-shuttle",
            searchTerms: [ "astronaut", "machine", "nasa", "rocket", "transportation" ]
        }, {
            title: "fab fa-speakap",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-spider",
            searchTerms: [ "arachnid", "bug", "charlotte", "crawl", "eight", "halloween", "holiday" ]
        }, {
            title: "fas fa-spinner",
            searchTerms: [ "loading", "progress" ]
        }, {
            title: "fas fa-splotch",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-spotify",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-spray-can",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-square",
            searchTerms: [ "block", "box" ]
        }, {
            title: "far fa-square",
            searchTerms: [ "block", "box" ]
        }, {
            title: "fas fa-square-full",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-square-root-alt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-squarespace",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-stack-exchange",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-stack-overflow",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-stamp",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-star",
            searchTerms: [ "achievement", "award", "favorite", "important", "night", "rating", "score" ]
        }, {
            title: "far fa-star",
            searchTerms: [ "achievement", "award", "favorite", "important", "night", "rating", "score" ]
        }, {
            title: "fas fa-star-and-crescent",
            searchTerms: [ "islam", "muslim" ]
        }, {
            title: "fas fa-star-half",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "far fa-star-half",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "fas fa-star-half-alt",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "fas fa-star-of-david",
            searchTerms: [ "jewish", "judaism" ]
        }, {
            title: "fas fa-star-of-life",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-staylinked",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-steam",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-steam-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-steam-symbol",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-step-backward",
            searchTerms: [ "beginning", "first", "previous", "rewind", "start" ]
        }, {
            title: "fas fa-step-forward",
            searchTerms: [ "end", "last", "next" ]
        }, {
            title: "fas fa-stethoscope",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-sticker-mule",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-sticky-note",
            searchTerms: ["mas"]
        }, {
            title: "far fa-sticky-note",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-stop",
            searchTerms: [ "block", "box", "square" ]
        }, {
            title: "fas fa-stop-circle",
            searchTerms: ["mas"]
        }, {
            title: "far fa-stop-circle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-stopwatch",
            searchTerms: [ "time" ]
        }, {
            title: "fas fa-store",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-store-alt",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-strava",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-stream",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-street-view",
            searchTerms: [ "map" ]
        }, {
            title: "fas fa-strikethrough",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-stripe",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-stripe-s",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-stroopwafel",
            searchTerms: [ "dessert", "food", "sweets", "waffle" ]
        }, {
            title: "fab fa-studiovinari",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-stumbleupon",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-stumbleupon-circle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-subscript",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-subway",
            searchTerms: [ "machine", "railway", "train", "transportation", "vehicle" ]
        }, {
            title: "fas fa-suitcase",
            searchTerms: [ "baggage", "luggage", "move", "suitcase", "travel", "trip" ]
        }, {
            title: "fas fa-suitcase-rolling",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-sun",
            searchTerms: [ "brighten", "contrast", "day", "lighter", "sol", "solar", "star", "weather" ]
        }, {
            title: "far fa-sun",
            searchTerms: [ "brighten", "contrast", "day", "lighter", "sol", "solar", "star", "weather" ]
        }, {
            title: "fab fa-superpowers",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-superscript",
            searchTerms: [ "exponential" ]
        }, {
            title: "fab fa-supple",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-surprise",
            searchTerms: [ "emoticon", "face", "shocked" ]
        }, {
            title: "far fa-surprise",
            searchTerms: [ "emoticon", "face", "shocked" ]
        }, {
            title: "fas fa-swatchbook",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-swimmer",
            searchTerms: [ "athlete", "head", "man", "person", "water" ]
        }, {
            title: "fas fa-swimming-pool",
            searchTerms: [ "ladder", "recreation", "water" ]
        }, {
            title: "fas fa-synagogue",
            searchTerms: [ "building", "jewish", "judaism", "star of david", "temple" ]
        }, {
            title: "fas fa-sync",
            searchTerms: [ "exchange", "refresh", "reload", "rotate", "swap" ]
        }, {
            title: "fas fa-sync-alt",
            searchTerms: [ "refresh", "reload", "rotate" ]
        }, {
            title: "fas fa-syringe",
            searchTerms: [ "immunizations", "needle" ]
        }, {
            title: "fas fa-table",
            searchTerms: [ "data", "excel", "spreadsheet" ]
        }, {
            title: "fas fa-table-tennis",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-tablet",
            searchTerms: [ "apple", "device", "ipad", "kindle", "screen" ]
        }, {
            title: "fas fa-tablet-alt",
            searchTerms: [ "apple", "device", "ipad", "kindle", "screen" ]
        }, {
            title: "fas fa-tablets",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "fas fa-tachometer-alt",
            searchTerms: [ "dashboard", "tachometer" ]
        }, {
            title: "fas fa-tag",
            searchTerms: [ "label" ]
        }, {
            title: "fas fa-tags",
            searchTerms: [ "labels" ]
        }, {
            title: "fas fa-tape",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-tasks",
            searchTerms: [ "downloading", "downloads", "loading", "progress", "settings" ]
        }, {
            title: "fas fa-taxi",
            searchTerms: [ "cab", "cabbie", "car", "car service", "lyft", "machine", "transportation", "uber", "vehicle" ]
        }, {
            title: "fab fa-teamspeak",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-teeth",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-teeth-open",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-telegram",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-telegram-plane",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-temperature-high",
            searchTerms: [ "mercury", "thermometer", "warm" ]
        }, {
            title: "fas fa-temperature-low",
            searchTerms: [ "cool", "mercury", "thermometer" ]
        }, {
            title: "fab fa-tencent-weibo",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-terminal",
            searchTerms: [ "code", "command", "console", "prompt" ]
        }, {
            title: "fas fa-text-height",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-text-width",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-th",
            searchTerms: [ "blocks", "boxes", "grid", "squares" ]
        }, {
            title: "fas fa-th-large",
            searchTerms: [ "blocks", "boxes", "grid", "squares" ]
        }, {
            title: "fas fa-th-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "fab fa-the-red-yeti",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-theater-masks",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-themeco",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-themeisle",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-thermometer",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-empty",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-full",
            searchTerms: [ "fever", "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-half",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-quarter",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-three-quarters",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fab fa-think-peaks",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-thumbs-down",
            searchTerms: [ "disagree", "disapprove", "dislike", "hand", "thumbs-o-down" ]
        }, {
            title: "far fa-thumbs-down",
            searchTerms: [ "disagree", "disapprove", "dislike", "hand", "thumbs-o-down" ]
        }, {
            title: "fas fa-thumbs-up",
            searchTerms: [ "agree", "approve", "favorite", "hand", "like", "ok", "okay", "success", "thumbs-o-up", "yes", "you got it dude" ]
        }, {
            title: "far fa-thumbs-up",
            searchTerms: [ "agree", "approve", "favorite", "hand", "like", "ok", "okay", "success", "thumbs-o-up", "yes", "you got it dude" ]
        }, {
            title: "fas fa-thumbtack",
            searchTerms: [ "coordinates", "location", "marker", "pin", "thumb-tack" ]
        }, {
            title: "fas fa-ticket-alt",
            searchTerms: [ "ticket" ]
        }, {
            title: "fas fa-times",
            searchTerms: [ "close", "cross", "error", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "fas fa-times-circle",
            searchTerms: [ "close", "cross", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "far fa-times-circle",
            searchTerms: [ "close", "cross", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "fas fa-tint",
            searchTerms: [ "drop", "droplet", "raindrop", "waterdrop" ]
        }, {
            title: "fas fa-tint-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-tired",
            searchTerms: [ "emoticon", "face", "grumpy" ]
        }, {
            title: "far fa-tired",
            searchTerms: [ "emoticon", "face", "grumpy" ]
        }, {
            title: "fas fa-toggle-off",
            searchTerms: [ "switch" ]
        }, {
            title: "fas fa-toggle-on",
            searchTerms: [ "switch" ]
        }, {
            title: "fas fa-toilet-paper",
            searchTerms: [ "bathroom", "halloween", "holiday", "lavatory", "prank", "restroom", "roll" ]
        }, {
            title: "fas fa-toolbox",
            searchTerms: [ "admin", "container", "fix", "repair", "settings", "tools" ]
        }, {
            title: "fas fa-tooth",
            searchTerms: [ "bicuspid", "dental", "molar", "mouth", "teeth" ]
        }, {
            title: "fas fa-torah",
            searchTerms: [ "book", "jewish", "judaism" ]
        }, {
            title: "fas fa-torii-gate",
            searchTerms: [ "building", "shintoism" ]
        }, {
            title: "fas fa-tractor",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-trade-federation",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-trademark",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-traffic-light",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-train",
            searchTerms: [ "bullet", "locomotive", "railway" ]
        }, {
            title: "fas fa-transgender",
            searchTerms: [ "intersex" ]
        }, {
            title: "fas fa-transgender-alt",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-trash",
            searchTerms: [ "delete", "garbage", "hide", "remove" ]
        }, {
            title: "fas fa-trash-alt",
            searchTerms: [ "delete", "garbage", "hide", "remove", "trash", "trash-o" ]
        }, {
            title: "far fa-trash-alt",
            searchTerms: [ "delete", "garbage", "hide", "remove", "trash", "trash-o" ]
        }, {
            title: "fas fa-tree",
            searchTerms: [ "bark", "fall", "flora", "forest", "nature", "plant", "seasonal" ]
        }, {
            title: "fab fa-trello",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-tripadvisor",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-trophy",
            searchTerms: [ "achievement", "award", "cup", "game", "winner" ]
        }, {
            title: "fas fa-truck",
            searchTerms: [ "delivery", "shipping" ]
        }, {
            title: "fas fa-truck-loading",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-truck-monster",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-truck-moving",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-truck-pickup",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-tshirt",
            searchTerms: [ "cloth", "clothing" ]
        }, {
            title: "fas fa-tty",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-tumblr",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-tumblr-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-tv",
            searchTerms: [ "computer", "display", "monitor", "television" ]
        }, {
            title: "fab fa-twitch",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-twitter",
            searchTerms: [ "social network", "tweet" ]
        }, {
            title: "fab fa-twitter-square",
            searchTerms: [ "social network", "tweet" ]
        }, {
            title: "fab fa-typo3",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-uber",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-uikit",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-umbrella",
            searchTerms: [ "protection", "rain" ]
        }, {
            title: "fas fa-umbrella-beach",
            searchTerms: [ "protection", "recreation", "sun" ]
        }, {
            title: "fas fa-underline",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-undo",
            searchTerms: [ "back", "control z", "exchange", "oops", "return", "rotate", "swap" ]
        }, {
            title: "fas fa-undo-alt",
            searchTerms: [ "back", "control z", "exchange", "oops", "return", "swap" ]
        }, {
            title: "fab fa-uniregistry",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-universal-access",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-university",
            searchTerms: [ "bank", "institution" ]
        }, {
            title: "fas fa-unlink",
            searchTerms: [ "chain", "chain-broken", "remove" ]
        }, {
            title: "fas fa-unlock",
            searchTerms: [ "admin", "lock", "password", "protect" ]
        }, {
            title: "fas fa-unlock-alt",
            searchTerms: [ "admin", "lock", "password", "protect" ]
        }, {
            title: "fab fa-untappd",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-upload",
            searchTerms: [ "export", "publish" ]
        }, {
            title: "fab fa-usb",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "far fa-user",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "fas fa-user-alt",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "fas fa-user-alt-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-astronaut",
            searchTerms: [ "avatar", "clothing", "cosmonaut", "space", "suit" ]
        }, {
            title: "fas fa-user-check",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-circle",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "far fa-user-circle",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "fas fa-user-clock",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-cog",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-edit",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-friends",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-graduate",
            searchTerms: [ "cap", "clothing", "commencement", "gown", "graduation", "student" ]
        }, {
            title: "fas fa-user-injured",
            searchTerms: [ "cast", "ouch", "sling" ]
        }, {
            title: "fas fa-user-lock",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-md",
            searchTerms: [ "doctor", "job", "medical", "nurse", "occupation", "profile" ]
        }, {
            title: "fas fa-user-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "fas fa-user-ninja",
            searchTerms: [ "assassin", "avatar", "dangerous", "deadly", "sneaky" ]
        }, {
            title: "fas fa-user-plus",
            searchTerms: [ "positive", "sign up", "signup" ]
        }, {
            title: "fas fa-user-secret",
            searchTerms: [ "clothing", "coat", "hat", "incognito", "privacy", "spy", "whisper" ]
        }, {
            title: "fas fa-user-shield",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-slash",
            searchTerms: [ "ban", "remove" ]
        }, {
            title: "fas fa-user-tag",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-user-tie",
            searchTerms: [ "avatar", "business", "clothing", "formal" ]
        }, {
            title: "fas fa-user-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "fas fa-users",
            searchTerms: [ "people", "persons", "profiles" ]
        }, {
            title: "fas fa-users-cog",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-ussunnah",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-utensil-spoon",
            searchTerms: [ "spoon" ]
        }, {
            title: "fas fa-utensils",
            searchTerms: [ "cutlery", "dinner", "eat", "food", "knife", "restaurant", "spoon" ]
        }, {
            title: "fab fa-vaadin",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-vector-square",
            searchTerms: [ "anchors", "lines", "object" ]
        }, {
            title: "fas fa-venus",
            searchTerms: [ "female" ]
        }, {
            title: "fas fa-venus-double",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-venus-mars",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-viacoin",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-viadeo",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-viadeo-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-vial",
            searchTerms: [ "test tube" ]
        }, {
            title: "fas fa-vials",
            searchTerms: [ "lab results", "test tubes" ]
        }, {
            title: "fab fa-viber",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-video",
            searchTerms: [ "camera", "film", "movie", "record", "video-camera" ]
        }, {
            title: "fas fa-video-slash",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-vihara",
            searchTerms: [ "buddhism", "buddhist", "building", "monastery" ]
        }, {
            title: "fab fa-vimeo",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-vimeo-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-vimeo-v",
            searchTerms: [ "vimeo" ]
        }, {
            title: "fab fa-vine",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-vk",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-vnv",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-volleyball-ball",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-volume-down",
            searchTerms: [ "audio", "lower", "music", "quieter", "sound", "speaker" ]
        }, {
            title: "fas fa-volume-mute",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-volume-off",
            searchTerms: [ "audio", "music", "mute", "sound" ]
        }, {
            title: "fas fa-volume-up",
            searchTerms: [ "audio", "higher", "louder", "music", "sound", "speaker" ]
        }, {
            title: "fas fa-vote-yea",
            searchTerms: [ "accept", "cast", "election", "politics", "positive", "yes" ]
        }, {
            title: "fas fa-vr-cardboard",
            searchTerms: [ "google", "reality", "virtual" ]
        }, {
            title: "fab fa-vuejs",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-walking",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-wallet",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-warehouse",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-water",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-weebly",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-weibo",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-weight",
            searchTerms: [ "measurement", "scale", "weight" ]
        }, {
            title: "fas fa-weight-hanging",
            searchTerms: [ "anvil", "heavy", "measurement" ]
        }, {
            title: "fab fa-weixin",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-whatsapp",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-whatsapp-square",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-wheelchair",
            searchTerms: [ "handicap", "person" ]
        }, {
            title: "fab fa-whmcs",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-wifi",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wikipedia-w",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-wind",
            searchTerms: [ "air", "blow", "breeze", "fall", "seasonal" ]
        }, {
            title: "fas fa-window-close",
            searchTerms: ["mas"]
        }, {
            title: "far fa-window-close",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-window-maximize",
            searchTerms: ["mas"]
        }, {
            title: "far fa-window-maximize",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-window-minimize",
            searchTerms: ["mas"]
        }, {
            title: "far fa-window-minimize",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-window-restore",
            searchTerms: ["mas"]
        }, {
            title: "far fa-window-restore",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-windows",
            searchTerms: [ "microsoft" ]
        }, {
            title: "fas fa-wine-bottle",
            searchTerms: [ "alcohol", "beverage", "drink", "glass", "grapes" ]
        }, {
            title: "fas fa-wine-glass",
            searchTerms: [ "alcohol", "beverage", "drink", "grapes" ]
        }, {
            title: "fas fa-wine-glass-alt",
            searchTerms: [ "alcohol", "beverage", "drink", "grapes" ]
        }, {
            title: "fab fa-wix",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wizards-of-the-coast",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fab fa-wolf-pack-battalion",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-won-sign",
            searchTerms: [ "krw" ]
        }, {
            title: "fab fa-wordpress",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wordpress-simple",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wpbeginner",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wpexplorer",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wpforms",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-wpressr",
            searchTerms: [ "rendact" ]
        }, {
            title: "fas fa-wrench",
            searchTerms: [ "fix", "settings", "spanner", "tool", "update" ]
        }, {
            title: "fas fa-x-ray",
            searchTerms: [ "radiological images", "radiology" ]
        }, {
            title: "fab fa-xbox",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-xing",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-xing-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-y-combinator",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-yahoo",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-yandex",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-yandex-international",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-yelp",
            searchTerms: ["mas"]
        }, {
            title: "fas fa-yen-sign",
            searchTerms: [ "jpy", "money" ]
        }, {
            title: "fas fa-yin-yang",
            searchTerms: [ "daoism", "opposites", "taoism" ]
        }, {
            title: "fab fa-yoast",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-youtube",
            searchTerms: [ "film", "video", "youtube-play", "youtube-square" ]
        }, {
            title: "fab fa-youtube-square",
            searchTerms: ["mas"]
        }, {
            title: "fab fa-zhihu",
            searchTerms: ["mas"]
        } ]
    });
});
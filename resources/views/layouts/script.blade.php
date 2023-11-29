<!--   Core JS Files   -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script src="/assets/js/plugins/datatables.js"></script>
<script src="/assets/js/jquery.mask.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
{{-- perfect scrollbar --}}
<script>
(this, function () {
    "use strict";
    var u = Math.abs,
        v = Math.floor;
    function t(a, b) {
        function c(b) {
            b.touches && b.touches[0] && (b[k] = b.touches[0].pageY), (s[o] = t + v * (b[k] - u)), g(a, p), q(a), b.stopPropagation(), b.preventDefault();
        }
        function d() {
            h(a, p), a[r].classList.remove(z.state.clicking), a.event.unbind(a.ownerDocument, "mousemove", c);
        }
        function f(b, e) {
            (t = s[o]),
                e && b.touches && (b[k] = b.touches[0].pageY),
                    (u = b[k]),
                    (v = (a[j] - a[i]) / (a[l] - a[n])),
                    e ? a.event.bind(a.ownerDocument, "touchmove", c) : (a.event.bind(a.ownerDocument, "mousemove",
                        c), a.event.once(a.ownerDocument, "mouseup", d), b.preventDefault()),
                    a[r].classList.add(z.state.clicking),
                    b.stopPropagation();
            }
            var i = b[0],
                j = b[1],
                k = b[2],
                l = b[3],
                m = b[4],
                n = b[5],
                o = b[6],
                p = b[7],
                r = b[8],
                s = a.element,
                t = null,
                u = null,
                v = null;
            a.event.bind(a[m], "mousedown", function(a) {
                    f(a);
                }),
                a.event.bind(a[m], "touchstart", function(a) {
                    f(a, !0);
                });
        }
        var w = "undefined" != typeof Element && (Element.prototype.matches || Element.prototype
                .webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype
                .msMatchesSelector),
            z = {
                main: "ps",
                rtl: "ps__rtl",
                element: {
                    thumb: function(a) {
                        return "ps__thumb-" + a;
                    },
                    rail: function(a) {
                        return "ps__rail-" + a;
                    },
                    consuming: "ps__child--consume",
                },
                state: {
                    focus: "ps--focus",
                    clicking: "ps--clicking",
                    active: function(a) {
                        return "ps--active-" + a;
                    },
                    scrolling: function(a) {
                        return "ps--scrolling-" + a;
                    },
                },
            },
            A = {
                x: null,
                y: null
            },
            B = function(a) {
                (this.element = a), (this.handlers = {});
            },
            C = {
                isEmpty: {
                    configurable: !0
                }
            };
        (B.prototype.bind = function(a, b) {
            "undefined" == typeof this.handlers[a] && (this.handlers[a] = []), this.handlers[a].push(b), this
                .element.addEventListener(a, b, !1);
        }),
        (B.prototype.unbind = function(a, b) {
            var c = this;
            this.handlers[a] = this.handlers[a].filter(function(d) {
                return !!(b && d !== b) || (c.element.removeEventListener(a, d, !1), !1);
            });
        }),
        (B.prototype.unbindAll = function() {
            for (var a in this.handlers) this.unbind(a);
        }),
        (C.isEmpty.get = function() {
            var a = this;
            return Object.keys(this.handlers).every(function(b) {
                return 0 === a.handlers[b].length;
            });
        }),
        Object.defineProperties(B.prototype, C);
        var D = function() {
            this.eventElements = [];
        };
        (D.prototype.eventElement = function(a) {
            var b = this.eventElements.filter(function(b) {
                return b.element === a;
            })[0];
            return b || ((b = new B(a)), this.eventElements.push(b)), b;
        }),
        (D.prototype.bind = function(a, b, c) {
            this.eventElement(a).bind(b, c);
        }),
        (D.prototype.unbind = function(a, b, c) {
            var d = this.eventElement(a);
            d.unbind(b, c), d.isEmpty && this.eventElements.splice(this.eventElements.indexOf(d), 1);
        }),
        (D.prototype.unbindAll = function() {
            this.eventElements.forEach(function(a) {
                    return a.unbindAll();
                }),
                (this.eventElements = []);
        }),
        (D.prototype.once = function(a, b, c) {
            var d = this.eventElement(a),
                e = function(a) {
                    d.unbind(b, e), c(a);
                };
            d.bind(b, e);
        });
        var E = {
                isWebKit: "undefined" != typeof document && "WebkitAppearance" in document.documentElement.style,
                supportsTouch: "undefined" != typeof window && ("ontouchstart" in window || ("maxTouchPoints" in
                    window.navigator && 0 < window.navigator.maxTouchPoints) || (window.DocumentTouch &&
                    document instanceof window.DocumentTouch)),
                supportsIePointer: "undefined" != typeof navigator && navigator.msMaxTouchPoints,
                isChrome: "undefined" != typeof navigator && /Chrome/i.test(navigator && navigator.userAgent),
            },
            F = function() {
                return {
                    handlers: ["click-rail", "drag-thumb", "keyboard", "wheel", "touch"],
                    maxScrollbarLength: null,
                    minScrollbarLength: null,
                    scrollingThreshold: 1e3,
                    scrollXMarginOffset: 0,
                    scrollYMarginOffset: 0,
                    suppressScrollX: !1,
                    suppressScrollY: !1,
                    swipeEasing: !0,
                    useBothWheelAxes: !1,
                    wheelPropagation: !0,
                    wheelSpeed: 1,
                };
            },
            G = {
                "click-rail": function(a) {
                    a.element;
                    a.event.bind(a.scrollbarY, "mousedown", function(a) {
                            return a.stopPropagation();
                        }),
                        a.event.bind(a.scrollbarYRail, "mousedown", function(b) {
                            var c = b.pageY - window.pageYOffset - a.scrollbarYRail.getBoundingClientRect()
                                .top,
                                d = c > a.scrollbarYTop ? 1 : -1;
                            (a.element.scrollTop += d * a.containerHeight), q(a), b.stopPropagation();
                        }),
                        a.event.bind(a.scrollbarX, "mousedown", function(a) {
                            return a.stopPropagation();
                        }),
                        a.event.bind(a.scrollbarXRail, "mousedown", function(b) {
                            var c = b.pageX - window.pageXOffset - a.scrollbarXRail.getBoundingClientRect()
                                .left,
                                d = c > a.scrollbarXLeft ? 1 : -1;
                            (a.element.scrollLeft += d * a.containerWidth), q(a), b.stopPropagation();
                        });
                },
                "drag-thumb": function(a) {
                    t(a, ["containerWidth", "contentWidth", "pageX", "railXWidth", "scrollbarX",
                            "scrollbarXWidth", "scrollLeft", "x", "scrollbarXRail"
                        ]),
                        t(a, ["containerHeight", "contentHeight", "pageY", "railYHeight", "scrollbarY",
                            "scrollbarYHeight", "scrollTop", "y", "scrollbarYRail"
                        ]);
                },
                keyboard: function(a) {
                    function b(b, d) {
                        var e = v(c.scrollTop);
                        if (0 === b) {
                            if (!a.scrollbarYActive) return !1;
                            if ((0 === e && 0 < d) || (e >= a.contentHeight - a.containerHeight && 0 > d))
                                return !a.settings.wheelPropagation;
                        }
                        var f = c.scrollLeft;
                        if (0 === d) {
                            if (!a.scrollbarXActive) return !1;
                            if ((0 === f && 0 > b) || (f >= a.contentWidth - a.containerWidth && 0 < b))
                                return !a.settings.wheelPropagation;
                        }
                        return !0;
                    }
                    var c = a.element,
                        f = function() {
                            return d(c, ":hover");
                        },
                        g = function() {
                            return d(a.scrollbarX, ":focus") || d(a.scrollbarY, ":focus");
                        };
                    a.event.bind(a.ownerDocument, "keydown", function(d) {
                        if (!((d.isDefaultPrevented && d.isDefaultPrevented()) || d.defaultPrevented) &&
                            (f() || g())) {
                            var e = document.activeElement ? document.activeElement : a.ownerDocument
                                .activeElement;
                            if (e) {
                                if ("IFRAME" === e.tagName) e = e.contentDocument.activeElement;
                                // go deeper if element is a webcomponent
                                else
                                    for (; e.shadowRoot;) e = e.shadowRoot.activeElement;
                                if (o(e)) return;
                            }
                            var h = 0,
                                i = 0;
                            switch (d.which) {
                                case 37:
                                    h = d.metaKey ? -a.contentWidth : d.altKey ? -a.containerWidth : -
                                        30;
                                    break;
                                case 38:
                                    i = d.metaKey ? a.contentHeight : d.altKey ? a.containerHeight : 30;
                                    break;
                                case 39:
                                    h = d.metaKey ? a.contentWidth : d.altKey ? a.containerWidth : 30;
                                    break;
                                case 40:
                                    i = d.metaKey ? -a.contentHeight : d.altKey ? -a.containerHeight : -
                                        30;
                                    break;
                                case 32:
                                    i = d.shiftKey ? a.containerHeight : -a.containerHeight;
                                    break;
                                case 33:
                                    i = a.containerHeight;
                                    break;
                                case 34:
                                    i = -a.containerHeight;
                                    break;
                                case 36:
                                    i = a.contentHeight;
                                    break;
                                case 35:
                                    i = -a.contentHeight;
                                    break;
                                default:
                                    return;
                            }
                            (a.settings.suppressScrollX && 0 !== h) || (a.settings.suppressScrollY &&
                                0 !== i) || ((c.scrollTop -= i), (c.scrollLeft += h), q(a), b(h, i) && d
                                .preventDefault());
                        }
                    });
                },
                wheel: function(b) {
                    function c(a, c) {
                        var d,
                            e = v(h.scrollTop),
                            f = 0 === h.scrollTop,
                            g = e + h.offsetHeight === h.scrollHeight,
                            i = 0 === h.scrollLeft,
                            j = h.scrollLeft + h.offsetWidth === h.scrollWidth;
                        return (d = u(c) > u(a) ? f || g : i || j), !d || !b.settings.wheelPropagation;
                    }

                    function d(a) {
                        var b = a.deltaX,
                            c = -1 * a.deltaY;
                        return (
                            ("undefined" == typeof b || "undefined" == typeof c) && ((b = (-1 * a
                                .wheelDeltaX) / 6), (c = a.wheelDeltaY / 6)),
                            a.deltaMode && 1 === a.deltaMode && ((b *= 10), (c *= 10)),
                            b !== b && c !== c /* NaN checks */ && ((b = 0), (c = a.wheelDelta)),
                            a.shiftKey ? [-c, -b] : [b, c]
                        );
                    }

                    function f(b, c, d) {
                        // FIXME: this is a workaround for <select> issue in FF and IE #571
                        if (!E.isWebKit && h.querySelector("select:focus")) return !0;
                        if (!h.contains(b)) return !1;
                        for (var e = b; e && e !== h;) {
                            if (e.classList.contains(z.element.consuming)) return !0;
                            var f = a(e); // if deltaY && vertical scrollable
                            if (d && f.overflowY.match(/(scroll|auto)/)) {
                                var g = e.scrollHeight - e.clientHeight;
                                if (0 < g && ((0 < e.scrollTop && 0 > d) || (e.scrollTop < g && 0 < d)))
                                    return !0;
                            } // if deltaX && horizontal scrollable
                            if (c && f.overflowX.match(/(scroll|auto)/)) {
                                var i = e.scrollWidth - e.clientWidth;
                                if (0 < i && ((0 < e.scrollLeft && 0 > c) || (e.scrollLeft < i && 0 < c)))
                                    return !0;
                            }
                            e = e.parentNode;
                        }
                        return !1;
                    }

                    function g(a) {
                        var e = d(a),
                            g = e[0],
                            i = e[1];
                        if (!f(a.target, g, i)) {
                            var j = !1;
                            b.settings.useBothWheelAxes ?
                                b.scrollbarYActive && !b.scrollbarXActive ?
                                (i ? (h.scrollTop -= i * b.settings.wheelSpeed) : (h.scrollTop += g * b.settings
                                    .wheelSpeed), (j = !0)) :
                                b.scrollbarXActive && !b.scrollbarYActive && (g ? (h.scrollLeft += g * b
                                    .settings.wheelSpeed) : (h.scrollLeft -= i * b.settings.wheelSpeed), (
                                    j = !0)) :
                                ((h.scrollTop -= i * b.settings.wheelSpeed), (h.scrollLeft += g * b.settings
                                    .wheelSpeed)),
                                q(b),
                                (j = j || c(g, i)),
                                j && !a.ctrlKey && (a.stopPropagation(), a.preventDefault());
                        }
                    }
                    var h = b.element;
                    "undefined" == typeof window.onwheel ? "undefined" != typeof window.onmousewheel && b.event
                        .bind(h, "mousewheel", g) : b.event.bind(h, "wheel", g);
                },
                touch: function(b) {
                    function c(a, c) {
                        var d = v(l.scrollTop),
                            e = l.scrollLeft,
                            f = u(a),
                            g = u(c);
                        if (g > f) {
                            // user is perhaps trying to swipe up/down the page
                            if ((0 > c && d === b.contentHeight - b.containerHeight) || (0 < c && 0 === d))
                                // set prevent for mobile Chrome refresh
                                return 0 === window.scrollY && 0 < c && E.isChrome;
                        } else if (f > g && ((0 > a && e === b.contentWidth - b.containerWidth) || (0 < a &&
                                0 === e)))
                            // user is perhaps trying to swipe left/right across the page
                            return !0;
                        return !0;
                    }

                    function d(a, c) {
                        (l.scrollTop -= c), (l.scrollLeft -= a), q(b);
                    }

                    function f(a) {
                        return a.targetTouches ? a.targetTouches[0] : a;
                    }

                    function g(a) {
                        return (
                            !(a.pointerType && "pen" === a.pointerType && 0 === a.buttons) && (!!(a
                                .targetTouches && 1 === a.targetTouches.length) || !!(a.pointerType &&
                                "mouse" !== a.pointerType && a.pointerType !== a.MSPOINTER_TYPE_MOUSE))
                        );
                    }

                    function h(a) {
                        if (g(a)) {
                            var b = f(a);
                            (m.pageX = b.pageX), (m.pageY = b.pageY), (n = new Date().getTime()), null !== p &&
                                clearInterval(p);
                        }
                    }

                    function i(b, c, d) {
                        if (!l.contains(b)) return !1;
                        for (var e = b; e && e !== l;) {
                            if (e.classList.contains(z.element.consuming)) return !0;
                            var f = a(e); // if deltaY && vertical scrollable
                            if (d && f.overflowY.match(/(scroll|auto)/)) {
                                var g = e.scrollHeight - e.clientHeight;
                                if (0 < g && ((0 < e.scrollTop && 0 > d) || (e.scrollTop < g && 0 < d)))
                                    return !0;
                            } // if deltaX && horizontal scrollable
                            if (c && f.overflowX.match(/(scroll|auto)/)) {
                                var h = e.scrollWidth - e.clientWidth;
                                if (0 < h && ((0 < e.scrollLeft && 0 > c) || (e.scrollLeft < h && 0 < c)))
                                    return !0;
                            }
                            e = e.parentNode;
                        }
                        return !1;
                    }

                    function j(a) {
                        if (g(a)) {
                            var b = f(a),
                                e = {
                                    pageX: b.pageX,
                                    pageY: b.pageY
                                },
                                h = e.pageX - m.pageX,
                                j = e.pageY - m.pageY;
                            if (i(a.target, h, j)) return;
                            d(h, j), (m = e);
                            var k = new Date().getTime(),
                                l = k - n;
                            0 < l && ((o.x = h / l), (o.y = j / l), (n = k)), c(h, j) && a.preventDefault();
                        }
                    }

                    function k() {
                        b.settings.swipeEasing &&
                            (clearInterval(p),
                                (p = setInterval(function() {
                                    return b.isInitialized ? void clearInterval(p) : o.x || o.y ? (
                                            0.01 > u(o.x) && 0.01 > u(o.y) ? void clearInterval(p) :
                                            void(d(30 * o.x, 30 * o.y), (o.x *= 0.8), (o.y *= 0.8))) :
                                        void clearInterval(p);
                                }, 10)));
                    }
                    if (E.supportsTouch || E.supportsIePointer) {
                        var l = b.element,
                            m = {},
                            n = 0,
                            o = {},
                            p = null;
                        E.supportsTouch ?
                            (b.event.bind(l, "touchstart", h), b.event.bind(l, "touchmove", j), b.event.bind(l,
                                "touchend", k)) :
                            E.supportsIePointer &&
                            (window.PointerEvent ?
                                (b.event.bind(l, "pointerdown", h), b.event.bind(l, "pointermove", j), b.event
                                    .bind(l, "pointerup", k)) :
                                window.MSPointerEvent && (b.event.bind(l, "MSPointerDown", h), b.event.bind(l,
                                    "MSPointerMove", j), b.event.bind(l, "MSPointerUp", k)));
                    }
                },
            }
    });
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/soft-ui-dashboard-pro.js"></script>

! function(e) {
	"use strict";
	var t, n, o, i, s, a, c, r, l, d, u, h, m, f, p, v, g, k, b, C, y, x, w, z, $, F, S, T, R, E, P, _, D, A, U, j, B, O, q, I, L = (t = e(window).width(), n = function() {
		jQuery(".default-select").length > 0 && jQuery(".default-select").selectpicker()
	}, o = function() {
		e("#preloader").fadeOut(500), e("#main-wrapper").addClass("show")
	}, i = function() {
		jQuery("#menu").length > 0 && e("#menu").metisMenu(), jQuery(".metismenu > .mm-active ").each(function() {
			!jQuery(this).children("ul").length > 0 && jQuery(this).addClass("active-no-child")
		})
	}, s = function() {
		jQuery(document).on("click", "#admin_detail", function() {
			e("#login_email").val("admin@gmail.com"), e("#login_password").val("12345678")
		}), jQuery(document).on("click", "#manager_detail", function() {
			e("#login_email").val("manager@gmail.com"), e("#login_password").val("12345678")
		}), jQuery(document).on("click", "#customer_detail", function() {
			e("#login_email").val("customer@gmail.com"), e("#login_password").val("12345678")
		})
	}, a = function() {
		jQuery(".dz-demo-content").length > 0 && (new PerfectScrollbar(".dz-demo-content"), e(".dz-demo-trigger").on("click", function() {
			e(".dz-demo-panel").addClass("show")
		}), e(".dz-demo-close, .bg-close,.dz_theme_demo,.dz_theme_demo_rtl").on("click", function() {
			e(".dz-demo-panel").removeClass("show")
		}), e(".dz-demo-bx").on("click", function() {
			e(".dz-demo-bx").removeClass("demo-active"), e(this).addClass("demo-active")
		}))
	}, c = function() {
		e("#checkAll").on("change", function() {
			e("td input:checkbox, .email-list .custom-checkbox input:checkbox").prop("checked", e(this).prop("checked"))
		})
	}, r = function() {
		e(".nav-control").on("click", function() {
			e("#main-wrapper").toggleClass("menu-toggle"), e(".hamburger").toggleClass("is-active")
		})
	}, l = function() {
		for (var t = window.location, n = e("ul#menu a").filter(function() {
				return this.href == t
			}).addClass("mm-active").parent().addClass("mm-active"); n.is("li");) n = n.parent().addClass("mm-show").parent().addClass("mm-active")
	}, d = function() {
		e("ul#menu>li").on("click", function() {
			let t = e("body").attr("data-sidebar-style");
			"mini" === t && e(this).find("ul").stop()
		})
	}, u = function() {
		var t = window.outerHeight,
			t = window.outerHeight;
		(t > 0 ? t : screen.height) && e(".content-body").css("min-height", t + 60 + "px")
	}, h = function() {
		e('a[data-action="collapse"]').on("click", function(t) {
			t.preventDefault(), e(this).closest(".card").find('[data-action="collapse"] i').toggleClass("mdi-arrow-down mdi-arrow-up"), e(this).closest(".card").children(".card-body").collapse("toggle")
		}), e('a[data-action="expand"]').on("click", function(t) {
			t.preventDefault(), e(this).closest(".card").find('[data-action="expand"] i').toggleClass("icon-size-actual icon-size-fullscreen"), e(this).closest(".card").toggleClass("card-fullscreen")
		}), e('[data-action="close"]').on("click", function() {
			e(this).closest(".card").removeClass().slideUp("fast")
		}), e('[data-action="reload"]').on("click", function() {
			var t = e(this);
			t.parents(".card").addClass("card-load"), t.parents(".card").append('<div class="card-loader"><i class=" ti-reload rotate-refresh"></div>'), setTimeout(function() {
				t.parents(".card").children(".card-loader").remove(), t.parents(".card").removeClass("card-load")
			}, 2e3)
		})
	}, m = function() {
		let t = e(".header").innerHeight();
		e(window).scroll(function() {
			"horizontal" === e("body").attr("data-layout") && "static" === e("body").attr("data-header-position") && "fixed" === e("body").attr("data-sidebar-position") && (e(this.window).scrollTop() >= t ? e(".deznav").addClass("fixed") : e(".deznav").removeClass("fixed"))
		})
	}, f = function() {
		jQuery(".dz-scroll").each(function() {
			var e = jQuery(this).attr("id");
			let t = new PerfectScrollbar("#" + e, {
				wheelSpeed: 2,
				wheelPropagation: !0,
				minScrollbarLength: 20
			});
			t.isRtl = !1
		})
	}, p = function() {
		t <= 991 && (jQuery(".menu-tabs .nav-link").on("click", function() {
			jQuery(this).hasClass("open") ? (jQuery(this).removeClass("open"), jQuery(".fixed-content-box").removeClass("active"), jQuery(".hamburger").show()) : (jQuery(".menu-tabs .nav-link").removeClass("open"), jQuery(this).addClass("open"), jQuery(".fixed-content-box").addClass("active"), jQuery(".hamburger").hide())
		}), jQuery(".close-fixed-content").on("click", function() {
			jQuery(".fixed-content-box").removeClass("active"), jQuery(".hamburger").removeClass("is-active"), jQuery("#main-wrapper").removeClass("menu-toggle"), jQuery(".hamburger").show()
		}))
	}, v = function() {
		jQuery(".bell-link").on("click", function() {
			jQuery(".chatbox").addClass("active")
		}), jQuery(".chatbox-close").on("click", function() {
			jQuery(".chatbox").removeClass("active")
		})
	}, g = function() {
		if (jQuery(".deznav-scroll").length > 0) {
			let e = new PerfectScrollbar(".deznav-scroll");
			e.isRtl = !1
		}
	}, k = function() {
		e(".btn-number").on("click", function(t) {
			t.preventDefault(), fieldName = e(this).attr("data-field"), type = e(this).attr("data-type");
			var n = e("input[name='" + fieldName + "']"),
				o = parseInt(n.val(), 10);
			isNaN(o) ? n.val(0) : "minus" == type ? n.val(o - 1) : "plus" == type && n.val(o + 1)
		})
	}, b = function() {
		jQuery(".dz-chat-user-box .dz-chat-user").on("click", function() {
			jQuery(".dz-chat-user-box").addClass("d-none"), jQuery(".dz-chat-history-box").removeClass("d-none")
		}), jQuery(".dz-chat-history-back").on("click", function() {
			jQuery(".dz-chat-user-box").removeClass("d-none"), jQuery(".dz-chat-history-box").addClass("d-none")
		}), jQuery(".dz-fullscreen").on("click", function() {
			jQuery(".dz-fullscreen").toggleClass("active")
		})
	}, C = function() {
		jQuery(".dz-fullscreen").on("click", function(e) {
			document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement ? document.exitFullscreen ? document.exitFullscreen() : document.msExitFullscreen ? document.msExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.webkitRequestFullscreen ? document.documentElement.webkitRequestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.msRequestFullscreen && document.documentElement.msRequestFullscreen()
		})
	}, y = function() {
		jQuery(".show-pass").on("click", function() {
			jQuery(this).toggleClass("active"), "password" == jQuery("#dz-password").attr("type") ? jQuery("#dz-password").attr("type", "text") : "text" == jQuery("#dz-password").attr("type") && jQuery("#dz-password").attr("type", "password")
		})
	}, x = function() {
		jQuery(".show-con-pass").on("click", function() {
			jQuery(this).toggleClass("active"), "password" == jQuery("#dz-con-password").attr("type") ? jQuery("#dz-con-password").attr("type", "text") : "text" == jQuery("#dz-con-password").attr("type") && jQuery("#dz-con-password").attr("type", "password")
		})
	}, w = function() {
		e(".heart").on("click", function() {
			e(this).toggleClass("heart-blast")
		})
	}, z = function() {
		e(".dz-load-more").on("click", function(t) {
			t.preventDefault(), e(this).append(' <i class="fa fa-refresh"></i>');
			var n = e(this).attr("rel"),
				o = e(this).attr("id");
			e.ajax({
				method: "POST",
				url: n,
				dataType: "html",
				success: function(t) {
					e("#" + o + "Content").append(t), e(".dz-load-more i").remove()
				}
			})
		})
	}, $ = function() {
		jQuery("#lightgallery").length > 0 && e("#lightgallery").lightGallery({
			loop: !0,
			thumbnail: !0,
			exThumbImage: "data-exthumbimage"
		})
	}, F = function() {
		jQuery("#smartwizard").length > 0 && e(document).ready(function() {
			e("#smartwizard").smartWizard()
		})
	}, S = function() {
		e(".custom-file-input").on("change", function() {
			var t = e(this).val().split("\\").pop();
			e(this).siblings(".custom-file-label").addClass("selected").html(t)
		})
	}, T = function() {
		var t = e(window).height() - 206;
		e(".chatbox .msg_card_body").css("height", t)
	}, R = function() {
		e(".chat-hamburger").on("click", function() {
			e(".chat-left-sidebar").toggleClass("show")
		})
	}, E = function() {
		t > 1024 && e(".metismenu  li").unbind().each(function(t) {
			if (e("ul", this).length > 0) {
				var n = e("ul:first", this).css("display", "block"),
					o = n.offset().left,
					i = n.width(),
					n = e("ul:first", this).removeAttr("style");
				e("body").height();
				var s = e("body").width();
				if (jQuery("html").hasClass("rtl")) var a = o + i <= s;
				else var a = o > 0;
				a ? e(this).find("ul:first").removeClass("left") : e(this).find("ul:first").addClass("left")
			}
		})
	}, P = function() {
		let t = e(".image-select");
		t.find("option").each((t, n) => {
			let o = e(n),
				i = o.attr("data-thumbnail");
			i && o.attr("data-content", "<img src='%i'/> %s".replace(/%i/, i).replace(/%s/, o.text()))
		}), t.selectpicker()
	}, _ = function() {
		jQuery(".dz-theme-mode").on("click", function() {
			jQuery(this).toggleClass("active"), jQuery(this).hasClass("active") ? jQuery("body").attr("data-theme-version", "dark") : jQuery("body").attr("data-theme-version", "light")
		})
	}, D = function() {
		jQuery(".W3cmsCkeditor").length > 0 && !0 == enableCkeditor && CKEDITOR.replace(jQuery(".W3cmsCkeditor").attr("id"), {
			removePlugins: "cloudservices, easyimage, exportpdf",
			disallowedContent: "script; *[on*]",
			allowedContent: {
				$1: {
					elements: CKEDITOR.dtd,
					attributes: !0,
					styles: !0,
					classes: !0
				}
			},
			toolbar: [{
				items: ['Image',"Source", "-", "SelectAll", "TextColor", "BGColor", "Bold", "Italic", "Underline", "Strike", "Subscript", "Superscript", "-", "Undo", "Redo", "-", "Find", "-", "NumberedList", "BulletedList", "-", "Outdent", "Indent", "-"]
			}, {
				items: [, "BidiLtr", "BidiRtl", "Link", "Unlink", "Table", "HorizontalRule", "SpecialChar"]
			}, "/", {
				name: "styles",
				items: ["Styles", "Format", "Font", "FontSize", "-", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock", "-", "Blockquote", "CreateDiv"]
			}, {
				name: "colors",
				items: []
			}, ]
		})
	}, A = function() {
		jQuery(".TwoFactorAuthForm").on("click", function() {
			var e = jQuery(this).attr("rel");
			jQuery("#recoveryCodeForm").addClass("d-none"), jQuery("#secretCodeForm").removeClass("d-none"), "recovery_form" == e && (jQuery("#recoveryCodeForm").removeClass("d-none"), jQuery("#secretCodeForm").addClass("d-none"))
		})
	}, U = function() {
		e(".img-input-onchange").on("change", function() {
			var t = this,
				n = e(this).val();
			if (n.substring(n.lastIndexOf(".") + 1).toLowerCase(), t.files && t.files[0]) {
				var o = new FileReader;
				o.onload = function(n) {
					e(t).parents(".img-parent-box").find(".img-for-onchange").attr("src", n.target.result)
				}, o.readAsDataURL(t.files[0])
			}
		})
	}, j = function() {
		jQuery(".datetimepicker").length > 0 && e(".datetimepicker").pickadate({
			format: "yyyy-mm-dd"
		})
	}, B = function() {
		jQuery(".permalink_selection").on("change", function() {
			var t = e(this).val();
			"custom" !== t && e("#permalink_structure").val(t)
		}), jQuery("#permalink_structure").on("click", function() {
			e("#CustomeStructure").prop("checked", !0)
		}), jQuery(".permas_type").on("click", function() {
			var t = jQuery("#permalink_structure").val(),
				n = jQuery(this),
				o = n.val();
			t.search(o) > -1 || n.hasClass("active") ? (t = t.replace("/" + o, ""), n.removeClass("active")) : (t = t ? t + o + "/" : t + "/" + o + "/", n.addClass("active")), 0 == jQuery("button.active").length && (t = ""), jQuery("#permalink_structure").val(t), e("#CustomeStructure").prop("checked", !0)
		})
	}, O = function() {
		jQuery(".bulkActionRoleCheckbox").on("change", function() {
			var e = jQuery(this).data("role-id"),
				t = jQuery(this).attr("rdx-link"),
				n = jQuery(this);
			jQuery.ajax({
				type: "GET",
				url: t,
				success: function(t) {
					t.status ? jQuery(".permissionCheckbox_" + e).prop("checked", n.is(":checked")) : n.prop("checked", !n.is(":checked")), alert(t.msg)
				},
				error: function(e) {
					alert(JSON.stringify(e)), alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(document).on("change", ".RoleCheckbox", function() {
			event.preventDefault();
			var e = jQuery(this).attr("rdx-link"),
				t = jQuery(this);
			jQuery.ajax({
				type: "GET",
				url: e,
				success: function(e) {
					e.status ? t.prop("checked", t.is(":checked")) : t.prop("checked", !t.is(":checked")), alert(e.msg)
				},
				error: function(e) {
					alert(JSON.stringify(e)), alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(document).on("change", ".UserCheckbox", function() {
			event.preventDefault();
			var e = jQuery(this).data("user-id");
			jQuery(this).data("permission-id");
			var t = jQuery(this).attr("rdx-link"),
				n = jQuery(this);
			jQuery.ajax({
				type: "GET",
				url: t,
				success: function(t) {
					t.status ? jQuery("#userCheckbox_" + e).prop("checked", n.is(":checked")) : n.prop("checked", !n.is(":checked")), alert(t.msg)
				},
				error: function(e) {
					alert(JSON.stringify(e)), alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(".deleteUserPermission").on("click", function() {
			if (event.preventDefault(), !confirm("Are you sure you want to delete User Level permission?")) return !1;
			var e = jQuery(this).data("user-id"),
				t = jQuery(this).data("permission-id"),
				n = jQuery(this).attr("rdx-link"),
				o = jQuery(this);
			jQuery.ajax({
				type: "GET",
				url: n,
				success: function(n) {
					n.status ? (jQuery("#userCheckbox_" + e + "_" + t).is(":checked") && jQuery("#userCheckbox_" + e + "_" + t).prop("checked", !1), jQuery("#userCheckbox_" + e + "_" + t).parent().find(".deny-permission").removeClass("deny-permission"), o.remove()) : alert(n.msg)
				},
				error: function(e) {
					alert(JSON.stringify(e)), alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(".RemoveUserPermission").on("change", function() {
			event.preventDefault();
			var e = jQuery(this).data("user-id"),
				t = jQuery(this).attr("rdx-link"),
				n = jQuery(this);
			jQuery.ajax({
				type: "GET",
				url: t,
				dataType: "json",
				success: function(t) {
					t.status ? jQuery(".permissionCheckbox_" + e).prop("checked", n.is(":checked")) : n.prop("checked", !n.is(":checked")), alert(t.msg)
				},
				error: function(e) {
					alert(JSON.stringify(e)), alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(document).on("click", ".toggle-icon", function() {
			jQuery(this).toggleClass("active"), jQuery(".support-menu").toggleClass("active")
		}), jQuery(document).on("click", ".AssignRevokePermissions", function() {
			event.preventDefault();
			var t = jQuery(this).data("permission-id"),
				n = jQuery(this).data("type"),
				o = jQuery(this).attr("href");
			jQuery(this), jQuery.ajax({
				headers: {
					"X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")
				},
				type: "POST",
				url: o,
				data: {
					permission_id: t,
					type: n
				},
				success: function(e) {
					jQuery("#AssignRevokePermissionsModalBody").html(e), jQuery("#AssignRevokePermissionsModal").modal("show")
				},
				error: function(e) {
					alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(document).on("change", "#RoleId", function() {
			event.preventDefault();
			var t = jQuery(this).val(),
				n = jQuery(this).attr("rdx-link");
			jQuery(this), jQuery.ajax({
				headers: {
					"X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")
				},
				type: "POST",
				url: n,
				data: {
					role_id: t
				},
				success: function(e) {
					jQuery("#PermissionUserId").html(e), jQuery("#AssignRevokePermissionsModal").modal("show")
				},
				error: function(e) {
					alert("Sorry! There is some problem. please check function calling.")
				}
			})
		}), jQuery(document).on("change", "#PermissionUserId", function() {
			event.preventDefault();
			var t = jQuery(this).val(),
				n = jQuery("#PermissionId").val(),
				o = jQuery(this).attr("rdx-link");
			if (jQuery(this), !t) return !1;
			jQuery.ajax({
				headers: {
					"X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")
				},
				type: "POST",
				url: o,
				data: {
					user_id: t,
					permission_id: n
				},
				success: function(e) {
					jQuery("#PermissionActionBtn").html(e), jQuery("#AssignRevokePermissionsModal").modal("show")
				},
				error: function(e) {
					alert("Sorry! There is some problem. please check function calling.")
				}
			})
		})
	}, q = function() {
		jQuery(".LogOutBtn").on("click", function() {
			event.preventDefault(), jQuery(this).closest("form").submit()
		})
	}, I = function() {
		jQuery(".ImportDemo").on("click", function() {
			event.preventDefault();
			var e = jQuery(this).attr("rel");
			jQuery("#DBFileUrl").val(e), jQuery("#ImportDataForm").modal("show")
		})
	}, {
		init: function() {
			o(), i(), c(), r(), l(), d(), u(), h(), m(), f(), p(), v(), g(), k(), b(), C(), y(), x(), w(), z(), $(), F(), S(), T(), R(), P(), _(), a(), s(), A(), U(), j(), B(), O(), q(), D(), I()
		},
		load: function() {
			o(), n(), P()
		},
		resize: function() {
			T()
		},
		handleMenuPosition: function() {
			E()
		}
	});
	jQuery(document).ready(function() {
		e('[data-toggle="popover"]').popover(), L.init(), [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function(e) {
			return new bootstrap.Popover(e)
		})
	}), jQuery(window).on("load", function() {
		L.load(), setTimeout(function() {
			L.handleMenuPosition()
		}, 1e3)
	}), jQuery(window).on("resize", function() {
		L.resize(), setTimeout(function() {
			L.handleMenuPosition()
		}, 1e3)
	}), jQuery(document).ready(function() {
		e("#dz_tree").length > 0 && e("#dz_tree").jstree({
			core: {
				themes: {
					responsive: !1
				}
			},
			types: {
				default: {
					icon: "fa fa-folder"
				},
				file: {
					icon: "fa fa-file-text"
				}
			},
			plugins: ["types"]
		})
	})
}(jQuery);

"use strict";function enterChat(s){var e=$(".message").val();if(/\S/.test(e)){var a='<div class="chat-content"><p>'+e+"</p></div>";$(".chat:last-child .chat-body").append(a),$(".message").val(""),$(".user-chats").scrollTop($(".user-chats > .chats").height())}}$((function(){var s=$(".chat-application .chat-user-list-wrapper"),e=$(".body-content-overlay"),a=$(".chat-application .chat-profile-sidebar"),o=$(".chat-application .profile-sidebar-area"),t=$(".chat-application .sidebar-profile-toggle"),l=$(".chat-application .user-profile-toggle"),n=$(".user-profile-sidebar"),i=$(".chat-application .user-status input:radio[name=userStatus]"),r=$(".user-chats"),c=$(".chat-users-list"),h=$(".chat-list"),d=$(".contact-list"),f=$(".sidebar-toggle"),v=$(".sidebar-content"),u=$(".chat-application .close-icon"),w=$(".chat-application .sidebar-close-icon"),p=$(".chat-application .menu-toggle"),C=$(".speech-to-text"),g=$(".chat-application #chat-search");if($.app.menu.is_touch_device())s.css("overflow","scroll"),n.find(".user-profile-sidebar-area").css("overflow","scroll"),r.css("overflow","scroll"),o.css("overflow","scroll"),$(c).find("li").on("click",(function(){$(v).removeClass("show"),$(e).removeClass("show")}));else{if(s.length>0)new PerfectScrollbar(s[0]);if(n.find(".user-profile-sidebar-area").length>0)new PerfectScrollbar(n.find(".user-profile-sidebar-area")[0]);if(r.length>0)new PerfectScrollbar(r[0],{wheelPropagation:!1});if(o.length>0)new PerfectScrollbar(o[0])}if(t.length&&t.on("click",(function(){a.addClass("show"),e.addClass("show")})),i.length&&i.on("change",(function(){var s="avatar-status-"+this.value,e=$(".header-profile-sidebar .avatar span");e.removeClass(),t.find(".avatar span").removeClass(),e.addClass(s+" avatar-status-lg"),t.find(".avatar span").addClass(s)})),u.length&&u.on("click",(function(){a.removeClass("show"),n.removeClass("show"),v.hasClass("show")||e.removeClass("show")})),w.length&&w.on("click",(function(){v.removeClass("show"),e.removeClass("show")})),l.length&&l.on("click",(function(){n.addClass("show"),e.addClass("show")})),e.length&&e.on("click",(function(){v.removeClass("show"),e.removeClass("show"),a.removeClass("show"),n.removeClass("show")})),s.find("ul li").length&&s.find("ul li").on("click",(function(){var e=$(this),a=$(".start-chat-area"),o=$(".active-chat");s.find("ul li").hasClass("active")&&s.find("ul li").removeClass("active"),e.addClass("active"),e.find(".badge").remove(),s.find("ul li").hasClass("active")?(a.addClass("d-none"),o.removeClass("d-none")):(a.removeClass("d-none"),o.addClass("d-none"))})),c.find("li").on("click",(function(){r.animate({scrollTop:r[0].scrollHeight},400)})),p.length&&p.on("click",(function(s){v.removeClass("show"),e.removeClass("show"),a.removeClass("show"),n.removeClass("show")})),$(window).width()<992&&f.length&&f.on("click",(function(){v.addClass("show"),e.addClass("show")})),g.length&&g.on("keyup",(function(){var e=$(this).val().toLowerCase();if(""!==e){h.find("li:not(.no-results)").filter((function(){$(this).toggle($(this).text().toLowerCase().indexOf(e)>-1)})),d.find("li:not(.no-results)").filter((function(){$(this).toggle($(this).text().toLowerCase().indexOf(e)>-1)}));var a=h.find("li:not(.no-results):visible").length,o=d.find("li:not(.no-results):visible").length;0==a?h.find(".no-results").addClass("show"):h.find(".no-results").hasClass("show")&&h.find(".no-results").removeClass("show"),0==o?d.find(".no-results").addClass("show"):d.find(".no-results").hasClass("show")&&d.find(".no-results").removeClass("show")}else c.find("li").show(),s.find(".no-results").hasClass("show")&&s.find(".no-results").removeClass("show")})),C.length){var m=m||webkitSpeechRecognition;if(null!=m){var b=new m,k=!1;C.on("click",(function(){var s=$(this);b.onspeechstart=function(){k=!0},!1===k&&b.start(),b.onerror=function(s){k=!1},b.onresult=function(e){s.closest(".form-send-message").find(".message").val(e.results[0][0].transcript)},b.onspeechend=function(s){k=!1,b.stop()}}))}}})),$(window).on("resize",(function(){$(window).width()>992&&$(".chat-application .body-content-overlay").hasClass("show")&&($(".app-content .sidebar-left").removeClass("show"),$(".chat-application .body-content-overlay").removeClass("show")),$(window).width()<991&&($(".chat-application .chat-profile-sidebar").hasClass("show")&&$(".chat-application .sidebar-content").hasClass("show")||($(".sidebar-content").removeClass("show"),$(".body-content-overlay").removeClass("show")))}));

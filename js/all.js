$(document).ready(function() {
	function getCookie(name) {
		var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
		 if(arr != null) return unescape(arr[2]); return null;
	}
	
	function delCookie(name) {
		var exp = new Date();
		exp.setTime(exp.getTime() - 1);
		var cval=getCookie(name);
		if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
	}
	
	$('a').click(function() {
		delCookie('cat_name');
		delCookie('sear_name');
	});
	
	$('a,input[type="submit"],object').bind('focus',function(){if(this.blur){ this.blur();}});
	
	var mainHeight = $(window).height() - $('#header_wrapper').height() - $('#footer_wrapper').height() - 40;
	if (($('#sear_wrapper').length <=0) && ($('#main').height() < mainHeight)) {
		$('#main').height(mainHeight);
	} else if (($('#sear_wrapper').length >0) && ($('#main').height() < (mainHeight-$('#sear_wrapper').height()))) {
		$('#main').height(mainHeight-$('#sear_wrapper').height());
	}
	
	$('#nav ul li:not(:last)').append('|');
	$('#guide ul li:not(:last)').append('|');
	
	$('.searchform .s').focus(function() {
		if ($(this).val() == 'SEARCH by Species, DOI, Data Type') {
			$(this).val('').addClass('input_focus');
		}
	});
	$('.searchform .s').blur(function() {
		if ($(this).val() == '') {
			$(this).val('SEARCH by Species, DOI, Data Type').removeClass('input_focus');
		}
		$(this).val($.trim($(this).val()));
	});
	
	$('.searchform .s').keyup(function() {
		if ($('._tag_suggestion').length>0) {
			$('.tagMatches').css('display', 'block');
		} else {
			$('.tagMatches').css('display', 'none');
		}
		if ($(this).val() == '') {
			$('.tagMatches').css('display', 'none');
		}
	});
	$('._tag_suggestion').live({
		mouseenter : function() {
			$(this).addClass('tag_hover');
		},
		mouseleave : function() {
			$(this).removeClass('tag_hover');
		},
		click : function() {
			$('.tagMatches').css('display', 'none');
		}
	});
	$('#select i').click(function() {
		$('#sear_option ul').css('display', 'block')
	});
	$('#sear_option ul li').addClass('select_option');
	
	$(document).click(function(ev) {
		if (!$(ev.target).hasClass('down_arrow')) {
			$('#sear_option ul').css('display', 'none')
		}
	});
	
	$('.searchform .submit').click(function(ev) {
		if ($('.searchform .s').val() == 'SEARCH by Species, DOI, Data Type') {
			ev.preventDefault(ev);
		} else {
			var searOptionHtml = $('#select span').html();
			if ($('#select span').html() != 'All databases') {
				document.cookie = 'cat_name=' + searOptionHtml; 
			} else {
				document.cookie = 'cat_name=All databases'; 
			}
			document.cookie = 'sear_name=' + $('.searchform .s').val();
		}
	});
	
	$('.header_searform .submit').click(function(ev) {
		if ($('.header_searform .s').val() == '') {
			ev.preventDefault(ev);
		} else {
			document.cookie = 'sear_name=' + $('.header_searform .s').val();
		}
	});
	
	if (getCookie('sear_name') && getCookie('sear_name') !='') {
		$('.searchform .s').val(getCookie('sear_name'));
		$('.header_searform .s').val(getCookie('sear_name'));
	}
	
	if (getCookie('cat_name') && getCookie('cat_name') !='') {
		$('#select span').html(getCookie('cat_name'));
	}
	
	$('#sear_option ul li a').click(function(ev) {
		$('#select span').html($(this).html());
		//ev.preventDefault(ev);
	});
	
	if ($.trim($('.page_prev').html()) == '' && $.trim($('.page_next').html()) == '') {
		$('#page_nav').css('display', 'none')
	}
	
	$($('.replace:last').parent().nextAll('p')).replaceAll($('#citation .widget_bd p'));
	$($('.replace:first').parent().nextAll('p')).replaceAll($('#download .widget_bd p'));
	
	var contentH2Height = $('.content_hd h2').height();
		
	$('.single .content_bd').css({
		'padding-top' : contentH2Height - 15
	});
	$('.search .list_bd, .archive .list_bd').each(function() {
		var contentH3Height = $('.content_hd h3', $(this)).height();
		$('.content_bd', $(this)).css({
			'padding-top' : contentH3Height - 15
		});
	})

	
	if ($('.searchform .s').val() != 'SEARCH by Species, DOI, Data Type') {
		$('.searchform .s').addClass('input_focus')
	}
});
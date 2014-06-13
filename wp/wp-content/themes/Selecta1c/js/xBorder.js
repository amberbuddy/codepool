$(function() {
	$('#content h2 a').click(function(e) {
		e.preventDefault();
		var htm = '假装异步加载ing',
		i = 9,
		t = $(this).html(htm).unbind('click'); (function ct() {
			i < 0 ? (i = 9, t.html(htm), ct()) : (t[0].innerHTML += '.', i--, setTimeout(ct, 200))
		})();
		window.location = this.href
	})
});
$(".pingpart").click(function() {
	$(this).css({
		color: "#b3b3b3"
	});
	$(".commentshow").hide(400);
	$(".pingtlist").show(400);
	$(".commentpart").css({
		color: "#A0A0A0"
	})
});
$(".commentpart").click(function() {
	$(this).css({
		color: "#b3b3b3"
	});
	$(".pingtlist").hide(400);
	$(".commentshow").show(400);
	$(".pingpart").css({
		color: "#A0A0A0"
	})
});
$('.report, .report1').click(function() {
	$body.animate({
		scrollTop: $('#comment').offset().top
	},
	400)
});
$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
$('.commentnav a').live('click',
function(e) {
	e.preventDefault();
	$.ajax({
		type: "GET",
		url: $(this).attr('href'),
		beforeSend: function() {
			$('.commentnav').remove();
			$('.commentlist').remove();
			$('#loading-comments').slideDown();
		},
		dataType: "html",
		success: function(out) {
			result = $(out).find('.commentlist');
			nextlink = $(out).find('.commentnav');
			$('#loading-comments').slideUp(500);
			$('#loading-comments').after(result.fadeIn(800));
			$('.commentlist').after(nextlink);
		}
	});
})

jQuery(document).ready(function($) {
	$('.reply').click(function() {
		var atid = '"#' + $(this).parent().parent().attr("id") + '"';
		var atname = $(this).parent().find('.name').text();
		$("#comment").attr("value", "@" + atname + " ：").focus();
	});
	$('.cancel_comment_reply a').click(function() {
		$("#comment").attr("value", '');
	});
})

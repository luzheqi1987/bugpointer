/* @ to commenter */
jQuery(".comment-reply-link").click(function() {
	var uid = jQuery(this).parent().parent().parent().attr("id");
	var unm = jQuery(this).parent().parent().children().first().text().trim();
	//jQuery("#comment").attr("value","<a href='#" + uid + "'>@" + unm + ":</a> ").focus();
	jQuery("#comment").attr("value","@" + unm + ": ").focus();
});
jQuery("#cancel-comment-reply-link").click(function() {
	jQuery("#comment").attr("value",'');
});
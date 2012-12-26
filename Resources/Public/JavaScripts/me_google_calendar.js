/************************************************************************
 *
 *  (c) 2012 Alexander Grein <mail@mediaessenz.de>, MEDIA::ESSENZ
 *
 ************************************************************************/

(function ($) {
	if(!console || !console.log) {
		var console = new Object();
		console.log = function () {}
	}
	$.extend({
				 URLEncode:function(c){
					 var o = '';
					 var x = 0;
					 c = c.toString();
					 var r = /(^[a-zA-Z0-9_.]*)/;
					 while (x < c.length){
						 var m = r.exec(c.substr(x));
						 if (m != null && m.length > 1 && m[1] != '') {
							 o += m[1];
							 x += m[1].length;
						 } else {
							 if (c[x]==' ') {
								 o += '+';
							 } else {
								 var d = c.charCodeAt(x);
								 var h = d.toString(16);
								 o += '%' + (h.length < 2 ? '0':'') + h.toUpperCase();
							 }
							 x++;
						 }
					 }
					 return o;
				 },
				 URLDecode:function(s){
					 var o = s;
					 var binVal,t;
					 var r = /(%[^%]{2})/;
					 while ((m=r.exec(o)) != null && m.length > 1 && m[1] != '') {
						 b = parseInt(m[1].substr(1), 16);
						 t = String.fromCharCode(b);
						 o = o.replace(m[1], t);
					 }
					 return o;
				 }
			 });

	$(function () {
		$('.fc-calendar').each(function() {
			var calendarId = $(this).attr('id');
			var settings = eval(calendarId + '_settings');
			settings.eventSources = [];
			$.each(settings.calendarFeeds, function (key, value) {
				settings.eventSources.push($.fullCalendar.gcalFeed(value.url, {className: value.className, currentTimezone: value.timeZone}));
			});
			$(this).fullCalendar(settings);
			var loadingWidth = $('#' + calendarId + ' .fc-content').outerWidth();
			var loadingHeight = $('#' + calendarId + ' .fc-content').outerHeight();
			$('#' + calendarId + '_overlay').width(loadingWidth).height(loadingHeight).position({my: 'center', at: 'center', of: '#' + calendarId + ' .fc-content'});
			$('#' + calendarId + '_loading').position({my: 'center', at: 'center', of: '#' + calendarId + ' .fc-content'});
			if (settings.hideTitle) {
				$('#' + calendarId + ' .fc-view table thead').hide();
			}
		});
	});
})(jQuery);

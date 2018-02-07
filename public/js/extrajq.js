(function ($) {
	$.fn.moveToEnd = function () {
		return this.each(function () {
			var v = $(this).val();
			$(this).val("").val(v);
		});
	};
})(jQuery);
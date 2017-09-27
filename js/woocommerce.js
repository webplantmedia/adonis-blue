(function ($) {
	'use strict';

	$(document).ready(function(){
		$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').find('input[type="number"]').attr('type','text').wrap('<div class="quantity-inner">').parent().prepend('<button class="minus"><i class="genericon genericon-expand"></i></button>').append('<button class="plus"><i class="genericon genericon-collapse"></i></button>');

		$('.quantity.buttons_added').on('click', '.plus, .minus', function (e) {
			e.preventDefault();
			var $qty = $(this).closest('.quantity').find('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			if (!currentVal || currentVal === '' || currentVal === 'NaN')
				currentVal = 0;
			if (max === '' || max === 'NaN')
				max = '';
			if (min === '' || min === 'NaN')
				min = 0;
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
				step = 1;

			if ($(this).is('.plus')) {
				if (max && (max === currentVal || currentVal > max)) {
					$qty.val(max);
				} else {
					$qty.val(currentVal + parseFloat(step));
				}
			} else {
				if (min && (min === currentVal || currentVal < min)) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val(currentVal - parseFloat(step));
				}
			}
			$qty.trigger('change');

		});
	});
})(jQuery);
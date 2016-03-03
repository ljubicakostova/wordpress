(function($, undefined){
	$(document).ready(function(){
		$('body').on('change', '.bmi-form input[name=unit]', function(){
			var el = $(this),
				form = el.closest('.bmi-form')
				val = form.find('input[name=unit]:checked').val();
			
			form.find('.bmi-section-metric,.bmi-section-imperial').hide();
			form.find('.bmi-section-metric,.bmi-section-imperial').find('input').attr('required', false);
			form.find('.bmi-section-'+val).show();
			form.find('.bmi-section-'+val).attr('required', true);
		});
		
		$('body').on('submit', '.bmi-form', function(e){
			e.preventDefault();
			
			var form = $(this)
				unit = form.find('input[name=unit]:checked').val(),
				bmi = null,
				height = null,
				weight = null,
				fields = form.serializeArray(),
				data = {},
				result = form.find('.bmi-result');
			
			fields.forEach(function(field){
				data[field.name] = field.value;
			});
			
			if (unit === 'metric') {
				height = parseFloat(data.heightCm) / 100;
				weight = parseFloat(data.weightKg);
			}
			else {
				height = parseFloat(data.heightIn) * 2.54 / 100;
				weight = parseFloat(data.weightLb) / 2.20462;
			}
			
			bmi = weight / height / height;
			
			if (result.css('display') === 'none') {
				result.find('.bmi-number').text(bmi.toFixed(1));
				result.slideDown();
			}
			else {
				result.find('.bmi-result-text').fadeOut(200, function(){
					result.find('.bmi-number').text(bmi.toFixed(1));
					$(this).fadeIn(200);
				});
			}
		});
	});
})(jQuery);

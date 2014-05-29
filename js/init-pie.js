$(function() {
				if (window.PIE) {
					$('#nav ul ul, .arrow-btn a').each(function() {
						PIE.attach(this);
					});
				}
			});
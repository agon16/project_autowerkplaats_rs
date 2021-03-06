/*
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	skel.breakpoints({
		xlarge: '(max-width: 1680px)',
		large: '(max-width: 1280px)',
		medium: '(max-width: 980px)',
		small: '(max-width: 736px)',
		xsmall: '(max-width: 480px)',
		'xlarge-to-max': '(min-width: 1681px)',
		'small-to-xlarge': '(min-width: 481px) and (max-width: 1680px)'
	});

	$(function() {

		var	$window = $(window),
			$head = $('head'),
			$body = $('body');

		// Disable animations/transitions ...

			// ... until the page has loaded.
				$body.addClass('is-loading');

				$window.on('load', function() {
					setTimeout(function() {
						$body.removeClass('is-loading');
					}, 100);
				});

			// ... when resizing.
				var resizeTimeout;

				$window.on('resize', function() {

					// Mark as resizing.
						$body.addClass('is-resizing');

					// Unmark after delay.
						clearTimeout(resizeTimeout);

						resizeTimeout = setTimeout(function() {
							$body.removeClass('is-resizing');
						}, 100);

				});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on medium.
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});

		// Fixes.

			// Object fit images.
				if (!skel.canUse('object-fit')
				||	skel.vars.browser == 'safari')
					$('.image.object').each(function() {

						var $this = $(this),
							$img = $this.children('img');

						// Hide original image.
							$img.css('opacity', '0');

						// Set background.
							$this
								.css('background-image', 'url("' + $img.attr('src') + '")')
								.css('background-size', $img.css('object-fit') ? $img.css('object-fit') : 'cover')
								.css('background-position', $img.css('object-position') ? $img.css('object-position') : 'center');

					});

		// Sidebar.
			var $sidebar = $('#sidebar'),
				$sidebar_inner = $sidebar.children('.inner');

			// Inactive by default on <= large.
				skel
					.on('+large', function() {
						$sidebar.addClass('inactive');
					})
					.on('-large !large', function() {
						$sidebar.removeClass('inactive');
					});

			// Hack: Workaround for Chrome/Android scrollbar position bug.
				if (skel.vars.os == 'android'
				&&	skel.vars.browser == 'chrome')
					$('<style>#sidebar .inner::-webkit-scrollbar { display: none; }</style>')
						.appendTo($head);

			// Toggle.
				if (skel.vars.IEVersion > 9) {

					$('<a href="#sidebar" class="toggle">Toggle</a>')
						.appendTo($sidebar)
						.on('click', function(event) {

							// Prevent default.
								event.preventDefault();
								event.stopPropagation();

							// Toggle.
								$sidebar.toggleClass('inactive');

						});

				}

			// Events.

				// Link clicks.
					$sidebar.on('click', 'a', function(event) {

						// >large? Bail.
							if (!skel.breakpoint('large').active)
								return;

						// Vars.
							var $a = $(this),
								href = $a.attr('href'),
								target = $a.attr('target');

						// Prevent default.
							event.preventDefault();
							event.stopPropagation();

						// Check URL.
							if (!href || href == '#' || href == '')
								return;

						// Hide sidebar.
							$sidebar.addClass('inactive');

						// Redirect to href.
							setTimeout(function() {

								if (target == '_blank')
									window.open(href);
								else
									window.location.href = href;

							}, 500);

					});

				// Prevent certain events inside the panel from bubbling.
					$sidebar.on('click touchend touchstart touchmove', function(event) {

						// >large? Bail.
							if (!skel.breakpoint('large').active)
								return;

						// Prevent propagation.
							event.stopPropagation();

					});

				// Hide panel on body click/tap.
					$body.on('click touchend', function(event) {

						// >large? Bail.
							if (!skel.breakpoint('large').active)
								return;

						// Deactivate.
							$sidebar.addClass('inactive');

					});

			// Scroll lock.
			// Note: If you do anything to change the height of the sidebar's content, be sure to
			// trigger 'resize.sidebar-lock' on $window so stuff doesn't get out of sync.

				$window.on('load.sidebar-lock', function() {

					var sh, wh, st;

					// Reset scroll position to 0 if it's 1.
						if ($window.scrollTop() == 1)
							$window.scrollTop(0);

					$window
						.on('scroll.sidebar-lock', function() {

							var x, y;

							// IE<10? Bail.
								if (skel.vars.IEVersion < 10)
									return;

							// <=large? Bail.
								if (skel.breakpoint('large').active) {

									$sidebar_inner
										.data('locked', 0)
										.css('position', '')
										.css('top', '');

									return;

								}

							// Calculate positions.
								x = Math.max(sh - wh, 0);
								y = Math.max(0, $window.scrollTop() - x);

							// Lock/unlock.
								if ($sidebar_inner.data('locked') == 1) {

									if (y <= 0)
										$sidebar_inner
											.data('locked', 0)
											.css('position', '')
											.css('top', '');
									else
										$sidebar_inner
											.css('top', -1 * x);

								}
								else {

									if (y > 0)
										$sidebar_inner
											.data('locked', 1)
											.css('position', 'fixed')
											.css('top', -1 * x);

								}

						})
						.on('resize.sidebar-lock', function() {

							// Calculate heights.
								wh = $window.height();
								sh = $sidebar_inner.outerHeight() + 30;

							// Trigger scroll.
								$window.trigger('scroll.sidebar-lock');

						})
						.trigger('resize.sidebar-lock');

					});

		// Menu.
			var $menu = $('#menu'),
				$menu_openers = $menu.children('ul').find('.opener');

			// Openers.
				$menu_openers.each(function() {

					var $this = $(this);

					$this.on('click', function(event) {

						// Prevent default.
							event.preventDefault();

						// Toggle.
							$menu_openers.not($this).removeClass('active');
							$this.toggleClass('active');

						// Trigger resize (sidebar lock).
							$window.triggerHandler('resize.sidebar-lock');

					});

				});

	});

})(jQuery);

/**
* Disable character input on keypress
*/
function numericOnly(event) {
	return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0 || event.charCode == 46;
}
function dateOnly(event) {
	return event.charCode >= 48 && event.charCode <= 57;
}

/* Switch user's state -> busy or availabl;e */
function state(id) {
	$.post('backend/state.php', {id:id}, function(data) {
		data = JSON.parse(data);
		if(data.busy == "yes") {
			$('#busy').addClass('special');
			$('#busy').html('Set status: <u>Beschikbaar</u>');
		} else if(data.busy == "no") {
			$('#busy').removeClass('special');
			$('#busy').html('Set status: <u>Bezig</u>');
		}
	});
}

/**
* Login
*/
$(function() {
	$('#formSubmit').submit(function(e) {
		e.preventDefault();

		var email = $('#email').val(),
		password = $('#password').val();

		$.post('backend/login.php', 
			{
				email: email,
				password: password
			}, function(data) {
				data = JSON.parse(data);
				if(data.result == 'true') {
					startRotation();

					$('.box').html('<p style="text-align: center;">U wordt ingelogd ...</p>');
					$('.box').slideDown(500);

					setTimeout(function() {
						window.location = 'dashboard.php';
					}, 2500);
					
				} else if(data.result == 'false') {
					stopRotation();

					$('.box').html('<p style="text-align: center;">Ga na dat alle velden juist zijn.</p>');
					$('.box').slideDown(500);

					setTimeout(function() {
						$('.box').slideUp(500);
					}, 3000);

				} else {
					alert("Some error");
				}
		});
	});
});

/**
* Datepicker
*/
$( function() {
	$( ".datepicker" ).datepicker();
	$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
});

/**
* Upload button
* Pass the button onclick to open the file input
* to upload an image
*/
$(function() {
	$('#btnUpload').click(function() {
		$('[name="photo"]').click();
	});
});

/**
* Password verify
*/
$(function() {
	$('#password1').on('keyup', function() {
		if($('#password2').val() == $('#password1').val()) {
			$('.special').removeClass('disabled', '');
		} else {
			$('.special').addClass('disabled', '');
		}
	});
});

$(function() {
	$('#password2').on('keyup', function() {
		if($('#password2').val() == $('#password1').val()) {
			$('.special').removeClass('disabled', '');
		} else {
			$('.special').addClass('disabled', '');
		}
	});
});

/**
* jQuery rotation
*/
var startRotation = function (){
  $("#border").rotate({
    angle:0,
    animateTo:24,
    callback: startRotation,
    easing: function (x,t,b,c,d) {
      return c*(t/d)+b;
    }
  });
}
startRotation();

var stopRotation = function (){
  $("#border").rotate({
    angle:0,
    animateTo:0,
    callback: stopRotation,
    easing: function (x,t,b,c,d) {
      return c*(t/d)+b;
    }
  });
}
stopRotation();

/**
* Werkzaamheden
*/
$('#werkzaamheden_car').click(function() {
	$('#car_id').removeAttr('required');
});

/**
* Add car
*/
$('#register_car').click(function() {
	$('#person_id').removeAttr('required');
	$('#license_plate').removeAttr('required');
	$('#car_model').removeAttr('required');
	$('#sachi').removeAttr('required');
	$('#company').removeAttr('required');
});
$('#register_company').click(function() {
	$('#person_id').removeAttr('required');
	$('#license_plate').removeAttr('required');
	$('#car_model').removeAttr('required');
	$('#sachi').removeAttr('required');
	$('#company').removeAttr('required');
});

var remove = {
	user: function(id, user) {
		swal({
		  title: 'Bent u zeker dat u '+user+' wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  swal(
		    'Verwijderd!',
		    user+' is verwijderd.',
		    'success',
		    setTimeout(function() {
		    	window.location = 'delete/delete_user.php?id='+id;
		    }, 650)
		  )
		})
	},
	car: function(id, car) {
		swal({
		  title: 'Bent u zeker dat u '+car+' wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  swal(
		    'Verwijderd!',
		    car+' is verwijderd.',
		    'success',
		    setTimeout(function() {
		    	window.location = 'delete/delete_car.php?id='+id;
		    }, 650)
		  )
		})
	},
	company: function(id, company) {
		swal({
		  title: 'Bent u zeker dat u '+company+' wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
			$.post('delete/delete_company.php?id='+id, {id: id}, function(data) {
		  	data = JSON.parse(data);
		  	if(data.result == 1) {
		  		swal(
				    'Verwijderd!',
		    		company+' is verwijderd.',
				    'success',
				    setTimeout(function() {
				    	window.location = 'overview_companies.php';
				    }, 650)
			 	)
		  	} else {
		  		swal(
				  'Melding',
				  'Bedrijf mag alleen verwijderd tenzij het niet is geassocieerd met een geregistreerde auto.',
				  'error'
				)
		  	}
		  })
		})
	},
	role: function(id, role) {
		swal({
		  title: 'Bent u zeker dat u de '+role+' rol wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  $.post('delete/delete_role.php?id='+id, {id: id}, function(data) {
		  	data = JSON.parse(data);
		  	if(data.result == 1) {
		  		swal(
				    'Verwijderd!',
				    role+' is verwijderd.',
				    'success',
				    setTimeout(function() {
				    	window.location = 'overview_roles.php';
				    }, 650)
			 	)
		  	} else {
		  		swal(
				  'Melding',
				  'Gebruiker rol mag alleen verwijderd tenzij het niet is geassocieerd met een registreerde gebruiker in het systeem.',
				  'error'
				)
		  	}
		  })
		})
	},
	car_model: function(id, car_model) {
		swal({
		  title: 'Bent u zeker dat u de '+car_model+' model wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  $.post('delete/delete_car_model.php?id='+id, {id: id}, function(data) {
		  	data = JSON.parse(data);
		  	if(data.result == 1) {
		  		swal(
				    'Verwijderd!',
				    car_model+' is verwijderd.',
				    'success',
				    setTimeout(function() {
				    	window.location = 'overview_car_models.php';
				    }, 650)
			 	)
		  	} else {
		  		swal(
				  'Melding',
				  'Auto model mag alleen verwijderd tenzij het niet is geassocieerd met een geregistreerde auto.',
				  'error'
				)
		  	}
		  })
		})
	},
	activity: function(id, activity) {
		swal({
		  title: 'Bent u zeker dat u de '+activity+' activiteit wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  swal(
		    'Verwijderd!',
		    activity+' activiteit is verwijderd.',
		    'success',
		    setTimeout(function() {
		    	window.location = 'delete/delete_activity.php?id='+id;
		    }, 650)
		  )
		})
	},
	towed_car: function(id) {
		swal({
		  title: 'Bent u zeker dat u deze sleep actie wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  swal(
		    'Verwijderd!',
		    'Sleep activiteit is verwijderd.',
		    'success',
		    setTimeout(function() {
		    	window.location = 'delete/delete_towed_car.php?id='+id;
		    }, 650)
		  )
		})
	},
	inspected_car: function(id) {
		swal({
		  title: 'Bent u zeker dat u deze keuring data wilt verwijderen?',
		  text: "Deze actie kunt u niet ongedaan maken",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#f0f0f0',
		  cancelButtonColor: '#D67373',
		  confirmButtonText: 'Ja!',
		  cancelButtonText: 'Nee!'
		}).then(function () {
		  swal(
		    'Verwijderd!',
		    'Keuring data is verwijderd.',
		    'success',
		    setTimeout(function() {
		    	window.location = 'delete/delete_inspection.php?id='+id;
		    }, 650)
		  )
		})
	}
};
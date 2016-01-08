;(function($) {
	"use strict";

	$(document).on('ready', function() {

		$( window ).on( 'load', function() {
			var $preloader = $( '.js-preloader' );
			$preloader.addClass( 'preloader-done' );
		});

		if ( $.fn.backstretch ) {

			var backstretch_autoheight = function() {
				$('.js-backstretch').each(function(i, el) {
					var $el = $(el),
					header = $('#header').outerHeight(),
					adminbar = $('#wpadminbar').outerHeight();
					$el.css('height',$(window).height()-header-adminbar);
				});
			}

			$('.js-backstretch').each(function(i, el) {
				var $el = $(el),
				    images = $el.data('images').split('\n');
				$el.backstretch(images, {duration: 3000, fade: 750});
			});

			backstretch_autoheight();

			$( window ).on( 'resize', function (){ backstretch_autoheight(); });
		}

		if ( $.fn.countdown ) {
			$('.js-countdown').each(function(i, el) {
				var $el = $(el),
				    datediff = $el.attr('data-diff');
				if (datediff > 0) {
					$el.countdown({until: +datediff, format: 'ODHMS'});
				} else {
					$el.countdown({since: datediff, format: 'ODHMS'});
				}
			});
		}

		if ( $.fn.parallax && loveydovey.is_mobile_or_tablet == 'false') {
			$( window ).on( 'load', function() {
				$( '.parallax-background' ).each(function() {
					var $this = $( this );
					$this.parallax( '50%', 0.5 );
				});
			});
		}

		if ( $.fn.justifiedGallery ) {

			$('.js-justifiedgallery').each(function(i, el) {
				var $el = $(el),
					jg_options;

				jg_options = {
					margins: 10,
					rowHeight: 200,
					lastRow: 'nojustify',
					captions: true,
					sizeRangeSuffixes: {
						'lt100':'',
						'lt240':'',
						'lt320':'',
						'lt500':'',
						'lt640':'',
						'lt1024':'',
					},
				};

				if ( $el.data('orderby') == 'rand' ) {
					jg_options['randomize'] = true;
				};

				$el.justifiedGallery(jg_options);

				$el.magnificPopup({
					delegate: 'a',
					type: 'image',
					gallery: {
						enabled: true,
						navigateByImgClick: false
					},
					image: {
						titleSrc: function(item) { return item.el.find('img').attr('alt'); }
					},
					closeBtnInside: false,
					mainClass: 'mfp-with-zoom',
					prependTo: '#popup-document',
					zoom: {
						enabled: true,
						duration: 300,
						easing: 'ease-in-out',
						opener: function(openerElement) {
							return openerElement.is('img') ? openerElement : openerElement.find('img');
						}
					}
				});
			});
		}
		$( '.navbar-floating-anchor' ).waypoint(function( direction ) {
			var $navbar = $( '#navbar' );

			if ( direction == 'down' ) {
				$navbar.css( 'top', $( 'body' ).offset().top ).addClass( 'floating' );
			} else if ( direction == 'up' ) {
				$navbar.css( 'top', '0').removeClass( 'floating' );
			};
		}, { offset: $( 'body' ).offset().top });

		if ( $.fn.isotope ) {
			$( '.js-isotope-grid' ).each(function() {

				var $el = $( this );

				$el.isotope();
				$el.imagesLoaded(function() {
					$el.isotope( 'layout' );
				});

			});
		}

		if ( $.fn.gmap3 ) {
			$( '.js-gmap' ).each(function( i, el ) {
				var $el = $( el ),
				    zoom = $el.data( 'zoom' ),
				    lat = $el.data( 'lat' ),
				    lng = $el.data( 'lng' ),
				    scroll = $el.data( 'scroll' ),
				    options;

				options = {
					map: {
						options: {
							center: [ lat, lng ],
							zoom: zoom,
							mapTypeControl: false,
							scrollwheel: scroll,
							streetViewControl: false,
							panControl: false,
							zoomControl: true,
							zoomControlOptions: {
								position: google.maps.ControlPosition.LEFT_CENTER,
								style: google.maps.ZoomControlStyle.SMALL,
							},
						}

					},
					marker: {
						latLng: [ lat, lng ],
					}
				}

				$el.gmap3( options );
			});

			$('.open-map').each(function( i , el ) {
				var $el = $(el);

				$el.magnificPopup({
					type:'inline',
					prependTo: '#popup-document',
					midClick: true,
					mainClass: 'popup-gmap',
					callbacks: {
						open: function() {
							var $map = $( $el.attr('href') ).find('.js-gmap');

							$map.gmap3({ trigger: "resize" });

							var marker = $map.gmap3({get:"marker"});
							var map = $map.gmap3("get");
							map.setCenter(marker.getPosition());
						}
					},
				});

			});
		}
		$( '.guestbook-form .ninja-forms-form' ).on('submitResponse.guestbook', function( e, response )	{
			if ( response.errors == false ) {
				var $this = $(this),
				    name_id = loveydovey.gb_name_id,
				    message_id = loveydovey.gb_message_id,
				    name = response.fields[name_id],
				    message = response.fields[message_id],
				    $guestbook_entry = $('<div class="guestbook-entry"><p class="guestbook-message">' + message + '</p><div class="guestbook-name">'+name+'</div></div><div class="separator list-guestbook-separator"><b></b><span><i class="fa fa-heart"></i></span><b></b></div>'),
				    $el = $this.parents('.guestbook-form').next('.list-guestbook-entries');
				$guestbook_entry.prependTo($el);
			}
			return true;
		});
	});

}(jQuery));

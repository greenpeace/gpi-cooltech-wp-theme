(function($, root, undefined) {

  $(function() {

    'use strict';

    $(document).ready(function() {

      $('#responsive-menu-button').sidr();
      $(".close_menu").click(function() {
        console.log("cliccoaaa chiudi");
        jQuery.sidr('close', 'sidr');
        $('#responsive-menu-button').sidr("close");
      });
      jQuery(window).resize(function() {
        jQuery.sidr("close", "sidr");
      });


      function startCounter(counterElement) {

        // Check if it has only just become visible on this scroll
        //if (counterElement.hasClass("notVisible")) {

        // Remove notVisible class
        //  counterElement.removeClass("notVisible");

        // Run your counter animation

        //	console.log(counterElement.text());

        counterElement.prop('Counter', 0).animate({
          Counter: counterElement.text()
        }, {
          duration: 400,
          easing: 'swing',
          step: function(now) {
            counterElement.text(Math.ceil(now).toLocaleString());
          }
        });
      }

      /*	$('#mn1')
      	  .animateNumber(
      	    {
      	      number: 2500,
      	      numberStep: function(now, tween) {
      	        // see http://stackoverflow.com/a/14428340
      	        var formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
      	        $(tween.elem).text('$' + formatted);
      	      }
      	    },
      	    20000
      	  ); */

      /*	$('.magic-number').each(function () {
          $(this).prop('Counter',0).animate({
              Counter: $(this).text()
          }, {
              duration: 400,
              easing: 'swing',
              step: function (now) {
                  $(this).text(Math.ceil(now).toLocaleString());
              }
          });
      }); */



      var waypoints = $('.wp-block-cgb-block-magic-numbers').waypoint({
        handler: function(direction) {
          //notify(this.element.id + ' hit');
          console.log("RAGGIUNTO");
          $('.magic-number').each(function() {
            startCounter($(this));
          });
        },
        offset: 100
      })


      $('ul#main-menu>li a').on('hover', function() {
        //	$('ul#main-menu>li').removeClass("show");
      });
      $('li.dropdown a').on('hover', function() {
        $(this).parent().addClass("show");
        console.log("metti lo show da a");
      });
      $('ul.dropdown-menu').on('mouseleave', function() {
        $(this).parent().removeClass("show");
        console.log("esco dal nero");
      });
      var indirizzo = "http://127.0.0.1/wp-greenpeace/wordpress/wp-admin/admin-ajax.php";
      $(".filter2").change(function() {
        $.ajax({
          type: 'POST',
          url: indirizzo,
          data: {
            manufacturer: $("#manufacturer").val(),
            refrigerant: $("#refrigerant").val(),
            country: $("#country").val(),
            application: $("#application").val(),
            action: 'filterElements'
          },
          success: function(data, textStatus, XMLHttpRequest) {
            //alert(data);
            console.log(data);
            //  jQuery("#label-result").css("display", "block");
            //	len = data.length;
            //	data = data.substring(0, len - 1);
            //	obj = jQuery.parseJSON(data);

            // creaLista(obj);
            //	creaPreventivo(obj[0].prezzo, persone);
            // alert(obj);
            // alert(obj.post_title[0]);
          },
          error: function(MLHttpRequest, textStatus, errorThrown) {
            //        alert(errorThrown);
          }
        });
      });

      $(".select-filter").on({
        "change": function() {
          $(this).blur();
        },
        'click': function() {
          console.log("displayed");
          $(this).parent().toggleClass("active");
        },
        "blur": function() {
          console.log("not displayed");
        },
        "keyup": function(e) {
          if (e.keyCode == 27)
            console.log("displayed");
        }
      });

      $(".expand_text").click(function() {
        $(this).parent().parent().siblings(".equipment_full_text").toggleClass("expanded");
      });

      /* display the selected elements in categories */
      $(".select-filter").change(function() {
        /* reset all the elements */
        $(".element").css("display", "block");
        $(".select-filter").each(function(index) {
          //	console.log( index + ": " + $( this ).val() );
          if ($(this).val() != 0) {
            $(".element:not(." + $(this).val() + ")").css("display", "none");
          }
        });

      });
      var searchRequest;

      /*				$('.search-autocomplete').autoComplete({
      						minChars: 2,
      						source: function(term, suggest){
      							try { searchRequest.abort(); } catch(e){}
      							searchRequest = $.post(indirizzo, { search: term, action: 'search_site' }, function(res) {
      								suggest(res.data);
      							});
      						}
      					});
      */
      /*
      var availableTags = [
      		"ActionScript",
      		"AppleScript",
      		"Asp",
      		"BASIC",
      		"C",
      		"C++",
      		"Clojure",
      		"COBOL",
      		"ColdFusion",
      		"Erlang",
      		"Fortran",
      		"Groovy",
      		"Haskell",
      		"Java",
      		"JavaScript",
      		"Lisp",
      		"Perl",
      		"PHP",
      		"Python",
      		"Ruby",
      		"Scala",
      		"Scheme"
      	];
      	$( ".search-autocomplete" ).autocomplete({
      		source: availableTags
      	}); */



      wp.blocks.registerBlockStyle('core/quote', {
        name: 'fancy-quote',
        label: 'Fancy Quote'
      });


      /*
      	$( ".search-autocomplete" ).autocomplete({
            source: function( request, response ) {
              $.ajax( {
      					type: 'POST',
                url: indirizzo,
                data: {
                  search: request.term,
      						action: 'search_site'
                },
                success: function( data ) {
      						console.log("uuueeee");
      						console.log(data);
                  response( data.data );
                }
              } );
            },
            minLength: 2,
            select: function( event, ui ) {
              log( "Selected: " + ui.item.value + " aka " + ui.item.id );
            }
          } );
      /*



      var $grid = $('#grid').isotope({
        itemSelector: '.card',
       percentPosition: true,
       masonry: {
      	// use element for option
      	columnWidth: '.card'
      }

      });
      // filter functions
      var filters = {};


      $('.filters').on( 'change', function( event ) {
        var $select = $( event.target );
        // get group key
        var filterGroup = $select.attr('value-group');
        // set filter for group
        filters[ filterGroup ] = event.target.value;
        // combine filters
        var filterValue = concatValues( filters );
        // set filter for Isotope
        $grid.isotope({ filter: filterValue });
      });

      // flatten object by concatting values
      function concatValues( obj ) {
        var value = '';
        for ( var prop in obj ) {
          value += obj[ prop ];
        }
        return value;
      }
      /*
      var $grid=$('#grid').masonry({
        // options
        itemSelector: '.card',
      	columnWidth: '.w-33',

      });
      $grid.on( 'layoutComplete',
        function( event, laidOutItems ) {
          console.log( 'Masonry layout completed on ' +
            laidOutItems.length + ' items' );
        }
      );

      var masonryUpdate = function() {
          setTimeout(function() {
              $('#grid').masonry({itemSelector: '.card',	columnWidth: '.w-33',});
          }, 0);
      } */




      /*	var el = document.querySelector('.odo');
      		od = new Odometer({ el: el, value: 1200,
      	// Any option (other than auto and selector) can be passed in here
      		theme: 'default'
      		});

      		console.log("odometer letto"); */
      //od.update(555)
      //	 or
      //		el.innerHTML = 555


    });

  });

})(jQuery, this);

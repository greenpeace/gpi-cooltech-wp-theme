(function($, root, undefined) {

    $(function() {

        'use strict';

        $(document).ready(function() {


				/* MOBILE MENU */
            $('#responsive-menu-button').sidr();
            $(".close_menu").click(function() {
                jQuery.sidr('close', 'sidr');
                $('#responsive-menu-button').sidr("close");
            });
            $(window).resize(function() {
                jQuery.sidr("close", "sidr");
            });


						function isElementVisible($elementToBeChecked) {
						    var TopView = $(window).scrollTop();
						    var BotView = TopView + $(window).height();
						    var TopElement = $elementToBeChecked.offset().top;
						    var BotElement = TopElement + $elementToBeChecked.height();
						    return ((BotElement <= BotView) && (TopElement >= TopView));
								}

								$(window).scroll(function () {
								    $( ".magic-number" ).each(function() {
								    var isOnView = isElementVisible($(this));
								        if(isOnView && !$(this).hasClass('Starting')){
								           $(this).addClass('Starting');
													 	console.log("visibile");
								          	startCounter($(this));
								        }
								    });
								});

						/* MAGIC NUMBERS */
            function startCounter(counterElement) {
                var inizio = counterElement.text();
              //  console.log(counterElement.text());
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
                      //  console.log(inizio);
                        // console.log("%"+z%1);
                        if (inizio % 1 == 0) {
                            counterElement.text(Math.ceil(now));
                        } else {
                            //  counterElement.text((now).toLocaleString());
                            counterElement.text(Math.round(now * 10) / 10);
                        }

                    }
                });
            }

      /*      var waypoints = $('.wp-block-cooltech-block-magic-numbers').waypoint({
                handler: function(direction) {
                    //notify(this.element.id + ' hit');
                  //  console.log("RAGGIUNTO");
                    $('.magic-number').each(function() {
                        startCounter($(this));
                    });
                },
                offset: 100
            }) */

						/* MENU */
            $('li.dropdown').on('hover', function() {
						//	$("#submenu-bar").children().remove();
						//	console.log("mouseenter");
          //     $(this).children("ul").css("display","table");
					//	var sub=$(this).children("ul").children("li").children("a");
					//		$("#submenu-bar").append(sub.clone());
					//		$(this).append($("#submenu-bar"));
            });
						$('li.dropdown').on('mouseout', function() {
							//	console.log("mouseout dropdwon");
							//	$(".submenu").children().remove();
							//	$(".submenu").remove();
							 $("ul.dropdown-menu").css("display","none");
						});
				/*		$('li.dropdown a').on('mouseout', function() {
								$(this).parent().removeClass("show");
								console.log("mouseout li");
						});

            $('li.dropdown a').on('mouseenter', function() {
                $(this).parent().addClass("show");
                console.log("mousenter a");
            });
            $('ul.dropdown-menu').on('mouseleave', function() {
                $(this).parent().removeClass("show");
                console.log("mouseleave ul");
            }); */

						/* page case study */



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

      /*      $(".select-filter").on({
                'click': function() {
                    console.log("displayed");
                    $(this).parent().toggleClass("active");
                },
            }); */

            $(".expand_text").click(function() {
                $(this).parent().parent().siblings(".equipment_full_text").toggleClass("expanded");
            });

						$(".selectable").click(function() {
							//	jQuery('html, body').stop().animate({
						//	scrollTop: jQuery("#case-study-results-title").offset().top
					//}, 1000, 'linear');
									console.log(this.id);
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

        });

    });

})(jQuery, this);

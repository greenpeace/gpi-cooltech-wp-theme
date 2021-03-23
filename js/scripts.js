(function($, root, undefined) {

    $(function() {

        'use strict';

        $(document).ready(function() {

          console.log("reeeddy");
				/* MOBILE MENU */
            $('#responsive-menu-button').sidr();

            $(".close_menu").click(function() {
                jQuery.sidr('close', 'sidr');
                $('#responsive-menu-button').sidr("close");
            });
            $(window).resize(function() {
                jQuery.sidr("close", "sidr");
            });

            function expandInformation() {
              $(this).parent().parent().parent().siblings(".equipment_full_text").toggleClass("expanded");
              $(this).toggleClass("btn--active");
              if ($(this).hasClass("btn--active")) {
                $(this).text("Less Information");
              } else {
                $(this).text("More Information");
              }
            }

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
													// 	console.log("visibile");
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
						/* page case study */
            var append=0;

            $(".select-filter").change(function() {
                let id=$(this).val();
                let t=$(this).find('option:selected').text();
                let f=$(this).find('option:first').text();

                $("#filter-"+this.id).remove();

                if(t!=f) {
                  append++;
                  var azione="agg";
                } else {
                  append--;
                  var azione="togli";
                }

                if(append==1 && azione=="agg") {
                  $("#filters").append("<span class='filter-label'>filters: </span>");
                }
                if(append==0 && azione=="togli") {
                  $(".filter-label").remove();
                }
                if(t!=f) {
                  $("#filters").append("<span class='filter-element' id='filter-"+this.id+"'>"+t+"</span>");
                }

                $("#results").empty();
                $(".infinite-loading").show();
                $.ajax({
                    type: 'POST',
                    url: ajax_url,
                    data: {
                        manufacturer: $("#manufacturer").val(),
                        refrigerant: $("#refrigerant").val(),
                        country: $("#country").val(),
                        application: $("#application").val(),
                        sector:$("#sector").val(),
                        tt:$("#technology-type").val(),
                        type:$("#type").val(),
                        action: 'filterElements',
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        var len = data.length;
                    	  data = data.substring(0, len - 1);
                        // alert("aaaaaa");

                        // console.log("aggiungo da script.js");
                        $(".infinite-loading").hide();
                    //    var obj = jQuery.parseJSON(data);
                        $("#results").empty();

                  //      console.log(obj.post);
                        if(!data) {
                          $('#results').append("<div class='no-product'>No products found</div>");
                        } else {
                          $('#results').append(data);
                        }

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


            $(document).on("click", ".expand_text", function() {
                $(this).parent().parent().parent().siblings(".equipment_full_text").toggleClass("expanded");
                $(this).toggleClass("btn--active");
                if ($(this).hasClass("btn--active")) {
                  $(this).text("Less Information");
                } else {
                  $(this).text("More Information");
                }
              });

						$(".selectable").click(function() {
							//	jQuery('html, body').stop().animate({
						//	scrollTop: jQuery("#case-study-results-title").offset().top
					//}, 1000, 'linear');
									console.log(this.id);
						});



            /* display the selected elements in categories
          $(".select-filter").change(function() {

                $(".element").css("display", "block");
                $(".select-filter").each(function(index) {
                    //	console.log( index + ": " + $( this ).val() );
                    if ($(this).val() != 0) {
                        $(".element:not(." + $(this).val() + ")").css("display", "none");
                    }
                });

            }); */

        });

    });

})(jQuery, this);

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

            function expandInformation() {
              $(this).parent().parent().siblings(".equipment_full_text").toggleClass("expanded");
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
						/* page case study */

            $(".select-filter").change(function() {
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
                        dataType: 'json'
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        var len = data.length;
                    	  data = data.substring(0, len - 1);
                        // alert("aaaaaa");

                        console.log(data);

                        var obj = jQuery.parseJSON(data);
                        $("#results").empty();

                        console.log(obj.post);
                        for(let x=0;x<obj.length;x++) {
                          var wrapper="<article class='element "+obj[x].post.post_type+"' id=''><div class='row d-lg-none'><div class='col-md-12'>";
                          var wrapper_close="</div></div></div></article>";


                          var sector="<h2 class='result_title'>"+obj[x].post.post_title+"</h2> </div></div><div class='row'><div class='col-md-3'><h2 class='result_title d-none d-sm-none d-md-none d-lg-block'>"+obj[x].post.post_title+"</h2><button class='air-conditioning expand_text btn btn-rounded btn-outline-dark' > More Information</button></div><div class='col-md-3'><div class='result_meta_title'>Sector</div><div class='result_meta_content'>"+obj[x].sector+"</div><div class='result_meta_title'>Application</div><div class='result_meta_content'>"+obj[x].application+"</div><div class='result_meta_title'>Technology Type </div><div class='result_meta_content'>"+obj[x].technology_type+"</div></div><div class='col-md-3'><div class='result_meta_title'>Refrigerant</div><div class='result_meta_content'>"+obj[x].refrigerant+"</div><div class='result_meta_title'>Manufacturer</div><div class='result_meta_content'>"+obj[x].manufacturer+"															</div>	<div class='result_meta_title'>		Country								</div><div class='result_meta_content'>	"+obj[x].country+"												</div>	</div>	<div class='col-md-3'><div class='result_meta_title'>Energy Efficency</div>	<div class='result_meta_content'>"+obj[x].energy_efficency+"</div></div></div><div class='equipment_full_text'><div class='row'><div class='col-sm-3'></div><div class='col-sm-9'><div><p>"+obj[x].post.post_content+"</p></div>";

                          var element=wrapper+sector;

                          if(obj[x].source) {
                          var source="<div class='result_meta_title'><a title='' target='_blank'>Source</a></div><div class='result_meta_content result_source'><a href='"+obj[x].source+"'>"+obj[x].source+"</a></div>";
                          element=element+source;
                          }
                          if(obj[x].web) {
                          var web="<div class='result_meta_title'>Website</div><div class='result_meta_content result_web'><a href='web' target='_blank'>"+obj[x].web+"</a></div>";
                          element=element+web;
                          }
                          element=element+wrapper_close;
                          $("#results").append(element);
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
                $(this).parent().parent().siblings(".equipment_full_text").toggleClass("expanded");
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

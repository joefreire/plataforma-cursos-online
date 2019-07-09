//----------------------------------
//   File          : js/core/app/layout.js
//   Type          : Layout configuration JS file
//   Version       : 2.0.0
//   Last Updated  : August 7, 2017
//----------------------------------

// ---------------------------------
// Table of contents
// ---------------------------------
// 1. Handheld devices menu toggle
// 2. Material menu
// 3. Dropdown menu
// 4. Dropdown label menu
// 5. Megamenu
// 6. Iconic menu
// 7. Sidebar menu
// 8. Boxed menu
// 9. Iconbar menu
// 10. Default menu (material)


jQuery(document).ready(function($) {
	'use strict';

	var totalWidth = $(window).width(),
		layout = $('.layout').css("font-family"),
		secondary_sidebar_width = 200;


	// ---------------------------------
	// 1. Handheld devices menu toggle
	// ---------------------------------
    $(".left-toggle-switch").hammer().on("click touchstart", function(e) {
        e.preventDefault();
        if ($("body").hasClass("left-aside-toggle")) {
            $("body").removeClass("left-aside-toggle");
        } else {
            $("body").addClass("left-aside-toggle");
        }
    });

    function AsideHeight() {
        var TopBarHeight = $('.main-nav').height(),
	        calc_wh = wh - TopBarHeight,
			menuMargin = $('header').outerHeight(),
			containerMargin = $('.main-nav').outerHeight(),
			menuHeight = wh - menuMargin;

        $(window).resize(function() {
            if($(window).width() < 801) {
                $(".menu").css({
                    "height": wh + "px"
                });
				$(".main-container").css('margin-top', containerMargin);
				$(".user-profile").load("menus/sidebar-user-profile.php");
				//$(".menu-container").load("menus/material-sidebar.php");
				$('.left-aside-container').slimscroll({
					height: calc_wh + 50,
					width: "250px"
					}).mouseover(function() {
					$(this).next('.slimScrollBar');
				});

				if ($.fn.navAccordion) {
					$('.sidebar-accordion').each(function() {
						$(this).navAccordion({
							eventType: 'click',
							hoverDelay: 100,
							autoClose: true,
							saveState: false,
							disableLink: true,
							speed: 'fast',
							showCount: false,
							autoExpand: true,
							classExpand: 'acc-current-parent'
						});
					});
				}


				var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

				$(".sidebar ul.sidebar-accordion li a").each(function(){
					if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
					{
						$(this).addClass(" active");
						$(this).parent().parent().css("display","block");
						$(this).parent().parent().parent().addClass(" active");
						$(this).parent().parent().parent().parent().css("display","block");
						$(this).parent().parent().parent().parent().parent().addClass(" active");
					}
				})

				$(".leftmenu ul.sidebar-accordion li a").each(function(){
					if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
					{
						$(this).addClass(" active");
						$(this).parent().parent().css("display","block");
						$(this).parent().parent().parent().addClass(" active");
						$(this).parent().parent().parent().parent().css("display","block");
						$(this).parent().parent().parent().parent().parent().addClass(" active");
					}
				})

				if($(window).width() == 800) {
					$(".container-sidebar").css({
						"height": "100%",
						"width": "200px",
						"position": "fixed",
						"float": "left"
					});

					$('.secondary-sidebar').slimscroll({
						height: calc_wh,
						width: "200px"
						}).mouseover(function() {
						$(this).next('.slimScrollBar');
					});

					$(".container-aside").css({
						"width": totalWidth - secondary_sidebar_width,
						"margin-left": secondary_sidebar_width,
						"float": "left"
					});
				}
            }

            else if(($(window).width() >= 1024)){

				// ---------------------------------
				// 2. Material menu
				// ---------------------------------
				if(layout == "material"){
			        $(".menu").addClass(" sidebar");
					$(".user-profile").load("menus/sidebar-user-profile.php");
					//$(".menu-container").load("menus/material-sidebar.php");
					$(".sidebar").css({
	                    "height": menuHeight ,
						"top": menuMargin
	                });
					$(".main-container").css('margin-top', containerMargin);
	                $('.sidebar .left-aside-container').slimscroll({
	                    height: menuHeight + 12,
	                    width: "220px"
	                    }).mouseover(function() {
	                    $(this).next('.slimScrollBar');
	                });
					var sidebar_width = 220;

					if ($.fn.navAccordion) {
                        $('.sidebar-accordion').each(function() {
                            $(this).navAccordion({
                                eventType: 'click',
                                hoverDelay: 100,
                                autoClose: true,
                                saveState: false,
                                disableLink: true,
                                speed: 'fast',
                                showCount: false,
                                autoExpand: true,
                                classExpand: 'acc-current-parent'
                            });
                        });
                    }


                    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

                    $(".sidebar ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })

                    $(".leftmenu ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })
			    }


				// ---------------------------------
				// 3. Dropdown menu
				// ---------------------------------
			    else if(layout == 'dropdown'){
			        $(".menu").addClass(" dd");
					$(".menu").css('top', menuMargin);
					$(".main-container").css('margin-top', containerMargin);
					//$(".menu-container").load("menus/dropdown.php");
					var sidebar_width = 0;

					var navMargin = $('#main-menu').outerHeight();
					$(".main-container").css('padding-top', navMargin);

					var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
					$("#main-menu li a").each(function(){
					    if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
					    {
					        $(this).addClass(" active");
					        $(this).parent().parent().parent().addClass(" active");
					        $(this).parent().parent().parent().parent().parent().addClass(" active");
					        $(this).parent().parent().parent().parent().parent().parent().parent().addClass(" active");
					    }
					});
			    }


				// ---------------------------------
				// 4. Dropdown label menu
				// ---------------------------------
			    else if(layout == 'dropdown_label'){
					$(".menu").addClass(" dd");
					$(".menu").css('top', menuMargin);
					$(".main-container").css('margin-top', containerMargin);
					//$(".menu-container").load("menus/dropdown.php");
					var sidebar_width = 0;

					var navMargin = $('#main-menu').outerHeight();
					$(".main-container").css('padding-top', navMargin);

					var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
					$("#main-menu li a").each(function(){
					    if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
					    {
					        $(this).addClass(" active");
					        $(this).parent().parent().parent().addClass(" active");
					        $(this).parent().parent().parent().parent().parent().addClass(" active");
					        $(this).parent().parent().parent().parent().parent().parent().parent().addClass(" active");
					    }
					});
			    }


				// ---------------------------------
				// 5. Megamenu
				// ---------------------------------
				else if(layout == 'megamenu'){
			        $(".menu").addClass(" megamenu");
					$(".menu").css('top', menuMargin);
					$("ul.main-menu").css('top', menuMargin);
					$(".main-container").css('margin-top', containerMargin);
					//$(".menu-container").load("menus/megamenu.php");
					var sidebar_width = 0;

					var navMargin = $('#horizontalMenu').outerHeight();
					$(".main-container").css('padding-top', navMargin);

					$(function () {
					    menuOpen();
					});
					function menuOpen() {
					    $('.dropdown').on('show.bs.dropdown', function (e) {
					        if ($(window).width() > 750) {
					            $(this).find('.dropdown-menu').first().stop(true, true).fadeIn('slow');
					        }
					        else {
					            $(this).find('.dropdown-menu').first().stop(true, true).show('slow');
					        }
					    });
					    $('.dropdown').on('hide.bs.dropdown', function (e) {
					        if ($(window).width() > 750) {
					            $(this).find('.dropdown-menu').first().stop(true, true).fadeOut('slow');
					        }
					        else {
					            $(this).find('.dropdown-menu').first().stop(true, true).hide('slow');
					        }
					    });
					}
			    }


				// ---------------------------------
				// 6. Iconic menu
				// ---------------------------------
			    else if(layout == 'iconic'){
					$("body").addClass(" iconic-view");
					$(".menu").addClass(" iconic-leftbar");
					$(".main-container").css('margin-top', containerMargin);
					$(".iconic-leftbar").css('margin-top', containerMargin);
					$(".user-profile").load("menus/sidebar-user-profile.php");
					//$(".menu-container").load("menus/iconic.php");
					$('ul.sidemenu-sub').slimscroll({
						height: menuHeight + 10,
						width: "200px"
						}).mouseover(function() {
						$(this).next('.slimScrollBar');
					});
					var sidebar_width = 60;

					if ($.fn.navAccordion) {
					    $('.list-accordion').each(function() {
					        $(this).navAccordion({
					            eventType: 'click',
					            hoverDelay: 100,
					            autoClose: true,
					            saveState: false,
					            disableLink: true,
					            speed: 'fast',
					            showCount: false,
					            autoExpand: true,
					            classExpand: 'acc-current-parent'
					        });
					    });
					}
			    }


				// ---------------------------------
				// 7. Sidebar menu
				// ---------------------------------
			    else if(layout == 'sidebar'){
			        $(".menu").addClass(" leftmenu");
					//$(".menu-container").load("menus/material-sidebar.php");
					$(".main-container").css('margin-top', containerMargin);
					$(".leftmenu").css({
	                    "height": menuHeight +1,
						"top": menuMargin
	                });
	                $('.leftmenu .left-aside-container').slimscroll({
	                    height: menuHeight + 11,
	                    width: "220px"
	                    }).mouseover(function() {
	                    $(this).next('.slimScrollBar');
	                });
					var sidebar_width = 220;

					if ($.fn.navAccordion) {
                        $('.sidebar-accordion').each(function() {
                            $(this).navAccordion({
                                eventType: 'click',
                                hoverDelay: 100,
                                autoClose: true,
                                saveState: false,
                                disableLink: true,
                                speed: 'fast',
                                showCount: false,
                                autoExpand: true,
                                classExpand: 'acc-current-parent'
                            });
                        });
                    }

                    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

                    $(".sidebar ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })

                    $(".leftmenu ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })
			    }


				// ---------------------------------
				// 8. Boxed menu
				// ---------------------------------
			    else if(layout == 'boxed'){
			        $(".menu").addClass(" leftmenu");
					//$(".menu-container").load("menus/material-sidebar.php");
					$(".main-container").css('margin-top', containerMargin);
					$(".leftmenu").css({
	                    "height": menuHeight +1,
						"top": menuMargin
	                });
	                $('.leftmenu .left-aside-container').slimscroll({
	                    height: menuHeight + 11,
	                    width: "200px"
	                    }).mouseover(function() {
	                    $(this).next('.slimScrollBar');
	                });
					var sidebar_width = 200;

					if ($.fn.navAccordion) {
                        $('.sidebar-accordion').each(function() {
                            $(this).navAccordion({
                                eventType: 'click',
                                hoverDelay: 100,
                                autoClose: true,
                                saveState: false,
                                disableLink: true,
                                speed: 'fast',
                                showCount: false,
                                autoExpand: true,
                                classExpand: 'acc-current-parent'
                            });
                        });
                    }

					var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

                    $(".sidebar ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })

                    $(".leftmenu ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })
			    }


				// ---------------------------------
				// 9. Iconbar menu
				// ---------------------------------
			    else if(layout == 'iconbar'){
			        $(".menu").addClass(" leftmenu");
					//$(".menu-container").load("menus/material-sidebar.php");
					$(".main-container").css('margin-top', containerMargin);
					$(".leftmenu").css({
	                    "height": menuHeight +1,
						"top": menuMargin
	                });
	                $('.leftmenu .left-aside-container').slimscroll({
	                    height: menuHeight + 11,
	                    width: "160px"
	                    }).mouseover(function() {
	                    $(this).next('.slimScrollBar');
	                });
					var sidebar_width = 200;

					if ($.fn.navAccordion) {
                        $('.sidebar-accordion').each(function() {
                            $(this).navAccordion({
                                eventType: 'click',
                                hoverDelay: 100,
                                autoClose: true,
                                saveState: false,
                                disableLink: true,
                                speed: 'fast',
                                showCount: false,
                                autoExpand: true,
                                classExpand: 'acc-current-parent'
                            });
                        });
                    }

					$(".leftmenu .acc-icon").css('display','none');

					var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

                    $(".leftmenu ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })
			    }


				// ---------------------------------
				// 10. Default menu (material)
				// ---------------------------------
			    else if(layout == ''){
					$(".menu").addClass(" leftmenu");
					//$(".menu-container").load("menus/material-sidebar.php");
					$(".main-container").css('margin-top', containerMargin);
					$(".leftmenu").css({
	                    "height": menuHeight +1,
						"top": menuMargin
	                });
	                $('.leftmenu .left-aside-container').slimscroll({
	                    height: menuHeight + 11,
	                    width: "200px"
	                    }).mouseover(function() {
	                    $(this).next('.slimScrollBar');
	                });
					var sidebar_width = 200;

					if ($.fn.navAccordion) {
                        $('.sidebar-accordion').each(function() {
                            $(this).navAccordion({
                                eventType: 'click',
                                hoverDelay: 100,
                                autoClose: true,
                                saveState: false,
                                disableLink: true,
                                speed: 'fast',
                                showCount: false,
                                autoExpand: true,
                                classExpand: 'acc-current-parent'
                            });
                        });
                    }


                    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

                    $(".sidebar ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })

                    $(".leftmenu ul.sidebar-accordion li a").each(function(){
                        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
                        {
                            $(this).addClass(" active");
                            $(this).parent().parent().css("display","block");
                            $(this).parent().parent().parent().addClass(" active");
                            $(this).parent().parent().parent().parent().css("display","block");
                            $(this).parent().parent().parent().parent().parent().addClass(" active");
                        }
                    })
			    }

				$(".container-sidebar").css({
					"height": "100%",
					"width": "200px",
					"position": "fixed",
					"float": "left"
				});

				$('.secondary-sidebar').slimscroll({
					height: calc_wh,
					width: "200px"
					}).mouseover(function() {
					$(this).next('.slimScrollBar');
				});

				$(".container-aside").css({
					"width": totalWidth - secondary_sidebar_width - sidebar_width,
					"margin-left": secondary_sidebar_width,
					"float": "left"
				});
            }
	    }).resize();
    }
	AsideHeight();
});

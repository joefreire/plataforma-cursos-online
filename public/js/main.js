"use strict";

$(function() {


	$(".rslides-header").responsiveSlides({
		prevText: '<i class="zmdi zmdi-chevron-left zmdi-hc-2x text-center"></i>',
		nextText: '<i class="zmdi zmdi-chevron-right zmdi-hc-2x text-center"></i>',
		nav: true
	});

	$(".scrolldown").on("click", function(){
		$("html,body").animate({
			scrollTop: $("header").height()
		});
	});

	$(".slick-features").slick({
		slidesToShow: 5,
		prevArrow: '<i class="zmdi zmdi-chevron-left zmdi-hc-2x text-center"></i>',
		nextArrow: '<i class="zmdi zmdi-chevron-right zmdi-hc-2x text-center"></i>',
		responsive: [
		{
			breakpoint: 1200,
			settings: {
				slidesToShow: 3
			}
		},
		{
			breakpoint: 992,
			settings: {
				slidesToShow: 2
			}
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 1
			}
		}]
	});

	$(".slick-testimonials").slick({
		slidesToShow: 1,
		prevArrow: '<i class="zmdi zmdi-chevron-left text-center"></i>',
		nextArrow: '<i class="zmdi zmdi-chevron-right text-center"></i>',
	});
/*
	$(".popular-scrolldown").on("click", function(){
		$('html,body').animate({
			scrollTop: $(".tutorials").offset().top - 50
		}, 1000);
	});*/

	var $teacher = 	$(".teacher > a");

	$teacher.hover(function(){
		$(this).siblings(".imgcontainer").find(".overlay").fadeIn();
	});

	$teacher.mouseout(function(){
		$(this).siblings(".imgcontainer").find(".overlay").fadeOut();
	});

	$(".jquery-select").selectmenu();

	$("#teacher-single .tutorials").slick({
		slidesToShow: 3,
		prevArrow: '<i class="zmdi zmdi-chevron-left text-center"></i>',
		nextArrow: '<i class="zmdi zmdi-chevron-right text-center"></i>',
		responsive: [
		{
			breakpoint: 992,
			settings: {
				slidesToShow: 2
			}
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 1
			}
		}]
	});

	$(".option-title").on("click", function(){
		var $parent = $(this).parent();
		$parent.toggleClass("opened");
		//$parent.siblings().removeClass("opened");
	});

	$(".courses-side-slick").slick({
		slidesToShow: 1,
		prevArrow: '<i class="zmdi zmdi-chevron-left text-center"></i>',
		nextArrow: '<i class="zmdi zmdi-chevron-right text-center"></i>'
	});

	$(".loadmore").on("click", function(e){
		$(this).fadeOut(500);
		$(".more-categories").slideDown(700);
		$(".service-categories").animate({"margin-bottom": 0}, 700);
		e.preventDefault();
	});

	if(window.innerWidth < 768){
		var $items = $("#myNavbar > ul > li > a");
		$items.each(function(i, el){
			if($(el).attr("href") == "#"){
				$(this).on("click",function(e){
					e.preventDefault();
					$(".submenu").hide();
					$(this).siblings(".submenu").show();

				});
			}
		});
	}

});


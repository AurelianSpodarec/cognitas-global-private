/*$(document).ready(function () {
  //open the login nav
  $('.mainNav-item--52225910 .mainNav-link').click(function(e){
    e.preventDefault();
    parentel = $(this).parent();
    submenu = $(parentel).find(".mainNav-subMenu");

    $(this).toggleClass('loginActive');

    $(submenu).toggleClass("navActive");
    $('.header-search').removeClass('header-search--isActive');
  });

	$('.msoSearchContainer').click(function(){
		$(this).toggleClass('msoSearchContainerActive');
		$('.msoSearchDropDown').toggleClass('msoSearchActive');
		$('.msoSearchBox').focus();
  });
  
  $(window).on('load resize scroll',function(){
    if ($(document).scrollTop() > 1) {
      $('.header-mobile').addClass('user-has-scrolled');
    } else {
      $('.header-mobile').removeClass('user-has-scrolled');
    }
  });

});*/
/*$(document).ready(function () {
	var sidebarNav = {
		toggle: function ($target) {
			var $list = $target.children('.sub-menu');

		  	$target.toggleClass('menu-item--isOpened');
		  	$list.slideToggle(250);
		},

		openAncestor: function () {
		  	var $target = $('.menu-item--ancestor');

		  	var $child = $target.find('.menu-list--child');

		  	if ($child.length === 0) {
		    	return;
		  	}
		  
		  	this.toggle($target);
		},

		init: function () {
		  	var self = this;
		  	var $parentNode = $('.menu-item-has-children');
		  	$parentNode.prepend('<button class="menu-childToggle"></button>');

		  	$('.menu-childToggle').on('click', function (e) {
		    	e.preventDefault();

		    	self.toggle(($(e.target).parent()));
		  	});

		  	$('.current-menu-item').addClass('menu-item--isOpened');
		  	$('.current-menu-item .sub-menu').show();

		  	self.openAncestor();
		},
	};

	return sidebarNav.init();
});*/

$(document).ready(function () {
	var pageSidebarNav = {
		toggle: function ($target) {
			var $list = $target.children('.children');

		  	$target.toggleClass('page_item--isOpened');
		  	$list.slideToggle(250);
		},

		openAncestor: function () {
		  	var $target = $('.page_item--ancestor');

		  	var $child = $target.find('.menu-list--child');

		  	if ($child.length === 0) {
		    	return;
		  	}
		  
		  	this.toggle($target);
		},

		init: function () {
		  	var self = this;
		  	var $parentNode = $('.page_item_has_children');
		  	$parentNode.prepend('<button class="menu-childToggle"></button>');

		  	$('.menu-childToggle').on('click', function (e) {
		    	e.preventDefault();

		    	self.toggle(($(e.target).parent()));
		  	});

		  	$('.current_page_item').addClass('page_item--isOpened');
		  	$('.current_page_item .children').show();

		  	self.openAncestor();
		},
	};

	return pageSidebarNav.init();
});

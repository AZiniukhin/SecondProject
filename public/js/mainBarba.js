$('document').ready(function () {
	
	$('.navigate-list a').click(function(){
		$('.navigate-list li').removeClass('active');
		$(this).parent().addClass('active');
	});
	
	var tl = new TimelineMax();
	tl.to('.nav-reveal__inner', 0.6, {scale: 2})
		.staggerTo('.navigate-list__item', 0.15, {x:15, opacity:1}, 0.1)
		.fromTo('.welcome-text', 0.4, {opacity: 0, y: 20}, {opacity: 1, y: 0});
	
	var transEffect = Barba.BaseTransition.extend({
		start: function () {
			this.newContainerLoading.then(val => this.fadeInNewcontent($(this.newContainer)));
		},
		fadeInNewcontent: function (nc) {
			nc.hide();
			var _this = this;
			
			$(this.oldContainer).animate({ top: -20, opacity: 0 }, 300, function() {
  $(this).css('display', 'none');
}).promise().done(function() {
				nc.css('visibiliti', 'visible');
				//$('.content>*').css('visibility', 'visible');
				nc.fadeIn(400, function () {
					tl.fromTo('.welcome-text', 0.4, {opacity: 0, y: 20}, {opacity: 1, y: 0});
					// startPage();
					//$('.content .welcome-text, .map').css({opacity: 1, top: 0});
					_this.done();
				})
			});
		}
	});
	Barba.Pjax.getTransition = function () {
		return transEffect;
	};
	Barba.Pjax.start();
});

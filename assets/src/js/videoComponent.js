/* homepage video */

$(document).ready(function () {
	if ($('#homeVideo').length === 0) {
		return false;
	}

	var videoPlayer = document.getElementById('homeVideo');

	$('.homeVideoWrapper').on('click', function () {
		$('.play-button').toggleClass('hide');
		if (videoPlayer.paused == false) {
			videoPlayer.pause();
			videoPlayer.firstChild.nodeValue = 'Play';
		} else {
			videoPlayer.play();
			videoPlayer.firstChild.nodeValue = 'Pause';
		}
	});
});
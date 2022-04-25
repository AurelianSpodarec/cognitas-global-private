$(document).ready(function () {
  /* eslint vars-on-top: 0 */
  /* eslint no-param-reassign: 0 */
  /* eslint no-unused-vars: 0 */

  $.fn.customerPopup = function (e, intWidth, intHeight, strResize) {
    // Prevent default anchor event
    e.preventDefault();

    // Set values for window
    intWidth = intWidth || '500';
    intHeight = intHeight || '400';
    strResize = (strResize ? 'yes' : 'no');

    // Set title and open popup with focus on it
    var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share');
    var strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize;
    var objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
  };

  $('.js-share').on('click', function (e) {
    e.preventDefault();

    $(this).customerPopup(e);
  });
});

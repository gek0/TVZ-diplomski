/**
 * initialize on page load
 */

window.onload = function () {
    var loadTime = (window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart) / 1000;
    var loaderElementHolder = document.getElementById('time-loader-holder');
    var loaderElement = document.getElementById('time-loader');

    loaderElement.innerHTML = loadTime;
    loaderElementHolder.style.display = 'inline-block';
}
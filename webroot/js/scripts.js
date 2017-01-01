(function(){
    var c = document.getElementById('container');
    function addAnim() {
        c.classList.add('animated')
        c.removeEventListener('mouseover', addAnim);
    };
    c.addEventListener('mouseover', addAnim);
})();

function removeMe() {
    var elem = document.getElementById('removable');
    elem.parentNode.removeChild(elem);
}
function removeFadeOut( el, speed ) {
    var seconds = speed/1000;
    el.style.opacity = 0;
    el.style.transition = "opacity "+seconds+"s  cubic-bezier(0.6, -0.28, 0.74, 0.05)";
    setTimeout(function() {
        el.parentNode.removeChild(el);
    }, speed);
}

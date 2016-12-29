/**
 * Created by pasanteit on 26/12/2016.
 */
(function(){
    var c = document.getElementById('container');
    function addAnim() {
        c.classList.add('animated')
        // remove the listener, no longer needed
        c.removeEventListener('mouseover', addAnim);
    };
    // listen to mouseover for the container
    c.addEventListener('mouseover', addAnim);
})();


var b = false;
function toggle_visibility(removable) {
    var e = document.getElementById(removable);
    if(e.style.display == 'block')
        e.style.display = 'none';
    else
        e.style.display = 'block';
    b = true;
}
function foo() {
    var e = document.getElementById('foo');
    if(!b) e.style.display = 'none';
    b=false;
}
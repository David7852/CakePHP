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
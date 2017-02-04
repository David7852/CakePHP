window.addEventListener("resize", function(){
    var elements=document.getElementsByClassName('viewLink');
    for(var i=0; i<elements.length; i++) {
        if (window.innerWidth < 720)
            if (typeof elements[i].textContent !== "undefined")
                elements[i].textContent = elements[i].textContent.replace("Agregar", "+");
            else
                elements[i].innerText = elements[i].innerText.replace("Agregar", "+");
        else
        if (typeof elements[i].textContent !== "undefined")
            elements[i].textContent = elements[i].textContent.replace("+", "Agregar");
        else
            elements[i].innerText = elements[i].innerText.replace("+", "Agregar");
    }
});
window.addEventListener("load", function(){
    var elements=document.getElementsByClassName('viewLink');
    for(var i=0; i<elements.length; i++) {
        if (window.innerWidth < 720)
            if (typeof elements[i].textContent !== "undefined")
                elements[i].textContent = elements[i].textContent.replace("Agregar", "+");
            else
                elements[i].innerText = elements[i].innerText.replace("Agregar", "+");
    }
});
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
function refreshimage()
{
    var el=document.getElementById("imagen");
    var file=el.options[el.selectedIndex].text;
    if(file===''||file===null)
        var image=document.getElementById("freshimage").src="/WIT/webroot/img/no disponible.png";
    else
        var image=document.getElementById("freshimage").src="/WIT/webroot/img/Modelos/"+file;
    image.style.transition = "all "+seconds+"s  cubic-bezier(0.6, -0.28, 0.74, 0.05)";
}
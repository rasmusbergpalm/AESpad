function myScrollTo(container, element){
    container = $(container); 
    element = $(element); 
    var x = element.x ? element.x : element.offsetLeft,
        y = element.y ? element.y : element.offsetTop;
    container.scrollLeft=x-(document.all?0:container.offsetLeft );
    container.scrollTop=y-(document.all?0:container.offsetTop);
    return element;
}
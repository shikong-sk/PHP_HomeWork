//公用函数定义
function sleep(fun,ms)
{
    setTimeout(fun,ms);
}

function loop(fun,ms)
{
	fun();
    setInterval(fun,ms);
}

addEventListener(
    "load",
    function() {
        setTimeout(hideURLbar, 0);
    },
    false
);

function hideURLbar()
{
    window.scrollTo(0, 1);
}

//核心函数
$(document).ready(function(){
    // wow.js预加载
    wow = new WOW({　　
        animateClass: 'animated',
    });         
    wow.init();

})

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name)  == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
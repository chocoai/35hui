//焦点图-begin/////////////////////////////////////////////////////////////////////////////////////////////////////
var buttons = { previous: $('#lofslidecontent45 .lof-next'),
    next: $('#lofslidecontent45 .lof-previous')
};

$obj = $('#lofslidecontent45').lofJSidernews({
    direction: 'opacity',
    easing: 'easeInOutExpo',
    duration: 1000,
    auto: true,
    maxItemDisplay: 5,
    navPosition: 'vertical', // horizontal
    navigatorHeight: 50,
    navigatorWidth: 65,
    mainWidth: 60,
    buttons: buttons,
    pictureUrlArray:[]
}
);
//焦点图-begin/////////////////////////////////////////////////////////////////////////////////////////////////////




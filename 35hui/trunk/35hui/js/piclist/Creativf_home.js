//焦点图-begin/////////////////////////////////////////////////////////////////////////////////////////////////////
var buttons = { previous: $('#lofslidecontent45 .lof-next'),
    next: $('#lofslidecontent45 .lof-previous')
};
$obj = $('#lofslidecontent45').lofJSidernews({
    direction: 'opacity',
    easing: 'easeInOutExpo',
    duration: 1000,
    auto: true,
    maxItemDisplay: 4,
    navPosition: 'horizontal', // vertical
    navigatorHeight: 75,
    navigatorWidth: 110,
    mainWidth: 100,
    buttons: buttons,
    pictureUrlArray:[]
});

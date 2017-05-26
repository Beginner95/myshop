$(document).ready(function(){


	$( ".slider-slides" ).cycle({
        pager:'.slider-btn',
        prev: '.prev',
        next: '.next'
    });

    $("a.zoom").prettyPhoto({
        social_tools: ''
    });

     $('.product figure .overlay a').hover(
        function(){
            $(this).stop().animate(
                {backgroundPosition: "(0 -41px)"},
                {duration:500}
            )
        },
        function(){
            $(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            )
        }
    );

    $('.sorting-bar .sorting-btn a').hover(
        function(){
            $(this).stop().animate(
                {backgroundPosition: "(0 -29px)"},
                {duration:500}
            )
        },
        function(){
            $(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            )
        }
    );

    $('.detail .icon a').hover(
        function(){
            $(this).stop().animate(
                {backgroundPosition: "(0 -42.3px)"},
                {duration:500}
            )
        },
        function(){
            $(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            )
        }
    );



});

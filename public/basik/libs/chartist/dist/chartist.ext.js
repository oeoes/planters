// Copyright flatfull.com
!function(e){e.plugins.animate=function(a){return function(t){var i={delay:80,duration:500,grid:!1,label:!1};a=e.extend({},i,a);var n=0;t.on("created",function(){n=0}),t.on("draw",function(t){if("label"===t.type&&t.axis&&"x"===t.axis.units.pos&&a.label)n++,t.element.animate({y:{begin:n*a.delay,dur:a.duration,from:t.y+100,to:t.y,easing:"easeOutQuart"}});else if("label"===t.type&&t.axis&&"y"===t.axis.units.pos&&a.label)n++,t.element.animate({x:{begin:n*a.delay,dur:a.duration,from:t.x-100,to:t.x,easing:"easeOutQuart"}});else if("grid"===t.type&&a.grid){var i={begin:++n*a.delay,dur:a.duration,from:t[t.axis.units.pos+"1"]-30,to:t[t.axis.units.pos+"1"],easing:"easeOutQuart"},s={begin:n*a.delay,dur:a.duration,from:t[t.axis.units.pos+"2"]-100,to:t[t.axis.units.pos+"2"],easing:"easeOutQuart"},r={};r[t.axis.units.pos+"1"]=i,r[t.axis.units.pos+"2"]=s,r.opacity={begin:n*a.delay,dur:a.duration,from:0,to:1,easing:"easeOutQuart"},t.element.animate(r)}else if("point"===t.type)n++,t.element.animate({x1:{begin:n*a.delay,dur:a.duration,from:t.x-10,to:t.x,easing:"easeOutQuart"},x2:{begin:n*a.delay,dur:a.duration,from:t.x-10,to:t.x,easing:"easeOutQuart"},opacity:{begin:n*a.delay,dur:a.duration,from:0,to:1,easing:"easeOutQuart"}});else if("line"===t.type)n++,t.element.animate({opacity:{begin:n*a.delay+1e3,dur:a.duration,from:0,to:1}});else if("area"===t.type)n++,t.element.animate({d:{begin:n*a.delay,dur:a.duration,from:t.path.clone().scale(1,0).translate(0,t.chartRect.height()).stringify(),to:t.path.clone().stringify(),easing:e.Svg.Easing.easeOutQuint}});else if("bar"===t.type)n++,t.element.animate({opacity:{begin:n*a.delay,dur:a.duration,from:0,to:1,easing:"easeOutQuart"}});else if("slice"===t.type){n++;var o=t.element._node.getTotalLength();t.element.attr({"stroke-dasharray":o+"px "+o+"px"});var u={"stroke-dashoffset":{id:"anim"+t.index,dur:1e3,from:-o+"px",to:"0px",easing:e.Svg.Easing.easeOutQuint,fill:"freeze"}};0!==t.index&&(u["stroke-dashoffset"].begin="anim"+(t.index-1)+".end"),t.element.attr({"stroke-dashoffset":-o+"px"}),t.element.animate(u,!1)}})}}}(Chartist);
var BetterAnalytics={};
!function(a,b,d,k){BetterAnalytics.BA=function(){this.__construct()};BetterAnalytics.BA.prototype={__construct:function(){a(d).ready(function(){BetterAnalytics._BA.init()})},s:null,videos:{},t:0,init:function(){this.s=a("#ba_s").data("o");this.init_start();var c="";this.s.g&2147483648&&(b.ga_debug={trace:!0},c="_debug");(function(a,b,c,h,f,e,d){a.GoogleAnalyticsObject=f;a[f]=a[f]||function(){(a[f].q=a[f].q||[]).push(arguments)};a[f].l=1*new Date;e=b.createElement(c);d=b.getElementsByTagName(c)[0];e.async=
1;e.src=h;d.parentNode.insertBefore(e,d)})(b,d,"script","//www.google-analytics.com/analytics"+c+".js","ga");ga("create",this.s.tid,this.s.co);this.s.g&32&&ga("require","displayfeatures");this.s.g&4&&ga("require","linkid","linkid.js");this.s.g&64&&ga("set","forceSSL",!0);this.s.g&16&&ga("set","anonymizeIp",!0);"object"==typeof this.s.d&&a.each(this.s.d,function(a,b){ga("set","dimension"+b[0],b[1])});"object"==typeof this.s.e&&(ga("set","expId",this.s.e.i),ga("set","expVar",this.s.e.v));if("string"==
typeof this.s.js)try{eval(this.s.js)}catch(f){console.error(f.stack)}this.init_end();ga("send","pageview");this.s.g&128&&setTimeout("ga('send','event','User','Engagement','Time on page more than 15 seconds')",15E3);this.s.g&2048&&a(d).ajaxComplete(function(a,b,c){a=d.createElement("a");a.href=c.url;ga("send","event","AJAX Request","Trigger",a.pathname)});this.s.g&512&&a("a").each(function(){if(this.href.slice(0,b.location.origin.length)!=b.location.origin)a(this).on("click",function(){ga("send","event",
"Link","Click",jQuery(this).prop("href"))})});if("string"==typeof this.s.dl){var e=new RegExp("("+BetterAnalytics._BA.s.dl+")$");a("a").each(function(){if(this.href.match(e))a(this).on("click",function(){ga("send","event","Link","Download",jQuery(this).prop("href"))})})}this.s.g&65536&&a(".error404").length&&ga("send","event","Error","Page Not Found",b.location.origin+b.location.pathname+" (Referrer: "+d.referrer+")");if(this.s.g&131072)a(b).on("beforeunload",function(){ga("send","event","User","Engagement",
"Scroll",parseInt((jQuery(d).scrollTop()+jQuery(b).height())/jQuery(d).height()*100),{nonInteraction:1})});this.s.g&262144&&(this.t=parseInt((new Date).getTime()/1E3),a(b).on("beforeunload",function(){ga("send","event","User","Engagement","Time On Page",parseInt((new Date).getTime()/1E3)-BetterAnalytics._BA.t,{nonInteraction:1})}));if(this.s.g&256&&a('iframe[src*="youtube.com/embed"]').length){a('iframe[src*="youtube.com/embed"]').each(function(c){var f=a(this).prop("src");-1===f.indexOf("origin=")&&
a(this).prop("src",f+(-1===f.indexOf("?")?"?":"&")+"enablejsapi=1&origin="+b.location.origin);a(this).prop("id")?c=a(this).prop("id"):(c="ba_yt_"+c,a(this).prop("id",c))});c=d.createElement("script");c.src="https://www.youtube.com/iframe_api";var g=d.getElementsByTagName("script")[0];g.parentNode.insertBefore(c,g)}this.s.a&16&&a(b).load(function(){setTimeout(BetterAnalytics._BA.dp_bind,3E3)});this.s.s&2&&a(b).load(function(){setTimeout(function(){try{"object"==typeof FB&&a.each({"edge.create":"Like",
"edge.remove":"Unlike","message.send":"Send","comment.create":"Comment","comment.remove":"Uncomment"},function(a,c){FB.Event.subscribe(a,function(a){ga("send","social","Facebook",c,a)})})}catch(c){}},1E3)});this.s.s&4&&a(b).load(function(){setTimeout(function(){try{"object"==typeof twttr&&a.each({tweet:"Tweet",follow:"Follow",retweet:"Retweet",favorite:"Favorite",click:"Click"},function(a,c){twttr.events.bind(a,function(a){if(a){var b;a.target&&"IFRAME"==a.target.nodeName&&(b=BetterAnalytics._BA.extract_param(a.target.src,
"url"));ga("send","social","Twitter",c,b)}})})}catch(c){}},1E3)});this.s.s&16&&a(b).load(function(){setTimeout(function(){try{a.each({'a[data-pin-log="button_follow"]':"Follow",'a[data-pin-log="embed_pin"]':"Pin",'a[data-pin-log="button_pinit_bookmarklet"]':"Pin"},function(c,b){a("body").on("click",c,function(a){a=d.href;"Follow"==b?a=jQuery(this).attr("href"):"Repin"==b&&(a=jQuery(this).parent().attr("href"));ga("send","social","Pinterest",b,a)})})}catch(c){}},1E3)});this.s.s&32&&a(b).load(function(){setTimeout(function(){a(".IN-widget").on("click",
function(){ga("send","social","LinkedIn","Share",b.location.href)})},1E3)})},init_start:function(){},init_end:function(){},dp_bind:function(){a(".dp_ad_inner").parent().on("click",function(){ga("send","event","Advertising","Click","Digital Point")})},yt_init:function(c){a('iframe[src*="youtube.com/embed"]').each(function(c){c=a(this).prop("id");BetterAnalytics._BA.videos[c]=new YT.Player(c,{events:{onStateChange:BetterAnalytics._BA.yt_state_change,onError:BetterAnalytics._BA.yt_error}})})},yt_state_change:function(a){0<=
a.data&&jQuery.each(YT.PlayerState,function(f,e){"number"==typeof e&&e==a.data&&ga("send","event","YouTube Video",f.charAt(0).toUpperCase()+f.substr(1).toLowerCase(),b.location.origin+b.location.pathname+" | "+a.target.getVideoData().title+" ("+a.target.getVideoUrl()+")")})},yt_error:function(a){},extract_param:function(a,b){if(a){a=a.split("#")[0];var e=a.split("?");if(1!=e.length){e=decodeURI(e[1]);paramName+="=";for(var e=e.split("&"),d=0;b=e[d];++d)if(0===b.indexOf(paramName))return decodeURIComponent(b.split("=")[1])}}}}}(jQuery,
this,document);originalYouTubeIFrame=onYouTubeIframeAPIReady;function onYouTubeIframeAPIReady(a){BetterAnalytics._BA.yt_init(a);originalYouTubeIFrame!=onYouTubeIframeAPIReady&&originalYouTubeIFrame(a)};
BetterAnalytics._BA=new BetterAnalytics.BA();
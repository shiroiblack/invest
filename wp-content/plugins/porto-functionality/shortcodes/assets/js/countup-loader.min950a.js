function portoInitStatCounter(t){"use strict";void 0===t&&(t=jQuery("body"));var n=t.find(".stats-block"),e=function(t){void 0===t&&(t=this);var n=jQuery(t),e=parseFloat(n.find(".stats-number").attr("data-counter-value")),a=n.find(".stats-number").attr("data-counter-value")+" ",r=parseInt(n.find(".stats-number").attr("data-speed")),o=n.find(".stats-number").attr("data-id"),s=n.find(".stats-number").attr("data-separator"),u=n.find(".stats-number").attr("data-decimal"),i=a.split(".");i=i[1]?i[1].length-1:0;var d=!0;"none"==u&&(u="");var c={useEasing:!1,useGrouping:d="none"!=s,separator:s,decimal:u},f=new countUp(o,0,e,i,r,c),m=function(){jQuery("#"+o).next(".counter_suffix").length>0&&jQuery("#"+o).next(".counter_suffix").css("display","inline")};setTimeout(function(){f.start(m)},500)};window.theme&&theme.intObs?theme.intObs(jQuery.makeArray(n),e,-50):n.each(function(){e(this)})}jQuery(document).ready(function(t){"use strict";portoInitStatCounter(),t(document.body).on("porto_refresh_vc_content",function(t,n){portoInitStatCounter(n)})});
(self.webpackChunktradingview=self.webpackChunktradingview||[]).push([[75692],{516684:(e,t,n)=>{"use strict";var r=n(823127),i=n(345848).trackEvent,s=n(226722).TVXWindowEvents,o=n(201089).getLogger("Pine.ScriptLib"),a=n(175203).telemetry,u=n(251954),c=n(707957).Delegate,l={fast:["delete","get","is_auth_to_get","is_auth_to_write","parse_title","rename","lib_list"],medium:["list","eval_pine_ex","translate_light"],slow:["process_legacy","publish","save","translate","translate_source","gen_alert"]},d=/[l|L]ines? (\d*)/;function p(e){if("object"==typeof e.reason)return e.reason;if(e.reason2)return e.reason2;const t={errors:[],warnings:[]},n=e.result&&e.result.metaInfo;if(n&&void 0!==n.warnings&&n.warnings.forEach((e=>t.warnings.push({message:e}))),e.reason){(Array.isArray(e.reason)?e.reason:e.reason.split("\n")).forEach((e=>{const n=e.match(d),r=n&&n.length&&Number(n[1]),i={message:e};if("number"==typeof r){i.start={line:r,column:0};const e=i.message.split(": ");e.shift(),i.message=e.join(": ")}t.errors.push(i)}))}return t}var f={};function S(){f._cache={}}f._isAuthCache=new S,f._pineDeleted=new c,s.on("TVScriptModified",(function(e){f.clearSavedScriptsCache(),f.scriptUpdater()&&f.scriptUpdater().onTVScriptModified(JSON.parse(e))})),s.on("TVScriptDeleted",(function(e){f.clearAllCaches(),f.scriptUpdater()&&f.scriptUpdater().onTVScriptDeleted(JSON.parse(e))})),s.on("TVScriptRenamed",(function(e){f.clearSavedScriptsCache(),f.scriptUpdater()&&f.scriptUpdater().onTVScriptRenamed(JSON.parse(e))})),s.on("TVScriptLegacyPineProcessed",(function(e){f.clearSavedScriptsCache(),f.scriptUpdater()&&f.scriptUpdater().onTVScriptLegacyPineProcessed(JSON.parse(e))})),f.getPineFacadeUrl=function(){return window.PINE_URL},f.PINE_FACADE_URL=function(){return window.PINE_URL},f.onPineDeleted=function(){return f._pineDeleted},f.safetyGetReason=p,f._pineFacadeAjax=function(e,t,n,i){o.logNormal("Requesting pine facade scripts, url: "+t);var s=function(e,t){for(var n=Object.keys(l),r=0;r<n.length;r++){var i=l[n[r]].filter((function(t){return-1!==e.indexOf(t)}));if(Boolean(i.length))return n[r]}return!1}(t),u=Date.now(),c=i?void 0:{withCredentials:!0};return r.ajax({url:f.PINE_FACADE_URL()+t,type:e,data:n||{},dataType:"json",xhrFields:c}).done((function(){var e=Date.now()-u;a.sendReport("pine",s+"_group_time_frame",{value:e}),a.sendReport("pine",s+"_group_ok"),o.logNormal("Requesting pine facade scripts finished, url: "+t)})).fail((function(){var e=Date.now()-u;a.sendReport("pine",s+"_group_time_frame",{value:e}),a.sendReport("pine",s+"_group_error"),o.logError("Requesting pine facade scripts failed, url: "+t)}))},f.convertScript=function(e,t){var n=r.Deferred(),i={source:e,version_to:t};return f._pineFacadeAjax("POST","/convert/",i).done((function(e,t,r){e.error?n.reject(f._readableError(e.error)):n.resolve(e)})).fail((function(e,t,r){f._anyRequestAsyncFail(n,e)})),n.promise()},f.translateScriptAsync=function(e,t,n,s){i("Pine","ScriptLib.translateScript"),s=!!s;var o=r.Deferred(),a="/translate_source/"+encodeURIComponent(t)+"/?is_pine_ex="+s,u={
user_name:window.user&&window.user.username,source:e,inputs:JSON.stringify(n||{})};return f._pineFacadeAjax("POST",a,u).done((function(e,t,n){f._translateScriptAsyncDone(o,e)})).fail((function(e,t,n){f._anyRequestAsyncFail(o,e)})),o.promise()},f.translateScriptAsync2=function(e,t){o.logNormal("translateScriptAsync2, pineId="+e+" pineVersion="+t),i("Pine","ScriptLib.translateScript");var n=r.Deferred(),a=0!==e.indexOf("USER"),c=window.user&&window.user.username,l="?user_name="+encodeURIComponent(c),d="/translate/"+encodeURIComponent(e)+"/"+t+"/";return a||null==c||(d+=l),f._pineFacadeAjax("GET",d,void 0,a).done((function(e,r,i){if(f._translateScriptAsyncDone(n,e),t<0){f.clearSavedScriptsCache();var o={scriptMetaInfo:e.result.metaInfo};s.emit("TVScriptLegacyPineProcessed",JSON.stringify(o)),u.emit("TVScriptLegacyPineProcessed",o),setTimeout((function(){o.isSelfCall=!0,null!=f.scriptUpdater()&&f.scriptUpdater().onTVScriptLegacyPineProcessed(o)}),0)}})).fail((function(e,t,r){f._anyRequestAsyncFail(n,e)})),n.promise()},f._translateScriptAsyncDone=function(e,t){if(t.error)e.reject(f._readableError(t.error));else if(t.success)e.resolve(t.result.metaInfo,p(t));else{var n=t.result?t.result.metaInfo:null;e.reject(p(t),n)}},f._saveScriptAsyncDone=function(e,t){if(t.error)e.reject(f._readableError(t.error));else if(t.success)e.resolve(t.result.metaInfo,p(t));else{var n=t.result?t.result.metaInfo:null;e.resolve(n,p(t))}},f._generateAlertAsyncDone=function(e,t){if(t.error)e.reject(f._readableError(t.error));else if(t.success)e.resolve(t.result.metaInfo,t.result.IL,t.result.inputs||null,t.result.gen_alert_data||null);else{var n=t.result?t.result.metaInfo:null;e.reject(p(t),n)}},f._readableError=function(e,t){return t},f._anyRequestAsyncFail=function(e,t){try{const n=p(JSON.parse(t.responseText));if(n)return e.reject(n)}catch(e){}0===f.PINE_FACADE_URL().indexOf("http")&&o.logError(t.responseText),e.reject(f._readableError(t.status,t.statusText))},f.isAuthToWritePineScript=function(e){var t="write_"+e,n=f._isAuthCache.getPromise(t);if(null!==n)return n;i("Pine","ScriptLib.isAuthToWritePineScript");var s=r.Deferred(),o="/is_auth_to_write/"+encodeURIComponent(e);return f._pineFacadeAjax("GET",o).done((function(e,t,n){s.resolve(e)})).fail((function(e,t,n){f._anyRequestAsyncFail(s,e)})),f._isAuthCache.setPromise(t,s.promise())},f.isAuthToGetPineSourceCode=function(e,t){var n="get_"+e+"_"+t,s=f._isAuthCache.getPromise(n);if(null!==s)return s;i("Pine","ScriptLib.isAuthToGetPineSourceCode");var o=r.Deferred(),a="/is_auth_to_get/"+encodeURIComponent(e)+"/"+t;return f._pineFacadeAjax("GET",a).done((function(e,t,n){o.resolve(e)})).fail((function(e,t,n){f._anyRequestAsyncFail(o,e)})),f._isAuthCache.setPromise(n,o.promise())},S.prototype.getPromise=function(e){var t=f._cache[e];return void 0===t?null:void 0!==t.value?r.Deferred().resolve(t.value):void 0!==t.promise?t.promise:null},S.prototype.setPromise=function(e,t){return f._cache[e]={promise:t},t.done((function(t){f._cache[e]={value:t}})).fail((function(t){delete f._cache[e]})),t},
f.getPineSourceCode=function(e,t,n){i("Pine","ScriptLib.getPineSourceCode");var s=r.Deferred(),o="?no_4xx="+!!n,a="/get/"+encodeURIComponent(e)+"/"+t+o;return f._pineFacadeAjax("GET",a).done((function(e,t,n){!1===e.success?s.reject(p(e)):s.resolve(e)})).fail((function(e,t,n){f._anyRequestAsyncFail(s,e)})),s.promise()},f.saveNewDraft=function(e){i("Pine","ScriptLib.saveNewDraft");var t=r.Deferred();if(null==e||""===e)return t.reject(n(777754).t(null,void 0,n(914002)));var s=window.user&&window.user.username,o="/save/new_draft/?user_name="+encodeURIComponent(s)+"&allow_use_existing_draft=true",a={source:e};return f._pineFacadeAjax("POST",o,a).done((function(e,n,r){f._translateScriptAsyncDone(t,e)})).fail((function(e,n,r){f._anyRequestAsyncFail(t,e)})),t.promise()},f.saveNextDraft=function(e,t,s){i("Pine","ScriptLib.saveNextDraft");var o=r.Deferred();if(null==t||""===t)return o.reject(n(777754).t(null,void 0,n(914002)));var a=window.user&&window.user.username,u=(s=!!s,"/save/next_draft/"+encodeURIComponent(e)+"/?user_name="+encodeURIComponent(a)+"&allow_create_new="+s),c={source:t};return f._pineFacadeAjax("POST",u,c).done((function(e,t,n){f._translateScriptAsyncDone(o,e)})).fail((function(e,t,n){f._anyRequestAsyncFail(o,e)})),o.promise()},f.processLegacy=function(e,t){i("Pine","ScriptLib.processLegacy");var n=r.Deferred(),s=window.user&&window.user.username,o="/process_legacy/"+encodeURIComponent(e)+"/?user_name="+encodeURIComponent(s),a={};return null!=t&&""!==t&&(a.source=t),f._pineFacadeAjax("POST",o,a).done((function(e,t,r){f._translateScriptAsyncDone(n,e)})).fail((function(e,t,r){f._anyRequestAsyncFail(n,e)})),n.promise()},f.generateAlert=function(e){i("Pine","ScriptLib.generateAlert");var t=r.Deferred(),n=window.user&&window.user.username,s="/gen_alert/?user_name="+encodeURIComponent(n),o={alert_info:e},u=Date.now();return f._pineFacadeAjax("POST",s,o).done((function(e,n,r){a.sendReport("alerts","compilation_ok"),f._generateAlertAsyncDone(t,e)})).fail((function(e,n,r){a.sendReport("alerts","compilation_error"),f._anyRequestAsyncFail(t,e)})).always((function(){var e=Date.now()-u;a.sendReport("alerts","compilation_time_frame",{value:e})})),t.promise()},f.parseScriptTitleAsync=function(e){i("Pine","ScriptLib.parseScriptTitle");var t=r.Deferred();if(null==e||""===e)return t.reject(n(777754).t(null,void 0,n(914002)));var s={user_name:window.user&&window.user.username,source:e};return f._pineFacadeAjax("POST","/parse_title/",s).done((function(e,n,r){e.error?t.reject(f._readableError(e.error)):e.success?t.resolve(e.result):t.reject(p(e))})).fail((function(e){f._anyRequestAsyncFail(t,e)})),t.promise()},f.scriptUpdater=function(){return window.scriptUpdater},f.clearAllCaches=function(){f.clearIsAuthToCaches(),f.clearSavedScriptsCache()},f.clearIsAuthToCaches=function(e){e?Object.keys(f._cache).filter((function(t){return t.indexOf(e)>=0})).forEach((function(e){delete f._cache[e]})):f._isAuthCache=new S},f.clearSavedScriptsCache=function(e){delete f._userScriptsDfd},f.requestUserScripts=function(e){
if(i("Pine","ScriptLib.requestUserScripts"),window.is_authenticated){if(!f._userScriptsDfd){f._userScriptsDfd=r.Deferred();var t=f._userScriptsDfd;f._pineFacadeAjax("GET","/list?filter=saved").done((function(e,n,r){t.resolve(e)})).fail((function(e){f._anyRequestAsyncFail(t,e)}))}t=f._userScriptsDfd}else t=r.Deferred().resolve([]);return"function"==typeof e&&t.done(e),t.promise()},f.setUserScripts=function(e){f._userScriptsDfd||(f._userScriptsDfd=r.Deferred().resolve(e))},f.requestUserPublishedScripts=function(e,t){if(i("Pine","ScriptLib.requestUserPublishedScripts"),window.is_authenticated){if(t||!f._userPublishedScriptsDfd){f._userPublishedScriptsDfd=r.Deferred();var n=f._userPublishedScriptsDfd;f._pineFacadeAjax("GET","/list?filter=published").done((function(e,t,r){n.resolve(e)})).fail((function(e){f._anyRequestAsyncFail(n,e)}))}n=f._userPublishedScriptsDfd}else n=r.Deferred().resolve([]);return"function"==typeof e&&n.done(e),n.promise()},f.requestPineEditorNewTemplateScripts=function(e){i("Pine","ScriptLib.requestPineEditorNewTemplateScripts");var t=r.Deferred();return f._pineFacadeAjax("GET","/list/?filter=template",void 0,!0).done((function(e,n,r){t.resolve(e)})).fail((function(e){f._anyRequestAsyncFail(t,e)})),"function"==typeof e&&t.done(e),t.promise()},f.requestInfoForScripts=function(e){return Promise.all([f._pineFacadeAjax("GET","/list?filter=saved"),f._pineFacadeAjax("GET","/list?filter=addon",void 0,!0)]).then((function(t){var n=t[0],r=t[1];return n.concat(r).filter((function(t){return e.includes(t.scriptIdPart)}))}))},f.requestBuiltinScripts=function(){i("Pine","ScriptLib.requestBuiltinScripts"),o.logNormal("Request built-in scripts");var e=r.Deferred();return f._pineFacadeAjax("GET","/list/?filter=standard",void 0,!0).done((function(t,n,r){o.logNormal("Request built-in scripts finished"),e.resolve(t)})).fail((function(t){o.logWarn("Request built-in scripts finished with fail"),f._anyRequestAsyncFail(e,t)})),e.promise()},f.requestBuiltinAndUserScripts=function(){i("Pine","ScriptLib.requestBuiltinAndUserScripts"),o.logNormal("Request built-in and user scripts");var e,t=window.user&&window.user.username,n={},r=new Promise((function(t,r){e=t,n.reject=r}));return Promise.all([f._pineFacadeAjax("GET","/list?filter=saved&user_name="+encodeURIComponent(t),void 0,!1),f._pineFacadeAjax("GET","/list?filter=standard",void 0,!0)]).then((function(t){o.logNormal("Request built-in and user scripts finished");var n=t[0],r=t[1];e(n.concat(r))})).catch((function(e){o.logWarn("Request built-in and user scripts finished with fail"),f._anyRequestAsyncFail(n,e)})),r},f.requestScriptInfo=function(e){i("Pine","ScriptLib.requestBuiltinAndUserScripts"),o.logNormal("Request public/user script info");var t=r.Deferred();return f._pineFacadeAjax("GET","/get_script_info/?pine_id="+encodeURIComponent(e)).done((function(e){o.logNormal("Request public/user script info finished"),t.resolve(e)})).fail((function(e){o.logWarn("Request public/user script info finished with fail"),f._anyRequestAsyncFail(t,e)})),t.promise()},
f.requestCandlestickScripts=function(){var e;i("Pine","ScriptLib.requestCandlestickScripts"),o.logNormal("Request candlestick scripts");var t={},n=new Promise((function(n,r){e=n,t.reject=r}));return f._pineFacadeAjax("GET","/list?filter=candlestick",void 0,!0).done((function(t){o.logNormal("Request candlestick scripts finished"),e(t)})).fail((function(e){o.logWarn("Request candlestick scripts finished with fail"),f._anyRequestAsyncFail(t,e)})),n};var y={time:-1/0,request:null};f.requestFundamentalScripts=function(){if(y.time+6e5>Date.now()&&null!==y.request)return o.logNormal("Return fundamentals from cache"),y.request;o.logNormal("Request fundamental scripts");var e=f._pineFacadeAjax("GET","/list?filter=fundamental",void 0,!1);return e.then((function(e){o.logNormal("Request fundamental scripts finished")})),e.fail((function(e){o.logWarn("Request fundamental scripts finished with fail, resetting cache"),y.request=null})),y.time=Date.now(),y.request=Promise.resolve(e.promise()),y.request},f.requestPineAddons=function(e){i("Pine","ScriptLib.requestPineAddons");var t=r.Deferred();return f._pineFacadeAjax("GET","/list?filter=addon&pine_id_prefix="+e).done((function(e){t.resolve(e)})).fail((function(e){f._anyRequestAsyncFail(t,e)})),t},f._updateAliveScriptInstances=function(e,t){var n={};n.scriptMetaInfo=e.result.metaInfo,n.scriptVersionToUpdate=t,s.emit("TVScriptModified",JSON.stringify(n)),u.emit("TVScriptModified",n),setTimeout((function(){n.isSelfCall=!0,null!=f.scriptUpdater()&&f.scriptUpdater().onTVScriptModified(n)}),0)},f.saveNew=function(e,t,s,o){i("Pine","ScriptLib.saveNew");var a=r.Deferred();if(null==e||""===e)return a.reject(n(777754).t(null,void 0,n(914002)));var u=window.user&&window.user.username,c=s?"&allow_overwrite=true":"",l="/save/new/?name="+encodeURIComponent(t)+"&user_name="+encodeURIComponent(u)+c,d={source:e};return f._pineFacadeAjax("POST",l,d).done((function(e,t,n){f.clearSavedScriptsCache(),f._updateAliveScriptInstances(e,o),f._saveScriptAsyncDone(a,e)})).fail((function(e,t,n){f._anyRequestAsyncFail(a,e)})),a.promise()},f.saveNext=function(e,t,s,o,a){i("Pine","ScriptLib.saveNext");var u=null!=s?"&name="+encodeURIComponent(s):"",c=r.Deferred();if(null==t||""===t)return c.reject(n(777754).t(null,void 0,n(914002)));var l=window.user&&window.user.username,d="/save/next/"+encodeURIComponent(e)+"/?user_name="+encodeURIComponent(l)+"&allow_create_new="+!!a+u,p={source:t};return f._pineFacadeAjax("POST",d,p).done((function(e,t,n){f.clearSavedScriptsCache(),f._updateAliveScriptInstances(e,o),f._saveScriptAsyncDone(c,e)})).fail((function(e,t,n){f._anyRequestAsyncFail(c,e)})),c.promise()},f.deletePine=function(e){i("Pine","ScriptLib.deletePine");var t=r.Deferred(),n=window.user&&window.user.username,o="/delete/"+encodeURIComponent(e)+"/?user_name="+encodeURIComponent(n);return f._pineFacadeAjax("POST",o).done((function(n,r,i){f.clearIsAuthToCaches(e),f.clearSavedScriptsCache(),t.resolve(n);var o={scriptIdPart:e};s.emit("TVScriptDeleted",JSON.stringify(o)),u.emit("TVScriptDeleted",o),
setTimeout((function(){o.isSelfCall=!0,null!=f.scriptUpdater()&&f.scriptUpdater().onTVScriptDeleted(o),f._pineDeleted.fire(e)}),0)})).fail((function(e,n,r){f._anyRequestAsyncFail(t,e)})),t.promise()},f.renamePine=function(e,t,n){i("Pine","ScriptLib.renamePine");var o=r.Deferred(),a=window.user&&window.user.username,c="/rename/"+encodeURIComponent(e)+"/?name="+encodeURIComponent(t)+"&user_name="+encodeURIComponent(a)+"&force="+encodeURIComponent(!!n);return f._pineFacadeAjax("POST",c).done((function(n,r,i){f.clearSavedScriptsCache();var a={scriptIdPart:e,scriptName:t};s.emit("TVScriptRenamed",JSON.stringify(a)),u.emit("TVScriptRenamed",a),setTimeout((function(){a.isSelfCall=!0,null!=f.scriptUpdater()&&f.scriptUpdater().onTVScriptRenamed(a)}),0),o.resolve(n)})).fail((function(e,t,n){f._anyRequestAsyncFail(o,e)})),o.promise()},f.publishNew=function(e,t){i("Pine","ScriptLib.publishNew");var n=r.Deferred(),s=window.user&&window.user.username,o="/publish/new/?access="+encodeURIComponent(t)+"&user_name="+encodeURIComponent(s),a={source:e};return f._pineFacadeAjax("POST",o,a).done((function(e,t,r){e.success?(f.clearSavedScriptsCache(),n.resolve(e)):n.reject(p(e))})).fail((function(e,t,r){f._anyRequestAsyncFail(n,e)})),n.promise()},f.publishNext=function(e,t){o.logNormal("ScriptLib.publishNext","pine"),i("Pine","ScriptLib.publishNext");var n=r.Deferred(),s=window.user&&window.user.username,a="/publish/next/"+encodeURIComponent(t)+"?user_name="+encodeURIComponent(s),u={source:e};return f._pineFacadeAjax("POST",a,u).done((function(e,t,r){f.clearSavedScriptsCache(),e.success||n.reject(p(e)),n.resolve(e)})).fail((function(e,t,r){f._anyRequestAsyncFail(n,e)})),n.promise()},f.lightTranslate=function(e,t){return o.logNormal("ScriptLib.lightTranslate","pine"),i("Pine","ScriptLib.lightTranslate"),new Promise((function(n,r){var i=window.user&&window.user.username,s=`/translate_light/?user_name=${encodeURIComponent(i)}`;t&&(s+=`&pine_id=${encodeURIComponent(t)}`);var o={source:e};f._pineFacadeAjax("POST",s,o).done((function(e,t,i){if(e.success)n(e.result);else{var s=e.result&&p(e.result)||p(e);r(s)}})).fail((function(e,t,n){f._anyRequestAsyncFail({reject:r},e)}))}))},f.getLibList=function(e,t,n){return o.logNormal("ScriptLib.getLibList","pine"),i("Pine","ScriptLib.getLibList"),new Promise((function(r,i){var s="/lib_list?lib_id_prefix="+encodeURIComponent(e);t&&(s+="&ignore_cache=true"),n&&(s+="&ignore_case=true"),f._pineFacadeAjax("GET",s).done((function(e,t,n){r(e)})).fail((function(e,t,n){f._anyRequestAsyncFail({reject:i},e)}))}))},f.getExistingLibraryInfo=async function(e){try{const t=await f.getLibList(e+"/last",!0,!0);if(!t.length)return null;const n=t[0];return{scriptIdPart:n.scriptIdPart,chartId:n.chartId,version:n.version}}catch(e){return null}},window.loginStateChange&&loginStateChange.subscribe(f,f.clearAllCaches),e.exports=f},465746:(e,t,n)=>{"use strict";n.d(t,{applyOverridesToStudyDefaults:()=>c});var r=n(650151),i=n(368135);const s=(0,n(201089).getLogger)("Chart.Model.StudyPropertiesOverrider");var o,a;function u(e,t,n,r){
const i=n.split(".");if(0===i.length||0===i[0].length)return;const u=function(e){const t=e.split(":");return{name:t[0],type:2===t.length?t[1]:null}}(i[0]),c=u.name,l=u.type,d=null!==l,p=!d||"band"===l,f=!d||"area"===l,S=!d||"input"===l,y=!d||"plot"===l?a.getPlotIdByTitle(e,c):null,_=p?a.getBandIndexByName(e,c):null,v=f?a.getFilledAreaIdByTitle(e,c):null,h=S?a.getInputByName(e,c):null,g=t.hasOwnProperty(c);if((null!==y?1:0)+(null!==_?1:0)+(null!==v?1:0)+(null!==h?1:0)+(g?1:0)>1)return void s.logWarn(`Study '${e.description}' has ambiguous identifier '${c}'`);const m=i[1];if(null!==y){if(1===i.length)return void s.logWarn(`Path of sub-property of '${c}' plot for study '${e.description}' must be not empty`);const n=i.slice(1);o.applyPlotProperty(e,t,y,n,r)}else if(null!==h)o.applyInputValue(t,h,r);else if(null!==_){if(void 0===m)return void s.logWarn(`Property name of '${c}' band for study '${e.description}' must be set`);o.applyBandProperty(t,_,m,r)}else if(null!==v){if(void 0===m)return void s.logWarn(`Property name of '${c}' area for study '${e.description}' must be set`);o.applyFilledAreaProperty(t,v,m,r)}else g?o.setRootProperty(t,i,r):s.logWarn(`Study '${e.description}' has no plot or input '${c}'`)}function c(e,t,n){for(const r in e){if(!e.hasOwnProperty(r))continue;const i=r.indexOf(".");if(-1===i)continue;const o=r.substring(0,i),c=a.getMetaInfoByDescription(t,o);if(null===c){s.logWarn(`There is no such study ${o}`);continue}const l=n(c);null!==l?u(c,l,r.substring(i+1),e[r]):s.logWarn(`Cannot apply overrides for study ${o}`)}}!function(e){const t={line:i.LineStudyPlotStyle.Line,histogram:i.LineStudyPlotStyle.Histogram,cross:i.LineStudyPlotStyle.Cross,area:i.LineStudyPlotStyle.Area,columns:i.LineStudyPlotStyle.Columns,circles:i.LineStudyPlotStyle.Circles,line_with_breaks:i.LineStudyPlotStyle.LineWithBreaks,area_with_breaks:i.LineStudyPlotStyle.AreaWithBreaks,step_line:i.LineStudyPlotStyle.StepLine,step_line_with_breaks:i.LineStudyPlotStyle.StepLineWithBreaks};e.applyPlotProperty=function(e,n,o,a,u){if(void 0===n.styles)return void s.logWarn("Study does not have styles");const c=a[0];if("color"===c){const t=function(e,t,n){if(void 0===e.plots)return null;for(const r of e.plots){if(!(0,i.isPaletteColorerPlot)(r)||void 0===t.palettes)continue;const e=t.palettes[r.palette];if(r.target===n&&void 0!==e)return e}return null}(e,n,o);return void function(e,t,n,i,o){var a;void 0!==e.styles?null===t&&!isNaN(i)&&i>0?s.logWarn(`Study plot does not have color #${i}`):((0===i||isNaN(i))&&((0,r.ensureDefined)(e.styles[n]).color=String(o),i=0),null!==t&&((0,r.ensureDefined)(null===(a=t.colors)||void 0===a?void 0:a[i]).color=String(o))):s.logWarn("Study does not have styles")}(n,t,o,a.length>1?parseInt(a[1]):NaN,u)}const l=n.styles[o];if(void 0!==l&&l.hasOwnProperty(c)){if("plottype"===c){const e=t[String(u)];if(void 0===e)return void s.logWarn(`Unsupported plot type for plot: ${u}`);u=e}l[c]=u}else s.logWarn(`Study plot does not have property '${c}'`)},e.applyBandProperty=function(e,n,r,i){
if(void 0===e.bands)return void s.logWarn("Study does not have bands");const o=e.bands[n];if(void 0!==o&&o.hasOwnProperty(r)){if("plottype"===r){const e=t[String(i)];if(void 0===e)return void s.logWarn(`Unsupported plot type for band: ${i}`);i=e}o[r]=i}else s.logWarn(`Study band does not have property '${r}'`)},e.applyFilledAreaProperty=function(e,t,n,r){if(void 0===e.filledAreasStyle)return void s.logWarn("Study does not have areas");const i=e.filledAreasStyle[t];void 0!==i&&i.hasOwnProperty(n)?i[n]=r:s.logWarn(`Study area does not have property '${n}'`)},e.applyInputValue=function(e,t,n){void 0!==e.inputs&&e.inputs.hasOwnProperty(t)?e.inputs[t]=n:s.logWarn(`Study does not have input '${t}'`)},e.setRootProperty=function(e,t,n){if(0===t.length)return;let r=e;for(const e of t.slice(0,-1)){if(null==r||!r.hasOwnProperty(e))break;r=r[e]}const i=t[t.length-1];null!=r&&r.hasOwnProperty(i)?r[i]=n:s.logWarn(`Study does not have property ${t.join(".")}`)}}(o||(o={})),function(e){e.getInputByName=function(e,t){if(void 0===e.inputs)return null;t=t.toLowerCase();for(const n of e.inputs)if(n.name.toLowerCase()===t)return n.id;return null},e.getPlotIdByTitle=function(e,t){if(void 0===e.styles)return null;t=t.toLowerCase();for(const n in e.styles){const r=e.styles[n];if((void 0!==r&&void 0!==r.title?r.title:n).toLowerCase()===t)return n}return null},e.getFilledAreaIdByTitle=function(e,t){if(void 0===e.filledAreas)return null;t=t.toLowerCase();for(const n of e.filledAreas)if(n.title.toLowerCase()===t)return n.id;return null},e.getBandIndexByName=function(e,t){if(void 0===e.bands)return null;t=t.toLowerCase();for(let n=0;n<e.bands.length;++n)if(e.bands[n].name.toLowerCase()===t)return n;return null},e.getMetaInfoByDescription=function(e,t){t=t.toLowerCase();for(const n of e)if(n.description.toLowerCase()===t||n.shortDescription.toLowerCase()===t)return n;return null}}(a||(a={}))},883161:(e,t,n)=>{"use strict";n.d(t,{StudyMetaInfoBase:()=>y});var r=n(827147),i=n(650151),s=n(62745),o=n(922814),a=n(125226);const u=new Set(["CorrelationCoefficient@tv-basicstudies","Correlation - Log@tv-basicstudies-1"]),c=(0,a.isFeatureEnabled)("multiple_SoS"),l=new Set([]),d=new Set(["line"]),p=new Map([["AnchoredVWAP@tv-basicstudies","linetoolanchoredvwap"],["RegressionTrend@tv-basicstudies","linetoolregressiontrend"]]),f=/^([^\$]+)\$\d+$/,S=["bool","color","time","text_area"];class y{static getSourceIdsByInputs(e,t){if(!Array.isArray(e)||!t)return[];const n=[];for(const i of e)if(y.isSourceInput(i)&&(0,r.default)(t[i.id])){const e=t[i.id];e.includes("$")&&n.push(e.split("$")[0])}return n}static isSourceInput(e){return Boolean(e.id&&(("source"===e.id||"src"===e.id)&&("text"===e.type||"source"===e.type)||"source"===e.type))}static getSourceInputIds(e){const t=[];for(const n of e.inputs)y.isSourceInput(n)&&t.push(n.id);return t}static setChildStudyMetaInfoPropertiesSourceId(e,t,n){for(const r of e.inputs){if(!y.isSourceInput(r))continue;const e=n.childs().inputs&&n.childs().inputs.childs()[r.id];if(e){const n=e.value(),r=f.exec(n)
;if(2===(null==r?void 0:r.length)){if("{pid}"===r[1]){const r=n.replace(/^[^\$]+/,t);e.setValue(r)}}}}}static patchSoSInputs(e,t){const n=e=>{const n=f.exec(e);if(2===(null==n?void 0:n.length)){const r=n[1],s=`${(0,i.ensureNotNull)(t(r))}`;return e.replace(/^[^\$]+/,s)}return e};for(const t in e)if(/in_[\d+]/.test(t)||"source"===t){const i=e[t];(0,r.default)(i)?e[t]=n(i):(0,s.isExtendedInput)(i)&&(0,s.isExtendedInputSource)(i)&&(i.v=n(i.v))}}static canBeChild(e){if((0,r.default)(e))return!0;if(!e)return!1;if(e.extra&&!y.isAllowedSourceInputsCount(e.extra.sourceInputsCount)||!0===e.canNotBeChild||!1===e.canBeChild||u.has(e.id))return!1;let t=0;for(const n of e.inputs)y.isSourceInput(n)&&(t+=1);return y.isAllowedSourceInputsCount(t)}static isAllowedSourceInputsCount(e){return c&&e>0||1===e}static canHaveChildren(e){if(e){if(e.isTVScriptStrategy||e.TVScriptSourceCode&&(0,o.isStrategy)(e.TVScriptSourceCode))return!1;if(e.id&&!l.has(e.id)&&Array.isArray(e.plots))for(const t of e.plots)if(d.has(t.type))return!0}return!1}static getChildSourceInputTitles(e,t,n){var r;const i={};if(t.plots&&t.plots.length&&e.options&&e.options.length)for(const s of e.options){const e=s?+s.split("$")[1]:NaN,o=isFinite(e)&&t.plots[e];o&&d.has(o.type)&&(i[s]=t.styles&&t.styles[o.id]&&(null===(r=t.styles[o.id])||void 0===r?void 0:r.title)||o.id,n&&(i[s]=n+": "+i[s]))}return i}static canPlotBeSourceOfChildStudy(e){return d.has(e)}static getStudyPropertyRootName(e){const t=p.get(e.id);if(void 0!==t)return t;let n="study_"+e.id;return e.pine&&e.pine.version&&(n+="_"+e.pine.version.replace(".","_")),n}static getStudyPropertyRootNameById(e){const t=p.get(e);return void 0!==t?t:"study_"+e}_updateInputDisplayDefaults(){this.inputs.filter((e=>void 0===e.display)).forEach((e=>{S.includes(e.type)?e.display=s.InputDisplayFlags.None:e.display=s.InputDisplayFlags.All}))}}},526075:(e,t,n)=>{"use strict";n.r(t),n.d(t,{StudyMetaInfo:()=>u});var r=n(201089).getLogger("Chart.Study.MetaInfo"),i=n(465746).applyOverridesToStudyDefaults,s=n(883161).StudyMetaInfoBase,o=n(520533).PineKind,a={};class u extends s{constructor(e){super(),TradingView.merge(this,{palettes:{},inputs:[],plots:[],graphics:{},defaults:{}}),TradingView.merge(this,e);var t=e.fullId||e.id;TradingView.merge(this,u.parseIdString(t)),this._updateInputDisplayDefaults()}static versionOf(e){var t="_metainfoVersion"in e&&isNumber(e._metainfoVersion)?e._metainfoVersion:0;return t<0&&r.logError("Metainfo format version cannot be negative: "+t),t}static parseIdString(e){var t={};if(-1===e.indexOf("@"))t.shortId=e,t.packageId="tv-basicstudies",t.id=e+"@"+t.packageId,t.version=1;else{var n=e.split("@");t.shortId=n[0];var r=n[1].split("-");if(3===r.length)t.packageId=r.slice(0,2).join("-"),t.id=t.shortId+"@"+t.packageId,t.version=r[2];else if(1===r.length&&"decisionbar"===r[0])t.packageId="les-"+r[0],t.id=t.shortId+"@"+t.packageId,t.version=1;else{if(1!==r.length)throw new Error("unexpected study id:"+e);t.packageId="tv-"+r[0],t.id=t.shortId+"@"+t.packageId,t.version=1}}if(t.fullId=t.id+"-"+t.version,
"tv-scripting"===t.packageId){var i=t.shortId;if(0===i.indexOf("Script$")||0===i.indexOf("StrategyScript$")){var s=i.indexOf("_");t.productId=s>=0?i.substring(0,s):t.packageId}else t.productId=t.packageId}else t.productId=t.packageId;return t}static getPackageName(e){return(/^[^@]+@([^-]+-[^-]+)/.exec(e||"")||[0,"tv-basicstudies"])[1]}static cutDollarHash(e){var t=e.indexOf("$"),n=e.indexOf("@");return-1===t?e:e.substring(0,t)+(n>=0?e.substring(n):"")}static hasUserIdSuffix(e){return/^USER;[\d\w]+;\d+$/.test(e)}static hasPubSuffix(e){return/^PUB;.+$/.test(e)}static hasStdSuffix(e){return/^STD;.+$/.test(e)}static isStandardPine(e){return/^(Strategy)?Script\$STD;.*@tv-scripting$/.test(e)}static getStudyIdWithLatestVersion(e){const t=u.cutDollarHash(e.id);let n=t;return t.indexOf("@tv-scripting")>=0?n+="-101!":t.endsWith("CP@tv-basicstudies")?n+="-"+Math.min(e.version,207):t.endsWith("CP@tv-chartpatterns")?n+="-"+Math.min(e.version,9):n+="-"+e.version,n}defaultInputs(){for(var e=[],t=0;t<this.inputs.length;t++)e.push(this.inputs[t].defval);return e}state(e){var t={};for(var n in this)this.hasOwnProperty(n)&&(t[n]=this[n],!0!==e&&"id"===n&&(t[n]+="-"+this.version));return t}symbolInputId(){var e=this.inputs.filter((function(e){return"symbol"===e.type}));return e.length>0?e[0].id:null}createDefaults(){if(this.defaults){var e=TradingView.clone(this.defaults);e.precision="default";var t=u.getStudyPropertyRootName(this);defaults.create(t,e)}}removeDefaults(){defaults.remove(u.getStudyPropertyRootName(this))}static findStudyMetaInfoByDescription(e,t){if(e){for(var n=0;n<e.length;++n)if(e[n].description.toLowerCase()===t.toLowerCase())return e[n];throw new Error("unexpected study id:"+t)}throw new Error("There is no studies metainfo")}static isParentSourceId(e){return"string"==typeof e&&/^[^\$]+\$\d+$/.test(e)}static overrideDefaults(e){0!==e.length&&i(a,e,(function(e){return TradingView.defaultProperties[u.getStudyPropertyRootName(e)]||null}))}static mergeDefaultsOverrides(e){TradingView.merge(a,e)}static isScriptStrategy(e){if(e.extra&&e.extra.kind)return e.extra.kind===o.Strategy;if(!0===e.isTVScriptStrategy)return!0;var t=e.TVScriptSourceCode||e.scriptSource;return!!t&&TVScript.isStrategy(t)}static getOrderedInputIds(e){for(var t=[],n=e.inputs,r=0;r<n.length;++r){var i=n[r];t.push(i.id)}return t}}u.VERSION_STUDY_ARG_SOURCE=41,u.METAINFO_FORMAT_VERSION_SOS_V2=42,u.VERSION_PINE_PROTECT_TV_4164=43,u.CURRENT_METAINFO_FORMAT_VERSION=52,u.VERSION_NEW_STUDY_PRECISION_FORMAT=46,u.FilledArea={},u.FilledArea.TYPE_PLOTS="plot_plot",u.FilledArea.TYPE_HLINES="hline_hline",TradingView.StudyMetaInfo=u},922814:(e,t,n)=>{var r;e=n.nmd(e),"undefined"!=typeof window&&(r=window.TVScript=window.TVScript||{}),(r=r||{}).Access={},r.Access.ACCESS_OPEN_NO_AUTH="open_no_auth",r.Access.ACCESS_CLOSED_NO_AUTH="closed_no_auth",r.Access.ACCESS_CLOSED_NEEDS_AUTH="closed_needs_auth",r.Access.MAP_ID_TO_NAME={1:r.Access.ACCESS_OPEN_NO_AUTH,2:r.Access.ACCESS_CLOSED_NO_AUTH,3:r.Access.ACCESS_CLOSED_NEEDS_AUTH},r.Access.MAP_NAME_TO_ID={},
Object.keys(r.Access.MAP_ID_TO_NAME).forEach((function(e){r.Access.MAP_NAME_TO_ID[r.Access.MAP_ID_TO_NAME[e]]=e})),r.PinePrefix={},r.PinePrefix.USER="USER;",r.PinePrefix.PUB="PUB;",r.PinePrefix.STD="STD;",r.PinePrefix.TV="TV_",r.PinePrefix.EDGR="EDGR_",r.PineType={},r.PineType.UserSaved="PineType_UserSaved",r.PineType.UserPublished="PineType_UserPublished",r.PineType.BuiltIn="PineType_BuiltIn",r.PineType.Addon="PineType_Addon",r.Type=r.Type||function(){},r.Type.VOID="void",r.Type.INTEGER="integer",r.Type.FLOAT="float",r.Type.STRING="string",r.Type.BOOL="bool",r.Type.COLOR="color",r.Type.SERIES="series",r.Type.PLOT="plot",r.Type.HLINE="hline",r.Type.BARCOLOR="barcolor",r.Type.BGCOLOR="bgcolor",r.Type.PLOTSHAPES="plotshape",r.Type.PLOTCHARS="plotchar",r.Type.PLOTARROWS="plotarrow",r.Type.NA="na",r.Type.ARRAY="array",r.TranslatorDefaultVersion=1,r.TranslatorReferenceVersioningIntroduced=4,r.TranslatorLastVersion=5,r.pineType=function(e){return e.startsWith(r.PinePrefix.USER)?r.PineType.UserSaved:e.startsWith(r.PinePrefix.PUB)?r.PineType.UserPublished:e.startsWith(r.PinePrefix.STD)||e.startsWith(r.PinePrefix.TV)||e.startsWith(r.PinePrefix.EDGR)?r.PineType.BuiltIn:r.PineType.Addon},r.patchILTemplate=function(e,t,n){var i=n||{};return r._patchTemplate(/<(in_\d+)>/g,e,t,i)},r.decorateQuotes=function(e){if(!e)return e;var t=/([^\\']+?)(')[^']*?/g,n="$1\\$2",r=e;return"'"==r.charAt(0)&&"'"==r.charAt(r.length-1)?"'"+(r=r.substr(1,r.length-2)).replace(t,n)+"'":r.replace(t,n)},r.patchInputs=function(e,t){var n={};for(var r in e)if(e.hasOwnProperty(r)){var i,s=e[r];i=s.isFake?{v:t[s.id],f:!0,t:s.type}:t[s.id],n[s.id]=i}return n},r._patchTemplate=function(e,t,n,i){var s=i||{};return t.replace(e,(function(e,t){for(var i=(t in s?s[t]:n.defaults.inputs[t]),o=0;o<n.inputs.length;++o)if(n.inputs[o].id===t)if("bool"===n.inputs[o].type)i=i?"1.0":"0.0";else if(["text","symbol","resolution","session"].indexOf(n.inputs[o].type)>=0)i="'"+r.decorateQuotes(i)+"'";else if("source"===n.inputs[o].type){var a=i.split("$");a[0]="'"+a[0]+"'",i="source("+a.join(",")+")"}return i}))},r.isStrategy=function(e){return/^\s*strategy\s*\(/m.test(e)};var i=/^\s*\/\/\s*?@version\s*?=\s*?(\S*?)\s*?$/gm,s=/^[0-9]+$/;r.extractVersion=function(e){i.lastIndex=0;var t=i.exec(e);if(null===t)return 1;var n=t[1],o=s.test(n)?Number(n):NaN;return isNaN(o)?1:Math.max(r.TranslatorDefaultVersion,Math.min(o,r.TranslatorLastVersion))},r.canUpgradeVersion=function(e){return e>=3&&e<r.TranslatorLastVersion},r.canDowngradeVersion=function(e){return e>=4&&e<=r.TranslatorLastVersion},e&&e.exports&&(e.exports=r)}}]);
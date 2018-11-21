/*
 * Project: vTimer
 * Description: Configurable event-based jQuery timer
 * Author: https://github.com/Wancieho
 * License: MIT
 * Version: 0.0.3
 * Dependancies: jquery-1.*
 * Date: 10/02/2016
 */
!function(t){"use strict";function i(i,e){this.element=i,this.settings=t.extend({},a,e),this._defaults=a,this._name=s,this.interval=null,this.remaining=null,this.expiresAt=null}function e(){return Math.round((new Date).getTime()/1e3)}function n(){var i=this;this.remaining=this.expiresAt-e(),t(this.element).trigger("update",this.remaining),this.remaining<=0?(t(this.element).trigger("complete"),this.stop()):this.interval=setTimeout(function(){n.apply(i)},1e3)}var s="vTimer",a={duration:0};t.extend(i.prototype,{start:function(){this.stop(),n.apply(this)},stop:function(){this.expiresAt=e()+this.settings.duration,clearInterval(this.interval),this.interval=null},cancel:function(){t(this.element).trigger("cancel"),this.stop()}}),t.fn[s]=function(e,n){return this.each(function(){t.data(this,"plugin_"+s)||t.data(this,"plugin_"+s,new i(this,n)),"start"===e&&t.data(this,"plugin_"+s).start(),"cancel"===e&&t.data(this,"plugin_"+s).cancel()})}}(jQuery);
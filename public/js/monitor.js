var Monitor = function () {
    this.url = 'http://cms.test.org/monitor/index';
    this.name = '88b21a15f028606c';
}

Monitor.prototype.init = function(){
    this.pv();
}

Monitor.prototype.pv = function(){
    var cookie = this.getCookie(this.name);
    if(!cookie){
        var value = {};
        value.firstTime = this.timeStamp();
        value.lastTime = this.timeStamp();
        this.setCookie(this.name, JSON.stringify(value));
        this.send(value.firstTime);
        return;
    }
    var visitInfo = JSON.parse(cookie);
    var lastTime = visitInfo.lastTime;
    var nowTime = this.timeStamp();
    if(nowTime - lastTime < 5) {
        return;
    }
    this.send(visitInfo.firstTime);
}

Monitor.prototype.send = function (firstTime){
    $.get(this.url, { firstTime: firstTime, url: window.location.pathname } );
}

Monitor.prototype.timeStamp = function(){
    return Math.round(new Date().getTime()/1000);
}

Monitor.prototype.setCookie = function(name, value, expire){
    var exdate = new Date()
    exdate.setDate(exdate.getDate()+expire)
    document.cookie = name+ "=" +escape(value)+ ((expire==null) ? "" : ";expires="+exdate.toGMTString())
}

Monitor.prototype.getCookie = function (name) {
    var arr,reg = new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg)){
        return unescape(arr[2]);
    }
    else {
        return null;
    }
}

Monitor.prototype.delCookie = function (name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = this.getCookie(name);
    if(!cval){
        document.cookie= name + "="+cval+";expires="+exp.toGMTString();
    }
}

window.onload = function(){new Monitor().init();}

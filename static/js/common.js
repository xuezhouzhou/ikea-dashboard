// JavaScript Document
var AL = {
	//千分位转换
	commafy:function(num){
		num = num + ""; 
		var re = /(-?\d+)(\d{3})/;
		while(re.test(num)){ 
			num=num.replace(re,"$1,$2"); 
		}
		return num; 
	}
};

//检测数组中是否包含某个元素
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt)
  {
    var len = this.length >>> 0;
    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;
    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}
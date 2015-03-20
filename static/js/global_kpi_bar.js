(function($,echarts,AL){
	var num = 1;
	
	$(function(){
		setReportMark();
		showChart();
	});
	
	$('#cn-switch').on('click',function(){
		$(this).toggleClass('cn-switch-show');
		var statue = $(this).attr('data');
		if(statue==0){
			$(this).attr('data','1')
			$(this).text('CN:Show');
		}else if(statue==1){
			$(this).attr('data','0')
			$(this).text('CN:Hide');
		}
		showChart();
	});
	
	$('.xzz-select-wrap').on('click',function(){
		$(this).toggleClass("border-radius-none");
		$(this).children('.xzz-list').toggle();
	});
	
	//时间段(report)点击
	$('#report-select .item').click(function(){
		var $_this = $(this);
		var text = $_this.text();
		var data = $_this.attr('data');
		$_this.parent().siblings('.cur-item').text(text);
		$_this.parent().siblings('.cur-item').attr('data',data);
		setReportMark();
		showChart();
	});
	
	//指标(index)点击
	$('#index-select .item').on('click',function(){
		var $_this = $(this);
		var text = $_this.text();
		$_this.parent().siblings('.cur-item').text(text);
		showChart();
	});
		

	
	$('#btn').click(function(){
		$(this).toggleClass('right');
		$('#x-table').toggle();
		
		if(num==1){
			$('#x-chart').removeClass('col-xs-10');
			$('#x-chart').addClass('col-xs-12');
			num = 0;
		}else{
			$('#x-chart').removeClass('col-xs-12');
			$('#x-chart').addClass('col-xs-10');
			num = 1;	
		}
		showChart();
	});
	
	//设置report的备注
	function setReportMark(){
		var html = $("#report-select .cur-item").attr('data');
		$('#report-mark').text(html);
	}
	
	function showChart(){
		var myChart = echarts.init(document.getElementById('chartdiv'));
		
		//配置信息
		var option = {
    	title : {
    		x:'center',
    	},
    	tooltip : {
      	trigger: 'item',
			},
    	xAxis : [{
      	type : 'category',
				name : 'Store',
				data:[],
			}],
    	yAxis : [{
				type : 'value',
        splitArea : {show : true},
				axisLabel : {
        	formatter: ''
        },
     	}],
    	series : [{
      	name:'Loading...',
        type:'bar',
				itemStyle: {
        	normal: {
          	color: 'tomato',
            label : {
            	show: true, 
							//position: 'inside',
							textStyle : {
								color:'#806d54',
              	fontSize : '12',
                fontFamily : 'Verdana',
                
              },
							formatter:function(a,b,c){
								return c;
							}
						}
					},
					
					emphasis: {
          	label : {
            	show: true, 
							textStyle : {
								color:'#806d54',
              	fontSize : '12',
                fontFamily : 'Verdana',
              },
							//formatter:'';
						}
					} 
				},
				data:[],
			}]
		};
		
		//当前坐标
		var index = $('#index-select .cur-item').text();
		//当前考察区间
		var report = $('#report-select .cur-item').text();
		var url = 'global_kpi_bar_data.php?index='+index+'&report='+report;
		var cnStatue = $('#cn-switch').attr('data');
		
		$.ajax({
			type: "GET",
			url:url,
			cache: false,
			async: false,
			dataType:'json',
			success: function(data){
				var html = '<tr><th>Store</th><th>Value</th></tr>';
				
				for(var i=0;i<data.length;i++){
					var color;	
					if(i%2==0){
						color = '#7f6d54'
					}else{
						color = '#e0bb92'
					}
					
					
					//排除CN数据(CN数据不再图表显示)
					if(data[i].store!='CN'){
						var tempData = {
							value:data[i].num,
							itemStyle:{
								normal:{
									color:color,
								}	
							}
						};
						option.series[0].data.push(tempData);
						option.xAxis[0].data.push(data[i].store);
					}else{
						var num = data[i].num;
						var total = num<=4 ? 4 : num*1.4;
						var units = /%/.test(index) ? "%" : "";
						
						
						$("#cn-chart .span-5").text(AL.commafy(Math.round(total))+units);
						$("#cn-chart .span-4").text(AL.commafy(Math.round(total*0.75))+units);
						$("#cn-chart .span-3").text(AL.commafy(Math.round(total*0.5))+units);
						$("#cn-chart .span-2").text(AL.commafy(Math.round(total*0.25))+units);
						$("#cn-chart .bar-cur span").text(AL.commafy(num)+units);
						$("#cn-chart .bar-cur").css({width:"5%"});
						var widthBfb = (num/total).toFixed(4)*100 +　"%";
						$("#cn-chart .bar-cur").animate({width:widthBfb},1000);
					}
					
					
					if(/%/.test(index)){
						html += '<tr><td>'+data[i].store+'</td><td>'+data[i].num+'%</td></tr>';
					}else{
						html += '<tr><td>'+data[i].store+'</td><td>'+AL.commafy(data[i].num)+'</td></tr>';
					}
				}
				
				if(index=="New Member Identification Rate"){
					//为指标"New Member Identification Rate"添加一个100%的假数据以撑高纵轴刻度
					var demoData = {
						value:100,
						itemStyle:{
							normal:{
								color:'#fff',
							}	
						}
					};
					option.series[0].data.push(demoData);
				}
				
				
			
				$("#chart-table").text('');
				$("#chart-table").append(html);
				
				//标题
				option.title.text = index;
					
				//副标题
				//option.title.subtext = report;
				//option.xAxis[0].data = arrStore;
				
				//纵轴名称
				//option.yAxis[0].name = indexTitle;
				
				
				
				if(/%/.test(index)){
					//直接显示的数据格式化
					option.series[0].itemStyle.normal.label.formatter = function(a,b,c){return c+'%';};
					//纵轴数据格式化
					option.yAxis[0].axisLabel.formatter = '{value}%';
					//悬浮数据格式化
					option.tooltip.formatter = '{c}%';
				}else{
					option.yAxis[0].axisLabel.formatter = '';
					option.series[0].itemStyle.normal.label.formatter = function(a,b,c){return AL.commafy(c)};
					option.tooltip.formatter = '{c0}'
				}
				
				
				myChart.setOption(option);
			}
		});
	}
})(jQuery,echarts,AL);
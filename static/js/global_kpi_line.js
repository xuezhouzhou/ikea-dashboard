(function($,echarts,AL){
	//DOM完成加载
	$(function(){
		setReportMark();
		showChart();
	});
	
	
	var num = 1;
	$('#btn').click(function(){
		$(this).toggleClass('right');
		$('#store-tag').toggle();
		if(num==1){
			$('#store-chart').css({'width':'100%'});	
			num = 0;
		}else{
			$('#store-chart').css({'width':'80%'});
			num = 1;	
		}
		showChart();
	});
	
	$('.xzz-select-wrap').on('click',function(){
		$(this).toggleClass("border-radius-none");
		$(this).children('.xzz-list').toggle();
	});
	
	//时间段(report)点击
	$('#report-select .item').on('click',function(){
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
	
	//商场选择
	$('#store-tag li').click(function(){
		$(this).toggleClass("checked");
		if($('#store-tag li.checked').length<1){
			alert('至少选择一家Store');
			$(this).toggleClass("checked");
		}else{
			showChart();	
		}
	});
	
	function setReportMark(){
		var html = $("#report-select .cur-item").attr('data');
		$('#report-mark').text(html);
	}
	
	//图表绘制
	function showChart(){
		var myChart = echarts.init(document.getElementById('chartdiv'));
		var option = {
			title:{
				text: '',
				x:'78',
			},
			tooltip : {
				trigger: 'axis'
			},
			legend: {
				data:[]
			},
			calculable : true,
			xAxis : [
				{
					type : 'category',
					boundaryGap : false,//折点位置 true 中间 false 左边
					data:[]
				}
			],
			yAxis : [
				{
					type : 'value',
					axisLabel : {
						formatter: '{value}'
					},
					splitArea : {show : true}//背景分隔
				}
			],
			
			series:[],
			
		};

		
		var index = $('#index-select .cur-item').text();
		var report = $('#report-select .cur-item').text();
		var storeLen = $('#store-tag li.checked').length;
		var storeChecked = '';
		var html = '<tr><th>Periods</th>';
		
		/*$('#checkbox-wrap input:checked').each(function(index, element) {
			var value = $(element).val();
      storeChecked += value+',';
			if(storeLen>0){
				html+= '<th>'+value+'</th>';	
			}
    });*/
		
		$('#store-tag li.checked').each(function(index,element){
			var value = $(element).text();
      storeChecked += value+',';
			html+= '<th>'+value+'</th>';	
		});
		
		
		storeChecked = storeChecked.substr(0,storeChecked.length-1);
		html += '</tr>';
		
		var url = 'global_kpi_line_data.php?index='+index+'&report='+report+'&storeChecked='+storeChecked;
		
		$.ajax({
			type: "GET",
			url:url,
			cache: false,
			async: false,
			dataType:'json',
			success: function(data){
				//console.log(data);
				var arrReport = [];
				var arrNum = [];
				var arrStore = [];
				var range = data.length/storeLen;
				
				for(var i=0;i<data.length;i++){
					
					
					arrNum.push(data[i].num);
					
					
					
					if(i<range){
						arrReport.push(data[i].report);
					}
					
					if((i+1)%range==0){
						arrStore.push(data[i].store);
						var itemSeries = {
							name:'',
							type:'line',
							itemStyle: {
								normal: {
									lineStyle: {
										shadowColor : 'rgba(0,0,0,0.4)',
										shadowBlur: 5,
										shadowOffsetX: 3,
										shadowOffsetY: 3,
									}
								}
							},
							symbolSize:5,
							data:[],
						};
						
						itemSeries.data = arrNum;
						itemSeries.name = data[i].store;
						option.series.push(itemSeries);
						arrNum = [];
					}
				}
				
				//console.log(option.series[0].data);
				//console.log(option.series[1].data);
				
				
				option.xAxis[0].data = arrReport;
				option.legend.data = arrStore;
				option.title.text = index;
				
				if(/%/.test(index)){
					option.yAxis[0].axisLabel.formatter = '{value}%';//纵轴格式
					option.tooltip.formatter = '{b0}<br>';
					for(var i=0;i<storeLen;i++){
						option.tooltip.formatter += '{a' + i + '} : {c' + i +'}%<br>';	
					}
				}else{
					option.yAxis[0].axisLabel.formatter = '';
					option.tooltip.formatter = '{b0}<br>';
					for(var i=0;i<storeLen;i++){
						option.tooltip.formatter += '{a' + i + '} : {c' + i +'}<br>';	
					}
				}
				
				$("#chart-table").text('');
				myChart.setOption(option);	
			}
		});
	}
})(jQuery,echarts,AL);
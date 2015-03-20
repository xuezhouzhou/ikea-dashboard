(function($,echarts){
  //store kpi 全部数据
  var storeKpiData = {};
  
  //获取store kpi 全部数据
  function getStroeKpiData(){
    $.ajax({
      type: "GET",
      url:'data.php',
      cache: false,
      async: false,
      dataType:'json',
      success: function(data){
        storeKpiData = data;
      }
    });  
  }

  //下拉列表
  $('.xzz-select-wrap').on('click',function(){
    $(this).toggleClass("border-radius-none");
    $(this).children('.xzz-list').toggle();
  });

  //显示数据
  function showData(year,month,store){
    storeKpiData.forEach(function(item,index){
      if(item['Store']==store && item['Year']==year && item['Month'] == month){
        //PartA 第1块
        $("#indexD").text(item['Member T/O']);
        
        //PartA 第2块
        $("#indexE").text(item['Active Member']);
        $("#indexF").text(item['Individual Spending']);
        $("#indexG").text(item['Avg.Ticket']);
        $("#indexH").text(item['Share Of Receipts']);
        $("#indexI").text(item['Share Of T/O']);
        
        //PartA 第3块
        $("#indexJ").text(item['Individual Spending-NEW']);
        $("#indexK").text(item['Individual Spending-NEW Repeat']);
        $("#indexL").text(item['Individual Spending-Continue']);
        $("#indexM").text(item['Individual Spending-Reactive']);
        
        //PartA 第4块
        $("#indexN").text(item['Member Quantity-New']);
        $("#indexO").text(item['Member Quantity-New Repeat']);
        $("#indexP").text(item['Member Quantity-Continue']);
        $("#indexQ").text(item['Member Quantity-Reactive']);

        //PartB 左侧
        var indexR = removeBfh(item['Share OF Receipts-New']);
        var indexS = removeBfh(item['Share OF Receipts-New Repeat']);
        var indexT = removeBfh(item['Share OF Receipts-Continue']);
        var indexU = removeBfh(item['Share OF Receipts-Reactive']);
        var indexV = removeBfh(item['Share OF Receipts-Non Member']);
        var shareOfReceiptsData = [indexR,indexS,indexT,indexU,indexV];
        
        $("#indexR").text(indexR);
        $("#indexS").text(indexS);
        $("#indexT").text(indexT);
        $("#indexU").text(indexU);
        $("#indexV").text(indexV);

        //PartB 左侧的饼图显示
        showPie(shareOfReceiptsData,'share-of-receipts');

        //PartB 右侧
        var indexW = removeBfh(item['Share OF T/O-New']);
        var indexX = removeBfh(item['Share OF T/O-New Repeat']);
        var indexY = removeBfh(item['Share OF T/O-Continue']);
        var indexZ = removeBfh(item['Share OF T/O-Reactive']);
        var indexAa = removeBfh(item['Share OF T/O-Non Member']);
        var shareOfToData = [indexW,indexX,indexY,indexZ,indexAa];
        
        $("#indexW").text(indexW);
        $("#indexX").text(indexX);
        $("#indexY").text(indexY);
        $("#indexZ").text(indexZ);
        $("#indexAa").text(indexAa);
        
        //PartB 右侧的饼图显示
        showPie(shareOfToData,'share-of-to');
      }
    });
  }
  
  $(function(){ 
    getStroeKpiData();
    showData('2014','12','058TJ') 
  });
     
  
  

  //删除数据百分号
  function removeBfh(str){
    return str.replace('%','');
  }

  //PartB 饼图显示
  function showPie(arrData,id){
    var option = {
      series : [
        {
          type:'pie',
          radius : ['55%', '75%'],
          itemStyle : {
            normal : {
              label : {
                show : false
              },
              labelLine : {
                show : false
              }
            }
          },
          data:[
            {
              value:335, 
              itemStyle:{
                normal:{
                  color:'#964b34'
                }
              }
            },
            {
              value:310, 
              itemStyle:{
                normal:{
                  color:'#368355'
                }
              }
            },
            {
              value:234, 
              itemStyle:{
                normal:{
                  color:'#2569a1'
                }
              }  
            },
            {
              value:135, 
              itemStyle:{
                normal:{
                  color:'#764e91'
                }
              }
            },
            {
              value:1548, 
              itemStyle:{
                normal:{
                  color:'#a86d2c'
                }
              }
            }
          ]
        }
      ]
    }; 

    for(var i=0;i<option.series[0].data.length;i++){
      option.series[0].data[i].value = arrData[i];
    }

    var myChart = echarts.init(document.getElementById(id));
    myChart.setOption(option);
  }

  //showPieChart(option,'share-of-receipts');
  //showPieChart(option2,'share-of-to');

})(jQuery,echarts);
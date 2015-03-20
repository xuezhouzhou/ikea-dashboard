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

  getStroeKpiData();
  
  

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

        console.log(shareOfReceiptsData);

        $("#indexR").text(indexR);
        $("#indexS").text(indexS);
        $("#indexT").text(indexT);
        $("#indexU").text(indexU);
        $("#indexV").text(indexV);

      }
    });
  }
  
  showData('2014','12','058TJ');

  

  //删除数据百分号
  function removeBfh(str){
    return str.replace('%','');
  }

  //获取左侧饼图数据
  function getPieLeftData(){
  
  }



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

var option2 = {
  tooltip : {
    trigger: 'item',
    formatter: "{a} <br/>{b} : {c} ({d}%)"
  },
  legend: {
    orient : 'vertical',
    x : 'left',
    data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
  },
  calculable : true,
  series : [
    {
      name:'访问来源',
      type:'pie',
      radius : ['60%', '80%'],
      itemStyle : {
        normal : {
          label : {
            show : false
          },
          labelLine : {
            show : false
          }
        },
        emphasis : {
          label : {
            show : true,
            position : 'center',
            textStyle : {
              fontSize : '30',
              fontWeight : 'bold'
            }
          }
        }
      },
      data:[
        {value:335, name:'直接访问'},
        {value:310, name:'邮件营销'},
        {value:234, name:'联盟广告'},
        {value:135, name:'视频广告'},
        {value:1548, name:'搜索引擎'}
      ]
    }
  ]
};

  //饼图显示
  function showPieChart(option,id){
    var myChart = echarts.init(document.getElementById(id));
    myChart.setOption(option);
  }


  showPieChart(option,'share-of-receipts');
  //showPieChart(option2,'share-of-to');

})(jQuery,echarts);
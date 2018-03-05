function showOptions(opt)
{
  if(opt == 'c')
  {
    $('#vehicle').show();
    $('#employee').hide();
  }
  else
  {
    $('#vehicle').hide();
    $('#employee').show();
  }
}

function checkQlf()
{    
    
    if($('#certificationdate1').val() != '' || $('#expirationdate1').val() != '' || $('#certificationdate2').val() != '' || $('#expirationdate2').val() != '' || $('#certificationdate3').val() != '' || $('#expirationdate3').val() != '' || $('#craneoperator').is(":checked") == true || $('#qlfcertified1').is(":checked") == true || $('#qlfsignalperson').is(":checked") == true || $('#qlfcertified2').is(":checked") == true || $('#qlfrigger').is(":checked") == true || $('#qlfcertified3').is(":checked") == true || $('#qlfmechanic').is(":checked") == true || $('#qlfelectromechanic').is(":checked") == true || $('#qlfinspector').is(":checked") == true)
    {
        $('.laborRate :input').each(function(){
           $(this).attr('required', '');
        })
    }
    else
    {
        $('.laborRate :input').each(function(){
           $(this).removeAttr('required');
        })
    }
    
}

function addMultipleFile()
{
    var html='';
      
     html+=' <label class="col-lg-4 control-label"></label>';
     html+='                          <div class="col-lg-6">';
     html+='                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">';
     html+='                                  <div class="form-control" data-trigger="fileinput">';
     html+='                                      <i class="glyphicon glyphicon-file fileinput-exists"></i>';
     html+='                                  <span class="fileinput-filename"></span>';
     html+='                                  </div>';
     html+='                                  <span class="input-group-addon btn btn-default btn-file">';
     html+='                                      <span class="fileinput-new">Select file</span>';
     html+='                                      <span class="fileinput-exists">Change</span>';
     html+='                                      <input type="file" multiple name="document[]"/>';
     html+='                                  </span>';
     html+='                                  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>';
     html+='                              </div> ';
     html+='                          </div>';

    // html+= '</div>';
     $('#showMultiple').append(html);
}
    var currentRow = null;
    function getItemDetail()
    {
        var itemid = $('#itemid').val();
        if(itemid != "")
        {
          $.ajax({
                    url: 'include/getData.php',
                    type: 'POST',
                    dataType: 'json',
                    data: "reqtype=getitemdetail&id="+itemid, //get model dan ukuran
                    success: function (data) {
                      if(data != 0)
                      {
                        var qty = $('#quantity').val();
                        var itmcost = parseFloat($('#unitprice').val()).toFixed(2);
                        var itmId = data[0];
                        var itmdesc = data[1];
                        var itmmeasurunit = data[2];
                        //var itmcost = data[3];
                        var itmamount = (qty * itmcost).toFixed(2);
                        var hdndata = data[0] +","+qty+","+itmamount+","+itmcost;
                        var rowData = "<input type='hidden' name='h1[]' value='"+hdndata+"'>";
                        var btnhtml = "<td><a onclick=\"editPOLine()\"  data-toggle='modal' data-target=\"#myModal\"><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<i onclick='rm(); showTotalOnRemoveRow() ; showPOGTotal();' class='glyphicon glyphicon-remove'></i></td>";
                        var new_row = "<tr>"+rowData+"<td>"+itmId+"</td><td>"+itmdesc+"</td><td>"+qty+"</td><td>"+itmmeasurunit+"</td><td>"+itmcost+"</td><td>"+itmamount+"</td>"+btnhtml+"</tr>";

                        if(currentRow) 
                        {
                          $(".tableline").find($(currentRow)).replaceWith(new_row);
                          currentRow = null;
                        }
                        else
                        {
                          $(".tableline").append(new_row);
                        }
                        
                        showTotalOnRemoveRow();
                        showPOGTotal();
                      }
                    },
                    error: function (e) {
                        //called when there is an error
                        console.log(e.message);
                    }
                });
        }
        

        $("#myModal .close").click();
    }

    function showTotalOnRemoveRow()
    {
      var totalOrgPrice = 0;

      $('input[name^="h1"]').each( function() {
          var spltVal = this.value.split(",");
          totalOrgPrice += parseFloat(spltVal[2]);
      });

      $("#unittoal").val(totalOrgPrice.toFixed(2));
    }

    function showPOGTotal()
    {
      var subtotal = $('#unittoal').val();
      var discount = $('#discount').val();
      var taxval = $('#taxval').val();
      if(taxval > 0)
      {
        var taxamount = ((subtotal - discount) * taxval) / 100;
        var totVal = ((subtotal - discount) + taxamount)
      }
      else
      {
        var totVal = subtotal - discount;
      }
      $('#grandtotal').val(totVal.toFixed(2));
    }

    function showItemDesc()
    {
      var itemid = $('#itemid').val();
      if(itemid == "-1")
      {
        $('#itmdesc').show();
      }
      else
        $('#itmdesc').hide();
    }
    
    function getStockTransferDetail()
    {
        var warehouse = $('#warehouse').val();
        var itemid = $('#itemid').val();
        

        if(itemid != "" && itemid != "-1" && parseInt($('#quantity').val()) <= parseInt($('#qtyinhand').val()))
        {
          $.ajax({
                    url: 'include/getData.php',
                    type: 'POST',
                    dataType: 'json',
                    data: "reqtype=getitemdetailwithstock&id="+itemid+"&warehouse="+warehouse, //get model dan ukuran
                    success: function (data) {
                      
                      if(data != 0)
                      {
                        var qty = $('#quantity').val();

                        var itmId = data[0];
                        var itmdesc = data[1];
                        
                        var hdndata = data[0] +"!"+qty+"!"+itmdesc;

                        var rowData = "<input type='hidden' name='h1[]' value='"+hdndata+"'>";
                        var btnhtml = "<td><a onclick=\"editStockTransferLine()\"  data-toggle='modal' data-target=\"#myModal\"><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<i onclick='rm()' class='glyphicon glyphicon-remove'></i></td>";
                        var new_row = "<tr>"+rowData+"<td>"+itmId+"</td><td>"+itmdesc+"</td><td>"+qty+"</td>"+btnhtml+"</tr>";

                        if(currentRow) 
                        {
                          $(".tableline").find($(currentRow)).replaceWith(new_row);
                          currentRow = null;
                        }
                        else
                        {
                          $(".tableline").append(new_row);
                        }
                        
                      }
                    },
                    error: function (e) {
                        //called when there is an error
                        console.log(e.message);
                    }
                });
        }
        $("#myModal .close").click();
    }


    function getReqItemDetail()
    {
        var warehouse = $('#warehouse').val();
        var itemid = $('#itemid').val();
        if(itemid != "" && itemid != "-1")
        {
          $.ajax({
                    url: 'include/getData.php',
                    type: 'POST',
                    dataType: 'json',
                    data: "reqtype=getitemdetailwithstock&id="+itemid+"&warehouse="+warehouse, //get model dan ukuran
                    success: function (data) {
                      if(data != 0)
                      {
                        var qty = $('#quantity').val();
                        var itmmeasurunit = $('#measureunit').val();
                        var itmId = data[0];
                        var itmdesc = data[1];
                        var itmcost = data[3];
                        var itmstock = data[4];
                        var itmamount = qty * itmcost;
                        var qtyBuy = ((itmstock - qty) < 0) ? (qty - itmstock ) : 0;
                        
                        var hdndata = data[0] +"!"+itmstock+"!"+qty+"!"+qtyBuy+"!"+itmdesc+"!"+itmmeasurunit;

                        var rowData = "<input type='hidden' name='h1[]' value='"+hdndata+"'>";
                        var btnhtml = "<td><a onclick=\"editReqLine()\"  data-toggle='modal' data-target=\"#myModal\"><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<i onclick='rm()' class='glyphicon glyphicon-remove'></i></td>";
                        var new_row = "<tr>"+rowData+"<td>"+itmId+"</td><td>"+itmdesc+"</td><td>"+itmstock+"</td><td>"+qty+"</td><td>"+qtyBuy+"</td><td>"+itmmeasurunit+"</td>"+btnhtml+"</tr>";

                        if(currentRow) 
                        {
                          $(".tableline").find($(currentRow)).replaceWith(new_row);
                          currentRow = null;
                        }
                        else
                        {
                          $(".tableline").append(new_row);
                        }
                        
                      }
                    },
                    error: function (e) {
                        //called when there is an error
                        console.log(e.message);
                    }
                });
        }
        else if( itemid == "-1")
        {
          
          var qty = $('#quantity').val();
          var itmmeasurunit = $('#measureunit').val();
          var itmId = -1;
          var itmdesc = $('#description').val();
          var itmcost = 0;
          var itmstock = 0;
          var itmamount = 0;
          var qtyBuy = qty;
          var hdndata = itmId +"!"+itmstock+"!"+qty+"!"+qtyBuy+"!"+itmdesc+"!"+itmmeasurunit;
          
          
          var rowData = "<input type='hidden' name='h1[]' value='"+hdndata+"'>";
          var btnhtml = "<td><a onclick=\"editReqLine()\"  data-toggle='modal' data-target=\"#myModal\"><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<i onclick='rm()' class='glyphicon glyphicon-remove'></i></td>";
          var new_row = "<tr>"+rowData+"<td>Not in Inventory</td><td>"+itmdesc+"</td><td>"+itmstock+"</td><td>"+qty+"</td><td>"+qtyBuy+"</td><td>"+itmmeasurunit+"</td>"+btnhtml+"</tr>";

          if(currentRow) 
          {
            $(".tableline").find($(currentRow)).replaceWith(new_row);
            currentRow = null;
          }
          else
          {
            $(".tableline").append(new_row);
          }
        }
        $("#myModal .close").click();
    }

    function rm() {

      $(event.target).closest("tr").remove();
      
    }

    function editLine()
    {
      var selectedRow = $(event.target).closest("tr");
      var pricperpound = selectedRow.find('td:eq(0)').text();
      var initialrange = selectedRow.find('td:eq(1)').text();
      var lastrange = selectedRow.find('td:eq(2)').text();
      $('#pricperpound').val(pricperpound);
      $('#initialrange').val(initialrange);
      $('#lastrange').val(lastrange);
      currentRow = selectedRow;
    }

    function editPOLine()
    {
      var selectedRow = $(event.target).closest("tr");
      var itmid = selectedRow.find('td:eq(0)').text();
      var quantity = selectedRow.find('td:eq(2)').text();
      var unitprice = selectedRow.find('td:eq(4)').text();
      $('#quantity').val(quantity);
      $('#unitprice').val(unitprice);
      $('#itemid').val(itmid).trigger("chosen:updated");
      currentRow = selectedRow;
    }

    function editReqLine()
    {
      var selectedRow = $(event.target).closest("tr");
      var itemid = selectedRow.find('td:eq(0)').text();
      
      var quantity = selectedRow.find('td:eq(3)').text();
      var measureunit = selectedRow.find('td:eq(5)').text();
      var description = selectedRow.find('td:eq(1)').text();
      var chval = [itemid];
      //$('select[name="itemid"]').find('option[value="'+itemid+'"]').attr("selected",true);
      //$("#itemid").val(chval).change();
      //$('#itemid').val(itemid);
      if(itemid == 'Not in Inventory')
      {
        itemid = -1;
        $('#itmdesc').show();
      }
      else
        $('#itmdesc').hide();
      $('#itemid').val(itemid).trigger("chosen:updated");
      $('#quantity').val(quantity);
      $('#measureunit').val(measureunit);
      $('#description').val(description);
      currentRow = selectedRow;
    }

    function editStockTransferLine()
    {
      var selectedRow = $(event.target).closest("tr");
      var itemid = selectedRow.find('td:eq(0)').text();
      
      var quantity = selectedRow.find('td:eq(2)').text();
      var description = selectedRow.find('td:eq(1)').text();
      var chval = [itemid];
      
      $('#itemid').val(itemid).trigger("chosen:updated");
      $('#quantity').val(quantity);
      $('#description').val(description);
      currentRow = selectedRow;
    }
function addItem()
{

   $('#quantity').val('');
   $('#unitprice').val('');
}

function addReqItem()
{
  $('#quantity').val('');
  $('#qtyinhand').val('');
  $('#measureunit').val('');
  $('#description').val('');
  $('#itemid').val('').trigger("chosen:updated");
}

function getQtyInHand()
{
  var warehouse = $('#warehouse').val();
  var itemid = $('#itemid').val();
  
  if(itemid > 0)
  {
      $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype=getqtyinhand&itemid="+itemid+"&warehouse="+warehouse, //get model dan ukuran
                success: function (data) {
                  
                  
                    // var expData = data.split(":");
                    $('#qtyinhand').val(data); 
                  
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
  }
}


function addAdjustQty()
{

  if($('#adjqty').val() != '')
  {
    if($('#qtyinhand').val() > 0)
      var totQty = parseFloat($('#adjqty').val()) + parseFloat($('#qtyinhand').val());
    else
      var totQty = parseFloat($('#adjqty').val());

    $('#addqty').val(totQty);
  }
}

function checkDate()
{
  var startdate=$('#startdate').val();
  var estimatedate=$('#estimatedate').val();
  var deliverydate=$('#deliverydate').val();
  var actualenddate=$('#actualenddate').val();
  $('#showerror').hide();
  setTimeout(function() { 
  if(startdate != "")
  {
    var sdobj = new Date(startdate).getTime();
    if(estimatedate != "")
    {
      var edobj = new Date(estimatedate).getTime();
      if( edobj < sdobj)  
      {
        $('#showerror').show();
        $('#estimatedate').val('');
      }
    }

    if(deliverydate != "")
    {
      var ddobj = new Date(deliverydate).getTime();
      
      if( ddobj < sdobj)  
      {
        $('#showerror').show();
        $('#deliverydate').val('');
      }
    }

    if(actualenddate != "")
    {
      var adobj = new Date(actualenddate).getTime();
      if( adobj < sdobj)  
      {
        $('#showerror').show();
        $('#actualenddate').val('');
      }
    }

  }
  
   }, 10);
}
function checkVal()
{
  var sectype = $('#vehsection').val();
  var vehid = $('#vehicle').val();
  
  if(vehid == "")
  {
    alert("please select first Vehicle");
    
    return;
  }
  else
  {
    if(sectype != "")
    {
      $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype=getlastfuelodometer&id="+vehid+"&sectype="+sectype, //get model dan ukuran
                success: function (data) {
                  
                  if(data != 0)
                  {
                    var expData = data.split(":");
                    $('#odometer').val(expData[0]); 
                    $('#enginehour').val(expData[1]); 
                    $('#lastodm').val(expData[0]); 
                    $('#lastenghr').val(expData[1]); 

                    $('#odometer').css('background-color' , '#FFFFEE');
                    $('#enginehour').css('background-color' , '#FFFFEE');
                  }
                  else
                  {
                    $('#odometer').val(0); 
                    $('#enginehour').val(0); 
                    $('#lastodm').val(0); 
                    $('#lastenghr').val(0);
                  }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
    }
  }
}

function checkWOVal()
{
  var sectype = $('#vehsection').val();
  var vehid = $('#vehicle').val();
  
  if(vehid == "")
  {
    alert("please select first Vehicle");
    
    return;
  }
  else
  {
    if(sectype != "")
    {
      $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype=getlastWOodometer&id="+vehid+"&sectype="+sectype, //get model dan ukuran
                success: function (data) {

                  if(data != 0)
                  {
                    var expData = data.split(":");
                    $('#odometer').val(expData[0]); 
                    $('#enginehour').val(expData[1]); 
                    $('#lastodm').val(expData[0]); 
                    $('#lastenghr').val(expData[1]); 

                    $('#odometer').css('background-color' , '#FFFFEE');
                    $('#enginehour').css('background-color' , '#FFFFEE');
                  }
                  else
                  {
                    $('#odometer').val(0); 
                    $('#enginehour').val(0); 
                    $('#lastodm').val(0); 
                    $('#lastenghr').val(0); 
                  }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
    }
  }
}

function checkFleetIssueVal()
{
  var sectype = $('#vehsection').val();
  var vehid = $('#vehicle').val();
  
  if(vehid == "")
  {
    alert("please select first Vehicle");
    
    return;
  }
  else
  {
    if(sectype != "")
    {
      $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype=getlastFleetIssueodometer&id="+vehid+"&sectype="+sectype, //get model dan ukuran
                success: function (data) {

                  if(data != 0)
                  {
                    var expData = data.split(":");
                    $('#odometer').val(expData[0]); 
                    $('#enginehour').val(expData[1]); 
                    $('#lastodm').val(expData[0]); 
                    $('#lastenghr').val(expData[1]); 

                    $('#odometer').css('background-color' , '#FFFFEE');
                    $('#enginehour').css('background-color' , '#FFFFEE');
                  }
                  else
                  {
                    $('#odometer').val(0); 
                    $('#enginehour').val(0); 
                    $('#lastodm').val(0); 
                    $('#lastenghr').val(0); 
                  }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
    }
  }
}

function getIssues()
{
  var vehid = $('#vehicle').val();
  
  if(vehid > 0)
  {
      $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype=getwoissues&id="+vehid, //get model dan ukuran
                success: function (data) {
                  if(data != 0)
                  {
                    // var expData = data.split(":");
                    $('#releatedissues').html(data); 
                  }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
  }
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function validateEmails(emails)
{
    var res = emails.split(",");
    for(i = 0; i < res.length; i++)
    {
      if(!isEmail(res[i])) 
      {
        alert("email address not valid");
        $('#emailsubscribed').val('');
        return false;
      }
    } 
    return true;
}

function checkMeterInterval()
{
  var meterinterval = $('#meterinterval').val(); 
   var meterthreshold = $('#meterthreshold').val();
    
    
   if(meterthreshold > 0 && meterthreshold >= meterinterval)
   {
        alert("Meter Threshold can not be greater than or equal to Meter Interval");
        $('#meterthreshold').val(""); 
        $('#meterthreshold').focus(); 
   }
}

function checkTimeInterval()
{
  var tieminterval = $('#tieminterval').val(); 
   var tiemthreshold = $('#tiemthreshold').val();
    
    
   if(tiemthreshold > 0 && tiemthreshold >= tieminterval)
   {
        alert("Time Threshold can not be greater than or equal to Time Interval");
        $('#tiemthreshold').val(""); 
        $('#tiemthreshold').focus(); 
   }
}

function checkOdometer(odmeter)
{
   var lastodmeter = $('#lastodm').val(); 
   var lastSection = $('#lastSection').val();
    
    
   if(odmeter > 0 && odmeter <= lastodmeter)
   {
        alert("Odometer values can not be greater than last odometer");
        $('#odometer').val(lastodmeter); 
        $('#odometer').focus(); 
   }

}
function checkEngineHr(enginehr)
{
   var lastenghr = $('#lastenghr').val(); 

   if(enginehr > 0 && enginehr <= lastenghr)
   {
        alert("Engine Hour values can not be greater than last Engine Hour");
        $('#enginehour').val(lastenghr);
        $('#enginehour').focus(); 
   }

}
function getOptionsData(el, type, id) {
        if (el.value === "") {
            $(el).siblings("input[name=model]").val("");
        } else {
            $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype="+type+"&id="+el, //get model dan ukuran
                success: function (data) {
                    
                    if(type == "getlastodometer")
                    {
                      alert(data);
                       if(data != 0)
                       {
                         var expData = data.split(":");
                         $('#'+id).val(expData[0]); 
                         $('#lastSection').val(expData[1]); 
                         $('#'+id).css('background-color' , '#FFFFEE');
                         $('#lastodm').val(expData[0]);
                      }
                    }
                    else if(type == "getlastenginehour")
                    {
                        if(data != 0)
                       {
                         var expData = data.split(":");
                         $('#'+id).val(expData[0]); 
                         $('#lastSection').val(expData[1]);  
                         $('#'+id).css('background-color' , '#FFFFEE');
                         $('#lastenghr').val(expData[0]);
                       }
                    }
                    else if(type == "showcustomerlink")
                    {
                       $('#'+id).html(data); 
                       $('#'+id).show();
                    }
                    else
                    {
                        $('#'+id).html(data);
                        //$('#'+id).chosen();
                        $('#'+id).val('').trigger("chosen:updated");
                    }
                    //$(el).closest('.barang_in').find("input[name='model']").val(data.nama_model + " " + "(" + data.ukuran + ")");//get the parent element and then find the input
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
        }
    }

    function showDATA(type)
    {
        /* initialize the calendar

             -----------------------------------------------------------------*/
          if(type == "employee")
          {
            var dtype = $('#edtype').val();
            var val = $('#eval').val();
          }
          else
          {
           var dtype = $('#dtype').val();
           var val = $('#val').val();
          } 

          var jType = "";
          if(type == 'jobtype')
          {
              var checked = []
              $("input[name='jobType[]']:checked").each(function ()
              {
                  checked.push(parseInt($(this).val()));
              });
              if(checked.length > 0)
                var jType = checked.join();
          }

           $.ajax({
                url: 'include/getData.php',
                type: 'POST',
                dataType: 'html',
                data: "reqtype=getresources&type="+type+"&val="+val+"&dtype="+dtype+"&jType="+jType, //get model dan ukuran
                success: function (data) {
                  
                  var data  = JSON.parse(data);
                  if(data.length == 0)
                     data = [];

                      var date = new Date();
                      var d = date.getDate();
                      var m = date.getMonth();
                      var y = date.getFullYear();
                      $('#calendar').fullCalendar('destroy');
                      $('#calendar').fullCalendar({
                          
                          header: {
                              left: 'prev,next today',
                              center: 'title',
                              right: 'month,agendaWeek,agendaDay'
                          },
                          editable: true,
                          droppable: false, // this allows things to be dropped onto the calendar
                          drop: function() {
                              // is the "remove after drop" checkbox checked?
                              if ($('#drop-remove').is(':checked')) {
                                  // if so, remove the element from the "Draggable Events" list
                                  $(this).remove();
                              }
                          },
                          events: data
                      });

                
              }
            });
    }
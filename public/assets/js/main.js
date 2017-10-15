$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var gridTables = {};

var uPage = {
	call: function(url, param, isMenu){
		$.post(url, param, function(result){
	    var $prevPage = $(".active-window");
	    var $newPage = $(result);

	    if($newPage.attr('id') != $prevPage.attr('id')){
	      $prevPage.removeClass('active-window').addClass('inactive-window');
	      $newPage.addClass('active-window').find('input.prev_window').val($prevPage.attr('id'));

	      $($newPage).find("input.datepicker").datepicker();
	      if(isMenu)
	        $(".uMainContent").html($newPage);
	      else
	        $(".uMainContent").append($newPage);

	      $('select').each(function(){
	        if(!$(this).hasClass('select2-selection__rendered'))
	          $(this).select2({
	            'width' : '100%'
	          });
	      });
	    }



		}).fail(function(xhr, status, error){
			//nMessage(error);
		});
	},

	close: function(windowId, callback){

    if(callback != undefined){
        callback();
    }

	  $prevWindowId = $("#"+windowId).find("input.prev_window").val();
	  $("#" + $prevWindowId).removeClass('inactive-window').addClass('active-window');
	  $("#"+windowId).remove();

	  $("span.select2.select2-container").each(function(){
	    $(this).css('style', 'width: auto !important');
	  });

	}
};

var uForm = {
	register: function(form_id, callback){
		$(".red-border").each(function(){
    		$(this).removeClass("red-border");
  		});
  		$('.help-block').remove();
  		$.post($('#'+form_id).attr('action'), $("#"+form_id).serialize(), function(data){
    		if(data.status == 422){
      			$.each(data.errors, function(i, v){
        			$("[name='"+i+"']").parent().append('<span class="help-block validation-error"><strong>'+v+'</strong></span>');
        			$("[name='"+i+"']").addClass('red-border');
      			});
	    	}else{
	      		callback(data);
	    	}
  		}).fail(function(xhr, status, error){
    		/*nMessage(error);*/
  		});
	  /*$.post($('#'+form_id).attr('action'), $("#"+form_id).serialize(), function(data){
	    if(data.status == 422){
	      $.each(data.errors, function(i, v){
	        $("[name='"+i+"']").parent().append('<span class="help-block validation-error"><strong>'+v+'</strong></span>');
	      });
	    }else{
	      callback(data);
	    }
	  }).fail(function(xhr, status, error){
	    //nMessage(error);
	  });*/
	}
};

var baseGridFunc = {

    lang: "",

		init: function(gridId , buttons, formId){

			var tableElmt = $("#" + gridId);
			var actionLcl = tableElmt.attr("action");

			var columnLcl = [];
			var columnSearchAble = [];
      var columnSortAble = [];
			var columnCounter = 0;
      var firstSortCol = 1;
      var firstSortType = "desc";

			var columnCont = $('.ucolumn-cont[data-table="'+ gridId +'"]');

      var onRowClick = columnCont.attr("rowclick");

			columnCont.find("ucolumn").each(function(){
					var colTmp = {};

          $this = $(this);

					colTmp["data"] = $this.attr("source");
					colTmp["name"] = $this.attr("name");

          if($this.attr("utype") == "index"){
            colTmp["className"] = "indexNumb";
            colTmp["render"] = function(data, type, row){
                return "";
            }
          }

          if($this.attr("utype") == "btn"){
              // var tmpBtn = '<button onclick="'+ $this.attr('func') +'(\''+ gridId +'\', this)" class="btn '+ $this.attr('uclass') +'">'+ $this.attr('utext') +'</button>';
              var tmpBtn = '<span onclick="'+ $this.attr('func') +'(\''+ gridId +'\', this)" class="gridIcon '+ $this.attr('uclass') +'" title="'+ $this.attr('utext') +'"></span>'
              colTmp["render"] = function(data, type, row){
                  return tmpBtn;
              }

              columnSearchAble.push(columnCounter);
              columnSortAble.push(columnCounter);
          }

          if($this.attr("utype") == "formatter"){
              var funcName = $this.attr("func");
              colTmp["render"] = function(data, type, row){
                  return eval(funcName)(data, type, row);
              }
          }

          if($this.attr("utype") != "btn"){
            if($this.attr('searchable') == "false"){
              columnSearchAble.push(columnCounter);
            }
            if($this.attr('sortable') == "false"){
              columnSortAble.push(columnCounter);
            }
          }

          if($this.attr('width') != undefined){
              colTmp["width"] = $this.attr("width");
          }

          if($this.attr("visible") == "false"){
            colTmp["className"] = "hidden_column";
          }

          if($this.attr("sort") == "true"){
            firstSortCol = columnCounter;
            if($this.attr("sorttype") != "desc"){
              firstSortType = "asc";
            }
          }

					columnLcl.push(colTmp);
					columnCounter ++;
			});


      if(gridTables[gridId] != undefined){
        alert("Grid id duplicated: " + gridId);
      }else{

        gridTables[gridId] = $('#' + gridId).dataTable({
   					processing: true,
   					serverSide: true,
            info: true,
   					ajax: {
   						url : actionLcl,
   						data : function(d){
                d.params = {};
                var sentData = baseGridFunc.loadForm(formId);
                for(var key in sentData){
                  d.params[key] = sentData[key];
                }
              }
   					},
   					columns: columnLcl,
       			"columnDefs": [
                 {
                     'searchable'    : false,
                     'targets'       : columnSearchAble
                 },
                 {
                     "orderable": false,
                     'targets'       : columnSortAble
                 }
            ],
            "order": [[ firstSortCol, firstSortType ]],
   					"language": {
   							"url": baseGridFunc.lang
   					},
   					"initComplete": function(settings, json) {


              $('#'+ gridId +'_wrapper').find("tr").each(function(index){
                  if(index != 0){
                    $(this).find(".indexNumb").text(index);
                  }
              });

               gridTables[gridId].on("draw.dt",function(){

                 var pageInfo = gridTables[gridId].fnPagingInfo();
                 var counter = pageInfo.iStart;

                 $(this).find("tr").each(function(index){
                     if(counter != pageInfo.iStart){
                       $(this).find(".indexNumb").text(counter);
                     }
                     counter++;
                 });
               });

              var btnWrapper = $('#'+ gridId +"_wrapper").find(".dataTable_btns");
              btnWrapper.html("");


   						for(var i=0; i < buttons.length; i++){
   								btnWrapper.append(buttons[i]);
   						}
               //
   						// $('#'+ gridId +'_wrapper .dataTables_filter input').addClass("input-medium ");
   						// $('#'+ gridId +'_wrapper .dataTables_length select').addClass("select2-wrapper span12");
   						// $(".select2-wrapper").select2({minimumResultsForSearch: -1});
               $('select[name="'+ gridId + '_length"]').select2();

   						$('#'+ gridId +'_wrapper tbody').on( 'click', 'tr', function () {

                   if(onRowClick != "" && onRowClick != undefined){
                       eval(onRowClick)(baseGridFunc.getRow(gridId, this));
                   }

   								if ( $(this).hasClass('row_selected') ) {
   										$(this).removeClass('row_selected');
   								}
   								else {
   										gridTables[gridId].$('tr.row_selected').removeClass('row_selected');
   										$(this).addClass('row_selected');
   								}
   						});
   					}
   			});
      }

		},

    getRow: function(gridId, elmnt){

      var columnCont = $('.ucolumn-cont[data-table="'+ gridId +'"]');
      var rowElmnt = $(elmnt).find("td");

      var retData = {};

      var counter = 0;

			columnCont.find("ucolumn").each(function(){

          retData[$(this).attr("name")] = $(rowElmnt[counter]).text();
					counter++;
			});

      return retData;

    },

    getRowData: function(gridId, elmnt){

      var columnCont = $('.ucolumn-cont[data-table="'+ gridId +'"]');
      var rowElmnt = $(elmnt).closest("tr").find("td");

      var retData = {};

      var counter = 0;

			columnCont.find("ucolumn").each(function(){

          retData[$(this).attr("name")] = $(rowElmnt[counter]).text();
					counter++;
			});

      return retData;

    },

		getSelectedRow: function(gridId, colname){

			var tableElmt = $("#" + gridId);

			var columnCont = $('.ucolumn-cont[data-table="'+ gridId +'"]');

			var counter = 0;
			var indexLcl;

			columnCont.find("ucolumn").each(function(){
					if($(this).attr("name") == colname){
						indexLcl = counter;
						return false;
					}

					counter++;
			});
      var retValue = "";
			if(tableElmt.find("tr.row_selected").length > 0){

					var i = 0;
					tableElmt.find("tr.row_selected").find("td").each(function(){
							if(i == indexLcl){
									retValue = $(this).text();
									return false;
							}
							i++;
					});

			}
			return retValue;
		},

		reload: function(gridId){
			$('#'+ gridId).DataTable().ajax.reload();
		},
		loadParam : function(gridId){
			var params = {};
			$("#"+gridId).closest('.grid-body').find('.grid-param').each(function(){
				params[$(this).attr('name')] = $(this).val();
			});
			return params;
		},
    loadForm : function(formId){
      var sentData = {};

      if(formId == null){
        sentData = {};
      }else{
        sentData = $("#" + formId).serializeObject();
      }

			return sentData;
		},

    toggleFilter: function(btn){
        var elmnt = $(btn).closest(".page-window").find(".gridFilterWrapper");
        if(elmnt.css("display") == "none"){
          elmnt.css("display","block");
        }else{
          elmnt.css("display","none");
        }
    }
};

var u$Grid = baseGridFunc;

var hiddenFormFunc = {
		show: function(id){
				$("#"+id).css("bottom","0px");
		}
};

var langFunc = {
	splitByLang(windowId){
      var $obj = $("#"+windowId).find(".has-lang").find(".row-fluid").clone();
      $("#"+windowId).find(".has-lang").find('.row-fluid').remove();
      $("input.langs").each(function(){
        var $tmpObj = $obj.clone();
        $tmpObj.find("label").text($tmpObj.find("label").text() + " /" + $(this).val() + "/");
        $tmpObj.find("input").attr('name', $tmpObj.find("input").attr('name') + "[" + $(this).val() + "]").addClass("input-lang-" + $(this).val());
        $("#"+windowId).find(".has-lang").append($tmpObj);

      });
	}
}
function Log(data){
    console.log(data);
}

var umsg = {
  success: function(tmpmsg){
    new PNotify({
			title: mainres.notification,
			text: tmpmsg,
			type: 'success',
			addclass: 'icon-nb'
		});
  },
  error: function(tmpmsg){
    new PNotify({
			title: mainres.notification,
			text: tmpmsg,
			type: 'error',
			addclass: 'icon-nb'
		});
  }
};

var uvalidate = {
    setErrors: function(errors){
        for(var error in errors){
            var tmpName = "";

            if(error.indexOf(".") > -1){
              tmpName = error.split(".");
              tmpName = tmpName[0] + "["+ tmpName[1] +"]";
            }else{
              tmpName = error;
            }
            console.log("[name='"+ tmpName +"']");
            $("[name='"+ tmpName +"']").css("border", "solid 1px red");
        }

        umsg.error(messages.fill);
    }
}

var windowObjectReference = null;

function openRequestedPopup(url) {

  if(windowObjectReference != null){
      windowObjectReference.close();
  }

  windowObjectReference = window.open(
    url,
    "Window",
    "resizable,scrollbars,status,width=1200,height=500"
  );
};

var onClickRow = {
  callop : function(rowdata){
    $.post('/sys/order/opdata', rowdata, function(data){
      if(data){
        var $obj = "";
        var $obj_sub = "";
        var total = "";
        $.each(data, function(i, v){
          if(v.split == 1){
            total = "Нийт";
          }else{
            total = "";
          }
          $obj += '<div class="form-group">';
          $obj += '<div class="col-md-3"><input class="form-control" type="text" name="product" disabled="true" value="'+v.product_name+'"/></div>';
          $obj += '<div class="col-md-1"><input class="form-control" type="text" name="unit" disabled="true" value="'+v.unit_name+'"/></div>';
          $obj += '<div class="col-md-1"><input class="form-control" type="text" name="size" disabled="true" value="'+v.size+'"/>'+total+'</div>';
          if(v.split == 1){
            $.ajax({
              url : '/sys/order/opsplitdata',
              type : 'post',
              data : v,
              async : false,
              success : function(sub_data){
                $.each(sub_data, function(i1, v1){
                  $obj += '<div class="col-md-1"><input class="form-control" type="text" name="subsize" disabled="true" value="'+v1.size+'"/><p>'+v1.day+' өдөр </p></div>';
                });
              }
            });
          }
          $obj += '</div>';
        })
        $("#show-op-container").html($obj);
      }
    });
  }
};

(function() {
    PNotify.prototype.options.delay = 1500;
}());

/* ***** BEGIN LICENSE BLOCK *****
 * 
 * This software is distributed under the New BSD License.
 * See LICENSE file for terms of use.
 * 
 * ***** END LICENSE BLOCK ***** */

FirePHPProcessor.Init = function() {

  this.RegisterConsoleStyleSheet('chrome://firephp/content/RequestProcessor.css');


  function getTraceTemplate() {
    return domplate(Firebug.Rep, {
      tag: DIV({
        class: "head",
        _repObject: "$object"
      }, A({
        class: "title",
        onclick: "$onToggleBody",
            _repInObject: "$__in__",
            onmouseover:"$onMouseOver",
            onmouseout:"$onMouseOut"
      }, "$object|getCaption")),
      
      infoTag: DIV({
        class: "info"
      }, TABLE({
        cellpadding: 3,
        cellspacing: 0
      }, TBODY(TR(TD({
        class: 'headerFile'
      }, 'File'), TD({
        class: 'headerLine'
      }, 'Line'), TD({
        class: 'headerInst'
      }, 'Instruction')), FOR("call", "$object|getCallList", TR({}, TD({
        class: 'cellFile'
      }, DIV({}, "$call.file")), TD({
        class: 'cellLine'
      }, DIV({}, "$call.line")), TD({
        class: 'cellInst'
      }, DIV({}, "$call|getCallLabel(", FOR("arg", "$call|argIterator", TAG("$arg.tag", {
        object: "$arg.value"
      }), SPAN({
        class: "arrayComma"
      }, "$arg.delim")), ")"))))))),
  
     
    onMouseOver: function(event) {
      
      if(event.currentTarget.repInObject.meta
         && event.currentTarget.repInObject.meta.File
         && event.currentTarget.repInObject.meta.Line) {

        FirePHP.setWindowStatusBarText(event.currentTarget.repInObject.meta.File
          + ' : '
          + event.currentTarget.repInObject.meta.Line);
      }
    },

    onMouseOut: function() {

        FirePHP.setWindowStatusBarText(null);
    },    
    
          
      getCaption: function(item){
        if (item.Class && item.Type == 'throw') {
          return item.Class + ': ' + item.Message;
        } else
        if (item.Class && item.Type == 'trigger') {
          return item.Message;
        }
        else {
          return item.Message;
        }
      },
      
      onToggleBody: function(event){
        var target = event.currentTarget;
        var logRow = getAncestorByClass(target, 'logRow-'+this.className);
        if (isLeftClick(event)) {
          toggleClass(logRow, "opened");
          
          if (hasClass(logRow, "opened")) {
          
            /* Lets only render the stack trace once we request it */
            if (!getChildByClass(logRow, "head", "info")) {
              this.infoTag.append({
                'object': getChildByClass(logRow, "head").repObject
              }, getChildByClass(logRow, "head"));
            }
          }
        }
      },
      
      getCallList: function(call){
        var list = call.Trace;
        list.unshift({
          'file': call.File,
          'line': call.Line,
          'class': call.Class,
          'function': call.Function,
          'type': call.Type,
          'args': call.Args
        });
        /* Now that we have all call events, lets sew if we can shorten the filename.
       * This only works for unif filepaths for now.
       * TODO: Get this working for windows filepaths as well.
       */
        try {
          if (list[0].file.substr(0, 1) == '/') {
            var file_shortest = list[0].file.split('/');
            var file_original_length = file_shortest.length;
            for (var i = 1; i < list.length; i++) {
              var file = list[i].file.split('/');
              for (var j = 0; j < file_shortest.length; j++) {
                if (file_shortest[j] != file[j]) {
                  file_shortest.splice(j, file_shortest.length - j);
                  break;
                }
              }
            }
            if (file_shortest.length > 2) {
              if (file_shortest.length == file_original_length) {
                file_shortest.pop();
              }
              file_shortest = file_shortest.join('/');
              for (var i = 0; i < list.length; i++) {
                list[i].file = '...' + list[i].file.substr(file_shortest.length);
              }
            }
          }
        } 
        catch (e) {
        }
        return list;
      },
      
      getCallLabel: function(call){
        if (call['class']) {
          if (call['type'] == 'throw') {
            return 'throw ' + call['class'];
          } else
          if (call['type'] == 'trigger') {
            return 'trigger_error';
          }
          else {
            return call['class'] + call['type'] + call['function'];
          }
        }
        return call['function'];
      },
      
      argIterator: function(call){
        if (!call.args) 
          return [];
        var items = [];
        for (var i = 0; i < call.args.length; ++i) {
          var arg = call.args[i];
          
//          var rep = FirePHP.getRep(arg);
//          var tag = rep.shortTag ? rep.shortTag : rep.tag;
                var rep = FirebugReps.PHPVariable;
                var tag = rep.tag;
          
/*          
          if(!arg) {
            var rep = Firebug.getRep(arg);
            var tag = rep.shortTag ? rep.shortTag : rep.tag;
          } else
          if (arg.constructor.toString().indexOf("Array") != -1 ||
              arg.constructor.toString().indexOf("Object") != -1) {
            var rep = FirebugReps.PHPVariable;
            var tag = rep.tag;
          }
          else {
            var rep = Firebug.getRep(arg);
            var tag = rep.shortTag ? rep.shortTag : rep.tag;
          }
*/          
          var delim = (i == call.args.length - 1 ? "" : ", ");
          items.push({
            name: 'arg' + i,
            value: arg,
            tag: tag,
            delim: delim
          });
        }
        return items;
      }
      
    });
  }
    
  this.RegisterConsoleTemplate('exception',domplate(getTraceTemplate(),
    {
      className: 'firephp-exception',
    })
  );

  this.RegisterConsoleTemplate('trace',domplate(getTraceTemplate(),
    {
      className: 'firephp-trace',
    })
  );


  this.RegisterConsoleTemplate('table',
    domplate(Firebug.Rep,
    {
      className: 'firephp-table',
      tag:
          DIV({class: "head", _repObject: "$object", _repMeta: "$meta"},
              A({class: "title", onclick: "$onToggleBody",
            _repInObject: "$__in__",
            onmouseover:"$onMouseOver",
            onmouseout:"$onMouseOut"}, "CustomCaption: $__in__|getCaption")
          ),
    
      infoTag: DIV({class: "info"},
             TABLE({cellpadding: 3, cellspacing: 0},
              TBODY(
                TR(
                  FOR("column", "$__in__|getHeaderColumns",
                    TD({class:'header'},SPAN('CustomCol:'), '$column', SPAN('CustomCol'))
                  )
                ),
                FOR("row", "$__in__|getRows",
                    TR({},
                      FOR("column", "$row|getColumns",
                        TD({class:'cell'},
                          TAG("$column.tag", {object: "$column.value"})
                        )
                      )
                    )
                  )
                )
              )
             ),
                  
           
    onMouseOver: function(event) {

      if(event.currentTarget.repInObject.meta
         && event.currentTarget.repInObject.meta.File
         && event.currentTarget.repInObject.meta.Line) {

        FirePHP.setWindowStatusBarText(event.currentTarget.repInObject.meta.File
          + ' : '
          + event.currentTarget.repInObject.meta.Line);
      }
    },

    onMouseOut: function() {

        FirePHP.setWindowStatusBarText(null);
    },
                      
      getCaption: function(row)
      {
        if(!row) return '';
        
        if(row.meta && row.meta.Label) {
          return row.meta.Label;
        }
        
        return row.object[0];
      },
    
      onToggleBody: function(event)
      {
          dump("getAncestorByClass: "+getAncestorByClass+"\n");
        var target = event.currentTarget;
        var logRow = getAncestorByClass(target, "logRow-firephp-table");
        if (isLeftClick(event))
        {
          toggleClass(logRow, "opened");
    
          if (hasClass(logRow, "opened"))
          {
    
            /* Lets only render the stack trace once we request it */        
            if (!getChildByClass(logRow, "head", "info"))
            {
                this.infoTag.append({'object':getChildByClass(logRow, "head").repObject,
                                     'meta':getChildByClass(logRow, "head").repMeta},
                                    getChildByClass(logRow, "head"));
            }
          }
        }
      },
      
      getHeaderColumns: function(row) {
        
        try{
          if(row.meta && row.meta.Label) {
            return row.object[0];
          } else {
            // Do this for backwards compatibility
            return row.object[1][0];
          }
        } catch(e) {}
        
        return [];
      },
      
      getRows: function(row) {
        
        try{
          var rows = null;
          if(row.meta && row.meta.Label) {
            rows = row.object;
          } else {
            // Do this for backwards compatibility
            rows = row.object[1];
          }
          rows.splice(0,1);
          return rows;
        } catch(e) {}
        
        return [];
      },
      
      getColumns: function(row) {

        if (!row) return [];
        
        var items = [];

        try {
        
          for (var i = 0; i < row.length; ++i)
          {
              var arg = row[i];
//          var rep = FirePHP.getRep(arg);
//          var tag = rep.shortTag ? rep.shortTag : rep.tag;
              
                var rep = FirebugReps.PHPVariable;
              
              if(typeof(arg)=='string') {
                rep = FirebugReps.FirePHPText;
              }
              
                var tag = rep.tag;
                
                
/*  
              if(!arg) {
                var rep = Firebug.getRep(arg);
                var tag = rep.shortTag ? rep.shortTag : rep.tag;
              } else
              if (arg.constructor.toString().indexOf("Array")!=-1 ||
                  arg.constructor.toString().indexOf("Object")!=-1) {
                var rep = FirebugReps.PHPVariable;
                var tag = rep.tag;
                
//                obj = new Object();
//                obj.Array = arg;
//                arg = ['Click for Data',obj];
              } else {
                var rep = FirebugReps.Text;
                var tag = rep.shortTag ? rep.shortTag : rep.tag;
              }
*/              
              items.push({name: 'arg'+i, value: arg, tag: tag});
          }
        } catch(e) {}
        
        return items;
      },
      
    })
  );




  this.RegisterConsoleTemplate('upgrade',
    domplate(Firebug.Rep,
    {
      className: 'firephp-upgrade',
      tag:
          DIV("You need to upgrade your FirePHP server library.",
            A({_object:"$object", onclick:'$upgradeLink'},'Upgrade Now!')),
          

      upgradeLink: function(event) {
        openNewTab(event.target.object.peerInfo.uri+event.target.object.peerInfo.version);
      }
    })
  );


  
}


/* 
 * Called once for each request as it comes in
 */
FirePHPProcessor.ProcessRequest = function(Wildfire,URL,Data) {
  
  if (Data || Wildfire.hasMessages()) {

    Firebug.Console.openGroup([URL], null, "firephpRequestGroup", null, false);

    /* 
     * We wrap the logging code to ensure we can close the group
     * just in case something goes wrong.
     */
    try {
			
      if(Data) {
        var data = json_parse(Data);
      
        if (data['FirePHP.Firebug.Console']) {
          
          var peerInfo = {uri:'http://meta.firephp.org/Wildfire/Plugin/FirePHP/Library-FirePHPCore/',
                          version:'0.2.0'}

          this.logToFirebug('upgrade', {peerInfo: peerInfo}, false);
          
        
    	    for (var index in data['FirePHP.Firebug.Console']) {
    	
    	      var item = data['FirePHP.Firebug.Console'][index];
            if (item && item.length==2) {
            
              this.processMessage(item[0], item[1]);
            }
    	    }
        }
      }      
		} catch(e) {
      this.logToFirebug('error', ['There was a problem writing your data from X-FirePHP-Data[\'FirePHP.Firebug.Console\'] to the console.',e], true);
		}


    try {
			
      if(Wildfire.hasMessages()) {
           
        var messages = Wildfire.getMessages('http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1');
        
        if(messages && messages.length>0) {
          
          var peers = Wildfire.getPeerPlugins();
          for( var peer_uri in peers ) {
            if(FirePHPLib.isVersionNewer(peers[peer_uri].minVersion, peers[peer_uri].version)) {

              this.logToFirebug('upgrade', {peerInfo: peers[peer_uri]}, false);
            }
          }
          
          for( var index in messages ) {
            
            var item = json_parse(messages[index]);
            
            this.processMessage(item[0].Type, item[1], item[0]);
          }
        }
      }
 
 		} catch(e) {
      this.logToFirebug('error', ['There was a problem writing your data from the Wildfire Plugin http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1',e], true);
		}

    Firebug.Console.closeGroup();
    
  }
}



FirePHPProcessor.processMessage = function(mode, data, meta) {

  mode = mode.toLowerCase();

  /* Change mode from TRACE to EXCEPTION for backwards compatibility */
  if (mode == 'trace') {
    var change = true;
    for (var key in data) {
      if (key == 'Type') {
        change = false;
      }
    }
    if (change) {
      mode = 'exception';
      data.Type = 'throw';
    }
  }
          
  if(mode=='group_start') {
    
    var msg = null;

    if(meta && meta.Label) {
      msg = [meta.Label];
    } else {
      msg = [data[0]];
    }
    
    if(meta && (meta.Collapsed || meta.Color)) {
      
      // NOTE: Throttleing is disabled which may caue the group to be interted in a different
      //       index than originally intended as other messages are inserted with throttleing enabled.
      //       This should be done in a better way in future.
      var row = Firebug.Console.openGroup(msg, null, "group", null, true);
      
      if(meta.Collapsed && meta.Collapsed=='true') {
        removeClass(row, "opened");
      }
      if(meta.Color) {
        row.style.color = meta.Color;
      }
      
    } else {
      Firebug.Console.openGroup(msg, null, "group", null, false);
    }
    
  } else
  if(mode=='group_end') {
    
    Firebug.Console.closeGroup();
    
  } else
  if (mode == 'log' || mode == 'info' || mode == 'warn' || mode == 'table' || mode == 'trace') {
  
    this.logToFirebug(mode, data, false, meta);
    
  } else 
  if (mode == 'error' || mode == 'exception') {
  
    Firebug.Errors.increaseCount(this.context);
    
    this.logToFirebug(mode, data, false, meta);
  }
}

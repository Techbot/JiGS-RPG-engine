/**
 * sdcAdventure - game designer
 * @author: Simon Champion.
 * @version: 0.1
 */
var gd = {
    scenes: {},
    chars : {},
    items : {},
    events: {},
    initialise : function() {
        $('button[data-type=desform]').click(function() {
            gd.load($(this).data('action'));
        });
        //change event for the scene image upload graphic
        $(document).on('change', '.gd_uploadbg', function() {
            var clicked = $(this);
            var id = clicked.data('id');
            var obj = gd.scenes[id];
            var thumb = clicked.siblings(".gd_bgthumb")[0];
            $(thumb).attr('src',pa_args.game_root+'/gfx/loader.gif');
            clicked.closest(".gd_uploadbgform").ajaxForm({dataType:'json', success: function(response) {
                obj.data.backdrop = response.results ? response.results.name : '';
                var image = gdui.details.inputField.imgurl(obj,'bg')
                $(thumb).attr('src',image);
                obj.shapeObj.setImage(image);
                obj.exitsObj.setImage(image);
                $.getJSON(pa_args.game_root+'/ajax.php',{'module':'listImages', lib:'designer','type':'scenes'},function(data) {
                    var options = '<option selected="selected" value="">--pick one--</option>';
                    for (var i = 0; i < data.results.length; i++) {
                        options += '<option value="' + data.results[i] + '">' + data.results[i] + '</option>';
                    }
                    $('#sel_'+gdui.details.inputField.fldid(obj,{field:'bgimg'})).html(options).val(obj.data.backdrop).change();
                });
            }}).submit();
        });
        //change event for the character image upload graphic
        $(document).on('change', '.gd_uploadsprite', function() {
            var clicked = $(this);
            var id = clicked.data('id');
            var obj = gd.chars[id];
            var thumb = clicked.siblings(".gd_spritethumb")[0];
            $(thumb).attr('src',pa_args.game_root+'/gfx/loader.gif');
            clicked.closest(".gd_uploadspriteform").ajaxForm({dataType:'json', success: function(response) {
                obj.data.sprite = response.results ? response.results.name : '';
                var image = gdui.details.inputField.imgurl(obj,'sprite')
                $(thumb).attr('src',image);
                obj.shapeObj.setImage(image);
                obj.exitsObj.setImage(image);
                $.getJSON(pa_args.game_root+'/ajax.php',{'module':'listImages', lib:'designer',type:'sprites'},function(data) {
                    var options = '<option selected="selected" value="">--pick one--</option>';
                    for (var i = 0; i < data.results.length; i++) {
                        options += '<option value="' + data.results[i] + '">' + data.results[i] + '</option>';
                    }
                    $('#sel_'+gdui.details.inputField.fldid(obj,{field:'sprite'})).html(options).val(obj.data.sprite).change();
                });
            }}).submit();
        });
        //change event for the scene image select drop-box.
        $(document).on('change', '.gd_bgexisting', function() {
            var clicked = $(this);
            var id = clicked.data('id');
            var obj = gd.scenes[id];
            obj.data.backdrop = clicked.val();
            var thumb = clicked.siblings(".gd_bgthumb")[0];
            var image = gdui.details.inputField.imgurl(obj,'bg')
            $(thumb).attr('src',image);
            obj.shapeObj.setImage(image);
            obj.exitsObj.setImage(image);
        });
        //change event for the characters image select drop-box.
        $(document).on('change', '.gd_spriteexisting', function() {
            var clicked = $(this);
            var id = clicked.data('id');
            var obj = gd.chars[id];
            obj.data.sprite = clicked.val();
            var thumb = clicked.siblings(".gd_spritethumb")[0];
            var image = gdui.details.inputField.imgurl(obj,'sprite')
            $(thumb).attr('src',image);
        });
        //change event for input fields on the edit forms: update the data field on the master object to match changes.
        $(document).on('change', '.gdui_input', function() {
            var sp=$(this).attr('id').split(/_/);
            var type = sp[0].replace(/^fld/,''), field = sp[1], id = sp[2];
            var obj = gd[type+'s'][id];
            if(obj) {obj.data[field]=$(this).val();}
        });
        //change event for action type field, to switch in the appropriate action type.
        $(document).on('change','.gdui_input_event_actionType', function() {
            var actionType = $(this);
            var actionTypeSubject = $(this).find('option:selected').data('dropbox');
            actionType.siblings('.event_actionSubjects').find('select').each(function() {
                var sel=$(this);
                var showOrHide = actionTypeSubject===sel.data('type');
                sel.toggle(showOrHide);
                if(showOrHide && sel.find('option').length==0) {
                    gd.load(actionTypeSubject, function(data) {
                        data = data.results;
                        var options = "<option value='0'>-- please select --</option>";
                        for(i in data) {if (data.hasOwnProperty(i)) {
                            options += "<option value='"+data[i].id+"'>"+(data[i].title?data[i].title:data[i].name)+"</option>";
                        }}
                        sel.append(options);
                    });
                }
            });
            gd.initSubOpt(actionType, 0);
        });
        //change event for specific action types to display any sub-types.
        $(document).on('change','.event_actionSubjects select', function() {
            gd.initSubOpt($('.gdui_input_event_actionType'), $(this).val());
        });
        gd.initClicks();
    },
    initSubOpt : function(actionType, suboptVal) {
        //@WIP.
        //populate sub-option drop-lists in events form. (@todo: this function should probably be somewhere else, but for once lets make it work first, then think about structure)
        //@wip note: trying to get sub-opts to work. actionType seems to contain the main action type but we want the selected character so we can pass it to the load function as actionOptVal.
        var actionOpt = $(actionType).find('option:selected');
        var actionSubOpt = actionOpt.data('subopt');
        actionType.parent().siblings('.event_actionSubAction').find('div').each(function() {
            var sel=$(this).find('select');
            var showOrHide = actionSubOpt===sel.data('type');
            $(this).toggle(showOrHide);
            if(showOrHide && sel.data('charID')!=suboptVal) {
                gd.load(actionSubOpt+':'+suboptVal, function(data) {
                    sel.data('charID',suboptVal);
                    data = data.results;
                    var options = "<option value='0'>-- please select --</option>";
                    for(var i in data) {if (data.hasOwnProperty(i)) {
                        var opttext = (data[i].title ? data[i].title : (data[i].name ? data[i].name : data[i].text));
                        options += "<option value='"+data[i].id+"'>"+opttext+"</option>";
                    }}
                    sel.html(options);
                });
            }
        });
    },
    initClicks : function() {
        //click event for the scene/character/item/event list boxes
        $(document).on('click', '.gd_datalistitem', function(e){
            var listitem=$(this);
            var type = listitem.data('type');
            $('#gd_datalist_'+type+' tr').removeClass('gd_datalistitemselected');
            listitem.addClass('gd_datalistitemselected');
        });
        //click event for button to setup demo database.
        $(document).on('click','#action_setup_db',function(e) {
            $.getJSON(pa_args.game_root+'/ajax.php',{'module':'createTables', lib:'designer'},function(data) {
                alert('Created tables!');
            });
        });
    },
    load : function(type, callback) {
        var tmod, subOpt;
        switch(type.split(':')[0]) {
            case 'scene':tmod='Scenes';break;
            case 'char' :tmod='Characters';break;
            case 'item' :tmod='Items';break;
            case 'event':tmod='Events';break;
            case 'talk' :tmod='Talk'; subOpt = type.split(':')[1]; break;
            default :alert('Unknown data type. ['+type+']');return;
        }
        $.getJSON(pa_args.game_root+'/ajax.php',{'module':'load'+tmod, 'all':true, 'charID':subOpt},function(data) {
            if(callback) {
                callback(data);
            } else {
                gdui.list.load(type,data);
            }
        });
    },
    createObj : function(type,data) {
        var tclone, obj;
        switch(type) {
            case 'scene':tclone=gdScene;break;
            case 'char' :tclone=gdCharacter;break;
            case 'item' :tclone=gdItem;break;
            case 'event':tclone=gdEvent;break;
            default :alert('Unknown data type. ['+type+']');return null;
        }
        obj = $.extend({},tclone);
        obj.create(data);
        return obj;
    },
    saveObj : function(obj,type) {
        var win = $('#'+obj.uiWin);
        $.getJSON(pa_args.game_root+'/ajax.php',$.extend({'module':'save'+type[0].toUpperCase()+type.slice(1), lib:'designer'},obj.data),function(resp) {
            //@todo: some of this may be better off in a separate function in gdui to share among the object types.
            if(resp.success) {
                if(win.length) {win.dialog('close');}
                if(!obj.data.id) {
                    //if saving a new record, we'll need the new id and update the main records array and UI table to match.
                    obj.data.id = resp.results.id;
                    gd[type+'s'][obj.data.id] = obj;
                    gd[type+'s'][0] = null;
                    gdui.list.delTableRow(type,0);
                    gdui.list.addTableRow(type, obj.data, obj.tableFields);
                } else {
                    //update the field values in the list table. (and update the tablesorter control too)
                    for(var i in obj.tableFields) {
                        $("#gduitd_"+type+"_"+obj.data.id+"_"+i).html(obj.data[i]);
                    }
                    $('#gd_datalist_'+type).trigger('update');
                }
                for(var i in resp.results) {
                    obj.data[i] = resp.results[i];
                }
                alert('Saved '+type+' '+resp.results.id);
            } else {
                alert('Failed to save '+type+'.')
            }
        });
    },
    dropBox : function(type,fieldID,defaultValue,styles) {
        if(!styles) {styles='';}    //protect against undefined
        var output = "<select id='"+fieldID+"' "+styles+">";
        var field, selected, i;
        for(i in gd[type+'s']) {
            field = gd[type+'s'][i].data[gd[type+'s'][i].dropBoxField()];
            selected = (gd[type+'s'][i].data.id === defaultValue) ? " selected='selected'" : "";
            output += "<option value='"+gd[type+'s'][i].data.id+"'"+selected+">"+field+"</option>"
        }
        output += "</select>";
        return output;
    }
}

var gdScene = {
    type : 'scene',
    uiWin : null,
    data : {},
    //@todo: better default shapes.
    baseData : {id:0,title:'*New Scene*',backdrop:'',walkable:'0,256, 640,256, 640,480,0,480',exits:[{id:0,destID:0,shape:'0,320, 60,320, 60,480, 0,480'}]},
    shapeObj : {},
    exitsObj : {},
    tableFields : {
        'id' : 'ID', 'title' : 'Description'
    },
    dataFields : [
        {caption: 'Title',field:'title',type:'text'},
        {caption: 'Exits',field:'exits',type:'count'},
        {caption: 'Backdrop',field:'bgimg',type:'bgimg'}
    ],
    walkableFields : [
        {caption: 'Walkable Areas',field:'walkable',type:'shape',bg:'walkablebd'}
    ],
    exitFields : [
        {caption: 'Exits',field:'exits',type:'shape',bg:'exitsbd'}
    ],
    dropBoxField : function() {return 'title';},
    create : function(data) {
        this.data = $.extend({},this.baseData,data);
        gdui.list.addTableRow('scene', this.data, this.tableFields);
    },
    winTitle : function() {
        if(this.data.id) {
            return 'Scene ' +this.data.id + ': '+this.data.title;
        }
        return 'New Scene';
    },
    tabID : function() {
        return 'gd_detswin_scene_'+(this.data.id);
    },
    winTabs : function() {
        var tab_id = this.tabID();
        var tabs = {
            'Data' : gdui.details.inputFields(this,'dataFields'),
            'Walkable' : gdui.details.inputFields(this,'walkableFields'),
            'Exits' : gdui.details.inputFields(this,'exitFields')
        };
        var output_tabs = '', output_divs = '';
        for(var i in tabs) {
            output_tabs += '<li><a href="#'+tab_id+'_tab'+i+'">'+i+'</a></li>';
            output_divs += '<div class="gd_tab" id="'+tab_id+'_tab'+i+'">'+tabs[i]+'</div>';
        }
        return '<div class="gd_tabset gd_scenedets" id="'+tab_id+'"><ul>'+output_tabs+'</ul>'+output_divs+'</div>';
    },
    postLoad : function() {
        //create a graphic object on top of the image.
        var self = this;
        var wdraw = jQuery('#draw_'+gdui.details.inputField.fldid(self,{field:'walkable'}));
        var xdraw = jQuery('#draw_'+gdui.details.inputField.fldid(self,{field:'exits'}));
        //draw the current shape(s) and allow create/edit of shapes.
        this.shapeObj = $.extend(true,{},gd_poly);
        this.exitsObj = $.extend(true,{},gd_poly);
        this.shapeObj.setup('Walkable',wdraw,[{shape:self.data.walkable}]);
        this.exitsObj.setup('Exits',xdraw,self.data.exits);

        $.getJSON(pa_args.game_root+'/ajax.php',{'module':'listImages', lib:'designer',type:'scenes'},function(resp) {
            var options = '<option selected="selected" value="">--pick one--</option>';
            for (var i = 0; i < resp.results.length; i++) {
                options += '<option value="' + resp.results[i] + '">' + resp.results[i] + '</option>';
            }
            $('#sel_'+gdui.details.inputField.fldid(self,{field:'bgimg'})).html(options).val(self.data.backdrop).change();
        });
    },
    save : function() {
        this.data.walkable = this.shapeObj.shapes[0].shape;
        for(var i in this.data.exits) {
            this.data.exits[i].shape = this.exitsObj.shapes[i].shape;
        }
        gd.saveObj(this,'scene');
    }
}

var gdCharacter = {
    type : 'char',
    uiWin : null,
    data : {},
    baseData : {id:0,name:'*New Character*',startSceneID : 0, sprite:''},
    tableFields : {
        'id' : 'ID', 'name' : 'Name'
    },
    dataFields : [
        {caption: 'Name',field:'name',type:'text'},
        {caption: 'Initial Location',field:'startSceneID',type:'text'},
        {caption: 'Sprite',field:'sprite',type:'spriteimg'}
    ],
    dropBoxField : function() {return 'name';},
    create : function(data) {
        this.data = $.extend({},this.baseData,data);
        gdui.list.addTableRow('char', this.data, this.tableFields);
    },
    winTitle : function() {
        if(this.data.id) {
            return 'Character ' +this.data.id + ': '+this.data.name;
        }
        return 'New Character';
    },
    tabID : function() {
        return 'gd_detswin_char_'+(this.data.id);
    },
    winTabs : function() {
        var tab_id = this.tabID();
        var tabs = {
            'Data' : gdui.details.inputFields(this,'dataFields'),
            'Sprite' : '@todo: Sprite image will be shown here, along with features to change it and specify the movement types.',
            'Conversations' : '@todo: Conversation trees with this character will be shown here, along with the ability to edit it.'
        };
        var output_tabs = '', output_divs = '';
        for(var i in tabs) {
            output_tabs += '<li><a href="#'+tab_id+'_tab'+i+'">'+i+'</a></li>';
            output_divs += '<div id="'+tab_id+'_tab'+i+'">'+tabs[i]+'</div>';
        }
        return '<div class="gd_tabset gd_chardets" id="'+tab_id+'"><ul>'+output_tabs+'</ul>'+output_divs+'</div>';
    },
    postLoad : function() {
        //create a graphic object on top of the image.
        var self = this;

        $.getJSON(pa_args.game_root+'/ajax.php',{'module':'listImages', lib:'designer','type':'sprites'},function(resp) {
            var options = '<option selected="selected" value="">--pick one--</option>';
            for (var i = 0; i < resp.results.length; i++) {
                options += '<option value="' + resp.results[i] + '">' + resp.results[i] + '</option>';
            }
            $('#sel_'+gdui.details.inputField.fldid(self,{field:'sprite'})).html(options).val(self.data.sprite).change();
        });
    },
    save : function() {
        gd.saveObj(this,'char');
    }
}

var gdItem = {
    type : 'item',
    uiWin : null,
    data : {},
    baseData : {id:0,title:'*New Item*',location:0},
    tableFields : {
        'id' : 'ID', 'title' : 'Name'
    },
    dataFields : [
        {caption: 'Name',field:'title',type:'text'},
        {caption: 'Initial Location',field:'location',type:'text'}
    ],
    dropBoxField : function() {return 'title';},
    create : function(data) {
        this.data = $.extend({},this.baseData,data);
        gdui.list.addTableRow('item', this.data, this.tableFields);
    },
    winTitle : function() {
        if(this.data.id) {
            return 'Item ' +this.data.id + ': '+this.data.title;
        }
        return 'New Item';
    },
    tabID : function() {
        return 'gd_detswin_item_'+(this.data.id);
    },
    winTabs : function() {
        var tab_id = this.tabID();
        var tabs = {
            'Data' : gdui.details.inputFields(this,'dataFields'),
            'Images' : '@todo: Images for the item will be shown here, along with features to change them.',
            'Actions' : '@todo: Data regarding the actions possible with the item will be shown here, along with features to change them.'
        };
        var output_tabs = '', output_divs = '';
        for(var i in tabs) {
            output_tabs += '<li><a href="#'+tab_id+'_tab'+i+'">'+i+'</a></li>';
            output_divs += '<div id="'+tab_id+'_tab'+i+'">'+tabs[i]+'</div>';
        }
        return '<div class="gd_tabset gd_itemdets" id="'+tab_id+'"><ul>'+output_tabs+'</ul>'+output_divs+'</div>';
    },
    postLoad : function() {
        
    },
    save : function() {
        alert('saving item '+this.data.id);
    }
}

var gdEvent = {
    type : 'event',
    uiWin : null,
    data : {},
    baseData : {id:0,title:'*New Event*',location:0},
    tableFields : {
        'id' : 'ID', 'title' : 'Name'
    },
    dataFields : [
        {caption: 'Name',field:'title',type:'text'},
        {caption: 'When the player...',field:'actionType',type:'actionType'}
    ],
    dropBoxField : function() {return 'title';},
    create : function(data) {
        this.data = $.extend({},this.baseData,data);
        gdui.list.addTableRow('event', this.data, this.tableFields);
    },
    winTitle : function() {
        if(this.data.id) {
            return 'Event ' +this.data.id + ': '+this.data.title;
        }
        return 'New Event';
    },
    tabID : function() {
        return 'gd_detswin_event_'+(this.data.id);
    },
    winTabs : function() {
        var tab_id = this.tabID();
        var tabs = {
            'Data' : gdui.details.inputFields(this,'dataFields')
        };
        var output_tabs = '', output_divs = '';
        for(var i in tabs) {
            output_tabs += '<li><a href="#'+tab_id+'_tab'+i+'">'+i+'</a></li>';
            output_divs += '<div id="'+tab_id+'_tab'+i+'">'+tabs[i]+'</div>';
        }
        return '<div class="gd_tabset gd_eventdets" id="'+tab_id+'"><ul>'+output_tabs+'</ul>'+output_divs+'</div>';
    },
    postLoad : function() {
        
    },
    save : function() {
        alert('saving event '+this.data.id);
    }
}

var gdui = {
    list : {
        load : function(type,data) {
            var i;
            if(!data.success) {alert(data.error);return;}
            data = data.results;
            gdui.list.createWindow(type);
            gd[type+'s'] = {};
            for(i in data) {if (data.hasOwnProperty(i)) {
                gd[type+'s'][data[i].id] = gd.createObj(type,data[i]);
            }}
            gdui.list.openWindow(type);
        },
        openWindow : function(type) {
            $('#gd_listwin_'+type).dialog('open');
            $('#gd_listwin_'+type+' .gd_datalist').tablesorter({
                widgets : ['zebra']
            });
        },
        createWindow : function(type) {
            var win_title, tobj;
            switch(type) {
                case 'scene':win_title='Scenes';tobj=gdScene;break;
                case 'char' :win_title='Characters';tobj=gdCharacter;break;
                case 'item' :win_title='Items';tobj=gdItem;break;
                case 'event':win_title='Events';tobj=gdEvent;break;
                default :alert('Unknown data type. ['+type+']');return;
            }
            var win_id = 'gd_listwin_' + type;
            var table_id = 'gd_datalist_' + type;
            var win_content = '<table class="gd_datalist tablesorter tablesorter-blue" id="'+table_id+'" data-type="'+type+'"><thead>'+gdui.list.tableHeader(tobj.tableFields)+'</thead><tbody></tbody></table>';

            var buttons = [];
            buttons.push({text: 'Create', click: function() {
                gdui.list.pressCreate($(this).find('.gd_datalist').data('type'));
            }});
            buttons.push({text: 'Edit', click: function() {
                var currItem = $(this).find('.gd_datalistitemselected');
                if(currItem.length===0) {alert('No item selected.');return;}
                gdui.list.pressUpdate(currItem.data('type'),currItem.data('id'));
            }});
            buttons.push({text: 'Delete', click: function() {
                var currItem = $(this).find('.gd_datalistitemselected');
                if(currItem.length===0) {alert('No item selected.');return;}
                gdui.list.pressDelete(currItem.data('type'),currItem.data('id'));
            }});
            $('body').append('<div class="dialog_window" id="'+win_id+'">'+win_content+'</div>');

            $('#'+win_id).dialog({
                width: 400,
                height: 400,
                title : win_title,
                autoOpen : false,
                buttons: buttons
            });
        },
        tableHeader : function(fields) {
            var output = '<tr>';
            for(var i in fields) {output += '<th>'+fields[i]+'</th>';}
            output += '</tr>';
            return output;
        },
        tableRow : function(type, data, fields) {
            var output = '<tr class="gd_datalistitem" id="gd_datalistitem_'+type+'_'+data.id+'" data-type="'+type+'" data-id="'+data.id+'">';
            for(var i in fields) {output += '<td id="gduitd_'+type+'_'+data.id+'_'+i+'">'+(data[i]?data[i]:'&nbsp;')+'</td>';}
            output += '</tr>';
            return output;
        },
        addTableRow : function(type,data,fields) {
            var row = $(gdui.list.tableRow(type,data,fields));
            $('#gd_datalist_'+type+' tbody').append(row).trigger('addRows',[row,true]);        
        },
        delTableRow : function(type,id) {
            $('#gd_datalistitem_'+type+'_'+id).remove();
            $('#gd_datalist_'+type).trigger('update');
        },
        pressCreate : function(type) {
            gdui.details.load(type,0);
        },
        pressUpdate : function(type,id) {
            gdui.details.load(type,id);
        },
        pressDelete : function(type,id) {
            var win_title;
            switch(type) {
                case 'scene':win_title='Scene';break;
                case 'char' :win_title='Character';break;
                case 'item' :win_title='Item';break;
                case 'event':win_title='Event';break;
                default :alert('Unknown data type. ['+type+']');return;
            }
            if(confirm('Are you sure you want to delete ' + win_title + ' #' + id)) {
                //@todo: prevent delete if linked with other locations/characters/items/events, or warn and unlink everything.
                alert('bang!'); //@todo: delete from DB, JS data and HTML table. Close details window if open.
            }
        }
    },
    details : {
        load : function(type,id) {
            if(!gd[type+'s'][id]) {gd[type+'s'][id] = gd.createObj(type,{id:0});}
            var obj = gd[type+'s'][id];
            var newWin = (!obj.uiWin || $('#'+obj.uiWin).length===0);
            if(newWin) {
                obj.uiWin = gdui.details.createWindow(obj);
            }
            $('#'+obj.uiWin).dialog('open');
            $('#'+obj.uiWin).dialog('moveToTop');
            if(newWin) {
                obj.postLoad();
            }
        },
        createWindow : function(obj) {
            var win_id = obj.tabID()+'_win';
            var win_content = obj.winTabs();

            var buttons = [];
            buttons.push({text: 'Save', click: function() {
                obj.save();
            }});
            $('body').append('<div class="dialog_window" id="'+win_id+'">'+win_content+'</div>');

            $('#'+win_id).dialog({
                width: 740,
                height:600,
                title : obj.winTitle(),
                autoOpen : false,
                buttons: buttons
            });
            $('#'+obj.tabID()).tabs();
            return win_id;
        },
        inputFields : function(obj,type) {
            //class=fldtext fldscene_title
            var output = '';
            for(var i=0; i<obj[type].length; i++) {
                var field = obj[type][i];
                output += '<div class="gd_field fld'+field.type+' fld'+obj.type+'_'+field.field+'">'+gdui.details.inputField[field.type](obj,field)+'</div>';
            }
            return output;
        },
        inputField : {
            fldid : function(obj,field) {
                return 'fld'+obj.type+'_'+field.field+'_'+obj.data.id;
            },
            imgurl : function(obj,type) {
                var dirs = {'bg':'scenes','sprite':'sprites'};
                var img = {'bg':'backdrop','sprite':'sprite'};
                return (obj.data[img[type]] ? pa_args.game_root+'/assets/'+pa_args.paGame+'/'+dirs[type]+'/'+obj.data[img[type]] : pa_args.game_root+'/gfx/noimage.png');
            },
            text : function(obj,field) {
                return this.caption(obj,field)+'<input type="text" class="gdui_input gdui_input_'+obj.type+'_'+field.field+'" id="'+this.fldid(obj,field)+'" value="'+obj.data[field.field]+'" />';
            },
            count : function(obj,field) {
                return this.caption(obj,field)+'<span>'+obj.data[field.field].length+'</span>';
            },
            caption : function(obj,field) {
                return '<caption for="'+this.fldid(obj,field)+'">'+field.caption+':</caption>';
            },
            bgimg : function(obj,field) {
                return this.imgupload(obj,field,'bg');
            },
            spriteimg : function(obj,field) {
                return this.imgupload(obj,field,'sprite');
            },
            imgupload : function(obj,field,fldtype) {
                //@todo: style the upload-file field so it looks less awkward and doesn't display the filename.
                var img = this.imgurl(obj,fldtype);
                return '<form class="gd_upload'+fldtype+'form" method="post" enctype="multipart/form-data" action="'+pa_args.game_root+'/ajax.php" >'
                    +this.caption(obj,field)+' <input type="file" class="gd_upload'+fldtype+'" name="gd_upload'+fldtype+'" id="'+this.fldid(obj,field)+'" data-id="'+obj.data.id+'" />'
                    +'<br />Or existing filename: <select class="gd_'+fldtype+'existing" name="use_existing" id="sel_'+this.fldid(obj,field)+'" data-id="'+obj.data.id+'"><option selected="selected" value="">--pick one--</option></select>'
                    +'<input type="hidden" name="module" value="upload'+fldtype[0].toUpperCase()+fldtype.slice(1)+'Image" /><input type="hidden" name="lib" value="designer" />'
                    +'<br />'
                    +'<img src="'+img+'" class="gd_'+fldtype+'thumb" id="'+this.fldid(obj,field)+'_thumb" />'
                    +'</form>';
            },
            shape : function(obj,field) {
                var img = this.imgurl(obj,'bg');
                return '<div id="draw_'+this.fldid(obj,{field:field.field})+'" class="gd_drawshape" data-img="'+img+'"></div>';
            },
            actionType : function(obj,field) {
                var opts, i, output, selected, mainsel;
                opts = [
                    {title:'-- please select --', dropbox:'', subOpt:''},
                    {title:'picks up object', dropbox:'item', subOpt:''},
                    {title:'uses object', dropbox:'item', subOpt:''},
                    {title:'talks to character',dropbox:'char', subOpt:'talk'},
                    {title:'goes to scene',dropbox:'scene', subOpt:''}
                ];
                mainsel=this.fldid(obj,field);
                output = '<div>';
                output += this.caption(obj,field)+'<select class="gdui_input gdui_input_'+obj.type+'_'+field.field+'" id="'+mainsel+'">';
                for(i in opts) {
                    selected = (obj.data[field.field]==opts[i]?'selected="selected"':'');
                    output += '<option '+selected+' value="'+i+'" data-dropbox="'+opts[i].dropbox+'" data-subopt="'+opts[i].subOpt+'">'+opts[i].title+'</option>';
                }
                output += "</select> ";

                output += "<div class='event_actionSubjects'>";
                output += gd.dropBox('scene', this.fldid(obj,{field:'appliesToSceneID'}), obj.data.appliesToSceneID, 'data-type="scene" data-mainsel="'+mainsel+'" style="display:none"');
                output += gd.dropBox('char',  this.fldid(obj,{field:'appliesToCharID'}),  obj.data.appliesToCharID,  'data-type="char"  data-mainsel="'+mainsel+'" style="display:none"');
                output += gd.dropBox('item',  this.fldid(obj,{field:'appliesToItemID'}),  obj.data.appliesToItemID,  'data-type="item"  data-mainsel="'+mainsel+'" style="display:none"');
                output += "</div>";
                output += "</div>";

                output += "<div class='event_actionSubAction'>";
                output += "<div id='"+this.fldid(obj,{field:'subOpttalk'})+"' data-typetalk' style='display:none;'>...and says <select id='"+this.fldid(obj,{field:'selSubOpttalk'})+"' data-type='talk'></select></div>";
                output += "</div>";

                return output;
            }
        }
    }
};

var gd_poly = {
    W: 640,
    H: 480,
    polyBorder : '#990000',
    boxfill : "#FF0000",
    buttonfill : "#FFFF00",
    movingfill : "#0000FF",
    gr : null,
    shapes : [],
    blankets : [],
    buttons : [],
    points : [],
    poly : [],
    start : null,
    image : null,
    type : '',

    setup : function(type,box,shapes) {
        var self = this;
        this.W = parseInt(box.css('width'));
        this.H = parseInt(box.css('height'));
        if(!this.W) {this.W = 640;}
        if(!this.H) {this.H = 480;}
        this.gr = Raphael(box[0], this.W, this.H);
        this.setImage(box.data('img'));
        this.type = type;
        this['setup'+type](box);
        this.shapes = shapes;
        this.points = [];
        this.buttons = [];
        this.blankets = [];
        this.poly = []

        for(var sh in shapes) {
            var shData = shapes[sh].shape.split(',');
            var points = [];
            while(shData.length) {
                points.push([parseInt(shData.shift()),parseInt(shData.shift())]);
            }
            this.setupNewShape(points);
        }
    },
    setupNewShape : function(points) {
        var poly = this.gr.path();
        poly.attr({path:this.getPolyPath(points), stroke: this.polyBorder, fill: this.boxfill, opacity: 0.55, "stroke-width": 2});
        this.points.push(points);
        this.poly.push(poly);
        this.blankets.push(this.gr.set());
        this.buttons.push(this.gr.set());
        var shapeID = this.points.length-1;
        for(var pointID=0; pointID<points.length; pointID++) {
            this.createDragPoint(this,shapeID,pointID,this.points[shapeID],this.poly[shapeID]);
        }
    },
    pointsToShapes : function() {
        for(var i in this.points) {
            this.shapes[i].shape = this.points[i].join();
        }
    },
    setImage : function(image) {
        var self=this;
        if(self.image) {self.image.remove();}
        self.image = self.gr.image(image,0,0,self.W,self.H);
        self.image.toBack();
        if(self.type === 'Exits') {
            $(self.image.node).contextMenu({
                menu:     'gd_contextmenu_image',
                onSelect: function(menuitem) {
                    switch(menuitem.attr('name')) {
                        case 'addShape' :
                            //place a new shape somewhere near the center of the area (randomised a bit so that multiple shapes don't just sit on top of each other).
                            var x = (self.W/2) + Math.floor(Math.random()*100)-50,
                                y = (self.H/2) + Math.floor(Math.random()*100)-50;
                            self.addShape(x,y);
                            break;
                    }
                    gd.initClicks();    //contextmenu unbinds all the click events, so we need to rebind them. grrr.
                }
            });
        }
    },
    setupWalkable : function(box) {
        this.polyBorder = '#990000';
        this.boxfill = "#FF0000";
        this.buttonfill = "#FFFF00";
        this.movingfill = "#AAAA44";
    },
    setupExits : function(box) {
        this.polyBorder = '#000099';
        this.boxfill = "#0000FF";
        this.buttonfill = "#00FF00";
        this.movingfill = "#44AA44";
    },
    createDragPoint : function(self,shapeID, pointID) {
        self.buttons[shapeID].splice(pointID,0,self.gr.circle(self.points[shapeID][pointID][0], self.points[shapeID][pointID][1], 5).attr({fill: self.buttonfill, stroke: "none"}));
        self.blankets[shapeID].splice(pointID,0,self.gr.circle(self.points[shapeID][pointID][0], self.points[shapeID][pointID][1], 25).attr({stroke: "none", fill: "#fff", opacity: 0}).mouseover(function () {
            self.buttons[shapeID].items[pointID].animate({r: 10}, 200);
        }).mouseout(function () {
            self.buttons[shapeID].items[pointID].animate({r: 5}, 200);
        }).drag(
            function (dx, dy, mx, my, e) {     //dragmove
                if(self.start) {
                    var newX = self.start.x+dx
                    var newY = self.start.y+dy;
                    (newX > self.W) && (newX = self.W);
                    (newX < 0) && (newX = 0);
                    (newY > self.H) && (newY = self.H);
                    (newY < 0) && (newY = 0);
                    self.points[shapeID][pointID]=[newX,newY];
                    self.poly[shapeID].attr({path:self.getPolyPath(self.points[shapeID])});
                    self.buttons[shapeID].items[pointID].attr({cx:newX, cy:newY});
                    self.blankets[shapeID].items[pointID].attr({cx:newX, cy:newY});
                    self.gr.safari();
                }
            },
            function (x, y, e) {       //dragstart
                self.start = {shapeID: shapeID, pointID: pointID, x: self.points[shapeID][pointID][0], y: self.points[shapeID][pointID][1]};
                self.buttons[shapeID][pointID].attr({fill: self.movingfill});
            },
            function (x, y, e) {       //dragend
                self.buttons[shapeID][pointID].attr({fill: self.buttonfill});
                self.start = null;
                self.pointsToShapes();
            }
        ));
        self.blankets[shapeID].items[self.blankets[shapeID].items.length - 1].node.style.cursor = "move";
        $(self.blankets[shapeID].items[self.blankets[shapeID].items.length - 1].node).contextMenu({
            menu:     'gd_contextmenu_point_'+self.type,
            onSelect: function(menuitem) {
                switch(menuitem.attr('name')) {
                    case 'addPoint' :self.addPoint(shapeID,pointID);break;
                    case 'delPoint' :self.delPoint(shapeID,pointID);break;
                    case 'exitDest' :self.setExitDest(shapeID);break;
                    case 'delShape' :self.delShape(shapeID);break;
                }
                gd.initClicks();    //contextmenu unbinds all the click events, so we need to rebind them. grrr.
            }
        });
    },
    getPolyPath : function(points) {
        var path = ['M'].concat(points[0]);
        for(var i=1; i<points.length; i++) {
            path = path.concat(['L']).concat(points[i]);
        }
        path = path.concat(['Z']);
        return path;
    },
    setExitDest : function(shapeID) {
        //pop up a droplist of locations to pick from.
        var self = this;
        var sh = self.shapes[shapeID];
        $("#gd_general_dialog").html(
            "<div><label>Exit leads to:</label>"+gd.dropBox('scene', 'gd_sel_exit_dest', sh.destID)+'</div>'+
            "<div><label>Player Coords:</label><input type='text' size='4' id='gd_sel_exit_dX' value='"+(sh.destX?sh.destX:'')+"'placeholder='X'><input type='text' size='4' id='gd_sel_exit_dY' value='"+(sh.destY?sh.destY:'')+"'placeholder='Y' /></div>"+
            "<div><label>Then move to:</label><input type='text' size='4' id='gd_sel_exit_dX2' value='"+(sh.destX2?sh.destX2:'')+"'placeholder='X'><input type='text' size='4' id='gd_sel_exit_dY2' value='"+(sh.destY2?sh.destY2:'')+"'placeholder='Y' /></div>"
        );
        $("#gd_general_dialog").dialog({
            autoOpen: false,
            height: 200,
            width: 450,
            modal: false,
            title: 'Set Exit Details',
            buttons: {
                "Set Exit Destination": function() {
                    sh.destID = $('#gd_sel_exit_dest option:selected').val();
                    sh.destX = parseInt($('#gd_sel_exit_dX').val());
                    if(!sh.destX) {sh.destX=0;}
                    sh.destY = parseInt($('#gd_sel_exit_dY').val());
                    if(!sh.destY) {sh.destY=0;}
                    sh.destX2 = parseInt($('#gd_sel_exit_dX2').val());
                    if(!sh.destX2) {sh.destX2=0;}
                    sh.destY2 = parseInt($('#gd_sel_exit_dY2').val());
                    if(!sh.destY2) {sh.destY2=0;}
                    $("#gd_general_dialog").dialog("close");
                },
                "Cancel": function() {
                    $("#gd_general_dialog").dialog("close");
                }
            }
        });
        $("#gd_general_dialog").dialog('open');
    },
    addPoint : function(shapeID, pointID) {
        //find coords midway between two existing points and add a new point with those coords.
        if(isNaN(parseInt(pointID)) || pointID>=this.points[shapeID].length) {pointID = this.points[shapeID].length-1;}
        var pointIDb = (pointID === 0) ? this.points[shapeID].length-1 :pointID-1;
        var x1 = this.points[shapeID][pointID][0],
            x2 = this.points[shapeID][pointIDb][0],
            y1 = this.points[shapeID][pointID][1],
            y2 = this.points[shapeID][pointIDb][1];
        this.points[shapeID].splice(pointID,0,[(x1+x2)/2,(y1+y2)/2]);
        this.rebuildPoints(shapeID,pointID);
        this.poly[shapeID].attr({path:this.getPolyPath(this.points[shapeID])});
    },
    delPoint : function(shapeID, pointID) {
        if(isNaN(parseInt(pointID)) || pointID>=this.points[shapeID].length) {pointID = this.points[shapeID].length-1;}
        if(this.points[shapeID].length>3) {
            this.points[shapeID].splice(pointID,1);
            this.rebuildPoints(shapeID,pointID);
            this.poly[shapeID].attr({path:this.getPolyPath(this.points[shapeID])});
        }
    },
    addShape : function(startX, startY) {
        //setup four points, around the specified X/Y, but within the main image area.
        var x1 = startX-20,
            x2 = startX+20,
            y1 = startY-10,
            y2 = startY+20;
        if(x1<=5) {x1+=10;x2+=10;}
        if(y1<=5) {y1+=10;y2+=10;}
        if(x2>=this.W-5) {x1-=10;x2-=10;}
        if(y2>=this.H-5) {y1-=10;y2-=10;}
        this.setupNewShape([[x1,y1],[x2,y1],[x2,y2],[x1,y2]]);
        if(this.type==='Walkable') {
            this.shapes.push({'shape':''});
        } else {
            this.shapes.push({'shape':'','destID':0,'id':0});
        }
        this.pointsToShapes();
    },
    delShape : function(shapeID) {
        if(this.type === 'Walkable') {
            alert('Cannot delete the walkable area.');
            return
        } else {
            if(!confirm('Delete this shape? Please confirm.')) {
                return;
            }
        }
        this.poly.splice(shapeID,1)[0].remove();
        this.blankets.splice(shapeID,1)[0].remove();
        this.buttons.splice(shapeID,1)[0].remove();
        this.points.splice(shapeID,1);
        this.shapes.splice(shapeID,1);
        for(var i in this.points) {
            this.rebuildPoints(i,0);
        }
    },
    rebuildPoints : function(shapeID,pointID) {
        //rebuild the point markers after the added/deleted one, since the existing callbacks will have the wrong IDs.
        var rb;
        var remBtns = this.buttons[shapeID].splice(pointID,this.buttons[shapeID].length-pointID);
        for(rb=0; rb<remBtns.length; rb++) {remBtns[rb].remove();}
        var remBlks = this.blankets[shapeID].splice(pointID,this.blankets[shapeID].length-pointID);
        for(rb=0; rb<remBlks.length; rb++) {remBlks[rb].remove();}
        for(var newPID=pointID; newPID<this.points[shapeID].length; newPID++) {
            this.createDragPoint(this,shapeID,newPID);
        }
        this.pointsToShapes();
    }
};

//------------------------------------------------------------------------------
$(document).ready(function() {
    gd.initialise();
});

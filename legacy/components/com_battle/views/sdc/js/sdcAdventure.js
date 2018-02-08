/**
 * sdcAdventure - main game playing Javascript library.
 * @author: Simon Champion.
 * @version: 0.1
 */

var pa = {
    chars : {},
    gameAction: 'moveto',
    playerchar : 0,
    initialise : function() {
        $('#clickmap area').live("click", function(e){
            pa.doSelectedAction($(this), e.pageX-$('#clickmap').offset().left, e.pageY-$('#clickmap').offset().top);
            e.stopPropagation();
            e.preventDefault();
            return false;
        });
        $('.pachar').live("click", function(e) {
            pa.doCharAction($(this));
            e.stopPropagation();
            e.preventDefault();
            return false;
        });
        $('.actionbutton').live("click", function(e){
            switch($(this).data('type')) {
                case 'gameaction' :
                    $('.actionbutton').removeClass('activebutton');
                    $(this).addClass('activebutton');
                    pa.gameAction = $(this).data('action');
                    break;
                case 'info' :
                    alert('info button!');
                    //@todo: load and show useful info data.
                    break;
            }
        });
        $('.talkopt').live('click', function(e) {
            var cdata = $(this).data('cdata');
            $('#gs_talkopts').empty();
            pa.chars[pa.playerchar].talk(cdata.text,function() {
                if(cdata.leadsToOpts) {
                    $.getJSON(pa_args.game_root+'/ajax.php',{'module':'talkTo', 'charID':cdata.saidTo, 'speechOptsID':cdata.leadsToOpts, 'talkTo':cdata.saidBy},function(data) {
                        pa.startConversation(data.results[0],data.results[1]);
                    });
                }
            });
        });
        $('#action_'+pa.gameAction).click();

    },
    loadScene : function(playerPos) {
        $('#gs_loading').show();
        $.getJSON(pa_args.game_root+'/ajax.php',{'module':'loadScenes', 'sceneID':pa_args.currentScene},function(data) {
            if(!data.success) {alert(data.error);return;}
            data = data.results[0];
            $('#gs_background').css({background:'url("'+pa_args.game_root+'/assets/'+pa_args.paGame+'/scenes/'+data.backdrop+'")'});
            pa.addMap(data.exits, data.walkable);
            if(playerPos) {
                var found=false;
                var playerData = {id:pa.playerchar,isPlayer:true,startX:playerPos[0],startY:playerPos[1],startFrame:'',startX2:playerPos[2],startY2:playerPos[3],startFrame2:''};
                for(var i in data.chars) {
                    if(data.chars[i].id===pa.playerchar) {
                        found = true;
                        data.chars[i]=playerData;
                    }
                }
                if(!found) {data.chars.push(playerData);}
            }
            for(var i in pa.chars) {
                pa.chars[i].hide();
            }
            if(data.chars) {
                for(var ch in data.chars) {
                    var dc = data.chars[ch];
                    if(dc.isPlayer) {pa.playerchar=dc.id;}
                    if(!pa.chars[dc.id]) {
                        pa.chars[dc.id]=$.extend({},paCharacter);
                        pa.chars[dc.id].load(dc);
                    } else {
                        pa.chars[dc.id].setupCharActions(dc);
                    }
                }
            } else {
                $('#gs_loading').hide();
            }
        });
    },
    addMap : function(exits, walkable) {
        var areas = [];
        for(var exit in exits) {
            var x=exits[exit];
            var icon = x.icon ? "cursor: url("+x.icon+"),auto" : '';
            areas.push("<area style='"+icon+"' data-type='exit' data-dest='"+x.destID+"' data-destpos='"+[x.destX,x.destY,x.destX2,x.destY2].join('|')+"' shape='poly' coords='"+x.shape+"' href='javascript:void;'>");
        }
        areas.push("<area data-type='walk' shape='poly' coords='"+walkable+"' href='javascript:void;'>");
        var html = "<img src='gfx/blank.png' class='gamepanel' id='clickmapmap' usemap='#clickmapmap'>"
                 + "<map id='clickmapmap' name='clickmapmap'>" + areas.join('') + "</map>";
        $('#clickmap').html(html);
    },
    /**
     * doSelectedAction: Called when user clicks on the main game panel.
     * Executes the currently selected game action (eg "Walk to", "Talk to", etc).
     */
    doSelectedAction : function(clickElement, x,y) {
        var subsequentFunc = null;
        var etype = clickElement.data('type');
        switch(pa.gameAction) {
            case 'moveto' :
                if(etype !== 'walk' && etype !== 'exit') {break;}
                if(etype==='exit') {
                    subsequentFunc=function() {
                        var pos=clickElement.data('destpos').split('|');
                        pa_args.currentScene=clickElement.data('dest');
                        pa.loadScene(pos);
                    }
                }
                if(pa.playerchar) {
                    pa.chars[pa.playerchar].moveTo(x,y,subsequentFunc);
                }
                break;
            case 'talkto' :
                alert('Click a character to talk to them.');
                break;
            default :
                alert('Unknown game action');
        }
    },
    doCharAction : function(clickElement) {
        var talkTo = clickElement.data('id');
        switch(pa.gameAction) {
            case 'moveto' :
                alert('Click an empty area of the ground to walk there.');
                break;
            case 'talkto' :
                $.getJSON(pa_args.game_root+'/ajax.php',{'module':'talkTo', 'charID':pa.playerchar, 'talkTo':talkTo},function(data) {
                    pa.startConversation(data.results[0],data.results[1]);
                });
                break;
            default :
                alert('Unknown game action');
        }
    },
    startConversation : function(cdata,nextdata) {
        if(!cdata) {$('#gs_talkopts').hide(); return;}
        for(var i in cdata) {var sdata = cdata[i];}
        var doTheTalking = function() {
            if(function() {var c=0; for(var i in cdata) {c++;} return c;}()===1) {
                pa.chars[sdata.saidBy].talk(sdata.text,function() {pa.startConversation(nextdata,null);});
            } else {
                //render a set of speech options for the player to pick from
                var container = $('#gs_talkopts');
                container.empty();
                var count=0;
                for(var i in cdata) {
                    var firstline = cdata[i].text.split('|')[0];
                    var optiondiv = $("<div class='talkopt'>"+firstline+"</div>");
                    optiondiv.data('cdata',cdata[i]);
                    container.append(optiondiv);
                    count++;
                }
                if(count===1) {optiondiv.click(); return;}    //no need to show the options list if only one option; just do the action.
                container.show();
            }
        }
        if(sdata.optsID === null && sdata.saidBy===pa.playerchar && sdata.saidBy!==sdata.saidTo) {
            $('#gs_talkopts').empty().show();
            //move to be close to the char we're talking to...
            //set characters to face each other.
            var newx, newy, newdir;
            var npc=pa.chars[sdata.saidTo].getPosition();
            newy = npc.y;
            if(npc.dir==='l') {
                newdir = 'r';
                newx = npc.x-(npc.w*1.5);
            } else {
                newdir = 'l';
                newx = npc.x+(npc.w*2.5);
            }
            pa.chars[pa.playerchar].moveTo(newx,newy, function() {
                pa.chars[pa.playerchar].setSprite('t'+newdir);
                doTheTalking();
            });
        } else {
            doTheTalking();
        }
    }
};

var paCharacter = {
    id : 0,
    data : {},
    obj : {},
    load : function(dc) {
        this.id = dc.id;
        this.data = {};
        this.obj = {};
        var self = this;
        $.getJSON(pa_args.game_root+'/ajax.php',{'module':'loadCharacters', 'charID':dc.id},function(data) {
            self.data = data.results[0];
            if(!self.data.dir) {self.data.dir = 'r';}
            self.obj = $('<div class="pachar" id="pachar_'+dc.id+'" data-id="'+dc.id+'"></div>').hide()
            .css({width:self.data.width,height:self.data.height,background:'url("'+pa_args.game_root+'/assets/'+pa_args.paGame+'/sprites/'+self.data.sprite+'")'})
            .sprite({
                fps: 5, 
                no_of_frames: self.data.frames
            }).active().spStop();
            $('#gamespace').append(self.obj);
            self.setupCharActions(dc);
            if(self.data.player) {self.setPlayerActions();}
        });
    },
    hide : function() {
        this.obj.hide();
    },
    show : function() {
        this.obj.show();
    },
    setupCharActions : function(dc) {
        if(dc.startFrame) {this.setSprite(dc.startFrame);}
        this.show();
        this.setPosition(dc.startX,dc.startY);
        $('#gs_loading').hide();    //@fixme: this should really only happen when we load the last one character.
        if(dc.startX2>0 && dc.startY2>0) {        //this means character moves immediately when loaded. (eg player char moves away from point of entrance)
            if(dc.startFrame2) {this.setSprite(dc.startFrame2);}
            this.moveTo(dc.startX2,dc.startY2);
        }
    },
    setSprite : function(act,dir) {
        //act: w=walk; t=talk.
        //dir: l=left, r=right,b=back,f=forward.
        //sprite should have a suitable mode. if not, pick next best.
        if(!dir) {
            if(act.length===2) {
                dir=act.charAt(1);
                act=act.charAt(0);
            } else {
                dir=this.data.dir;
            }
        }
        var actions = {'w':'t','t':'w'}, directions = {'l':'f','f':'l','r':'b','b':'r'};
        var spnum=0;
        if(!actions[act]) {act='w';}
        if(!directions[dir]) {dir='l';}
        var attempts = [
            act+dir,
            act+directions[dir],
            actions[act]+dir,
            actions[act]+directions[dir],
            'wr'
        ];
        for(var att in attempts) {
            spnum = this.data.animList.split(',').indexOf(attempts[att])+1;
            if(spnum) {
                this.obj.spState(spnum);
                this.data.dir=attempts[att].charAt(1);   //keep track of which way we're facing.
                return true;
            }
        }
        return false;
    },
    setPosition : function(x,y) {
        var h=parseInt(this.obj.css('height')), w=parseInt(this.obj.css('height'));
        this.obj.css({top:y-h,left:x-(w/2)}).show();
    },
    getPosition : function() {
        return {
            x:parseInt(this.obj.css('left'))+(parseInt(this.obj.css('width'))/2),
            y:parseInt(this.obj.css('top'))+parseInt(this.obj.css('height')),
            dir:this.data.dir,
            w:parseInt(this.obj.css('width')),
            h:parseInt(this.obj.css('height'))
        };
    },
    /**
     * Calculate the direction of movement, set the appropriate sprite, and walk to destination.
     */
    moveTo : function(x,y,subsequentFunc) {        //@todo: generate path to destination.
        if(!subsequentFunc || typeof subsequentFunc!== 'function') {subsequentFunc=function(){};}
        var obj=this.obj;
        var w=parseInt(obj.css('width'))/2, h=parseInt(obj.css('height'));
        y-=h;
        var currX = parseInt(obj.css('left')), currY=parseInt(obj.css('top'));
        var dx=x-currX, dy=y-currY, dir='';
        if(Math.abs(dx)>=Math.abs(dy)) {    //moving further horizontally or vertically?
            dir=(dx>0) ? 'r' : 'l';         //horizontally: then use right or left anim.
        } else {
            dir=(dy>0) ? 'f' : 'b';         //vertically: then use back or forward anim.
        }
        this.setSprite('w',dir);            //walking, in specified direction.
        //obj.stop().fps(5).animate({top:y-h,left:x-(w/2)},{duration:??, complete: function() {obj.spStop(true); subsequentFunc();}});
        obj.stop().fps(5).supremate({top:y,left:x-w},150, 'linear', function() {obj.spStop(true);subsequentFunc();});
    },
    talk : function(text,subsequentFunc) {
        //@todo: calculate optimum text display position.
        this.setSprite('t');            //talking, in current direction.
        this.obj.stop().fps(5);
        this.renderSpeech(text.split('|'),this.data.talkColour,subsequentFunc);
    },
    renderSpeech : function(lines,talkColour,subsequentFunc) {
        var line = lines.shift();
        var self=this;
        if(line) {
            $('#talking').html(line).css({color:talkColour}).fadeIn(200,function() {
                var words = line.split(' ');
                var duration = words.length*750;
                if(duration<2500) {duration=2500;}
                setTimeout(function() {
                    $('#talking').fadeOut(200,function() {
                        self.renderSpeech(lines,self.data.talkColour,subsequentFunc);
                    });
                },duration);
            });
        } else {
            this.obj.spStop(true);
            if(subsequentFunc) {subsequentFunc();}
        }
    }
}

//------------------------------------------------------------------------------
$(document).ready(function() {
    pa.initialise();
    pa.loadScene();
});

var Shoutbox = new Class({
    options: {
        refresh: 4000,
        sound: true,
        captcha: false,
        geturl: 'modules/mod_shoutbox/getShouts.php',
        periods_singular: ['second', 'minute', 'hour', 'day'],
        periods_plural: ['seconds', 'minutes', 'hours', 'days'],
        ago: 'ago',
        path: 'modules/mod_shoutbox/',
        fade_from: '#ff0000',
        fade_to: '#ffffff',
        addBottom: false,
        latestMessage: true,
        growShouts: true,
        sbid: 1
    },
    initialize: function (a) {
        this.setOptions(a);
        if (this.options.sound && Browser.Plugins.Flash.version > 9) {
            document.id('sbsound_btn' + this.options.sbid).addEvent('click', function(e) {
            	this.setSound(e);
            }.bind(this));
            this.soundobj = new Swiff(this.options.path + 'js/sound.swf').toElement();
            document.id('sbsound' + this.options.sbid).adopt(this.soundobj)
        }
        this.refresh = this.options.refresh;
        if (document.id('chatForm' + this.options.sbid) != null) {
            this.form = document.id('chatForm' + this.options.sbid);
            this.form.addEvent('submit', function(e) {
            	this.submitForm(e);
            }.bind(this));
            this.sbname = document.id('sbname' + this.options.sbid);
            this.sbname.addEvent('blur', function(e) {
            	this.checkName(e);
            }.bind(this));
            this.sburl = document.id('sburl' + this.options.sbid);
            this.sburl.addEvent('blur', function(e) {
            	this.checkURL(e);
            }.bind(this));
            this.sbshout = document.id('sbshout' + this.options.sbid);
            this.sbshout.addEvent('keydown', function(e) {
            	this.pressedEnter(e);
            }.bind(this));
            
            this.checkName();
            this.checkUrl()
        }
        this.chatoutput = document.id('chatoutput' + this.options.sbid);
        this.outputlist = document.id('outputList' + this.options.sbid);
        this.sbloadtimes = 1;
        this.sbtime = document.id('sbtime' + this.options.sbid);
        this.sblastid = document.id('sblastid' + this.options.sbid);
        this.sound = ((!Cookie.read('sb_sound' + this.options.sbid) || Cookie.read('sb_sound' + this.options.sbid) == 1) && this.options.sound);
        this.request = new Request.JSON({
            url: this.options.geturl,
            onSuccess: this.addShouts.bind(this)
        }).get({
            'sbid': this.options.sbid,
            'sblastid': this.sblastid.value - 1,
            'rand': Math.floor(Math.random() * 1000000)
        });
        if (document.id('shoutboxOp' + this.options.sbid) != null) {
            this.captcha = document.id('shoutboxOp' + this.options.sbid);
            this.captcha.addEvent('change', function(e) {
            	this.captchaSelect(e);
            }.bind(this));
        }
        if (this.options.addBottom) this.chatoutput.scrollTop = this.chatoutput.scrollHeight;
        this.getShouts();
        this.serverTime = document.id('sbservertime' + this.options.sbid).value;
        this.periodical = this.getShouts.periodical(this.refresh, this);
        if (this.options.latestMessage) {
            this.updateTime();
            this.updateTime.periodical(1000, this)
        }
    },
    getShouts: function () {
        this.sbloadtimes++;
        if (this.sbloadtimes > 9) {
            this.refresh = this.refresh * 5 / 4;
            clearInterval(this.periodical);
            this.periodical = this.getShouts.periodical(this.refresh, this)
        }
        this.request.get({
            'sbid': this.options.sbid,
            'sblastid': this.sblastid.value - 1,
            'rand': Math.floor(Math.random() * 1000000)
        })
    },
    setSound: function () {
        this.sound = (Cookie.read('sb_sound' + this.options.sbid) == '' || Cookie.read('sb_sound' + this.options.sbid) == 0) ? 1 : 0;
        Cookie.write('sb_sound' + this.options.sbid, this.sound, {
            duration: 365
        });
        document.id('sbsound_btn' + this.options.sbid).src = (this.sound) ? this.options.path + 'images/sound_1.gif' : this.options.path + 'images/sound_0.gif'
    },
    submitForm: function (e) {
        e.stop();
        if (this.sbshout.value == '') return;
        this.form.set('send', {
            onSuccess: function (a) {
                autoCancel: true,
                this.getShouts()
            }.bind(this)
        });
        this.form.send(this.form.action);
        this.sbshout.value = ''
    },
    pressedEnter: function (e) {
        if (e.key == 'enter') this.submitForm(e)
    },
    checkName: function () {
        sbCookie = Cookie.read('sb_username' + this.options.sbid);
        currentName = this.sbname;
        if (currentName.value != sbCookie) Cookie.write('sb_username' + this.options.sbid, currentName.value, {
            duration: 365
        });
        if (sbCookie && currentName.value == '') {
            currentName.value = sbCookie;
            return
        }
        if (currentName.value == '') currentName.value = 'guest_' + Math.floor(Math.random() * 10000)
    },
    checkUrl: function () {
        sbCookie = Cookie.read('sb_url' + this.options.sbid);
        currentUrl = this.sburl;
        if (currentUrl.value == '') {
            Cookie.write('sb_url' + this.options.sbid, 'http://', {
                duration: 365
            });
            return
        }
        if (currentUrl.value != sbCookie) {
            Cookie.write('sb_url' + this.options.sbid, currentUrl.value, {
                duration: 365
            });
            return
        }
        if (sbCookie && currentUrl.value == '');
        currentUrl.value = sbCookie
    },
    addShouts: function (b, c) {
        if (b) {
            b.each(function (a) {
                lastid = parseInt(a.id) + 1;
                if (lastid > this.sblastid.value) this.sblastid.value = lastid;
                if (parseInt(a.time) > this.sbtime.value) this.sbtime.value = parseInt(a.time);
                el = new Element('li').set("html", a.text);
                span = new Element('span');
                if (a.url != 'http://' && a.url != '') {
                    name = new Element('a', {
                        'href': a.url
                    }).set("text", a.name + ': ').inject(span, 'top')
                } else {
                    span.set("text", a.name + ': ')
                }
                span.inject(el, 'top');
                if (a.avatar != '0') {
                    divimg = new Element('div', {
                        'class': 'avatar'
                    }).inject(el, 'top');
                    img = new Element('img', {
                        'src': a.avatar,
                        'class': 'avatar'
                    }).inject(divimg, 'top')
                }(this.options.addBottom) ? el.inject(this.outputlist) : el.inject(this.outputlist, 'top');
                if (!this.options.growShouts && this.options.addBottom) {
                    this.outputlist.getFirst().remove()
                } else if (!this.options.growShouts) {
                    this.outputlist.getLast().remove()
                }
                this.sbloadtimes = 1;
                this.refresh = this.options.refresh;
                clearInterval(this.periodical);
                this.periodical = this.getShouts.periodical(this.refresh, this);
                new Fx.Morph(el, {
                    duration: 1500,
                    transition: Fx.Transitions.linear
                }).start({
                    'background-color': [this.options.fade_from, this.options.fade_to]
                });
                if (this.options.addBottom) {
                    new Fx.Scroll(this.chatoutput, {
                        duration: 500
                    }).toBottom()
                }
                if (this.options.sound && this.sound) Swiff.remote(this.soundobj, 'playSound')
            }, this)
        }
    },
    updateTime: function () {
        this.serverTime++;
        difference = this.serverTime - this.sbtime.value;
        lengths = ["60", "60", "24"];
        duration = 1053940800000;
        for (var j = 0; difference >= lengths[j]; j++) {
            difference /= lengths[j]
        }
        difference = (difference < 0) ? 0 : Math.round(difference);
        if (difference != 1) {
            text = ((j == 0) ? '' : difference) + ' ' + this.options.periods_plural[j] + ' ' + this.options.ago
        } else {
            text = ((j == 0) ? '' : difference) + " " + this.options.periods_singular[j] + ' ' + this.options.ago
        }
        document.id('responseTime' + this.options.sbid).set("html", text)
    },
    captchaSelect: function () {
        posEgal = this.captcha.options[0].text.indexOf("=");
        if (this.captcha.options[this.captcha.selectedIndex].value == eval(this.captcha.options[0].text.substr(0, posEgal))) document.id('shoutbox_captcha' + this.options.sbid).setStyle('display', 'none')
    }
});
Shoutbox.implement(new Options);
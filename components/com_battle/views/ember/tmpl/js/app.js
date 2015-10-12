App = Ember.Application.create();

App.Router.map(function(){

    this.resource('about');
    this.resource('posts', function() {
        this.resource('post', { path: ':post_id' });
    });
});

/*
App.PostsRoute = Ember.Route.extend({

    model:function(){

        return posts;
    }
});
*/

App.PostRoute = Ember.Route.extend({
    model: function(params) {
        return posts.findBy('id', params.post_id);
    }
});

App.PostsRoute = Ember.Route.extend({
    model: function() {

        return $.getJSON('/index.php?option=com_battle&format=json&task=bankAction&action=get_account_list&bank_id=11059').then(function(data) {

            return data;
            //return data.posts.map(function (post){
            //    post.body = post.content;
            //    return post;
            //});
        });
     }
});


var posts = [{
    id: '1',
    name: "Rails is Omakase",
    author: { name: "d2h" },
    date: new Date('12-27-2012'),
    excerpt: "There are lots of à la carte software environments in this world. Places where in order to eat, you must first carefully look over the menu of options to order exactly what you want.",
    body: "I want this for my ORM, I want that for my template language, and let's finish it off with this routing library. Of course, you're going to have to know what you want, and you'll rarely have your horizon expanded if you always order the same thing, but there it is. It's a very popular way of consuming software.\n\nRails is not that. Rails is omakase."
}, {
    id: '2',
    name: "The Parley Letter",
    author: { name: "d2h" },
    date: new Date('12-24-2012'),
    excerpt: "My [appearance on the Ruby Rogues podcast](http://rubyrogues.com/056-rr-david-heinemeier-hansson/) recently came up for discussion again on the private Parley mailing list.",
    body: "A long list of topics were raised and I took a time to ramble at large about all of them at once. Apologies for not taking the time to be more succinct, but at least each topic has a header so you can skip stuff you don't care about.\n\n### Maintainability\n\nIt's simply not true to say that I don't care about maintainability. I still work on the oldest Rails app in the world."
}];


function get_data() {
    $.ajax({
        type: "POST",
        url: "/index.php?option=com_battle&format=json&task=bankAction&action=get_account_list&bank_id=" + 11059

    })
        .done(function (data) {
            return data
        });
}


App.Person = Ember.Object.extend({
    say: function(thing) {
        alert(thing);
    }
});

var John = App.Person.create({



    });

John.say('hi');

App.Person2 = Ember.Object.extend({
    init: function() {
        var name = this.get('name');
        alert(name + ", reporting for duty!");
    }
});

App.Person2.create({
    name: "Stefan Penner"
});
angular.module('app.values', [])

.value('Config', {
  getUrlPosts  : 'http://agoraentert.com.br/wp-json/wp/v2/posts/',
  getUrlApi    : 'http://agoraentert.com.br/wp-admin/admin-ajax.php',
})

.value('Social', {
  fb : 'https://www.facebook.com/agoraentert/',
  fb_share:function(url){
    var shareUrl = 'https://www.facebook.com/sharer/sharer.php';
    shareUrl += '?u=' + url;
    return shareUrl;
  },
  tw_share:function(hashtags,text,url,via){
    var shareUrl = 'https://twitter.com/intent/tweet';
    shareUrl += '?hashtags=' + hashtags;
    shareUrl += '&text=' + text;
    shareUrl += '&url=' + url;
    // shareUrl += '&via=' + via;
    return shareUrl;
  }
})

.value('Session', {
  db:null,
  initSession:function(){
    this.db = window.openDatabase("web_aei","1.0","Banco Local",2000);
    this.db.transaction(function(res){
      res.executeSql("CREATE TABLE IF NOT EXISTS user(name TEXT, email TEXT, hash TEXT, interests TEXT);",[]);
    });
  },
  logout:function(){
    this.db.transaction(function(res){
      res.executeSql("DROP TABLE user");
    });
  },
  login:function(name,email,hash,interests){
    this.logout();
    this.initSession();
    this.db.transaction(function(res){
      res.executeSql("INSERT INTO user(name,email,hash,interests) VALUES(?,?,?,?);",[name,email,hash,interests]);
    });
  },
  updateInterests:function(interests){
    this.initSession();
    this.db.transaction(function(res){
      res.executeSql('UPDATE user SET interests=? WHERE rowid=1', [interests]);
    });
  },
  hasSession:function(callback){
    this.initSession();
    this.db.transaction(function(res){
      res.executeSql("SELECT * FROM user;",null,function(i,data){
        callback(data);
      });
    });
  },
})

<?php /*a:1:{s:66:"D:\wenwu\think_redis_admin\application\index\view\index\index.html";i:1537806212;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>think_redis_admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name = "format-detection" content="telephone = no" />
    <style>
        body{
            padding: 10px;
            box-sizing: border-box;
            margin: 0;
            height:100%;
        }
        h5,h2,h3,h4,h1{
            margin:0;
            padding: 0;
        }
        a{
            color: #1E9FFF;
            margin-left: 10px;
        }
        .a_btn{
            background-color: #1E9FFF;
            color: #ffffff;
            display:inline-block;
            padding: 5px 10px;
        }
        .btn{
            background-color: #1E9FFF;
            color: #ffffff;
            display:inline-block;
            padding: 5px 10px;
            border: 0;
        }
        .del{
            background-color: orangered;
        }
        .keywords{
            width: 60%;
            margin-right: 10px;
        }
        #menu{
            width: 30%;
            display: inline-block;
            height: auto;
            padding: 0;
            margin: 0;
        }
        #menu .menu_box{
            width: 95%;
            color: #1E9FFF;
            text-align: center;
            border: 1px solid #2D93CA;
        }
        #menu h2{
            background-color: #2D93CA;
            color: #ffffff;
            padding: 5px 0;
        }
        #menu .search_box{
            margin: 10px 0;
        }
        #menu .search_box input{
            padding: 4px 1px;
            border: 1px solid #2D93CA;
            width: 60%;
            margin-bottom: 5px;
            color: #2D8eca;
        }
        #menu .search_box button{
            margin-top: 2px;
        }
        #menu #keyList{
            overflow-y: scroll;
        }
        #menu h5{
            border-bottom: 1px solid #cccccc;
            padding: 3px 0;
        }
        #menu .select_on{
            background-color: #1E9FFF;
            color: #000000;
        }
        #info{
            width: 100%;
        }
        #info .refresh img{
            width: 28px;
            height: 28px;
            float: right;
        }
        #info select{
            padding: 5px 0;
            border: 1px solid #2D8eca;
            color: #f97800;
            font-weight: bold;
            float: left;
            margin-left: 5px;
        }
        #info option{
            padding: 5px 0;
        }
        #info h5{
            margin: 15px 0;
        }
        #info h5 a{
            margin-left: 0px;
            width: 100%;
            padding: 8px 0;
            text-align: center;
        }
        #info .db_change{
            padding: 3px 10px;
            font-size: 10px;
            background-color: #f99800;
        }
        #serverInfo{
            width: 69%;
            position: fixed;
            right: 0;
            top: 120px;
            text-align: center;
            background-color: #ffffff;
        }
        #serverInfo .server_box{
            display: inline-block;
            margin: 0 auto;
        }
        #serverInfo h5{
            /*margin: 5px 0;*/
            margin: 5px auto;
        }
        #serverInfo h5 label,#serverInfo h5 span{
            width: 100px;
            text-align: right;
            display: inline-block;
            background-color: #2eabc7;
            color: #ffffff;
            padding: 8px 0;
            margin-left: 5px;
        }
        #serverInfo h5 span{
            width:130px;
            text-align: left;
            padding-left:5px;
        }
        #form{
            display: none;
            width: 360px;
            height: 330px;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        #form h5{
            margin-bottom: 8px;
        }
        #form label{
            width: 20%;display: inline-block;
        }
        #form .btn_box{
            text-align: center;
            margin-top: 20px;
        }
        #form .btn_box button{
            margin-left: 10px;
            width: 80px;
            height: 30px;
            border: 1px solid #2D93CA;
            background-color: #0eeeee;
            color: #2D93CA;
        }
        #form textarea{
            width: 66%;
            height: 120px;
        }
        #content{
            width: 69%;
            display: inline-block;
            float: right;
            color: #ae3000;
        }
        #content  a{
            padding: 3px 10px;
            font-size: 10px;
            background-color: #1E9FFF;
            color: #ffffff;
        }
        #content h5{
            margin-top: 8px;
        }
        #content .del{
            background-color: orangered;
        }
        #content .data h5{
            background-color: #eeefff;
            margin-top: 3px;
            width: 100%;
            padding: 5px 3px;
            box-sizing: border-box;
        }
        #content label{
            width: 80px;
            display: inline-block;
            color: #2D8eca;
        }
        #content .data{
            margin-top: 30px;
            width: 100%;
        }
        #content .data .key_value {
            margin-left: 5px;
        }
        #content .data a{
            margin-top: 1px;
        }
        #content .data p{
            width:125px;
            display: inline-block;
            padding: 3px 0;
            margin: 0;
            box-sizing: border-box;
        }
        #content .data span{
            width: 65%;
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
<script src="/static/js/vue.js"></script>
<script src="/static/js/axios.min.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/layer/layer.js"></script>
<div id="info">
    <select name="" id="server" v-model="this_server">
        <option v-for="(name,index) in redisList" :value="index" v-text="name"></option>
    </select>
    <select name="" id="db" v-model="this_db">
        <option v-for="(db,index) in 16" :value="index">db{{index}}</option>
    </select>
    <a @click="db_change" class="a_btn db_change">切换</a>
    <a @click="view_info" class="a_btn">详情</a>
    <a class="refresh" @click="refresh"><img src="/static/images/refresh.png" alt=""></a>
    <h5><a class="a_btn addkey" @click="addKey">添加key</a></h5>
    <div id="serverInfo" v-show="is_info">
        <div class="server_box">
            <h5><label>redis版本：</label><span v-text="serverInfo.redis_version"></span></h5>
            <h5><label>key数量：</label><span v-text="serverInfo.size"></span></h5>
            <h5><label>使用内存：</label><span v-text="serverInfo.used_memory_human"></span></h5>
            <h5><label>内存峰值：</label><span v-text="serverInfo.used_memory_peak_human"></span></h5>
            <h5><label>运行时长：</label><span v-text="serverInfo.uptime_in_days"></span></h5>
            <h5><label>持久化：</label><span v-text="serverInfo.aof"></span></h5>
            <h5><label>上次保存时间：</label><span v-text="serverInfo.last_save_time"></span></h5>
        </div>
    </div>
</div>
<div id="menu">
    <div class="menu_box">
        <h2>key列表</h2>
        <div class="search_box"><input type="text" class="keywords" v-model.trim="keywords" @keyup.enter="get_all_key(1)">
            <button type="button" class="btn" @click="get_all_key(1)">查找</button></div>
        <div id="keyList" :style="{height:heights}">
        <h5 v-for="keys in keyslist" @click="keyinfo" :keys="keys" :class="{'select_on':keys==select_key}">{{keys}}</h5>
        </div>
    </div>
</div>
<div id="content">
    <div id="keyInfo" v-show="keys">
        <h3><label>key名：</label>{{keys}}<a @click="rename" class="a_btn">修改</a><a class="del a_btn" @click="del_key">删除</a></h3>
        <h5><label>类型：</label>{{type}}</h5>
        <h5><label>过期时间：</label>{{ttl}}<a @click="set_ttl" class="a_btn">修改</a></h5>
        <h5><label>编码：</label>{{encoding}}</h5>
        <h5><label>大小：</label>{{size}}</h5>
        <div class="data">
            <button v-if="type != 'string'" class="btn" @click="edit_value('','')">添加数据</button>
            <h5 v-if="type == 'string'">
                <label>数据值：</label><span v-text="data"></span>
                <p><a @click="edit_value(data,0)" class="a_btn">修改</a></p>
            </h5>
            <h5 v-else-if="type == 'hash'"  v-for="(val,index,key) in data">
                <label>键：</label>{{index}}<label class="key_value">数据值：</label><span v-text="val"></span>
                <p><a @click="edit_value(val,index)" class="a_btn">修改</a><a v-if="size > 1" class="del a_btn" @click="del_value(index)">删除</a></p>
            </h5>
            <h5 v-else-if="type == 'list'"  v-for="(val,index) in data">
                <label>索引：</label>{{index}}<label class="key_value">数据值：</label><span v-text="val"></span>
                <p><a @click="edit_value(val,index)" class="a_btn">修改</a><a v-if="size > 1" class="del a_btn" @click="del_value(index)">删除</a></p>
            </h5>
            <h5 v-else  v-for="(val,index) in data">
                <label>索引：</label>{{index}}<label class="key_value">数据值：</label><span v-text="val"></span>
                <p><a @click="edit_value(val,index)">修改</a><a v-if="size > 1" class="del a_btn" @click="del_value(index)">删除</a></p>
            </h5>
        </div>
    </div>
</div>
<div id="form" class="form" >
    <h5>
        <label>类型</label>
        <span>
                <select name="" v-model="formType">
                    <option v-for="val in redisType"  :value="val">{{val}}</option>
                </select>
                </span>
    </h5>
    <h5><label>key</label><span><input v-model="formKeys" type="text"></span></h5>
    <h5 v-show="formType != 'string' && formType != 'set'"><label>索引</label><span><input v-model="formIndex" type="text"></span></h5>
    <h5><label>值</label><span><textarea v-model="formValue" name=""></textarea></span></h5>
    <h5 class="btn_box"><button type="button" @click="form_save">提交</button><button type="button" @click="cancel">取消</button></h5>
</div>
</body>
<script>
    axios.defaults.headers['X-Requested-with'] = 'XMLHttpRequest';
    //获取参数
    var input = function (name,urls) {
        var url = window.location.search;
        if(urls)url=urls;
        // 正则筛选地址栏
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        // 匹配目标参数
        var result = url.substr(1).match(reg);
        //返回参数值
        return result ? decodeURIComponent(result[2]) : '';
    };
    var serverInfo=new Vue({
        el:'#info',
        data:{
            redisList:[],
            this_server:0,
            this_db:0,
            serverInfo:[],
            is_info:0
        },
        created:function () {
            var _this=this;
            axios.get('/index/api/get_redis').then(function (res) {
                var res=res.data;
                if(res.code==1){
                    _this.redisList=res.data.redisList;
                    _this.this_server=res.data.select.server;
                    _this.this_db=res.data.select.db;
                }
            });
            axios.get('/index/api/get_redis_info').then(function (res) {
                var res=res.data;
                if(res.code==1){
                    _this.serverInfo=res.data;
                    if(keyInfo.keys=='') _this.is_info=1;
                }
            });
        },
        methods:{
            //刷新页面
            refresh:function () {
                window.location.reload();
            },
            //info 页面
            view_info:function () {
                this.is_info=this.is_info==0?1:0;
            },
            //切换
            db_change:function () {
                axios.post('/index/api/set_redis',{server:this.this_server,db:this.this_db}).then(function (res) {
                    var res=res.data;
                    if(res.code==1){
                        window.location='/';
                    }else{
                        layer.msg(res.msg);
                    }
                });
            },
            addKey:function () {
                view.push_state('act=addkey');
                form.formType='string';
                form.formKeys='';
                form.formIndex=0;
                form.formValue='';
                form.formOldValue='';
                form.is_form=1;
                form.is_add=1;
                view.form_view();
            }
        }
    });
    var menu=new Vue({
        el:'#menu',
        data:{
            keyslist:[],
            keywords:'',
            select_key:'',
            heights:''
        },
        created:function () {
            var _this=this;
            var h = document.documentElement.offsetHeight || document.body.offsetHeight ;
            h-=document.getElementById('info').clientHeight;
            h-=document.querySelector('#menu .menu_box h2').clientHeight;
            h-=document.querySelector('#menu .search_box').clientHeight;
            _this.heights=h+'px';
            _this.keywords=input('keywords');
            _this.get_all_key();
        },
        methods:{
            get_all_key:function (is_push) {
                if(is_push)view.push_state('');
                var _this=this;
                axios.get('/index/api/get_all_key?key='+_this.keywords).then(function (res) {
                    var res=res.data;
                    if(res.code==1){
                        _this.keyslist=res.data;
                    }
                });
            },
            keyinfo:function (e) {
                var keys=e.currentTarget.getAttribute('keys');
                this.select_key=keys;
                view.push_state('act=keyinfo&key='+keys);
                form.is_form=0;
                if(keys!=keyInfo.keys) {
                    keyInfo.keys = keys;
                    keyInfo.is_form=0;
                    keyInfo.get_info();
                }
            }
        }
    });
    var keyInfo=new Vue({
        el:'#keyInfo',
        data:{
            keys:'',
            type:'',
            ttl:'',
            encoding:'',
            size:'',
            data:'',
        },
        methods:{
            get_info:function (index) {
                serverInfo.is_info=0;
                var _this=this;
                axios.get('/index/api/key_info?key='+_this.keys).then(function (res) {
                    var res=res.data;
                    if(res.code==1){
                        var info=res.data;
                        _this.type=info.type;
                        _this.ttl=info.ttl;
                        _this.encoding=info.encoding;
                        _this.size=info.size;
                        _this.data=info.data;
                        if(typeof(index)!='undefined'){
                            if(typeof(_this.data)=='string' || typeof(_this.data)=='int'){
                                var data=_this.data;
                            }else{
                                var data=_this.data[index];
                            }
                            _this.edit_value(data,index);
                        }
                    }else{
                        layer.msg(res.msg);
                    }
                });
            },
            //修改姓名
            rename:function () {
                var _this=this;
                layer.prompt({title:'请输入新的key名',value:_this.keys},function (now_key,index) {
                    layer.close(index);
                    axios.get('/index/api/rename?key='+_this.keys+'&now_key='+now_key).then(function (res) {
                        var res=res.data;
                        if(res.code==1){
                            var ole_key=_this.keys;
                            _this.keys=now_key;
                            var index=menu.keyslist.indexOf(ole_key);
                            Vue.set(menu.keyslist,index,now_key);
                            menu.select_key=now_key;
                        }
                    });
                });
            },
            //修改过期时间
            set_ttl:function () {
                var _this=this;
                layer.prompt({title:'请输入时间（s）,-1不过期',value:_this.ttl},function (times,index) {
                    layer.close(index);
                    axios.get('/index/api/ttl?key='+_this.keys+'&ttl='+times).then(function (res) {
                        var res=res.data;
                        if(res.code==1){
                            _this.ttl=times;
                        }
                    });
                });
            },
            //修改值
            edit_value:function (value,index) {
                view.push_state('act=editkey&key='+this.keys+'&index='+index);
                form.formType=this.type;
                form.formKeys=this.keys;
                form.formIndex=index;
                form.formValue=value;
                form.formOldValue=value;
                form.is_form=1;
                form.is_add=0;
                view.form_view();
            },
            //删除值
            del_value:function (index) {
                var value=this.data[index];
                var datas={key:this.keys,index:index,value:value,type:this.type};
                layer.alert('确定要删除吗？',function (ins) {
                    layer.close(ins);
                    axios.post('/index/api/del_value',datas).then(function (res) {
                        var res=res.data;
                        if(res.code==1){
                            menu.get_all_key();
                            form.cancel();
                            keyInfo.get_info();
                        }else{
                            layer.msg(res.msg)
                        }
                    });
                });
            },
            del_key:function () {
                layer.alert('确定要删除吗？',function (ins) {
                    layer.close(ins);
                    axios.post('/index/api/del_key',{key:keyInfo.keys}).then(function (res) {
                        var res=res.data;
                        if(res.code==1){
                            view.push_state('key=');
                            menu.get_all_key();
                            form.cancel();
                            keyInfo.keys='';
                        }
                    });
                });
            }
        }
    });
    var form=new Vue({
        el:'#form',
        data:{
            is_add:0,
            is_form:0,
            //表单
            redisType:['string','list','hash','set','zset'],
            formKeys:'',
            formType:'',
            formIndex:'',
            formValue:'',
            formOldValue:''
        },
        methods:{
            //取消
            cancel:function () {
                this.is_form=0;
                if(view.form_view_layer)layer.close(view.form_view_layer);
                history.go(-1);
            },
            //提交保存
            form_save:function () {
                var _this=this;
                var data={
                    'key':_this.formKeys,
                    'type':_this.formType,
                    'index':_this.formIndex,
                    'value':_this.formValue,
                    'old_value':_this.formOldValue,
                }
                axios.post('/index/api/form_op',data).then(function (res) {
                    var res=res.data;
                    if(res.code==1){
                        layer.msg('保存成功');
                        if(_this.is_add==0){
                            _this.is_form=0;
                            keyInfo.keys=_this.formKeys;
                            keyInfo.get_info();
                        }else{
                            keyInfo.keys=_this.formKeys;
                            keyInfo.get_info();
                            _this.is_add=1;
                        }
                        menu.get_all_key();
                    }else{
                        layer.msg(res.msg);
                    }
                });
            }
        }
    });
    var view={
        form_view_layer:null,
        init:function () {
            var act=input('act');
            switch (act){
                case 'addkey':view.addkey();break;
                case 'keyinfo':view.keyinfo();break;
                case 'editkey':view.editkey();break;
            }
        },
        form_view:function () {
            view.form_view_layer=layer.open({
                title: '信息',
                type: 1,
                shade: false,
                content: $('#form'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function(){
                    form.cancel();
                }
            });
        },
        push_state:function (param) {
            var map='';
            if(menu.keywords)map+='keywords='+menu.keywords+'&';
            map+=param;
            var href=window.location.search;
            if(map)if(('?'+map)!=href)history.pushState(null, null,'?'+map);
        },
        addkey:function () {
            serverInfo.addKey();
        },
        keyinfo:function () {
            var key=input('key');
            keyInfo.keys=key;
            menu.select_key=key;
            keyInfo.get_info();
        },
        editkey:function () {
            var key=input('key');
            var index=input('index');
            keyInfo.keys=key;
            keyInfo.get_info(index);
        }
    };
    view.init();
</script>
</html>
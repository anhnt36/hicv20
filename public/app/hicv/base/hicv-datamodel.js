(function() {
    'use strict';

    angular
        .module('hicv.datamodel', [])
        .factory('DataModel', DataModel);

    function DataModel() {
        //return (function(){
        // stuff to exclude from the serialization
        // and a polyfill for knockout until that bit is sorted out
        var blacklist = /^(_.*|def|pre|post|serialize|extend|map|type|watch|validate|errors)$/,
            $ar = {};

        $ar.type = function(variable,type) {
            var t = typeof variable,
                trap = false,
                more,ni;
            if(t === 'object'){
                more = Object.prototype.toString.call(variable);
                if(more === '[object Array]') {
                    t = 'array';
                } else if(more === '[object Null]') {
                    t = 'null';
                } else if(more === '[object Date]') {
                    t = 'date';
                } else if(variable === window) {
                    t = 'node';
                } else if(variable.nodeType) {
                    if(variable.nodeType === 1) {
                        t = 'node';
                    } else {
                        t = 'textnode';
                    }
                }
            }

            if(!type) {
                return t;
            }
            type = type.split(',');
            for(more = 0; more < type.length; more++) {
                trap = trap || (type[more] === t);
            }
            return trap;
        };

        // $ar.clone:
        // lets keep our data clean and seperated
        $ar.clone = function(obj){
            var type = $ar.type(obj),
                copy = {},
                ni;

            if(!/^(object||array||date)$/.test(type)) {
                return obj;
            }
            if(type === 'date') {
                return (new Date()).setTime(obj.getTime());
            }
            if(type === 'array'){
                copy = obj.slice(0);
                for(ni = 0; ni < copy.length; ni++){
                    copy[ni] = $ar.clone(copy[ni]);
                }
                return copy;
            }

            for(ni in obj) {
                if(obj.hasOwnProperty(ni)) {
                    copy[ni] = $ar.clone(obj[ni]);
                }
            }

            return copy;
        };

        // lets only add clean data to our models
        function _cleanNumbers(obj) {
            var type = $ar.type(obj),
                ni;

            if(/^(b.*|nu.*|f.*)$/.test(type)) {
                return obj;
            }

            if(type === 'string'){
                /**
                 * TODO | If we serialize a string property with empty value (''), it will be converted to null that not always
                 * TODO | what we expect. In current data model implementation it causes issues sometimes
                 */
                if(!obj || obj === 'null') {
                    obj = null;
                }
                else if(!isNaN(parseFloat(obj)) && isFinite(obj)) {
                    return parseFloat(obj);
                }

                return obj;
            }

            if(type === 'array'){
                for(ni = 0; ni < obj.length; ni++) {
                    obj[ni] = _cleanNumbers(obj[ni]);
                }
            }

            if(type === 'object'){
                for(ni in obj) {
                    obj[ni] = _cleanNumbers(obj[ni]);
                }
            }

            return obj;
        }

        // something needed to normalize knockout stuff
        function _cleanRead(model,key){
            if(model.def[key].observable) {
                return model[key]();
            }
            return model[key];
        }
        // something needed to normalize knockout stuff
        function _cleanWrite(model,key,val){
            if(model.def[key].observable) {
                model[key](val);
            } else {
                model[key] = val;
            }
        }
        function _cleanDate(date){
            return date.getUTCFullYear() + '-' + ('0'+(date.getUTCMonth()+1)).slice(-2) + '-' + ('0'+date.getUTCDate()).slice(-2) + ' ' + date.getUTCHours() + ':' + date.getUTCMinutes() + ':' + date.getUTCSeconds();
        }

        // does the heavy lifting for importing an object into a model
        function _sin(model,data,pre){
            var ni, na, no, a;

            if(!data){
                // reset to default values
                for(ni in model.def){
                    if(model.def._blacklist.test(ni)) {
                        continue;
                    }
                    _cleanWrite(model,ni,$ar.clone(model.def[ni]['default']));
                }
                return model;
            }
            if(!pre) {
                pre = [];
            }

            for(ni = 0; ni < pre.length; ni++){
                if(pre[ni].after){
                    continue;
                }
                pre[ni].fun(data);
            }

            for(ni in model.def){
                if(model.def._blacklist.test(ni)) {
                    continue;
                }

                na = ni;
                for(no = 0; no < model.def[ni].external.length; no++){
                    if(!data.hasOwnProperty(model.def[ni].external[no])) {
                        continue;
                    }
                    na = model.def[ni].external[no];
                    break;
                }

                //catch when ni=na and !data[na]
                if(!data.hasOwnProperty(na)) {
                    continue;
                }

                a = null;
                if(!model.def[ni].type){
                    _cleanWrite(model,ni,_cleanNumbers(data[na]));
                    continue;
                }
                if(!$ar.type(model.def[ni]['default'], 'array')){
                    if(model.def[ni].type === Date){
                        if($ar.type(data[na],'date')) {
                            _cleanWrite(model,ni, new model.def[ni].type(new Date(data[na].valueOf())));
                        } else if($ar.type(data[na],'string') && !isNaN(Date.parse(data[na].replace('-','/')))) {
                            _cleanWrite(model,ni, new model.def[ni].type(new Date(data[na].replace('-','/'))));
                        }
                        continue;
                    }
                    if($ar.type(model.def[ni].type,'function') ){
                        _cleanWrite(model,ni, new model.def[ni].type(data[na]));
                    }else if( $ar.type(model.def[ni].type,'string') && model.def[ni].type === 'string' ){
                        _cleanWrite(model,ni, data[na]);
                    }
                    continue;
                }

                a = [];
                data[na] = data[na]||[];
                for(no = 0; no < data[na].length; no++){
                    if(model.def[ni].type === Date){
                        if($ar.type(data[na][no],'date')) {
                            _cleanWrite(model,ni, new model.def[ni].type(new Date(data[na][no].valueOf())));
                        } else if($ar.type(data[na][no],'string') && !isNaN(Date.parse(data[na][no].replace('-','/')))) {
                            _cleanWrite(model,ni, new model.def[ni].type(new Date(data[na][no].replace('-','/'))));
                        }
                        continue;
                    }

                    if($ar.type(model.def[ni].type,'function') ){
                        a.push(new model.def[ni].type(data[na][no]));
                    }else if( $ar.type(model.def[ni].type,'string') && model.def[ni].type === 'string' ){
                        a.push(data[na][no]);
                    }
                }

                _cleanWrite(model,ni,a);
            }
            for(ni = 0; ni < pre.length; ni++){
                if(!pre[ni].after){
                    continue;
                }
                pre[ni].fun.apply(model, [data]);
            }

            return model;
        }

        // does the same as _sin, but for exporting
        function _sout(model, post){
            var obj = {},
                black = model.def._blacklist,
                tmp, ni, na, no, a;

            post = post || [];

            for(ni = 0; ni < post.length; ni++){
                if(!post[ni].fire_before){
                    continue;
                }
                post[ni].fun();
            }

            for(ni in model.def){
                if(black.test(ni)) {
                    continue;
                }

                tmp = model[ni];

                na = model.def[ni].external[0]||ni;

                //gotta look for models WITHIN models
                if($ar.type(tmp, 'null')) {
                    obj[na] = '';
                } else if(!tmp) {
                    obj[na] = tmp;
                } else if(tmp.hasOwnProperty('serialize')){
                    obj[na] = tmp.serialize();
                } else if($ar.type(tmp,'array')){
                    obj[na] = [];
                    for(no = 0; no < tmp.length; no++){
                        a = tmp[no];
                        if($ar.type(a,'function')){
                            continue;
                        }
                        if($ar.type(a,'date')) {
                            a = _cleanDate(a);
                        }
                        if($ar.type(a,'object') && a.hasOwnProperty('serialize')) {
                            a = a.serialize();
                        }
                        obj[na].push(a);
                    }
                } else if($ar.type(tmp,'date')){
                    obj[na] = _cleanDate(tmp);
                } else if($ar.type(tmp,'object')){
                    obj[na] = {};
                    for(no in tmp){
                        a = tmp[no];
                        if($ar.type(a,'function')) {
                            continue;
                        }
                        if($ar.type(a,'date')) {
                            a = _cleanDate(a);
                        }
                        if($ar.type(a,'object') && a.hasOwnProperty('serialize')) {
                            a = a.serialize();
                        }
                        obj[na][no] = a;
                    }
                } else {
                    if($ar.type(tmp,'function')) {
                        continue;
                    }
                    obj[na] = tmp;
                }
            }

            for(ni = 0; ni < post.length; ni++){
                if(post[ni].fire_before){
                    continue;
                }
                post[ni].fun(obj);
            }

            return obj;
        }

        modelFactory.unwrap = function(obj) {
            if (obj.serialize) {
                obj = obj.serialize();
            }

            return obj;
        };

        // mmmmmm factory
        return modelFactory;

        function modelFactory(def) {
            var self = {
                errors: [],
                def: {
                    _pre: [],
                    _post: [],
                    _blacklist: blacklist,
                    errors: {
                        'default': [],
                        observable: false,
                        type: null,
                        external: [],
                        validation: []
                    }
                }
            };

            // all these functions chain!!!! GO NUTS!
            self.serialize = function(data) {
                // no arguments, you export data from the model
                // with an object, you import
                if (arguments.length === 0) {
                    return _sout(self, self.def._post);
                }

                return _sin(self, data, self.def._pre);
            };
            self.extend = function(_def) {
                // use models to make bigger models!
                var ni;
                for (ni in _def) {
                    if (self.def._blacklist.test(ni)) {
                        continue;
                    }
                    if (ni in self.def) {
                        continue;
                    }
                    self.def[ni] = {
                        'default': $ar.clone(_def[ni]),
                        observable: false,
                        type: null,
                        external: [],
                        validation: []
                    };

                    self[ni] = _def[ni];
                }

                return self;
            };
            self.attach = function(_obj) {
                for (var ni in _obj) {
                    if (blacklist.test(ni) || ni in self.def) {
                        continue;
                    }
                    self[ni] = _obj[ni];
                }
                return self;
            };
            self.map = function(_maps) {
                // internal name on the left side, external on the right
                // for keeping your clean data model in sync with your ugly api
                for (var ni in _maps) {
                    if (!self.def.hasOwnProperty(ni)) {
                        continue;
                    }
                    if (!$ar.type(_maps[ni], 'array')) {
                        _maps[ni] = [_maps[ni]];
                    }
                    self.def[ni].external = _maps[ni];
                }
                return self;
            };
            self.type = function(_types) {
                // to have hierarchical chains of models, we need to be able
                // to specify a model type for those properties
                for (var ni in _types) {
                    if (!self.def.hasOwnProperty(ni)) {
                        continue;
                    }
                    self.def[ni].type = _types[ni];
                }
                return self;
            };
            self.pre = function(filter, fire_after) {
                if (!$ar.type(filter, 'function')) {
                    return self;
                }
                // here we add filters that edit the json data before it enters
                self.def._pre.push({
                    fun: filter,
                    after: !!fire_after
                });
                return self;
            };
            self.post = function(filter, fire_before) {
                if (!$ar.type(filter, 'function')) {
                    return self;
                }
                // here we add filters that edit the json data before it leaves
                self.def._post.push({
                    fun: filter,
                    before: !!fire_before
                });
                return self;
            };
            self.watch = function(_map) {
                /*var ni,isArray;
                 //make all the things observable!
                 if(!arguments.length){
                 _map = { errors: true };
                 for(ni in self.def) {
                 _map[ni] = true;
                 }
                 }
                 // this bad boy controls which properties are observable
                 for(ni in _map){
                 if(!self.def.hasOwnProperty(ni)) {
                 continue;
                 }
                 if(_map[ni] === self.def[ni].observable) {
                 continue;
                 }
                 self.def[ni].observable = _map[ni];
                 isArray = $ar.type(self.def[ni]['default'],'array');
                 if(_map[ni]){
                 |--
                 if($ar.type(_map[ni],'object')){
                 //this is patrick mess, in the furture going to change, this is to handle KO extenders
                 self[ni] = ko['observable'+(isArray?'Array':'')](self[ni]).extend(_map[ni]);
                 }else{
                 self[ni] = ko['observable'+(isArray?'Array':'')](self[ni]);
                 }
                 --/
                 self[ni] = ko['observable'+(isArray?'Array':'')](self[ni]);
                 } else {
                 self[ni] = ko.unwrapObservable(self[ni]);
                 }
                 }*/
                return self;
            };
            self.validate = function(_map) {
                var ni, no, v, e;

                if (!arguments.length) {
                    var errs = [];

                    for (ni in self.def) {
                        if (blacklist.test(ni)) {
                            continue;
                        }
                        v = self.def[ni].validation || [];
                        for (no = 0; no < v.length; no++) {
                            e = v[no](_cleanRead(self, ni));
                            if (!$ar.type(e, 'array')) {
                                continue;
                            }
                            errs = errs.concat(e);
                        }
                    }
                    _cleanWrite(self, 'errors', errs);

                    if (!errs.length) {
                        return true;
                    }
                    return false;
                }

                for (ni in _map) {
                    if (!self.def.hasOwnProperty(ni)) {
                        continue;
                    }
                    self.def[ni].validation.push(_map[ni]);
                }

                return self;
            };

            //initialization
            return self.extend(def);
        }
    }
})();

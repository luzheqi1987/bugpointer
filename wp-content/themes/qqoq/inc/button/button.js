(function() {
    tinymce.create('tinymce.plugins.t', {
        init : function(ed, url) {
            ed.addButton('t', {
                title : 'T',    
                image : url+'/t.png',
                onclick : function() {
                     ed.selection.setContent('[t]这里填写标题[/t]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('t', tinymce.plugins.t);
})();
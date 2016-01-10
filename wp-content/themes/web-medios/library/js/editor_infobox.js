(function() {
    tinymce.PluginManager.add('infobox_mce_button', function(editor, url) {
        editor.addButton('infobox_mce_button', {
            icon: 'newspaper-o',
            title: 'Agregar Infobox',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Insertar Infobox',
                    body: [{
                        type: 'textbox',
                        name: 'infoboxTitulo',
                        label: 'Título',
                        value: ''
                    }, {
                        type: 'listbox',
                        name: 'className',
                        label: 'Alineación',
                        values: [{
                            text: 'Izquierda',
                            value: 'left'
                        }, {
                            text: 'Centro',
                            value: 'center'
                        }, {
                            text: 'Derecha',
                            value: 'right'
                        }]
                    }, {
                        type: 'textbox',
                        name: 'infoboxContenido',
                        multiline: true,
                        label: 'Contenido',
                        value: editor.selection.getContent()
                    }],
                    onsubmit: function(e) {
                        console.log(e.data);
                        editor.insertContent(
                            '[infobox class=&quot;' +
                            e.data.className +
                            '&quot; titulo=&quot;' +
                            e.data.infoboxTitulo +
                            '&quot;]' +
                            e.data.infoboxContenido +
                            '[/infobox]'
                        );
                    }
                });
            }
        });
    });
})();

(function() {
    tinymce.PluginManager.add('leyenda_mce_button', function(editor, url) {
        editor.addButton('leyenda_mce_button', {
            icon: 'leyenda',
            title: 'Agregar contenido con leyenda',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Insertar contenido con leyenda',
                    body: [{
                        type: 'textbox',
                        name: 'leyendaTexto',
                        label: 'Leyenda',
                        value: ''
                    }, {
                        type: 'listbox',
                        name: 'className',
                        label: 'Alineación',
                        values: [{
                            text: 'Completa',
                            value: 'center'
                        }, {
                            text: 'Izquierda',
                            value: 'left'
                        }, {
                            text: 'Derecha',
                            value: 'right'
                        }]
                    }, {
                        type: 'textbox',
                        name: 'leyendaContenido',
                        multiline: true,
                        label: 'Contenido',
                        value: editor.selection.getContent()
                    }],
                    onsubmit: function(e) {
                        console.log(e.data);
                        editor.insertContent(
                            '[leyenda class=&quot;' +
                            e.data.className +
                            '&quot; texto=&quot;' +
                            e.data.leyendaTexto +
                            '&quot;]' +
                            e.data.leyendaContenido +
                            '[/leyenda]'
                        );
                    }
                });
            }
        });
    });
})();

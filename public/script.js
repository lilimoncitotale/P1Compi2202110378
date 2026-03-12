let resultadoActual = '';
let erroresActuales = [];
let tablaActual = [];
let erroresActualesCsv = null;
let tokensActuales = [];
let tokensCsvActual = null;

function nuevoArchivo() {
    document.getElementById('codigo').value = '';
    limpiarConsola();
}

function cargarArchivo() {
    document.getElementById('fileInput').click();
}

document.getElementById('fileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        document.getElementById('codigo').value = e.target.result;
    };
    
    reader.readAsText(file);
});

function guardarArchivo() {
    const contenido = document.getElementById('codigo').value;
    const blob = new Blob([contenido], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'programa.go';
    a.click();
}

function ejecutar() {
    const codigo = document.getElementById('codigo').value;
    
    fetch('/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ codigo: codigo })
    })
    .then(response => response.json())
    .then(data => {
        const consola = document.getElementById('consola');
        consola.innerHTML = data.salida.replace(/\n/g, '<br>');
        
        resultadoActual = data.salida;
        // Compatibilidad: soportar respuesta antigua ('errores') y nueva ('syntax' + 'semantic')
        const syntax = data.syntax || [];
        const semantic = data.semantic || [];
        if (data.errores && Array.isArray(data.errores) && syntax.length === 0 && semantic.length === 0) {
            // respuesta antigua
            erroresActuales = data.errores;
        } else {
            // combinar ambos tipos
            erroresActuales = syntax.concat(semantic);
        }
        tablaActual = data.tabla || [];
        erroresActualesCsv = data.errors_csv || null;
        tokensActuales = data.tokens || [];
        tokensCsvActual = data.tokens_csv || null;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function limpiarConsola() {
    document.getElementById('consola').innerHTML = '';
}

function descargarResultado() {
    if (!resultadoActual) return;
    
    const blob = new Blob([resultadoActual], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'resultado.txt';
    a.click();
}

function descargarErrores() {
    if (!erroresActuales || erroresActuales.length === 0) return alert('No hay errores para descargar');

    // Si el backend proporcionó CSV, ofrecerlo directamente
    if (erroresActualesCsv) {
        const blob = new Blob([erroresActualesCsv], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'errores.csv';
        a.click();
        return;
    }

    // Fallback: texto legible si no hay CSV
    let contenido = '# Errores detectados\n';
    erroresActuales.forEach((err, i) => {
        let tipo = '';
        let msg = '';
        let line = '';
        let col = '';
        if (err.message !== undefined) {
            tipo = 'Sintáctico';
            msg = err.message;
            line = err.line ?? '';
            col = err.column ?? '';
            if (err.offending) msg += ` (offending: ${err.offending})`;
        } else if (err.msg !== undefined) {
            tipo = err.type || 'Semántico';
            msg = err.msg;
            line = err.line ?? '';
            col = err.col ?? '';
        } else {
            tipo = 'Error';
            msg = JSON.stringify(err);
        }
        contenido += `${i+1}\t${tipo}\t${msg}\t${line}\t${col}\n`;
    });

    const blob = new Blob([contenido], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'errores.txt';
    a.click();
}

function descargarTabla() {
    if (!tablaActual || tablaActual.length === 0) return alert('No hay tabla de símbolos disponible');

    // Generar CSV: Identifier,Type,Value,IsConst,Scope,Line,Column
    const headers = ['Identifier','Type','Value','IsConst','Scope','Line','Column'];
    let rows = [headers.join(',')];

    tablaActual.forEach(row => {
        const values = [
            (row.identifier ?? '').toString().replace(/\"/g, '"'),
            (row.type ?? '').toString(),
            (row.value ?? '').toString().replace(/\"/g, '"'),
            (row.isConst ? 'true' : 'false'),
            (row.scope ?? ''),
            (row.line ?? ''),
            (row.column ?? '')
        ];
        // Escape double quotes and wrap fields containing commas
        const esc = values.map(v => {
            const s = v.toString();
            if (s.indexOf(',') >= 0 || s.indexOf('"') >= 0 || s.indexOf('\n') >= 0) {
                return '"' + s.replace(/"/g, '""') + '"';
            }
            return s;
        });
        rows.push(esc.join(','));
    });

    const csv = rows.join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'tabla_simbolos.csv';
    a.click();
}

function descargarTokens() {
    if (!tokensActuales || tokensActuales.length === 0) return alert('No hay tokens para descargar');
    if (tokensCsvActual) {
        const blob = new Blob([tokensCsvActual], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'tokens.csv';
        a.click();
        return;
    }

    // Fallback: build CSV
    const headers = ['Index','Text','Type','Line','Pos'];
    let rows = [headers.join(',')];
    tokensActuales.forEach(t => {
        const vals = [t.index, t.text, t.type, t.line, t.pos];
        const esc = vals.map(v => {
            const s = (v===null||v===undefined)?'':v.toString();
            if (s.indexOf(',') >= 0 || s.indexOf('"') >= 0 || s.indexOf('\n') >= 0) {
                return '"'+s.replace(/"/g,'""')+'"';
            }
            return s;
        });
        rows.push(esc.join(','));
    });
    const csv = rows.join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'tokens.csv';
    a.click();
}
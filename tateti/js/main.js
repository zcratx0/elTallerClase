var selected = 0;

//  Cambiar de color el tablero

function resaltar(id, color) {
    document.getElementById(id).style.color = color;
}

//  Seleccionar un valor

function clickear(id) {
    var col1 = 'green';
    var col2 = 'blue';
    document.getElementById('send').disabled = false;
    if (selected ==0) {
        selected = id;
    } else {
        document.getElementById(selected).style.background = 'white';
        selected = id;
    }
    if (document.getElementById('player').value == 0) {
        document.getElementById(id).style.background = col1;
    } else {
        document.getElementById(id).style.background = col2;
    }
    document.getElementById('value').value = id;
}

//  Crear las tablas

function generateTable() {
    console.log('Iniciando tabla!')
    var celda = 0;
    var colorEnter = 'red';
    var colorLeave = 'black';
    for (var i = 0; i < 3; i++) {
        document.getElementById('tablero').innerHTML += '<tr id=tablero' + i +  '>';
            for (var x=0; x < 3; x++) {
                celda++;
                document.getElementById('tablero'+i).innerHTML += '<td id="celda'+ celda +'"><input type="button" id="' + celda +'" onclick="clickear('+ "'"+ celda + "'" +')" onmouseover="resaltar('+"'"+ celda +"', '"+colorEnter+"'"+');"  onmouseout="resaltar('+"'"+celda+"',"+"'"+colorLeave+"'"+')";>'+'</input></td>';
            }
        document.getElementById('tablero').innerHTML += '</tr>';
    }
    console.log('Finalizando Tabla!')

}

//  Cambiar los valores de las tablas
function updateTable(id, value) {
    if (document.getElementById(id)) {
        document.getElementById(id).innerHTML = '<input type="button" value="'+ value+ '">';   
    }
    
}

//  Finalizar el juego
function winEndGame() {
    document.getElementById('send').disabled = true;
    document.getElementById('send').hidden = true;
    
}
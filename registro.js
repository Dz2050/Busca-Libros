let mysql = require('mysql');
let config = require('./config.js');

let connection = mysql.createConnection(config);

connection.connect();

let latitud = 20.1234;
let longitud = -103.5678;

let sql = `INSERT INTO horas (latitud, longitud) VALUES (${latitud}, ${longitud})`;

connection.query(sql, (error, results, fields) => {
    if (error) {
        return console.error('Hubo un error al insertar los datos:', error.message);
    }
    console.log('Se insertaron los datos correctamente:', results);
});

connection.end();

const express = require('express');
const mysql = require('mysql2/promise');
const cors = require('cors');

const app = express();
const port = 3000;

// Permet au frontend sur le port 8080 de faire des requêtes au backend sur le port 3000
app.use(cors());

// Connexion à MySQL
const pool = mysql.createPool({
    host: process.env.DB_HOST || 'database',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || 'root',
    database: process.env.DB_NAME || 'projetdb',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Route / : Message de bienvenue
app.get('/', (req, res) => {
    res.json({ message: "Bienvenue sur le backend Node.js !" });
});

// Route /api/status : Vérifie la BDD et retourne l'heure
app.get('/api/status', async (req, res) => {
    try {
        const connection = await pool.getConnection();
        const [rows] = await connection.query('SELECT NOW() as currentTime');
        connection.release();
        res.json({ status: 'success', time: rows[0].currentTime });
    } catch (error) {
        res.status(500).json({ status: 'error', message: "Impossible de joindre la DB", details: error.message });
    }
});

app.listen(port, () => {
    console.log(`🚀 Backend en écoute sur le port ${port}`);
});
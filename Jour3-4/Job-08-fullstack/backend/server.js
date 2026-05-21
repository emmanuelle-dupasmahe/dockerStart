require('dotenv').config();
const express = require('express');
const mysql = require('mysql2/promise');

const app = express();
const port = process.env.PORT || 3000;

// Création d'un pool de connexions MySQL (plus performant et robuste que createConnection à chaque requête)
const pool = mysql.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Configuration CORS améliorée pour une communication fluide avec le frontend Vite
app.use((req, res, next) => {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
    if (req.method === 'OPTIONS') {
        return res.status(200).end();
    }
    next();
});

app.get('/', (req, res) => {
    res.json({ message: 'Hello depuis le backend Node.js ! (Backend Hot Reload validé ! 🚀)' });
});

app.get('/db-test', async (req, res) => {
    try {
        // Récupère une connexion depuis le pool
        const connection = await pool.getConnection();
        await connection.ping();
        connection.release(); // Libère la connexion pour qu'elle puisse être réutilisée
        res.json({ status: 'success', message: '✅ Connexion à MySQL réussie !' });
    } catch (error) {
        res.status(500).json({ status: 'error', message: '❌ Erreur MySQL', error: error.message });
    }
});

app.listen(port, () => {
    console.log(`j'écoute sur le port ${port}`);
});
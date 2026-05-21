import { useState, useEffect } from 'react'

function App() {
    const [backendData, setBackendData] = useState(null)
    const [dbStatus, setDbStatus] = useState(null)

    useEffect(() => {
        // Fetch vers la route principale (Port 3000 = Backend Dockerisé)
        fetch('http://localhost:3000/')
            .then(res => res.json())
            .then(data => setBackendData(data.message))
            .catch(err => setBackendData("Erreur de connexion au backend"));

        // Fetch vers le test de base de données
        fetch('http://localhost:3000/db-test')
            .then(res => res.json())
            .then(data => setDbStatus(data.message))
            .catch(err => setDbStatus("Erreur de connexion MySQL"));
    }, [])

    return (
        <div className="App">
            <h1>🚀 Stack Fullstack - Job 08</h1>
            <div className="card">
                <h2>Backend Status:</h2>
                <p style={{ color: '#646cff' }}>{backendData || "Chargement..."}</p>

                <h2>Database Status:</h2>
                <p style={{ color: dbStatus?.includes('✅') ? 'green' : 'red' }}>{dbStatus || "Chargement..."}</p>
            </div>
            <p className="read-the-docs">
                Hot Reload testé et validé avec succès depuis Docker ! 🎉
            </p>
        </div>
    )
}

export default App
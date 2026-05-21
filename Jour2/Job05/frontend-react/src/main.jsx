import React from 'react'
import ReactDOM from 'react-dom/client'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <div style={{ textAlign: 'center', marginTop: '50px', fontFamily: 'sans-serif' }}>
      <h1>🚀 React + Nginx + Docker</h1>
      <p>Ceci est un build multi-stage ultra-léger !</p>
    </div>
  </React.StrictMode>
)
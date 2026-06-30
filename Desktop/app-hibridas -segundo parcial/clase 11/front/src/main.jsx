import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { RouterProvider } from "react-router-dom"
import router from './Routes/Routes' // Tu archivo de rutas impecable
import { SessionProvider } from './context/Session.context' // Tu carpeta singular sin S

// Estilos de Bootstrap para que no se vea roto el diseño del profe
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap/dist/js/bootstrap.bundle.min.js"
import './index.css'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <SessionProvider>
      {/* Adiós <Fetch />, hola enrutador dinámico */}
      <RouterProvider router={router} />
    </SessionProvider>
  </StrictMode>,
)
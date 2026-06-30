import React from 'react'
import { Link } from 'react-router-dom'
import { useToken, useRol, useLogout } from '../context/Session.context'

const NavBar = () => {
  const token = useToken()
  const rol = useRol()

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light border-bottom p-3">
      <div className="container-fluid">
        {/* Nombre de la app a la izquierda */}
        <Link className="navbar-brand fw-bold" to="/">Navbar</Link>
        
        <div className="collapse navbar-collapse">
          <ul className="navbar-nav me-auto mb-2 mb-lg-0">
            {/* Si está logueado, ve el link de Home */}
            {token && (
              <li className="nav-item">
                <Link className="nav-link" to="/">Home</Link>
              </li>
            )}
            
            {/* Si es SuperAdmin (rol >= 2), ve la sección de usuarios */}
            {token && rol >= 2 && (
              <li className="nav-item">
                <Link className="nav-link" to="/usuarios">usuarios</Link>
              </li>
            )}

            {/* Enlaces condicionales de sesión */}
            {!token ? (
              <li className="nav-item">
                <Link className="nav-link" to="/login">Ingresar</Link>
              </li>
            ) : (
              <li className="nav-item">
                <Link className="nav-link text-danger" to="/logout">Salir</Link>
              </li>
            )}
          </ul>
          
          {/* Muestra el rol sutilmente a la derecha si está logueado */}
          {token && (
            <span className="navbar-text text-muted small">
              Rol asignado: {rol}
            </span>
          )}
        </div>
      </div>
    </nav>
  )
}

export default NavBar
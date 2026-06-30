import React from 'react';
import { Navigate } from 'react-router-dom';
import { useToken, useRol } from '../context/Session.context';

const ProtectedRoute = ({ element, rol }) => {
    const token = useToken();
    const userRol = useRol();

    // 1. Si no hay token guardado, directo al login
    if (!token) {
        return <Navigate to="/login" replace />;
    }

    // 2. Control de Jerarquía Estricto y Seguro:
    // Si el rol del usuario es MENOR que el requerido por la ruta, lo rebota a la Home
    if (userRol < rol) {
        return <Navigate to="/" replace />;
    }

    // 3. Si pasa ambas validaciones, ve la pantalla correspondiente
    return element;
};

export default ProtectedRoute;
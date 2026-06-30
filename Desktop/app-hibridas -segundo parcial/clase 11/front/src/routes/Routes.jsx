import { createBrowserRouter } from "react-router-dom";
import Home from "../crud/Home";
import Layout from "../components/Layout";
import Detalle from "../crud/Detalle";
import ProtectedRoute from "../components/ProtectedRoute";
import NuevaMascota from "../crud/NuevaMascota";
import ModificarMascota from "../crud/ModificarMascota";
import DeleteMascota from "../crud/DeleteMascota";

// Componentes de Auth (apuntando a  Login, Register, etc.)
import Login from "../pages/auth/Login"; 
import Logout from "../pages/auth/Logout";
import Register from "../pages/auth/Register";
import Usuarios from "../pages/auth/usuarios";

const router = createBrowserRouter([
  {
    path: "/",
    element: <Layout />,
    children: [
      {
        path: "/",
        element: <ProtectedRoute element={<Home />} rol={0} />,
      },
      {
        path: "/detalle/:idMascota", // Cambiado a idMascota para hacer juego con el hook
        element: <ProtectedRoute element={<Detalle />} rol={0}/>
      },
      {
        path: "/nueva-mascota",
        element: <ProtectedRoute element={<NuevaMascota />} rol={1}/>
      },
      {
        path: "/modificar-mascota/:idMascota",
        element: <ProtectedRoute element={<ModificarMascota />} rol={1}/>
      },
      {
        path: "/borrar-mascota/:idMascota",
        element: <ProtectedRoute element={<DeleteMascota />} rol={2}/>
      },
      {
        path: "/usuarios",
        element: <ProtectedRoute element={<Usuarios />} rol={2}/>
      },      
      {
        path: "/login",
        element: <Login />
      },
      {
        path: "/register",
        element: <Register />
      },
      {
        path: "/logout",
        element: <Logout />
      },
      {
        path: "*",
        element: <div>404 - Página no encontrada</div>
      }
    ]
  }
]);

export default router;
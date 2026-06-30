import React from "react";
import { RouterProvider } from "react-router-dom";
import router from "./routes"; // Importa el enrutador que configuraste

const App = () => {
  // Ahora App.jsx limpia la pantalla y le entrega el control absoluto a tus rutas y al Layout
  return <RouterProvider router={router} />;
};

export default App;
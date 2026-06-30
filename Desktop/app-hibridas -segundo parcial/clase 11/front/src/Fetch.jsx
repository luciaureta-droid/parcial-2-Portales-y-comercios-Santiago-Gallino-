import React, { useEffect, useState } from 'react';

const Fetch = () => {
    // Cambiamos los estados de los perritos por los de nuestros pacientes reales
    const [pacientes, setPacientes] = useState([]);
    const [error, setError] = useState(null);

    // Función para ir a buscar los pacientes a TU Backend (puerto 3333)
    const traerPacientes = () => {
        console.log("Conectando al backend para traer pacientes...");
        
        // Ponemos la URL de tu API local (antiguo primer parcial)
        fetch("http://localhost:3333/api/pacientes") 
            .then(res => {
                if (res.ok) {
                    return res.json();
                } else {
                    throw new Error("Error al conectar con la base de datos de la veterinaria.");
                }
            })
            .then(data => {
                // Guardamos el array de mascotas que nos devuelve tu backend
                setPacientes(data); 
            })
            .catch(err => {
                console.error(err);
                setError("No se pudieron cargar los pacientes. ¿Está el backend prendido?");
            });
    };

    // Usamos el useEffect igual que el profe para cargar los datos apenas abre la pantalla
    useEffect(() => {
        traerPacientes();
    }, []);

    return (
        <div style={{ padding: '20px', fontFamily: 'sans-serif', backgroundColor: '#f9f9f9' }}>
            <h2 style={{ color: '#2c3e50', textAlign: 'center' }}>🐾 Panel de Pacientes Veterinarios 🐾</h2>
            
            <div style={{ display: 'flex', justifyContent: 'center', marginBottom: '20px' }}>
                <button 
                    onClick={traerPacientes} 
                    style={{ padding: '10px 20px', backgroundColor: '#3498db', color: 'white', border: 'none', borderRadius: '5px', cursor: 'pointer' }}
                >
                 Actualizar Lista
                </button>
            </div>

            {/* Si hay un error, lo mostramos de manera clara */}
            {error && <p style={{ color: 'red', textAlign: 'center' }}>{error}</p>}

            {/* Contenedor de Tarjetas (Cards) para evitar las tablas aburridas que el profe criticó */}
            <div style={{ display: 'flex', flexWrap: 'wrap', gap: '20px', justifyContent: 'center' }}>
                {pacientes.length === 0 && !error ? (
                    <p>No hay pacientes registrados en este momento.</p>
                ) : (
                    pacientes.map((mascota) => (
                        <div 
                            key={mascota._id || mascota.id} 
                            style={{ 
                                backgroundColor: 'white', 
                                border: '1px solid #e0e0e0', 
                                borderRadius: '8px', 
                                padding: '15px', 
                                width: '250px', 
                                boxShadow: '0 4px 6px rgba(0,0,0,0.05)' 
                            }}
                        >
                            <h3 style={{ margin: '0 0 10px 0', color: '#2c3e50' }}>🐶 {mascota.nombre}</h3>
                            <p style={{ margin: '5px 0', fontSize: '14px' }}><strong>Especie:</strong> {mascota.especie}</p>
                            <p style={{ margin: '5px 0', fontSize: '14px' }}><strong>Edad:</strong> {mascota.edad} años</p>
                            <hr style={{ border: '0', borderTop: '1px solid #eee', margin: '10px 0' }} />
                            <p style={{ margin: '0', fontSize: '13px', color: '#7f8c8d' }}>
                                👤 <strong>Dueño:</strong> {mascota.duenio || mascota.apellido}
                            </p>
                        </div>
                    ))
                )}
            </div>
        </div>
    );
};

export default Fetch;
# sistema-vacunas
Sistema de vacunas
## Rutas AJAX disponibles
### Vacunas:
#### Crear vacuna
Ruta:/vacunas
Metodo:POST
Datos requeridos:name,requerido y debe de ser string
Retorno:["message":"ok"]
#### Editar vacuna
Ruta:/vacunas/{vaccination_id}
Metodo:PUT
Datos requeridos:name,debe de ser string
Retorno:["message":"ok"]
#### Eliminar vacuna
Ruta:/vacunas/{vaccination_id}
Metodo:DELETE
Retorno:["message":"ok"]
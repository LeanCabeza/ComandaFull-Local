DOCUMENTACIÓN LA COMANDA

1ro – Login, que se encarga de validar un usuario en la BDD y darle un token correspondiente en caso de que corresponda.

Tipos de usuarios
    • Socio
    • Bartender
    • Cervecero
    • Cocinero
    • Mozo
Socio

Puede hacer todo.
Aclaración: Que pueda hacer todo, no quiere decir que tenga la obligación de hacerlo.

Los socios le dan descansos, vacaciones, despiden empleados.

    • ABM Mesas
    • ABM Usuarios
    • ABM Productos
    • ABM Pedidos

Mozo

    • Listar los pedidos que ya estén listos para entregar en la mesa 
        ◦ Pedidos→listarSegunSector ( Los que esten listos para entregar )
    • Modificación Mesa.
        ◦ Modificar Estado Mesa
    • Modificación Pedidos.
        ◦ Pedidos → ActualizarEstadoPedidoSegunSector
      
Bartender

    • Listar Pedidos que le correspondan, cambiarle el estado y cambiarle el tiempo de preparación.
        ◦ Pedidos→listarSegunSector (Los que le correspondan al sector Bartender)
    • Puede modificar el estado de los pedidos de su sector, cambiarle estado y seleccionar el tiempo que le va demorar.
        ◦ Pedidos → ActualizarEstadoPedidoSegunSector
          
Cervecero

    • Listar Pedidos que le correspondan, cambiarle el estado y cambiarle el tiempo de preparación.
        ◦ Pedidos→listarSegunSector (Los que le correspondan al sector Cervecero)
    • Puede modificar el estado de los pedidos de su sector, cambiarle estado y seleccionar el tiempo que le va demorar.
        ◦ Pedidos → ActualizarEstadoPedidoSegunSector
Cocinero

    • Listar Pedidos que le correspondan, cambiarle el estado y cambiarle el tiempo de preparación.
        ◦ Pedidos→listarSegunSector (Los que le correspondan al sector Cocinero)
    • Puede modificar el estado de los pedidos de su sector, cambiarle estado y seleccionar el tiempo que le va demorar.
        ◦ Pedidos → ActualizarEstadoPedidoSegunSector
      
Circuito del Pedido.

    1.  Primero el mozo se encargara de presentarse y ofrecer las mesas disponibles
       
    2. . El Mozo agenda cliente en BBDD.
       
    3.  Mozo,  asignara entrega la cartilla.
       
    4. Luego de un rato, el Mozo se acercara  a tomar el pedido y agendara el producto de la cartilla. 
       Cambien se encargara de derivar los pedidos a cada sector correspondiente. 
       Y luego le actualizara el estado de la mesa a “Esperando”.

    5. Cada sector se encargara de listar los pedidos correspondientes y solo verán los correspondientes a su sector. 
       Una vez que tengan un pedido que les corresponda, se encargaran de actualizare el tiempo de espera y el estado lo podrán como “En preparacion”. 
       Una vez que terminen, le agendaran el estado “Listo”.
       
    6. El Mozo puede listar todos los pedidos y si hay alguno con el estado “Listo”, lo ira a buscar al sector correspondiente y lo entregara a la mesa. Una vez que lo entrega todos los pedidos a la mesa, le cambiara el estado a “Comiendo”.
       
    7. Una vez que terminan de comer, el Mozo pasa a cobrar la cuenta y actualiza el estado a “Abonado”
       
    8. Luego Limpiara la mesa y la podrá en estado “Disponible”, para que se siente otro comensal.
       
       Encuesta
    • Al terminar de comer el cliente puede hacer la encuesta, o no …
    • En la encuesta se valorara cada servicio recibido con un puntaje del 1 al 10 y puede añadir una descripción de hasta 67 caracteres.
    • A las encuestas solo accede el cliente y el SOCIO.
    • Las encuestan se  pueden guardar en PDF/CSV. 
    • Tambien se puede cargar desde un CSV encuesta a la base de datos.








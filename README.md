# Kata: Reservas de restaurante

## Descripción

Queremos construir una clase para gestionar las reservas de un restaurante mediante instrucciones de texto.

El restaurante empieza sin reservas. El usuario puede crear reservas, cancelar reservas o vaciar todas las reservas.

Cada reserva está asociada a un nombre y a un número de personas.

El objetivo de esta kata es practicar:

- Interpretación de comandos en texto.
- Gestión de estado interno.
- Uso de arrays o mapas.
- Validaciones sencillas.
- Ordenación alfabética.
- TDD.
- Clean Code.

---

## Objetivo

Implementar una clase que mantenga el estado actual de las reservas del restaurante.

Después de cada instrucción válida, el método debe devolver el estado completo de las reservas.

---

## Restricciones

- Solo debe existir una clase pública.
- La clase debe tener un único método público.
- El método público debe recibir un `String`.
- El método público debe devolver un `String`.
- Las reservas empiezan vacías.
- Los nombres no distinguen entre mayúsculas y minúsculas.
- Los nombres deben guardarse y mostrarse en minúsculas.
- Las reservas deben mostrarse ordenadas alfabéticamente por nombre.
- No hace falta gestionar instrucciones mal formadas.

---

## Método público

```java
String ejecutar(String instruccion)
```

Ejemplo de uso:

```java
ReservasRestaurante reservas = new ReservasRestaurante();

reservas.ejecutar("reservar Ana 4");
```

---

# Acciones disponibles

## 1. Reservar mesa

Permite crear una reserva.

### Formato

```txt
reservar <nombre> <personas>
```

### Reglas

- Si el nombre no tiene reserva, se crea una nueva.
- Si el nombre ya tiene una reserva, se devuelve un mensaje de error.
- El número de personas será siempre un número entero positivo.
- El nombre se guarda en minúsculas.
- Después de crear una reserva válida, se devuelve la lista completa de reservas.

### Mensaje de error

Si ya existe una reserva para ese nombre, se debe devolver exactamente:

```txt
La reserva ya existe
```

### Ejemplo 1

```txt
Entrada:
reservar Ana 4

Salida:
ana x4
```

### Ejemplo 2

```txt
Estado inicial:
ana x4

Entrada:
reservar Luis 2

Salida:
ana x4, luis x2
```

### Ejemplo 3

```txt
Estado inicial:
ana x4

Entrada:
reservar ANA 3

Salida:
La reserva ya existe
```

---

## 2. Cancelar reserva

Permite cancelar una reserva existente.

### Formato

```txt
cancelar <nombre>
```

### Reglas

- Si existe una reserva para ese nombre, se elimina.
- Si no existe, se devuelve un mensaje de error.
- La comparación debe ignorar mayúsculas y minúsculas.
- Después de cancelar una reserva válida, se devuelve la lista actualizada.

### Mensaje de error

Si la reserva no existe, se debe devolver exactamente:

```txt
La reserva seleccionada no existe
```

### Ejemplo 1

```txt
Estado inicial:
ana x4, luis x2

Entrada:
cancelar Ana

Salida:
luis x2
```

### Ejemplo 2

```txt
Estado inicial:
luis x2

Entrada:
cancelar Marta

Salida:
La reserva seleccionada no existe
```

---

## 3. Vaciar reservas

Permite eliminar todas las reservas.

### Formato

```txt
vaciar
```

### Reglas

- Elimina todas las reservas.
- Devuelve una cadena vacía.

### Ejemplo

```txt
Estado inicial:
ana x4, luis x2

Entrada:
vaciar

Salida:
""
```

---

## Formato de salida

Después de cada instrucción válida, se devuelve el estado actual de las reservas.

Cada reserva debe mostrarse con este formato:

```txt
<nombre> x<personas>
```

Las reservas deben aparecer:

- En minúsculas.
- Ordenadas alfabéticamente por nombre.
- Separadas por coma y espacio.

### Ejemplo

```txt
ana x4, luis x2, marta x6
```

Si no hay reservas, se devuelve:

```txt
""
```

---

## Ejemplo de flujo completo

```txt
"reservar Ana 4"    -> "ana x4"
"reservar Luis 2"   -> "ana x4, luis x2"
"reservar ANA 3"    -> "La reserva ya existe"
"cancelar ana"      -> "luis x2"
"cancelar Marta"    -> "La reserva seleccionada no existe"
"vaciar"            -> ""
```

---

## Casos de prueba recomendados

Puedes desarrollar la kata con TDD siguiendo este orden:

1. Crear una reserva en una lista vacía.
2. Crear dos reservas y devolverlas ordenadas.
3. Guardar los nombres en minúsculas.
4. No permitir reservas repetidas.
5. No permitir reservas repetidas aunque cambien las mayúsculas.
6. Cancelar una reserva existente.
7. Cancelar una reserva usando mayúsculas diferentes.
8. Devolver error al cancelar una reserva inexistente.
9. Vaciar todas las reservas.
10. Después de vaciar, permitir crear una reserva nueva.

---

## Consejos de implementación

Una forma sencilla de resolverlo es usar un mapa:

```txt
nombre -> numeroDePersonas
```

Por ejemplo:

```txt
ana -> 4
luis -> 2
```

Puedes tener métodos privados como:

```java
reservar(nombre, personas)
cancelar(nombre)
vaciar()
formatearReservas()
normalizarNombre(nombre)
```

Recuerda que solo el método `ejecutar` debe ser público.

---

## Sugerencia de commits

```txt
[rojo] - Crea test para reservar una mesa
[verde] - Permite crear una reserva
[rojo] - Crea test para mostrar varias reservas ordenadas
[verde] - Muestra reservas ordenadas alfabéticamente
[rojo] - Crea test para evitar reservas duplicadas
[verde] - Devuelve error si la reserva ya existe
[rojo] - Crea test para cancelar una reserva existente
[verde] - Permite cancelar reservas
[rojo] - Crea test para cancelar reserva inexistente
[verde] - Devuelve error si la reserva no existe
[refactor] - Extrae normalización y formateo de reservas
```
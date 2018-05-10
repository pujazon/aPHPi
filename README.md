# phpcounters
Aprendiendo PHP haciendo una página con contadores actualizados al hacer click ciertos elementos del sitio.

Historia:

Commit 15: Al clicar al botón ya añade una entrada en, base de datos correspondiente al mes, la tabla del link correspondiente. La suma de las tablas es el número de clicks que han hecho en el mes.

Bugs que hay:
  1. El campo dia es 'D' por lo que pone Tue,Mon... Pero no el numero del dia. Habra que añadir ese campo.
  2. El contador no lo hace bien porque hay que resetearlo a 0 antes de que empiece el segundo contaje.
  

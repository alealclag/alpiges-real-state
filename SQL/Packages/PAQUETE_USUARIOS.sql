--PAQUETES
    --USUARIOS
        --ESPECIFICACIONES
CREATE OR REPLACE PACKAGE PAQ_USUARIOS IS
PROCEDURE INICIALIZAR;
PROCEDURE CONSULTAR;
PROCEDURE INSERTAR(W_DNI IN USUARIOS.DNI%TYPE, W_NOMBRE IN USUARIOS.NOMBRE%TYPE, W_APELLIDOS IN USUARIOS.APELLIDOS%TYPE, 
W_FECHA_NACIMIENTO IN USUARIOS.FECHA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN USUARIOS.CORREO_ELECTRONICO%TYPE, 
W_TELEFONO IN USUARIOS.TELEFONO%TYPE, W_CONTRASENA IN USUARIOS.CONTRASENA%TYPE);
PROCEDURE ACTUALIZAR (W_OID_US IN USUARIOS.OID_US%TYPE, W_DNI IN USUARIOS.DNI%TYPE, W_NOMBRE IN USUARIOS.NOMBRE%TYPE, 
W_APELLIDOS IN USUARIOS.APELLIDOS%TYPE, W_FECHA_NACIMIENTO IN USUARIOS.FECHA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN USUARIOS.CORREO_ELECTRONICO%TYPE, 
W_TELEFONO IN USUARIOS.TELEFONO%TYPE, W_CONTRASENA IN USUARIOS.CONTRASENA%TYPE);
PROCEDURE ELIMINAR (W_OID_US IN USUARIOS.OID_US%TYPE);
END;
/ 
        --CUERPOS
CREATE OR REPLACE PACKAGE BODY PAQ_USUARIOS IS
CURSOR C IS
SELECT * FROM USUARIOS;
W_USUARIOS USUARIOS%ROWTYPE;

PROCEDURE INICIALIZAR IS
BEGIN
DELETE FROM USUARIOS;
END INICIALIZAR;

PROCEDURE CONSULTAR IS
BEGIN
OPEN C;
FETCH C INTO W_USUARIOS;
DBMS_OUTPUT.PUT_LINE(RPAD('ID USUARIO:', 25) || RPAD('DNI:', 25) || RPAD('NOMBRE:', 25) || RPAD('APELLIDOS:', 25) ||
RPAD('FECHA DE NACIMIENTO:', 25) || RPAD('CORREO ELECTRONICO:', 25) || RPAD('TELEFONO:', 25) || RPAD('CONTRASENA:', 25));
DBMS_OUTPUT.PUT_LINE(LPAD('-', 120, '-'));
WHILE C%FOUND LOOP
DBMS_OUTPUT.PUT_LINE(RPAD(W_USUARIOS.OID_US, 25) || RPAD(W_USUARIOS.DNI, 25) || RPAD(W_USUARIOS.NOMBRE, 25) || 
RPAD(W_USUARIOS.APELLIDOS, 25) || RPAD(W_USUARIOS.FECHA_NACIMIENTO, 25) || RPAD(W_USUARIOS.CORREO_ELECTRONICO, 25) ||
RPAD(W_USUARIOS.TELEFONO, 25) || RPAD(W_USUARIOS.CONTRASENA, 25));
FETCH C INTO W_USUARIOS;
END LOOP;
CLOSE C;
END CONSULTAR;

PROCEDURE INSERTAR(W_DNI IN USUARIOS.DNI%TYPE, W_NOMBRE IN USUARIOS.NOMBRE%TYPE, W_APELLIDOS IN USUARIOS.APELLIDOS%TYPE, 
W_FECHA_NACIMIENTO IN USUARIOS.FECHA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN USUARIOS.CORREO_ELECTRONICO%TYPE, 
W_TELEFONO IN USUARIOS.TELEFONO%TYPE, W_CONTRASENA IN USUARIOS.CONTRASENA%TYPE) IS
W_OID_US USUARIOS.OID_US%TYPE;
BEGIN
INSERT INTO USUARIOS (OID_US, DNI, NOMBRE, APELLIDOS, FECHA_NACIMIENTO, CORREO_ELECTRONICO, TELEFONO, CONTRASENA) 
VALUES (W_OID_US, W_DNI, W_NOMBRE, W_APELLIDOS, W_FECHA_NACIMIENTO, W_CORREO_ELECTRONICO, W_TELEFONO, W_CONTRASENA);
W_OID_US := SEC_USUARIOS.CURRVAL;
SELECT * INTO W_USUARIOS FROM USUARIOS WHERE DNI = W_DNI;
IF W_USUARIOS.OID_US != W_OID_US OR W_USUARIOS.DNI !=W_DNI OR W_USUARIOS.NOMBRE !=W_NOMBRE OR W_USUARIOS.APELLIDOS !=W_APELLIDOS OR
W_USUARIOS.FECHA_NACIMIENTO !=W_FECHA_NACIMIENTO OR W_USUARIOS.CORREO_ELECTRONICO !=W_CORREO_ELECTRONICO OR W_USUARIOS.TELEFONO !=W_TELEFONO 
OR W_USUARIOS.CONTRASENA !=W_CONTRASENA
THEN
DBMS_OUTPUT.PUT_LINE('FALLO AL INSERTAR EL ELEMENTO');
ELSE
DBMS_OUTPUT.PUT_LINE('ELEMENTO INSERTADO CORRECTAMENTE');
END IF;
COMMIT;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE('FALLO AL INSERTAR EL ELEMENTO');
ROLLBACK;
END INSERTAR;

PROCEDURE ACTUALIZAR (W_OID_US IN USUARIOS.OID_US%TYPE, W_DNI IN USUARIOS.DNI%TYPE, W_NOMBRE IN USUARIOS.NOMBRE%TYPE, 
W_APELLIDOS IN USUARIOS.APELLIDOS%TYPE, W_FECHA_NACIMIENTO IN USUARIOS.FECHA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN USUARIOS.CORREO_ELECTRONICO%TYPE, 
W_TELEFONO IN USUARIOS.TELEFONO%TYPE, W_CONTRASENA IN USUARIOS.CONTRASENA%TYPE) IS
BEGIN
UPDATE USUARIOS SET DNI=W_DNI WHERE OID_US=W_OID_US;
UPDATE USUARIOS SET NOMBRE=W_NOMBRE WHERE OID_US=W_OID_US;
UPDATE USUARIOS SET APELLIDOS=W_APELLIDOS WHERE OID_US=W_OID_US;
UPDATE USUARIOS SET FECHA_NACIMIENTO=W_FECHA_NACIMIENTO WHERE OID_US=W_OID_US;
UPDATE USUARIOS SET CORREO_ELECTRONICO=W_CORREO_ELECTRONICO WHERE OID_US=W_OID_US;
UPDATE USUARIOS SET TELEFONO=W_TELEFONO WHERE OID_US=W_OID_US;
UPDATE USUARIOS SET CONTRASENA=W_CONTRASENA WHERE OID_US=W_OID_US;
SELECT * INTO W_USUARIOS FROM USUARIOS WHERE OID_US = W_OID_US;
IF W_USUARIOS.OID_US != W_OID_US OR W_USUARIOS.DNI !=W_DNI OR W_USUARIOS.NOMBRE !=W_NOMBRE OR W_USUARIOS.APELLIDOS !=W_APELLIDOS OR
W_USUARIOS.FECHA_NACIMIENTO !=W_FECHA_NACIMIENTO OR W_USUARIOS.CORREO_ELECTRONICO !=W_CORREO_ELECTRONICO OR W_USUARIOS.TELEFONO !=W_TELEFONO 
OR W_USUARIOS.CONTRASENA !=W_CONTRASENA
THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ACTUALIZACI�N DEL ELEMENTO');
ELSE
DBMS_OUTPUT.PUT_LINE('ELEMENTO ACTUALIZADO CORRECTAMENTE');
END IF;
COMMIT;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ACTUALIZACI�N DEL ELEMENTO');
ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (W_OID_US IN USUARIOS.OID_US%TYPE) IS
AUX NUMBER := 0;
BEGIN
DELETE FROM USUARIOS WHERE OID_US = W_OID_US;
SELECT COUNT(*) INTO AUX FROM USUARIOS WHERE OID_US = W_OID_US;
IF AUX <> 0 THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ELIMINACI�N DEL ELEMENTO');
ELSE
DBMS_OUTPUT.PUT_LINE('ELEMENTO ELIMINADO CORRECTAMENTE');
END IF;
COMMIT;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ELIMINACI�N DEL ELEMENTO');
ROLLBACK;
END ELIMINAR;

END;
/
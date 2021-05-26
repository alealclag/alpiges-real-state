--PAQUETES
    --COMERCIALES
        --ESPECIFICACIONES
CREATE OR REPLACE PACKAGE PAQ_COMERCIALES IS
PROCEDURE INICIALIZAR;
PROCEDURE CONSULTAR;
PROCEDURE INSERTAR(W_DNI IN COMERCIALES.DNI%TYPE, W_NOMBRE IN COMERCIALES.NOMBRE%TYPE, W_APELLIDOS IN COMERCIALES.APELLIDOS%TYPE,
W_FECHA_NACIMIENTO IN COMERCIALES.FEHCA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN COMERCIALES.CORREO_ELECTRONICO%TYPE,
W_TELEFONO IN COMERCIALES.TELEFONO%TYPE,W_DIRECCION IN COMERCIALES.DIRECCION%TYPE, W_PRIVILEGIO IN COMERCIALES.PRIVILEGIO%TYPE);
PROCEDURE ACTUALIZAR (W_OID_CO IN COMERCIALES.OID_CO%TYPE, W_DNI IN COMERCIALES.DNI%TYPE, W_NOMBRE IN COMERCIALES.NOMBRE%TYPE,
W_APELLIDOS IN COMERCIALES.APELLIDOS%TYPE, W_FECHA_NACIMIENTO IN COMERCIALES.FEHCA_NACIMIENTO%TYPE,W_CORREO_ELECTRONICO IN COMERCIALES.CORREO_ELECTRONICO%TYPE,
W_TELEFONO IN COMERCIALES.TELEFONO%TYPE, W_DIRECCION IN COMERCIALES.DIRECCION%TYPE, W_PRIVILEGIO IN COMERCIALES.PRIVILEGIO%TYPE);
PROCEDURE ELIMINAR (W_OID_CO IN COMERCIALES.OID_CO%TYPE);
END;
/ 
        --CUERPOS
CREATE OR REPLACE PACKAGE BODY PAQ_COMERCIALES IS
CURSOR C IS
SELECT * FROM COMERCIALES;
W_COMERCIALES COMERCIALES%ROWTYPE;

PROCEDURE INICIALIZAR IS
BEGIN
DELETE FROM COMERCIALES;
END INICIALIZAR;

PROCEDURE CONSULTAR IS
BEGIN
OPEN C;
FETCH C INTO W_COMERCIALES;
DBMS_OUTPUT.PUT_LINE(RPAD('ID COMERCIAL:', 25) || RPAD('DNI:', 25) || RPAD('NOMBRE:', 25) || RPAD('APELLIDOS:', 25) ||
RPAD('FECHA DE NACIMIENTO:', 25) || RPAD('CORREO ELECTRONICO:', 25) || RPAD('TELEFONO:', 25) || RPAD('DIRECCION:', 25) || RPAD('PRIVILEGIO:', 25));
DBMS_OUTPUT.PUT_LINE(LPAD('-', 120, '-'));
WHILE C%FOUND LOOP
DBMS_OUTPUT.PUT_LINE(RPAD(W_COMERCIALES.OID_CO, 25) || RPAD(W_COMERCIALES.DNI, 25) || RPAD(W_COMERCIALES.NOMBRE, 25) ||
RPAD(W_COMERCIALES.APELLIDOS, 25) || RPAD(W_COMERCIALES.FEHCA_NACIMIENTO, 25) || RPAD(W_COMERCIALES.CORREO_ELECTRONICO, 25) ||
RPAD(W_COMERCIALES.TELEFONO, 25) || RPAD(W_COMERCIALES.DIRECCION, 25) || RPAD(W_COMERCIALES.PRIVILEGIO, 25));
FETCH C INTO W_COMERCIALES;
END LOOP;
CLOSE C;
END CONSULTAR;

PROCEDURE INSERTAR(W_DNI IN COMERCIALES.DNI%TYPE, W_NOMBRE IN COMERCIALES.NOMBRE%TYPE, W_APELLIDOS IN COMERCIALES.APELLIDOS%TYPE, 
W_FECHA_NACIMIENTO IN COMERCIALES.FEHCA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN COMERCIALES.CORREO_ELECTRONICO%TYPE, 
W_TELEFONO IN COMERCIALES.TELEFONO%TYPE, W_DIRECCION IN COMERCIALES.DIRECCION%TYPE, W_PRIVILEGIO IN COMERCIALES.PRIVILEGIO%TYPE) IS
W_OID_CO COMERCIALES.OID_CO%TYPE;
BEGIN
INSERT INTO COMERCIALES (OID_CO, DNI, NOMBRE, APELLIDOS, FEHCA_NACIMIENTO, CORREO_ELECTRONICO, TELEFONO, DIRECCION, PRIVILEGIO) 
VALUES (W_OID_CO, W_DNI, W_NOMBRE, W_APELLIDOS, W_FECHA_NACIMIENTO, W_CORREO_ELECTRONICO, W_TELEFONO, W_DIRECCION, W_PRIVILEGIO);
W_OID_CO := SEC_COMERCIALES.CURRVAL;
SELECT * INTO W_COMERCIALES FROM COMERCIALES WHERE DNI = W_DNI;
IF W_COMERCIALES.OID_CO != W_OID_CO OR W_COMERCIALES. DNI !=W_DNI OR W_COMERCIALES.NOMBRE !=W_NOMBRE OR W_COMERCIALES.APELLIDOS !=W_APELLIDOS OR
W_COMERCIALES.FEHCA_NACIMIENTO !=W_FECHA_NACIMIENTO OR W_COMERCIALES.CORREO_ELECTRONICO !=W_CORREO_ELECTRONICO OR
W_COMERCIALES.TELEFONO !=W_TELEFONO OR W_COMERCIALES. DIRECCION !=W_DIRECCION OR W_COMERCIALES.PRIVILEGIO !=W_PRIVILEGIO
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

PROCEDURE ACTUALIZAR (W_OID_CO IN COMERCIALES.OID_CO%TYPE, W_DNI IN COMERCIALES.DNI%TYPE, W_NOMBRE IN COMERCIALES.NOMBRE%TYPE, 
W_APELLIDOS IN COMERCIALES.APELLIDOS%TYPE, W_FECHA_NACIMIENTO IN COMERCIALES.FEHCA_NACIMIENTO%TYPE, W_CORREO_ELECTRONICO IN COMERCIALES.CORREO_ELECTRONICO%TYPE, 
W_TELEFONO IN COMERCIALES.TELEFONO%TYPE, W_DIRECCION IN COMERCIALES.DIRECCION%TYPE, W_PRIVILEGIO IN COMERCIALES.PRIVILEGIO%TYPE) IS
BEGIN
UPDATE COMERCIALES SET DNI=W_DNI WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET NOMBRE=W_NOMBRE WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET APELLIDOS=W_APELLIDOS WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET FEHCA_NACIMIENTO=W_FECHA_NACIMIENTO WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET CORREO_ELECTRONICO=W_CORREO_ELECTRONICO WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET TELEFONO=W_TELEFONO WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET DIRECCION=W_DIRECCION WHERE OID_CO=W_OID_CO;
UPDATE COMERCIALES SET PRIVILEGIO=W_PRIVILEGIO WHERE OID_CO=W_OID_CO;
SELECT * INTO W_COMERCIALES FROM COMERCIALES WHERE OID_CO = W_OID_CO;
IF W_COMERCIALES.OID_CO != W_OID_CO OR W_COMERCIALES. DNI !=W_DNI OR W_COMERCIALES.NOMBRE !=W_NOMBRE OR W_COMERCIALES.APELLIDOS !=W_APELLIDOS OR
W_COMERCIALES.FEHCA_NACIMIENTO !=W_FECHA_NACIMIENTO OR W_COMERCIALES.CORREO_ELECTRONICO !=W_CORREO_ELECTRONICO OR
W_COMERCIALES.TELEFONO !=W_TELEFONO OR W_COMERCIALES. DIRECCION !=W_DIRECCION OR W_COMERCIALES.PRIVILEGIO !=W_PRIVILEGIO
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

PROCEDURE ELIMINAR (W_OID_CO IN COMERCIALES.OID_CO%TYPE) IS
AUX NUMBER := 0;
BEGIN
DELETE FROM COMERCIALES WHERE OID_CO = W_OID_CO;
SELECT COUNT(*) INTO AUX FROM COMERCIALES WHERE OID_CO = W_OID_CO;
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
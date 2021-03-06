    --OFICINAS
        --ESPECIFICACIONES
CREATE OR REPLACE PACKAGE PAQ_OFICINAS IS
PROCEDURE INICIALIZAR;
PROCEDURE CONSULTAR;
PROCEDURE INSERTAR(W_DIRECCION IN OFICINAS.DIRECCION%TYPE,W_DIAS IN OFICINAS.DIAS%TYPE,
W_HORA_APERTURA IN OFICINAS.HORA_APERTURA%TYPE,W_HORA_CIERRE IN OFICINAS.HORA_CIERRE%TYPE,W_CIF IN OFICINAS.CIF%TYPE);
PROCEDURE ACTUALIZAR (W_DIRECCION IN OFICINAS.DIRECCION%TYPE,W_DIAS IN OFICINAS.DIAS%TYPE,
W_HORA_APERTURA IN OFICINAS.HORA_APERTURA%TYPE,W_HORA_CIERRE IN OFICINAS.HORA_CIERRE%TYPE,W_CIF IN OFICINAS.CIF%TYPE);
PROCEDURE ELIMINAR (W_DIRECCION IN OFICINAS.DIRECCION%TYPE);
END;
/ 
        --CUERPOS
CREATE OR REPLACE PACKAGE BODY PAQ_OFICINAS IS
CURSOR C IS
SELECT * FROM OFICINAS;
W_OFICINAS OFICINAS%ROWTYPE;

PROCEDURE INICIALIZAR IS
BEGIN
DELETE FROM OFICINAS;
END INICIALIZAR;

PROCEDURE CONSULTAR IS
BEGIN
OPEN C;
FETCH C INTO W_OFICINAS;
DBMS_OUTPUT.PUT_LINE(RPAD('DIRECCION:', 25) || RPAD('DIAS:', 25) || RPAD('HORA_APERTURA:', 25) || RPAD('HORA_CIERRE:', 25));
DBMS_OUTPUT.PUT_LINE(LPAD('-', 120, '-'));
WHILE C%FOUND LOOP
DBMS_OUTPUT.PUT_LINE(RPAD(W_OFICINAS.DIRECCION, 25) || RPAD(W_OFICINAS.DIAS, 25) || RPAD(W_OFICINAS.HORA_APERTURA, 25) || RPAD(W_OFICINAS.HORA_CIERRE, 25));
FETCH C INTO W_OFICINAS;
END LOOP;
CLOSE C;
END CONSULTAR;

PROCEDURE INSERTAR(W_DIRECCION IN OFICINAS.DIRECCION%TYPE,W_DIAS IN OFICINAS.DIAS%TYPE,W_HORA_APERTURA IN OFICINAS.HORA_APERTURA%TYPE,W_HORA_CIERRE IN OFICINAS.HORA_CIERRE%TYPE,W_CIF IN OFICINAS.CIF%TYPE) IS
BEGIN
INSERT INTO OFICINAS (DIRECCION, DIAS, HORA_APERTURA, HORA_CIERRE, CIF) VALUES (W_DIRECCION, W_DIAS, W_HORA_APERTURA, W_HORA_CIERRE, W_CIF);
SELECT * INTO W_OFICINAS FROM OFICINAS WHERE DIRECCION = W_DIRECCION;
IF W_OFICINAS.DIRECCION != W_DIRECCION OR W_OFICINAS.DIAS != W_DIAS OR W_OFICINAS.HORA_APERTURA != W_HORA_APERTURA OR W_OFICINAS.HORA_CIERRE != W_HORA_CIERRE OR W_OFICINAS.CIF != W_CIF
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

PROCEDURE ACTUALIZAR (W_DIRECCION IN OFICINAS.DIRECCION%TYPE,W_DIAS IN OFICINAS.DIAS%TYPE,
W_HORA_APERTURA IN OFICINAS.HORA_APERTURA%TYPE,W_HORA_CIERRE IN OFICINAS.HORA_CIERRE%TYPE,W_CIF IN OFICINAS.CIF%TYPE) IS
BEGIN
UPDATE OFICINAS SET DIRECCION=W_DIRECCION WHERE DIRECCION=W_DIRECCION;
UPDATE OFICINAS SET DIAS=W_DIAS WHERE DIRECCION=W_DIRECCION;
UPDATE OFICINAS SET HORA_APERTURA=W_HORA_APERTURA WHERE DIRECCION=W_DIRECCION;
UPDATE OFICINAS SET HORA_CIERRE=W_HORA_CIERRE WHERE DIRECCION=W_DIRECCION;
UPDATE OFICINAS SET CIF=W_CIF WHERE DIRECCION=W_DIRECCION;
SELECT * INTO W_OFICINAS FROM OFICINAS WHERE DIRECCION = W_DIRECCION;
IF W_OFICINAS.DIRECCION != W_DIRECCION OR W_OFICINAS.DIAS != W_DIAS OR W_OFICINAS.HORA_APERTURA != W_HORA_APERTURA OR W_OFICINAS.HORA_CIERRE != W_HORA_CIERRE OR W_OFICINAS.CIF != W_CIF
THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ACTUALIZACI?N DEL ELEMENTO');
ELSE
DBMS_OUTPUT.PUT_LINE('ELEMENTO ACTUALIZADO CORRECTAMENTE');
END IF;
COMMIT;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ACTUALIZACI?N DEL ELEMENTO');
ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (W_DIRECCION IN OFICINAS.DIRECCION%TYPE) IS
AUX NUMBER := 0;
BEGIN
DELETE FROM OFICINAS WHERE DIRECCION = W_DIRECCION;
SELECT COUNT(*) INTO AUX FROM OFICINAS WHERE DIRECCION = W_DIRECCION;
IF AUX <> 0 THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ELIMINACI?N DEL ELEMENTO');
ELSE
DBMS_OUTPUT.PUT_LINE('ELEMENTO ELIMINADO CORRECTAMENTE');
END IF;
COMMIT;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ELIMINACI?N DEL ELEMENTO');
ROLLBACK;
END ELIMINAR;

END;
/

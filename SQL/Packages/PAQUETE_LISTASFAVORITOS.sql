--PAQUETES

--EXTRAS
        
--ESPECIFICACIONES


CREATE OR REPLACE PACKAGE PAQ_LISTASFAVORITOS IS

PROCEDURE INICIALIZAR;
PROCEDURE CONSULTAR;
PROCEDURE INSERTAR;
PROCEDURE ELIMINAR (W_OID_FAV IN LISTASFAVORITOS.OID_FAV%TYPE);

END;
/ 
   
 
--CUERPOS
CREATE OR REPLACE PACKAGE BODY PAQ_LISTASFAVORITOS IS
CURSOR C IS
SELECT * FROM LISTASFAVORITOS;
W_LISTASFAVORITOS LISTASFAVORITOS%ROWTYPE;

PROCEDURE INICIALIZAR IS
BEGIN
DELETE FROM LISTASFAVORITOS;
END INICIALIZAR;

PROCEDURE CONSULTAR IS
BEGIN
OPEN C;
FETCH C INTO W_LISTASFAVORITOS;
DBMS_OUTPUT.PUT_LINE(RPAD('ID LISTASFAVORITOS:', 25));
DBMS_OUTPUT.PUT_LINE(LPAD('-', 120, '-'));
WHILE C%FOUND LOOP
DBMS_OUTPUT.PUT_LINE(RPAD(W_LISTASFAVORITOS.OID_FAV, 25) );
FETCH C INTO W_LISTASFAVORITOS;
END LOOP;
CLOSE C;
END CONSULTAR;

PROCEDURE INSERTAR IS
W_OID_FAV LISTASFAVORITOS.OID_FAV%TYPE;
BEGIN
INSERT INTO LISTASFAVORITOS (OID_FAV) VALUES ('A');
W_OID_FAV := SEC_LISTASFAVORITOS.CURRVAL;
SELECT * INTO W_LISTASFAVORITOS FROM LISTASFAVORITOS WHERE OID_FAV = W_OID_FAV;
IF W_LISTASFAVORITOS.OID_FAV != W_OID_FAV
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

PROCEDURE ELIMINAR (W_OID_FAV IN LISTASFAVORITOS.OID_FAV%TYPE) IS
AUX NUMBER := 0;
BEGIN
DELETE FROM LISTASFAVORITOS WHERE OID_FAV = W_OID_FAV;
SELECT COUNT(*) INTO AUX FROM LISTASFAVORITOS WHERE OID_FAV = W_OID_FAV;
IF AUX <> 0 THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ELIMINACIÓN DEL ELEMENTO');
ELSE
DBMS_OUTPUT.PUT_LINE('ELEMENTO ELIMINADO CORRECTAMENTE');
END IF;
COMMIT;
EXCEPTION
WHEN OTHERS THEN
DBMS_OUTPUT.PUT_LINE('FALLO EN LA ELIMINACIÓN DEL ELEMENTO');
ROLLBACK;
END ELIMINAR;

END;
/
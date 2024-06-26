CREATE DATABASE CARTEIRA;

CREATE TABLE CLIENTE (
    CD_CLI INT AUTO_INCREMENT PRIMARY KEY,
    NM_CLI VARCHAR(100) NOT NULL,
    DC_CPF VARCHAR(20) NOT NULL,
    DC_TEL VARCHAR(20),
    DC_EMAIL VARCHAR(100),
    CD_MUNI INT,
    DT_RGST DATE NOT NULL
);

CREATE TABLE CONTRATO (
    CD_CTO INT AUTO_INCREMENT PRIMARY KEY,
    VL_CTO FLOAT NOT NULL,
    DT_ASS DATE NOT NULL,
    DT_INI DATE NOT NULL,
    DT_FIM DATE,
    DC_STATUS CHAR(1) NOT NULL,
    DT_RGST DATE NOT NULL,
    CHECK (DC_STATUS IN ('A', 'D'))
);

CREATE TABLE ASSC_CONTRATO_CLIENTE (
    CD_CTO_CLI INT AUTO_INCREMENT PRIMARY KEY,
    CD_CTO INT NOT NULL,
    CD_CLI INT NOT NULL,
    DT_RGST DATE NOT NULL,
    FOREIGN KEY (CD_CTO) REFERENCES CONTRATO(CD_CTO) ON DELETE CASCADE,
    FOREIGN KEY (CD_CLI) REFERENCES CLIENTE(CD_CLI) ON DELETE CASCADE
);

CREATE VIEW CONSULTACLIENTECONTRATO AS
    SELECT
        C.CD_CLI,
        C.NM_CLI,
        C.DC_CPF,
        C.DC_TEL,
        C.DC_EMAIL,
        CO.CD_CTO,
        CO.VL_CTO,
        CO.DT_ASS,
        CO.DT_INI,
        CO.DT_FIM,
        CO.DC_STATUS
    FROM
        CLIENTE               C
        JOIN ASSC_CONTRATO_CLIENTE ACC
        ON C.CD_CLI = ACC.CD_CLI
        JOIN CONTRATO CO
        ON ACC.CD_CTO = CO.CD_CTO;
# SERVER-PHP Application

Esta é uma aplicação PHP para cadastro de vendas e clientes.

## Funcionalidades

- Cadastro de novos clientes e contratos
- Consulta de contratos existentes
- Filtragem de contratos por data
- Interface de usuário utilizando Bootstrap
- Feedback de sucesso após o cadastro de contratos

## Tecnologias Utilizadas

- PHP
- MySQL
- Bootstrap
- HTML/CSS

## Instalação

1. Clone o repositório:
    ```sh
    git clone https://github.com/eduardoapt/server-php.git
    ```
2. Navegue até o diretório do projeto:
    ```sh
    cd server-php
    ```
3. Configure o banco de dados:
    - Crie o banco de dados `CARTEIRA` e as tabelas `CLIENTE`, `CONTRATO`, `ASSC_CONTRATO_CLIENTE` conforme os scripts SQL fornecidos no arquivo **scripts.sql** .
    - Atualize as credenciais do banco de dados no arquivo `config.php`.

4. Inicie o servidor PHP:
    ```sh
    php -S localhost:8000
    ```

5. Acesse a aplicação no seu navegador:
    - Novo Cadastro: [http://localhost:8000](http://localhost:8000)


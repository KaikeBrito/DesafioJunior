# Documentação Desafio Junior 🗎:

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Ferramentas usadas 🛠️:

<div style="display": inline_block><br/>
<img align="center" alt="html5" src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
<img align="center" alt="html5" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
<img align="center" alt="html5" src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"/>
<img align="center" alt="html5" src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E"/>
</div>

## Arquitetura e Estrutura 👨‍💻:

<p>
1. Conexão com Banco de Dados: A primeira etapa do desenvolvimento foi estabelecer a conexão com o banco de dados MySQL, que é responsável pelo armazenamento de informações do sistema, como os registros de usuários e dados relacionados a produtos, categorias e imagens. A configuração foi realizada de forma a garantir a integridade e segurança dos dados, utilizando as melhores práticas para gerenciamento de informações sensíveis, dando o exemplo abaixo.

2.Implementação de Login e Registro:
O sistema conta com uma interface de login e registro de usuários, onde o usuário pode se cadastrar e realizar a autenticação.
Para garantir a segurança durante o processo de login, é utilizada uma autenticação baseada em tokens, o que protege os dados do usuário contra acessos não autorizados.
Uma vez autenticado, o usuário é redirecionado para a dashboard principal do sistema.

3.Dashboard e Navegação:
Após o login com sucesso, o usuário acessa a dashboard do sistema, que oferece uma visão geral das funcionalidades disponíveis.
A dashboard contém uma navbar que facilita a navegação entre os diferentes módulos do sistema, permitindo acesso rápido aos CRUDs (Create, Read, Update, Delete) para produtos, categorias e imagens.

4.Módulos de CRUD (Produtos, Categorias e Imagens):
Produtos: O módulo de produtos permite a criação, edição, visualização e exclusão de produtos. Cada produto possui um campo id_categoria que estabelece uma relação direta com uma categoria específica, permitindo organizar os produtos conforme suas respectivas categorias.
Categorias: O sistema permite a gestão de categorias, onde novas categorias podem ser criadas, editadas e associadas aos produtos existentes.
Imagens: As imagens dos produtos e das categorias podem ser carregadas e gerenciadas diretamente no sistema, facilitando a visualização e apresentação visual das informações.

</p>

#### observação: o aparecimento dessas imagens nas entidades categorias e produtos era necessário, mas de acordo com o curto periodo de tempo e um atraso que tive por causa de um erro, acabei não completando essa etapa.

## Fluxo de Funcionamento do Sistema

<p>
1. O usuário acessa a tela de login ou registro.</br></br>
2. Ao se registrar, os dados do usuário são armazenados no banco de dados MySQL.</br></br>
3. No login, o sistema verifica as credenciais do usuário e, em caso de sucesso, gera um token de autenticação.</br></br>
4. O usuário autenticado é redirecionado para a dashboard, onde tem acesso às funcionalidades de gestão de produtos, categorias e imagens.</br></br>
5. Operações de CRUD podem ser realizadas nos produtos e categorias, com todas as alterações sendo refletidas no banco de dados em tempo real.

</p>

## Códigos que usei para fazer a criação do projeto 🌐:

<p>
# 1. Criar um novo projeto Laravel (caso você tenha iniciado um novo projeto)
composer create-project --prefer-dist laravel/laravel nome-do-projeto

#2. Inicializar o servidor de desenvolvimento local
php artisan serve

</p>

## Criação do Banco de dados 🏦🎲:

<p>Certifique-se de ter configurado o seu arquivo .env com as credenciais do banco de dados MySQL. O arquivo deve conter algo semelhante a:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3307

DB_DATABASE=laravel

DB_USERNAME=root

DB_PASSWORD=

</p>

## Comandos para Configuração e Criação das Tabelas 📑:

<p>
# 3. Criar o arquivo de migração para as tabelas no banco de dados
php artisan make:migration create_nome_da_tabela_table<br><br>
# 4. Executar as migrações para criar as tabelas no banco de dados
php artisan migrate</p>

## Comandos para Gerenciar Models, Controllers e Seeds 🎰:

<p>
# 7. Criar um novo model e migration
php artisan make:model NomeDoModel -m<br><br>
# 8. Criar um novo controller
php artisan make:controller NomeDoController<br><br>
# 9. Criar uma nova seed (para popular o banco de dados com dados de teste)
php artisan make:seeder NomeDaSeeder<br><br>
# 10. Executar as seeds no banco de dados
php artisan db:seed
</p>

## impeza e Manutenção 🧹:

<p>
# 11. Limpar o cache da aplicação
php artisan cache:clear<br><br>
# 12. Limpar o cache de configuração
php artisan config:clear<br><br>
# 13. Limpar o cache de rotas
php artisan route:clear<br><br>
# 14. Limpar as views compiladas
php artisan view:clear

</p>

## Executando o Projeto :

<p># 15. Executar o servidor de desenvolvimento Laravel
php artisan serve
</p>

## Observações e Melhoras Futuras 👀:

<p>1. Conferir o Banco de dados no protocolo : http://localhost/phpmyadmin/<br><br>
2. Com um pouco de mais tempo poderia implementar as imagens para aparecer nas models categorias e produtos, cada imagem se adeque com o seu tipo de models e aprimore os controllers, fazendo o final das funcionalidades para que fique completo o sistema.
</p>

## Conclusão:

<p>
Este sistema oferece uma solução completa para o gerenciamento de produtos, categorias e imagens, utilizando Laravel e MySQL para proporcionar uma experiência segura, eficiente e escalável. A implementação de autenticação com token e a estruturação clara dos módulos de CRUD tornam o sistema uma ferramenta poderosa para usuários que buscam um controle centralizado de seus dados.
</p>

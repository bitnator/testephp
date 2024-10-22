## CRUD de usuários com validação no Controller
- Após clonar o projeto, rodar o comando composer install ou composer update
- Copiar o arquivo .env.exampple e renomear para .env 
- Criar o banco de dados e colocar as credenciais no .env
- Editei as migrations então se rodar o php artisan migrate ele já vai funcionar
- Mas caso queira já sair com dados cadastrados fiz um dump do meu banco de dados local e coloquei na raiz do projeto como exemplo 
- Usei o laragon para desenvolver 
- Testei no xampp e mais rotas do route:resource não foram reconhecidas nele. Então tive que fazer algumas alterações para funcionar no xampp sem virtualhosts 
- Colei os arquivos na pasta htdocs ai ficou assim no navegador http://localhost/testephp/public funcionou perfeitamente.
# to-do list
Um simples gerenciador de tarefas.

# Executando o ambiente
- Defina as variáveis de ambiente do MySQL criando um arquivo .env com base no arquivo ``.env.example``.

- Crie a imagem do aplicativo com o seguinte comando:

``docker-compose build app``

Quando a compilação for concluída, você poderá executar o ambiente em segundo plano com:

``docker-compose up -d``

Para mostrar informações sobre o estado de seus serviços ativos, execute:

``docker-compose ps``


Você pode usar o comando ``docker-compose exec`` para executar comandos nos contêineres de serviço, como um ``ls -l` para mostrar informações detalhadas sobre os arquivos no diretório do aplicativo:

``docker-compose exec app ls -l``

Use [http://localhost:8000](http://localhost:8000) para acessar o aplicativo a partir de seu navegador.

Você pode usar o comando logs para verificar os logs gerados por seus serviços:

``docker-compose logs nginx``

Se você deseja pausar seu ambiente Docker Compose enquanto mantém o estado de todos os seus serviços, execute:

``docker-compose pause``

Você pode então retomar seus serviços com:

``docker-compose unpause``

Para desligar seu ambiente Docker Compose e remover todos os seus contêineres, redes e volumes, execute:

``docker-compose down``

Cleanup
``docker system prune -a``
``docker volume prune``
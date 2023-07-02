# to-do list
Um simples gerenciador de tarefas.

Acesse o aplicativo no seu navegador utilizando o endereço
[http://localhost:8000](http://localhost:8000).

## Links
- [Conventional Commits](https://github.com/BeeTech-global/bee-stylish/blob/master/commits/README.md)

## /docs
- Especificação da API: /docs/swagger.yaml

## Ambiente de desenvolvimento
### Variáveis de ambiente
---
Crie o arquivo ``.env`` utilizando como base ``.env.example``.
- Defina as variáveis de ambiente para o MySQL no arquivo ``.env``.

### Docker
---
Fornece o ambiente necessário para executar o projeto.

Para continuar é necessário ter o [Docker](https://www.docker.com/)
instalado em seu computador.

### Comando para criar a imagem do aplicativo
---
``docker-compose build app``
### Comando para executar o ambiente em segundo plano
---
``docker-compose up -d``
### Comando para mostrar informações
---
Para mostrar informações sobre o estado de seus serviços
ativos, execute:

``docker-compose ps``
### Comando para executar outros comandos dentro do contêiner
---
Você pode usar o comando ``docker-compose exec`` para executar comandos nos contêineres de serviço, como um ``ls -l`` para mostrar informações detalhadas sobre os arquivos no diretório do aplicativo:

``docker-compose exec app ls -l``


### Comando para exibir logs gerados
---
Você pode usar o comando logs para verificar os logs gerados por seus serviços:

``docker-compose logs nginx``

### Comando para pausar a execução do ambiente
---
``docker-compose pause``

### Comando para desfazer a pausa da execução do ambiente
---
``docker-compose unpause``

### Comando para remover o ambiente
---
Para desligar seu ambiente Docker Compose e remover todos os seus contêineres, redes e volumes, execute:

``docker-compose down``

### Comando para remover tudo que não está em uso (Contêineres, imagens, redes e volumes)
---
``docker system prune -a --volumes``
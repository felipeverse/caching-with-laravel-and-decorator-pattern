# Implementação de cache com laravel e decorator pattern

Este repositório contém um projeto demonstrando duas abordagens distintas para implementar cache e invalidação de cache utilizando Laravel, redis e decorator pattern.

## Conceitos Chave
**Cache**: Utilização de uma camada de armazenamento temporário para acelerar o acesso a dados frequentemente solicitados, diminuindo a necessidade de execuções repetidas de consultas dispendiosas ao banco de dados.

**Redis**: Um armazenamento de estrutura de dados em memória, usado como banco de dados, cache e broker de mensagens. No contexto deste projeto, o Redis é utilizado para armazenar dados de cache, aproveitando sua alta performance e estruturas de dados avançadas para operações rápidas de chave-valor.

**Padrão Decorator**: Um padrão de design que permite a extensão de funcionalidades de objetos sem alterar o código existente. No projeto, é aplicado para adicionar comportamento de cache a repositórios existentes de forma desacoplada.

**Desacoplamento**: A técnica de separar componentes do software de maneira que mudanças em uma parte não afetem diretamente as outras. Aqui, é crucial para permitir a flexibilidade no manejo das dependências e na substituição de componentes específicos, como a implementação de cache.

## Estrutura do projeto
O projeto utiliza Laravel e Redis configurados com docker compose. As duas abordagens de cache estão implementadas em branches separadas:
- [implementacao-cache-simples](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/tree/implementacao-cache-simples-de-forma-acoplada): Implementa cache na camada de Repository do projeto.
- [implementacao-cache-usando-decorator-pattern](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/tree/implementacao-cache-usando-decorator-pattern-de-forma-desacoplada): Implementa cache de forma avançada e desacoplada usando o patter Decorator

## Arquivos importantes em cada Implementação 
### Branch: implementacao-cache-simples
- [app/Repositories/EloquentUserRepository.php](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/blob/implementacao-cache-simples-de-forma-acoplada/app/Repositories/EloquentUserRepository.php): Tem todos os detalhes da implementação de cache e invalidação de cache simples diretamente na camada de Repository
- [config/cache.php](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/blob/implementacao-cache-simples-de-forma-acoplada/config/cache.php): Configurações de cache do Laravel

### Branch: implementacao-cache-usando-decorator-pattern: 
- [app/Repositories/Decorators/CachingUserRepository.php](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/blob/implementacao-cache-usando-decorator-pattern-de-forma-desacoplada/app/Repositories/Decorators/CachingUserRepository.php): Decorator que implementa o cache e a invalidação do cache
- [app/Repositories/Interfaces/UserRepositoryInterface.php](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/blob/implementacao-cache-usando-decorator-pattern-de-forma-desacoplada/app/Repositories/Interfaces/UserRepositoryInterface.php): Interface para desacoplar a implementação da Repository
- [app/Providers/AppServiceProvider.php](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/blob/implementacao-cache-usando-decorator-pattern-de-forma-desacoplada/app/Providers/AppServiceProvider.php): Configura o bind do decorator no serviço do Laravel
- [config/cache.php](https://github.com/felipeverse/caching-with-laravel-and-decorator-pattern/blob/implementacao-cache-simples-de-forma-acoplada/config/cache.php): Configurações de cache do Laravel

## Configuração e uso
1. Clone o repositório. 
2. Instale o docker e o docker compose
3. Rode o comando `docker compose up -d` para subir o container
4. Configure o arquivo .env com as credenciais do Redis.
5. Entre no container e execute o comando `php artisan migrate` para configurar o banco de dados.
6. Acesse as diferentes branches para testar cada implementação de cache.

### Referências Utilizadas

- Documentação oficial do Laravel sobre cache: [Laravel Cache](https://laravel.com/docs/8.x/cache#redis)
- Tutorial Redis: [Redis Documentation](https://redis.io/docs/get-started/data-store/)
- Curso sobre desempenho no Laravel: [Performant Laravel](https://serversforhackers.com/laravel-perf/course)
- Padrão Decorator: [Refactoring Guru](https://refactoring.guru/design-patterns/decorator) e [DesignPatternsPHP](https://designpatternsphp.readthedocs.io/en/latest/Structural/Decorator/README.html)
- Implementação de repositórios no Laravel com decorators: [Matthew Daly's Blog](https://matthewdaly.co.uk/blog/2017/03/01/decorating-laravel-repositories/) e [Laravel Repositories with Decorators](https://github.dev/matthewbdaly/laravel-repositories)
- Uso do Docker com Laravel: [Dockerize Laravel Application](https://medium.com/@sushantkumarsinha22/dockerize-your-php-laravel-mysql-application-94333d0a1f46) e [Laravel e Redis com Docker](https://itgolabs.com/blog/pt-br/2022/03/21/rodando-laravel-e-redis-com-docker-em-5-passos/)

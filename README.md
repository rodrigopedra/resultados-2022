# Resultados eleições 2022

Quando vi esse tweet:

https://twitter.com/gzanlorenssi/status/1576634817948839936

Resolvi escrever esta aplicação para passar o tempo e segurar a ansiedade para on início das apurações.

## Requisitos

Como é feito com Laravel 9, é necessário:

- PHP >= 8.0 instalado na máquina
- composer instalado e configurado

Não requer banco de dados.

## Instalação

```
git clone git@github.com:rodrigopedra/resultados-2022
cd resultados-2022
cp .env.example .env
php artisan key:generate
```

## Execução

Um comando vai ficar rodando no Scheduler de 1 em 1 minuto. 

Como a ideia é rodar localmente apenas como exercício, não precisa mexer com `cron` ou agendador de tarefas 

Abre um terminal/console e inicia o deamnon do scheduler:

~~~
php artisan shedule:work
~~~

Deixa este terminal aberto que ele vai executar sozinho.

Para acessar a aplicação vai execute:

~~~
php artisan serve
~~~

E acesse http://127.0.0.1:8000


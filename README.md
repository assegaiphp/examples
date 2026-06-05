<div align="center" style="padding-bottom: 48px">
  <a href="https://assegaiphp.com/" target="blank">
    <img src="https://assegaiphp.com/images/logo.png" width="200" alt="Assegai Logo">
  </a>
</div>

# AssegaiPHP Examples

Learn AssegaiPHP by running small, complete applications.

This repository is the public examples home for [AssegaiPHP](https://assegaiphp.com/). Each example is designed to show one useful part of the framework in a project you can install, run, inspect, and adapt.

AssegaiPHP is a modern PHP framework for building server-side applications with controllers, modules, dependency injection, DTO validation, server-rendered UI, and optional ORM support.

## Start Here

You will need:

- PHP 8.4 or newer
- Composer 2.x
- the Assegai Console CLI

Install the CLI:

```bash
composer global require assegaiphp/console
```

Check that it is available:

```bash
assegai
```

If your shell cannot find `assegai`, add Composer's global bin directory to your `PATH`:

```bash
composer global config bin-dir --absolute
```

## Run An Example

Choose an example folder, install its dependencies, and start the development server:

```bash
cd <example-name>
composer install
assegai serve
```

Most examples run at:

```text
http://localhost:5000
```

Some examples need one extra setup step, such as copying `.env.example` to `.env`, creating a SQLite database, or starting a local service. The README inside each example folder will list those steps.

## What You Can Learn

The examples are organized around common development tasks:

- creating a first AssegaiPHP app
- building HTTP APIs with controllers and services
- using route params, request bodies, and DTO validation
- organizing features with modules and providers
- rendering pages with Twig and Assegai components
- adding browser behavior with HTMX and Web Components
- storing data with the Assegai ORM
- working with migrations, repositories, and SQLite
- adding authentication flows
- using events, queues, and background jobs
- exporting OpenAPI docs and viewing Swagger UI
- trying the OpenSwoole runtime

Each example aims to be small enough to understand in one sitting and real enough to use as a starting point.

## Create A Fresh App

If you want to start from a blank project instead of opening an example, use the CLI:

```bash
assegai new my-app
cd my-app
assegai serve
```

Then open:

```text
http://localhost:5000
```

The generated project includes a root module, controller, service, bootstrap file, and starter page.

## Example Layout

Each example is a normal AssegaiPHP project:

```text
<example-name>/
|-- README.md
|-- composer.json
|-- assegai.json
|-- config/
|-- public/
|-- src/
`-- tests/
```

The example README will tell you:

- what the example demonstrates
- how to install dependencies
- how to run the app
- which routes or pages to try
- how to run tests, when tests are included
- how to reset local data, when local data is used

## Useful Commands

Inside an example project, these are the commands you will see most often:

```bash
composer install
assegai serve
assegai test
composer test
composer analyze
```

Not every example uses every command. Follow the README in the example folder you are running.

## Contributing Examples

Contributions are welcome, especially examples that make it easier for new developers to understand one framework concept at a time.

A good example should:

- be runnable from a clean clone
- have a clear README
- keep the main idea focused
- avoid real secrets or machine-specific paths
- prefer SQLite or simple fixtures unless another service is the point of the example

## Learn More

- [AssegaiPHP Website](https://assegaiphp.com/)
- [Guide](https://assegaiphp.com/guide)
- [Support](https://assegaiphp.com/support)
- [AssegaiPHP on GitHub](https://github.com/assegaiphp)

## License

AssegaiPHP examples are MIT licensed.

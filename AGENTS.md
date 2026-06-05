# AGENTS.md

This file gives coding agents and contributors the working rules for the AssegaiPHP examples repository.

## Scope

These instructions apply to the entire repository.

The repository is for runnable example applications that teach real AssegaiPHP workflows. Keep changes practical, focused, and easy for a new framework user to run.

## Project intent

Every example should answer one clear question, such as:

- How do I build a minimal API?
- How do controllers, services, and modules fit together?
- How do I validate request DTOs?
- How do I render server-side pages?
- How do I use the ORM with SQLite?
- How do I add authentication or OAuth?
- How do I run queues, events, or OpenSwoole?

Avoid adding broad demo apps that mix many unrelated ideas unless the example is explicitly an end-to-end tutorial.

## Repository structure

Use one directory per example:

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

Directory names must be kebab-case. PHP namespaces should be valid PSR-4 namespaces and should match the example's `composer.json`.

Each example must include its own `README.md` with:

- what the example demonstrates
- requirements
- setup commands
- run commands
- test commands, if any
- important routes or URLs
- cleanup steps for generated data

## Framework conventions

- Target PHP 8.4 or newer.
- Prefer the `assegai` CLI for scaffolding projects and framework features.
- Keep controllers thin; put business behavior in services/providers.
- Use modules to group related controllers, providers, declarations, entities, and configuration.
- Use DTOs for request shapes and validation attributes for request validation.
- Prefer explicit route attributes, module imports, and provider declarations over hidden wiring.
- For server-rendered UI, use Assegai views, components, Twig, HTMX, and Web Components according to the feature being demonstrated.
- For persistence examples, prefer SQLite unless the point of the example is a specific database driver.
- For ORM examples, include entities, repositories or injected providers, migrations or setup steps, and seed data where useful.

## Dependency rules

- Examples should work from a clean clone using released `assegaiphp/*` packages.
- Do not commit `vendor/`.
- Do not commit Composer path repositories with absolute local paths.
- If local path repositories are needed while testing unreleased framework work, keep them as local-only changes.
- Keep optional services optional. If an example requires MySQL, PostgreSQL, RabbitMQ, Beanstalkd, Redis, or OpenSwoole, document the requirement and provide the smallest useful local setup.

## Secrets and generated files

Never commit real secrets, tokens, database passwords, OAuth client secrets, private keys, or machine-local paths.

Use sample files instead:

- `.env.example`
- `config/default.php`
- documented placeholders such as `replace-me`

Do not commit local runtime output unless it is intentional fixture data:

- `.env`
- `config/secure.php`
- `storage/*.sqlite`
- logs
- caches
- generated coverage reports
- temporary API exports

If a generated artifact is useful for the example, document how to regenerate it.

## Testing and verification

Before finishing changes to an example, run the narrowest meaningful verification available from that example directory.

Common commands:

```bash
composer install
composer test
composer analyze
assegai test
assegai serve
assegai api:export openapi
php -l <file>
```

Not every example will support every command. Use the scripts and instructions present in the example.

For API examples, verify representative HTTP requests and document them in the example README. For UI examples, verify the page renders in a browser and that assets load correctly.

## Documentation style

- Write for someone learning the framework.
- Keep the root `README.md` welcoming, public-facing, and focused on helping people get started.
- Avoid opening public docs with repository governance, internal planning, or contribution policy.
- Keep each example README task-oriented.
- Include commands in copyable fenced code blocks.
- Name the expected URL, route, or command output when it helps.
- Explain why the example exists, but let the code carry most of the teaching.
- Avoid claiming production readiness for examples.

## Commit and PR style

Use the AssegaiPHP commit convention:

```text
type(scope): short summary
```

Recommended types:

- `fix`
- `feature`
- `docs`
- `test`
- `refactor`
- `chore`

Examples:

```text
docs(examples): add ORM SQLite notes walkthrough
feature(auth): add GitHub OAuth session example
test(api): cover kitchen orders request validation
```

Keep commits small, single-purpose, and easy to review.

## Agent workflow

When modifying this repository:

1. Inspect the target example before editing.
2. Preserve unrelated user changes.
3. Keep edits scoped to the requested example or documentation.
4. Update the relevant README whenever setup, routes, commands, or dependencies change.
5. Run available verification commands and report what passed.
6. If verification cannot run because dependencies or services are missing, say exactly what blocked it.

Prefer small, real examples over clever scaffolding. The best contribution here is code a reader can run, inspect, and adapt.

[![CI Workflow](https://github.com/bpolaszek/rolladice/actions/workflows/ci.yml/badge.svg)](https://github.com/bpolaszek/rolladice/actions/workflows/ci.yml)
[![Coverage](https://codecov.io/gh/bpolaszek/rolladice/branch/main/graph/badge.svg?token=L5ulTaymbt)](https://codecov.io/gh/bpolaszek/rolladice)

# RollADice

An API-Platform 3.x example app about managing Gaming Clubs.

## Run Tests

The following personas are used to run integration tests:

- **Bob** is _owner_ of the Backgammon club **Triangles**
- **Alice** is _admin_ of this club (she can add other members, but cannot revoke **Bob**)
- **Bob** is _member_ of the Chess club **Chessy**
- **Alice** is not member of **Chessy**, so she cannot play chess with **Bob**

```bash
composer ci:check
```

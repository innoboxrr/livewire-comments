# Livewire Comments

**A comment system for Laravel, rendered with Livewire.**

Drop the component onto a page and get a working comment thread — posting, listing and deletion — without writing any JavaScript.

```blade
<livewire:comment :model="$article" />
```

## What ships

| | |
|---|---|
| `Livewire/Comment` | The component that renders and drives the thread |
| `Models/Comment` | Polymorphic comment model — attach to any record |
| `Http/Controllers/CommentController` | REST endpoints for the comment resource |
| `resources/views/` | `comments.blade.php` and `comment.blade.php`, both publishable |
| `config/lwc.php` | Configuration — table name, pagination, authorisation |

Authorisation runs through a dedicated auth service provider, so who may post, edit or delete is a policy decision in your application rather than a setting in this package.

## Why Livewire

A comment thread is mostly server state: who can see what, who may edit what, what is published. Rendering it server-side keeps that authorisation logic in one place instead of duplicating it in a client-side store where it can drift.

If you want the Tailwind-styled variant, see [wirecomments](https://github.com/innoboxrr/wirecomments).

## Install

```bash
composer require innoboxrr/livewire-comments
php artisan vendor:publish --tag=lwc-config
php artisan migrate
```

---

Part of [Innobox R&R](https://github.com/innoboxrr) — 52 open-source packages extracted from production work. **[innobox.systems](https://innobox.systems)**

# Livewire Comments

**Embed the Innoboxrr comment service in a Laravel page, with a Livewire component.**

The component does not store comments itself: it renders the embed script of the external comment service configured in `lwc.base_url` (by default `https://comment-system.innoboxrr.com`) and passes it the block, the signed-in user and their avatar. The package also exposes read-only pages that list comments fetched from that service.

```blade
<livewire:lwc-comment block-id="lesson-42" title="Publicar comentario" role="student" />
```

| Parameter | Default | |
|---|---|---|
| `block-id` | the current URL | The thread the comments belong to |
| `title` | `Publicar comentario` | Heading shown by the embed |
| `role` | `student` | Any other role shows a "Ver reporte de foro" link to the host route `forum.report` — define that route if you use it |

The component needs an authenticated user (`auth()->user()->name`).

## What ships

| | |
|---|---|
| `Livewire\Comment` | The `lwc-comment` component |
| `GET user/{id}/avatar` (`lwc.comments.user.avatar`) | Redirects to `$user->avatar` of `lwc.user_class` |
| `GET block/{blockId}/user/{userId}/comments` | One user's comments in one block |
| `GET block/{blockId}/comments` | All comments in a block |
| `GET user/{userId}/comments` | All comments by a user |
| `config/lwc.php` | `user_class` and `base_url` |

The three listing routes read from the service API and cache the answer for one second; if the service fails they show an empty list.

## Install

Requires PHP 8.3, Laravel 13 and Livewire 3.7.11+ or 4.

```bash
composer require innoboxrr/livewire-comments
php artisan vendor:publish --tag=lwc-config
```

---

Part of [Innobox R&R](https://github.com/innoboxrr) — 52 open-source packages extracted from production work. **[innobox.systems](https://innobox.systems)**

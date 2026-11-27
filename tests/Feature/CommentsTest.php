<?php

namespace Innoboxrr\LivewireComments\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Innoboxrr\LivewireComments\Livewire\Comment;
use Innoboxrr\LivewireComments\Tests\Fixtures\User;
use Innoboxrr\LivewireComments\Tests\TestCase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;

/**
 * El componente y las rutas, con el servicio de comentarios simulado.
 */
final class CommentsTest extends TestCase
{
    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:' . base64_encode(str_repeat('a', 32)));
        $app['config']->set('lwc.user_class', User::class);
        $app['config']->set('lwc.base_url', 'https://comments.example.test');
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();

        Http::fake([
            'comments.example.test/*' => Http::response([
                ['comment' => 'Muy claro', 'data' => ['CUSER_NAME' => 'Ana'], 'created_at' => '2026-11-27 10:00:00'],
            ]),
        ]);
    }

    /**
     * Antes la accion validaba blockId y userId como entrada de la peticion,
     * donde no estan: la ruta respondia siempre con el error de validacion.
     */
    #[Test]
    public function lista_los_comentarios_de_un_usuario_en_un_bloque(): void
    {
        $this->get('block/b-1/user/7/comments')
            ->assertOk()
            ->assertSee('Muy claro')
            ->assertSee('Ana');

        Http::assertSent(fn (Request $request) => $request->url() === 'https://comments.example.test/api/get-comments/b-1/7');
    }

    #[Test]
    public function lista_los_comentarios_de_un_bloque_y_de_un_usuario(): void
    {
        $this->get(route('lwc.comments.block.comments.index', 'b-1'))->assertOk()->assertSee('Muy claro');
        $this->get(route('lwc.comments.user.comments.index', 7))->assertOk()->assertSee('Muy claro');

        Http::assertSent(fn (Request $request) => $request->url() === 'https://comments.example.test/api/comments/filter/content/b-1');
        Http::assertSent(fn (Request $request) => $request->url() === 'https://comments.example.test/api/comments/filter/user/7');
    }

    #[Test]
    public function si_el_servicio_falla_muestra_la_lista_vacia(): void
    {
        config(['lwc.base_url' => 'https://down.example.test']);
        Http::fake(['down.example.test/*' => Http::response('caido', 503)]);

        $this->get(route('lwc.comments.block.comments.index', 'b-2'))->assertOk()->assertDontSee('Muy claro');
    }

    #[Test]
    public function el_avatar_redirige_a_la_imagen_del_usuario(): void
    {
        $user = User::forceCreate(['name' => 'Ana', 'email' => 'ana@example.test', 'password' => 'x']);

        // avatar no es columna: en la aplicacion suele ser un accesor.
        User::retrieved(fn (User $model) => $model->setAttribute('avatar', 'https://img.example.test/ana.png'));

        $this->get(route('lwc.comments.user.avatar', $user->id))->assertRedirect('https://img.example.test/ana.png');
        $this->get(route('lwc.comments.user.avatar', 999))->assertNotFound();
    }

    #[Test]
    public function el_componente_incrusta_el_sistema_de_comentarios(): void
    {
        $user = User::forceCreate(['name' => 'Ana', 'email' => 'ana@example.test', 'password' => 'x']);

        $this->actingAs($user);

        Livewire::test(Comment::class, ['blockId' => 'b-1', 'title' => 'Opina'])
            ->assertSet('blockId', 'b-1')
            ->assertSet('callback', url('/blocks/b-1/user/' . $user->id . '/comments'))
            ->assertSee('commentSystem_ContentID="b-1"', false)
            ->assertSee('commentSystem_Title="Opina"', false);
    }

    #[Test]
    public function el_componente_se_registra_con_su_nombre(): void
    {
        $this->actingAs(User::forceCreate(['name' => 'Ana', 'email' => 'ana@example.test', 'password' => 'x']));

        Livewire::test('lwc-comment', ['blockId' => 'b-9'])->assertSee('commentSystem_ContentID="b-9"', false);
    }
}

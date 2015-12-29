<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase {

    use DatabaseTransactions;

    protected $title = 'Cursos de Interfaces Dinamicas';
    protected $link = 'https://styde.net/curso-de-interfaces-dinamicas-con-laravel-y-jquery/';

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_create_resource()
    {
        // Having
        $user = seed('User');

        // When
        $this->actingAs($user)
            ->visit(route('tickets.create'))
            ->type($this->title, 'title')
            ->type($this->link, 'link')
            ->press('Enviar Solicitud');

        // Then
        $this->see($this->title)
            ->seeLink('Ver recurso', $this->link);

        $this->seeInDatabase('tickets', [
            'title' => $this->title,
            'link' => $this->link,
            'status' => 'closed',
        ]);
    }

}

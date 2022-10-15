<?php

namespace Tests\Middlewares;

use Lmc\HttpConstants\Header;
use Tests\TestCase;

class OnlyApiTest extends TestCase
{
    protected $groups = 'api';

    public function testApi(): void
    {
        $this
            ->get('api')
            ->assertSuccessful()
            ->assertHeader(Header::ACCEPT, 'application/json')
            ->assertJsonStructure(['data'])
            ->assertJson(['data' => 'Hello, Api!']);
    }

    public function testWeb(): void
    {
        $this
            ->get('web')
            ->assertSuccessful()
            ->assertHeaderMissing(Header::ACCEPT)
            ->assertJsonStructure(['data'])
            ->assertJson(['data' => 'Hello, Web!']);
    }

    public function testCustom(): void
    {
        $this
            ->get('custom')
            ->assertSuccessful()
            ->assertHeaderMissing(Header::ACCEPT)
            ->assertJsonStructure(['data'])
            ->assertJson(['data' => 'Hello, Custom!']);
    }

    public function testCustomHeader(): void
    {
        $this
            ->get('custom', [Header::ACCEPT => 'application/xml'])
            ->assertSuccessful()
            ->assertHeaderMissing(Header::ACCEPT)
            ->assertJsonStructure(['data'])
            ->assertJson(['data' => 'Hello, Custom!']);
    }

    public function testAsterisk(): void
    {
        $this
            ->get('custom', [Header::ACCEPT => '*/*'])
            ->assertSuccessful()
            ->assertHeaderMissing(Header::ACCEPT)
            ->assertJsonStructure(['data'])
            ->assertJson(['data' => 'Hello, Custom!']);
    }
}
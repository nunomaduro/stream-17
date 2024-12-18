<?php

it('renders the home page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

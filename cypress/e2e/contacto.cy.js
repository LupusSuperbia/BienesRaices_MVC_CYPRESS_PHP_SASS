///  <reference types="cypress" />

describe('Prueba el Formulario de Contacto', () => {
    it('Prueba la pagina de contacto y el envio de emails', () => {
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');

        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'Formulario Contacto');
        
        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Llene el formulario');
        cy.get('[data-cy="formulario-contacto"]').should('exist');

        
    })

    it('Llenar el formulario', () => {
        cy.get('[data-cy = "input-nombre"]').type('Agustin');
        cy.get('[data-cy = "input-mensaje"]').type('Deseo comprar una casa');
        cy.get('[data-cy = "input-opciones"]').select('Compra');
        cy.get('[data-cy = "input-precio"]').type('120000');
        cy.get('[data-cy = "forma-contacto"]').eq(1).check();

        cy.wait(3000);
        
        cy.get('[data-cy = "forma-contacto"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type('14312451');
        cy.get('[data-cy="input-fecha"]').type('2022-05-06');
        cy.get('[data-cy="input-hora"]').type('22:38');

        cy.get('[data-cy="formulario-contacto"]').submit();

        
        cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
        cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal', 'Mensaje Enviado Correctamente')
        cy.get('[data-cy="alerta-envio-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').should('not.have.class', 'error');
    })
})
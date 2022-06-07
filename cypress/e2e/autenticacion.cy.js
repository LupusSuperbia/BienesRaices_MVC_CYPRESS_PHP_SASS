///  <reference types="cypress" />

describe('Probar la autenticacion', () => {
    it('Prueba la autennticacion en /login', () => {
        cy.visit('/login'); 

        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar Sesión');

        cy.get('[data-cy="formulario-login"]').should('exist');

        // Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error').and('have.class', 'alerta');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El Email es obligatorio')


        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error').and('have.class', 'alerta');
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'El Password es obligatorio')
        // El usuario exista


        // Verefica el password
    })
})